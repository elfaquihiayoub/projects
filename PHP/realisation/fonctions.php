<?php

// the verifierNotes function declaration
function verifierNotes(array $notes){

    foreach ($notes as $matiere => $notesAll) {

        foreach ($notesAll as $note) {

            if ($note === "" || !is_numeric($note) || $note < 0 || $note > 20) {
                return false;
            }
        }
    }


    return true;
};
// calcule moyen per subject 

function calculerMoyenPerSubject(array $notes){
    $moyenTotal=[];
    foreach ($notes as $matiere => $notesAll) {
        $moyenTotal[$matiere]=array_sum($notesAll)/count($notesAll);

    }
    return $moyenTotal;
};

// calcule la moyenGeneral de bulltein
function moyenGeneral(array $moyenTotal){
    
    return array_sum($moyenTotal)/count($moyenTotal);
};
// moyen general variable stocked !!!


// get montion function
function getMention($moyenne) {

    if ($moyenne >= 16) return "Très Bien";
    elseif ($moyenne >= 14) return "Bien";
    elseif ($moyenne >= 12) return "Assez Bien";
    elseif ($moyenne >= 10) return "Passable";
    else return "Aucune mention";
};
// get decision function
function decisionFinale($moyenne) {
    return ($moyenne >= 10) ? "Admis" : "Ajourné";
}


?>