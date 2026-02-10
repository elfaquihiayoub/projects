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
   
     echo "<h2>Bulletin de l'étudiant</h2>";
echo "<p><strong>Nom :</strong> $nom</p>";
echo "<p><strong>Date de naissance :</strong> $dateNaissance</p>";
echo "<p><strong>Filière :</strong> $filiere</p>";

echo "<h3>Notes par matière</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Matière</th><th>Note 1</th><th>Note 2</th><th>Moyenne</th></tr>";

foreach ($notes as $matiere => $notesAll) {
    $moyenne = $moyenPerSubject[$matiere];
    echo "<tr>";
    echo "<td>$matiere</td>";
    echo "<td>{$notesAll[0]}</td>";
    echo "<td>{$notesAll[1]}</td>";
    echo "<td>$moyenne</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>Moyenne Générale : $moyenGeneral</h3>";
echo "<h3>Mention : $montion</h3>";
echo "<h3>Décision Finale : $decision</h3>";

    
}




};





?>