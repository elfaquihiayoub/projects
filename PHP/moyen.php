<?php
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    
    $nom = trim($_POST['nom']);
    $note_1 = trim($_POST['note_1']);
    $note_2 = trim($_POST['note_2']);
    $note_3 = trim($_POST['note_3']);
    $moyenne= 0;

    if (empty($note_1) || empty($note_2) ||empty($note_3) || empty($nom) ) {
        echo "saisir tous les champes";
    }
    else{
        $notes=[$note_1,$note_2,$note_3];
    }

   
    foreach ($notes as $note ) {
        if ($note <=0  && $note >=20){
            echo " les notes ne sont pas entre 0 et 20 ";
            break;
        }
    }

}


function calculerMoyenne($notes) {
   if(count($notes)>0){
    global $moyenne;
    $moyenne=0;
    $moyenne= array_sum($notes)/count($notes);
    return $moyenne;
   }
   else{
    echo "error";
   }

}


function getMention($moyenne) {
    if ($moyenne >= 18 && $moyenne <= 20) {
        echo "Vous êtes admis avec mention Excellent";
    }

    elseif ($moyenne >= 16 && $moyenne < 18) {
        echo "Vous êtes admis avec mention Très Bien";
    }

    elseif ($moyenne >= 14 && $moyenne < 16) {
        echo "Vous êtes admis avec mention Bien";
    }

    elseif ($moyenne >= 12 && $moyenne < 14) {
        echo "Vous êtes admis avec mention assez_bien";
    }
    elseif ($moyenne >= 10 && $moyenne < 12) {
        echo "Vous êtes admis avec mention Passable";
    }
    else { 
        echo "Vous n'êtes pas admis !!!";
    }
}
calculerMoyenne($notes);
getMention($moyenne);





?>