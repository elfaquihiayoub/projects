<?php

require("fonctions.php");
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    // students informations!!!

    $nom=$_POST["nom"];
    $dateNaissance =$_POST["date_naissance"];
    $filiere =$_POST["filiere"];

// notes of the current srudent !!!
        $notes = [
    "Frontend" => [$_POST['frontend1'], $_POST['frontend2']],
    "Backend" => [$_POST['backend1'], $_POST['backend2']],
    "Entreprenariat" => [$_POST['entre1'], $_POST['entre2']],
    "Anglais" => [$_POST['anglais1'], $_POST['anglais2']],
    "Soft Skills" => [$_POST['soft1'], $_POST['soft2']]
];
if(!verifierNotes($notes)){
    echo "<h3>  ERROR : ONE OR MORE NOTES ARE INVALIDE</h3>";
    exit;

}else{
    $moyenPerSubject= calculerMoyenPerSubject($notes);
    $moyenGeneral=moyenGeneral($moyenPerSubject);
    $moyenGeneral=moyenGeneral($moyenPerSubject);
    $montion=getMention($moyenGeneral);
    $decision=decisionFinale($montion);

    // bultun___________________________________________
   

    
}




};




require("index.php");
?>;