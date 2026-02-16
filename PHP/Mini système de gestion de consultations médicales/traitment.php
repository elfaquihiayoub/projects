<?php 

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
    


    
}
















?>