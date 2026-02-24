<?php

require 'function.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "acces non autoriser";
    exit;
}


    $data = $_POST;

    

    $erreurs1 = val_champs_obligatoires($data);
        if (!empty($erreurs1)) {
        foreach ($erreurs1 as $message) {
        echo "- $message <br>";
    }
    exit;
}
    $erreurs2 = val_mesures_Numb($data, $mesures);
    if (!empty($erreurs2)) {
        foreach ($erreurs2 as $message) {
        echo "- $message <br>";
    }

    exit;
}
    $erreurs3 = val_date_consultation($data);


    if (!empty($erreurs3)) {
        foreach ($erreurs3 as $message) {
        echo "- $message <br>";
    }

    exit;
}





    $age = calcul_age($data['date_naissance']);

    $imc = calcul_imc(
        $data['poids'],
        $data['taille']
    );

    $temp = classifier_temperature($data['temperature']);

    $tension = classifier_tension(
   $data['tension_systolique'],
       $data['tension_diastolique']
    );

    $imc_res = classifier_imc($imc);

   





    $alert = generer_alerte($temp, $tension, $imc_res);

    $generatedId=generer_id_patient();
    

$resultat = [
    "id"=>$generatedId,
    "nom" => $data['nom'],
    "prenom" => $data['prenom'],
    "sexe" => $data['sexe'],
    "telephone" => $data['telephone'],
    "age" => $age,

    "date_consultation" => $data['date_consultation'],
    "motif" => $data['motif_de_consultation'],
    "symptomes" => $data['symptomes'],

    "temperature" => $temp,

    
    "tension" => $tension,

    "poids" => $data['poids'],
    "taille" => $data['taille'],
    "imc_etat" => $imc_res,

    // Alert
    "alert" => $alert
];


if(file_exists(DATA_FILE)){
    $data_content=file_get_contents(DATA_FILE);
    $consultations=json_decode($data_content,true);
}else{
    $consultations=[];
}
$consultations[]=$resultat;
$jsonData=json_encode($consultations,JSON_PRETTY_PRINT);
file_put_contents(DATA_FILE,$jsonData);

echo "ur consultation savad succefuly";















// echo "<h2>Résultat</h2>";

// echo "Nom: ".$data['nom']."<br>";
// echo "Prénom: ".$data['prenom']."<br>";
// echo "telephonne : ".$data['telephone']."<br>";
// echo "Age: $age <br>";
// echo "motif : ".$data['motif_de_consultation']."<br>";
// echo "date de consultation : ".$data['date_consultation']."<br>";
// echo "Sexe: ".$data['sexe']."<br>";
// echo "Température: ".$temp['etat']. " (". $temp['level'].") ". $temp['temp'] . "°C" . " <br>";
// echo "Tension: ".$tension['etat']. " (". $tension['level'].") ".$tension['sys'] . "/" . $tension['dia']." <br>";
// echo "Taille: ".$data['taille']."m <br>";
// echo "IMC état: ".$imc_res['etat'].$data['poids'] ."<br>";
// echo" symptomes: ".implode(' , ', $data['symptomes'])."<br>";
// echo "<h3>$alert</h3>";






















