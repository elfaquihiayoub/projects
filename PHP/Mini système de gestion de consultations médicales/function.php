<?php
define("DATA_FILE","data/consultation.json");
function val_champs_obligatoires($data) {
    $erreurs = [];

    $champs = [
        'nom',
        'prenom',
        'date_naissance',
        'sexe',
        'telephone',
        'date_consultation',
        'motif_de_consultation',
        'poids',
        'taille',
        'temperature',
        'tension_systolique',
        'tension_diastolique',
    ];
    
    foreach ($champs as $champ) {
        if (!isset($data[$champ]) || trim($data[$champ]) == '') {
            $erreurs[$champ] = 'Veuillez remplir le champ ' . $champ;
        }       
    }
    
    if (!isset($data['symptomes']) || empty($data['symptomes'])) {
        $erreurs['symptomes'] = 'Veuillez choisir au moins un symptôme';
    }
    
    return $erreurs;
}

function val_mesures_Numb($data, $mesures) {
    $erreurs = [];

    foreach ($mesures as $key => $config) {
        $value = $data[$key] ?? null;
        
        if (!is_numeric($value)) {
            $erreurs[$key] = "Le champ {$config['label']} doit être un nombre";
            continue;
        }
        
        $number = (float) $value;
        
        if ($number < $config['min']) {
            $erreurs[$key] = "{$config['label']} doit être ≥ {$config['min']}";
            continue;
        }
        
        if ($number > $config['max']) {
            $erreurs[$key] = "{$config['label']} doit être ≤ {$config['max']}";
            continue;
        }
    }
    
    return $erreurs;
}

$mesures = [
    "temperature" => [
        "label" => "Température",
        "min" => 35,
        "max" => 42
    ],
    "poids" => [
        "label" => "Poids",
        "min" => 2,
        "max" => 250
    ],
    "taille" => [
        "label" => "Taille",
        "min" => 0.5,
        "max" => 2.5
    ],
    "tension_systolique" => [
        "label" => "Tension systolique",
        "min" => 80,
        "max" => 200
    ],
    "tension_diastolique" => [
        "label" => "Tension diastolique",
        "min" => 40,
        "max" => 130
    ]
];

function val_date_consultation($data) {
    $erreurs = [];

    $date = $data['date_consultation'] ?? '';

    $date_consultation = strtotime($date);
    $today = strtotime(date("Y-m-d"));

    if ($date_consultation === false) {
        $erreurs['date_consultation'] = "Format de date invalide (attendu : AAAA-MM-JJ)";
    } elseif ($date_consultation > $today) {
        $erreurs['date_consultation'] = "La date de consultation ne peut pas être dans le futur";
    }

    return $erreurs;
}

function calcul_age($date_naissance) {
    $naissance = new DateTime($date_naissance);
    $today = new DateTime();
    
    $age = $today->diff($naissance);
    
    return $age->y;
}

function calcul_imc($poids, $taille) {
    $imc = $poids / ($taille * $taille);
    return round($imc, 2);
}

function classifier_temperature($temperature) {
    $ranges = [
        ["min" => 41,   "max" => 42,   "etat" => "Hyperthermie dangereuse",     "level" => 5],
        ["min" => 39,   "max" => 40.9, "etat" => "Fièvre élevée - Risque",       "level" => 4],
        ["min" => 38,   "max" => 38.9, "etat" => "Fièvre",                       "level" => 3],
        ["min" => 37.5, "max" => 37.9, "etat" => "Élévation légère",             "level" => 2],
        ["min" => 35,   "max" => 37.4, "etat" => "Température normale",          "level" => 0],
    ];

    foreach ($ranges as $range) {
        if ($temperature >= $range["min"] && $temperature <= $range["max"]) {
            return [
                "etat"  => $range["etat"],
                "level" => $range["level"],
                "temp"  => $temperature
            ];
        }
    }

    return ["etat" => "Valeur non valide médicalement", "level" => 5];
}

function classifier_tension($sys, $dia) {
    $thresholds = [
        ["sys" => 180, "dia" => 120, "etat" => "Urgence hypertensive",       "level" => 5],
        ["sys" => 160, "dia" => 100, "etat" => "Hypertension sévère",        "level" => 4],
        ["sys" => 140, "dia" => 90,  "etat" => "Hypertension artérielle",    "level" => 3],
        ["sys" => 130, "dia" => 85,  "etat" => "Pré-hypertension",           "level" => 2],
        ["sys" => 120, "dia" => 80,  "etat" => "Tension légèrement élevée",  "level" => 1],
        ["sys" => 90,  "dia" => 60,  "etat" => "Tension normale",            "level" => 0],
    ];

    foreach ($thresholds as $data) {
        if ($sys >= $data["sys"] || $dia >= $data["dia"]) {
            return [
                "etat" => $data["etat"],
                "level" => $data["level"],
                "sys"  => $sys,
                "dia"  => $dia
            ];
        }
    }

    return ["etat" => "Tension normale"];
}

function classifier_imc($imc) {
    $ranges = [
        ["min" => 40,    "max" => 50,   "etat" => "Obésité morbide",          "level" => 5],
        ["min" => 35,    "max" => 39.9,  "etat" => "Obésité sévère (classe 2)", "level" => 4],
        ["min" => 30,    "max" => 34.9,  "etat" => "Obésité modérée (classe 1)", "level" => 3],
        ["min" => 25,    "max" => 29.9,  "etat" => "Surpoids",                  "level" => 2],
        ["min" => 18.5,  "max" => 24.9,  "etat" => "Poids normal",              "level" => 0],
        ["min" => 16,    "max" => 18.4,  "etat" => "Insuffisance pondérale",    "level" => 2],
        ["min" => 0,     "max" => 15.9,  "etat" => "Dénutrition sévère",        "level" => 4],
    ];

    foreach ($ranges as $range) {
        if ($imc >= $range["min"] && $imc <= $range["max"]) {
            return [
                "etat"  => $range["etat"],
                "level" => $range["level"],
                "imc"   => $imc
            ];
        }
    }

    return ["etat" => "Valeur non réaliste", "level" => 5];
}


function generer_id_patient(){
    return "PAT-".date("Ymd")."-".rand(1000,9999);

};



function get_consultation(){
    if(!file_exists(DATA_FILE)){
        return[];
    } 
    $data=file_get_contents(DATA_FILE);
    if(empty($data)){
        return[];
    }
    $consultation=json_decode($data,true);
    return $consultation;
    

};


function generer_alerte($temp_result, $tension_result, $imc_result) {
    $elements = [
        "Température"   => $temp_result["level"],
        "Tension"       => $tension_result["level"],
        "IMC"           => $imc_result["level"]
    ];

    $critique = [];
    $surveillance = [];

    foreach ($elements as $label => $level) {
        if ($level >= 4) {
            $critique[] = $label;
        } elseif ($level >= 2) {
            $surveillance[] = $label;
        }
    }

    if (!empty($critique)) {
        return "🚨 État critique détecté : " . implode(" + ", $critique);
    }

    if (!empty($surveillance)) {
        return "⚠️ Surveillance recommandée : " . implode(" + ", $surveillance);
    }

    return "✅ État stable";
}




?>