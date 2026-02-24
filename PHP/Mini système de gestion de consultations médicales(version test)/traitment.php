<?php 
require("function.php");

if ($_SERVER["REQUEST_METHOD"]==="POST") {
    // patient data

    $name=$_POST["name"];
    $sex=$_POST["sex"];
    $birth_date=$_POST["date_nessance"];
    $tel=$_POST["telephone"];

    // consultation data
    $dateConsultation=$_POST["date_consultation"];
    $motif=$_POST["motif"];
    $temperature=$_POST["temperatur"];
    $tension_systolique=$_POST["tension_systolique"];
    $tension_diastolique=$_POST["tension_diastolique"];
    $poids=$_POST["poids"];
    $taille=$_POST["taille"];
    $symptomes=$_POST["symptomes"];
    
    $result=validation($name,$sex,$birth_date,
     $tel, $dateConsultation, $motif,$temperature,
     $tension_systolique,$tension_diastolique,$poids,
     $taille,$symptomes
     ) ;


    //  cheching the function

    if ($result===true) {
        

        // create consultation---------------------

            
        $idPatient="PAT-".date("Ymd")."-".rand(1000,9999);

        $newConsultation=[
            "id"=>$idPatient,
            "patiend"=>[
                "name"=>$name,
                "sex"=>$sex,
                "birthday"=>$birth_date,
                "tel"=>$tel,
            ],
            "consultation"=>[
                "date_cosultation"=>$dateConsultation,
                "motif"=>$motif,
                "temperature"=>$temperature,
                "tension_systolique"=>$tension_systolique,
                "tension_diastolique"=>$tension_diastolique,
                "poids"=>$poids,
                "taille"=>$taille,
                "symptomes"=>$symptomes
            ],

        ];

    // file traitment



        define("DATA_FILE","data/consultations.json");
        // checkingfile existance and read data
        
        if(file_exists(DATA_FILE)){
            $data_content=file_get_contents(DATA_FILE);
            $consultations=json_decode($data_content,true);

        }
        else{
            $consultations=[];

        }

        // adding new consultation
        $consultations[]=$newConsultation;
        // conversion data into json format
        $jsonData= json_encode($consultations,JSON_PRETTY_PRINT);

        // saving the consultaion

        file_put_contents(DATA_FILE,$jsonData);



    echo "ur consultation saved succesfuly";


    }
    else{
        echo "<ul>";
        foreach($result as $error){
             echo "<li>$error</li>";
        }
        echo "</ul>";
    }


    
}
















?>