<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>students notes</title>
</head>
<body>

   

    <form action="traitement.php" method="POST">

        <h3>student infos</h3>

        <label>Nom :</label>
        <input type="text" name="nom" required><br><br>


        <label>Date de naissance :</label>
        <input type="date" name="date_naissance" required><br><br>

        <label>Filière:</label>
        <input type="text" name="filiere" required><br><br>

        <h3>Notes</h3>

        <h4>Frontend</h4>
        <input type="number" name="frontend1" min="0" max="20" step="0.25" placeholder="note1" required >
        <input type="number" name="frontend2" min="0" max="20" step="0.25" required placeholder="note2">

        <h4>Backend</h4>
        <input type="number" name="backend1" min="0" max="20" step="0.25" required placeholder="note1">
        <input type="number" name="backend2" min="0" max="20" step="0.25" required placeholder="note2">

        <h4>Entreprenariat</h4>
        <input type="number" name="entre1" min="0" max="20" step="0.25" required placeholder="note1">
        <input type="number" name="entre2" min="0" max="20" step="0.25" required placeholder="note2">

        <h4>Anglais</h4>
        <input type="number" name="anglais1" min="0" max="20" step="0.25" required placeholder="note1">
        <input type="number" name="anglais2" min="0" max="20" step="0.25" required placeholder="note2">

        <h4>Soft Skills</h4>
        <input type="number" name="soft1" min="0" max="20" step="0.25" required placeholder="note1">
        <input type="number" name="soft2" min="0" max="20" step="0.25" required placeholder="note2">

        <br><br>

        <button type="submit">Générer le bulletin</button>
        <button type="reset">Réinitialiser</button>

    </form>
    <?php

 echo "<h2>Bulletin de l'étudiant</h2>";
echo "<p><strong>Nom :</strong> $nom</p>";
echo "<p><strong>Prénom :</strong> $prenom</p>";
echo "<p><strong>Date de naissance :</strong> $dateNaissance</p>";
echo "<p><strong>Filière :</strong> $filiere</p>";

echo "<h3>Notes par matière</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Matière</th><th>Note 1</th><th>Note 2</th><th>Moyenne</th></tr>";

foreach ($notes as $matiere => $notesAll) {
    $moyenne = $moyennesParMatiere[$matiere];
    echo "<tr>";
    echo "<td>$matiere</td>";
    echo "<td>{$notesAll[0]}</td>";
    echo "<td>{$notesAll[1]}</td>";
    echo "<td>$moyenne</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>Moyenne Générale : $moyenneGenerale</h3>";
echo "<h3>Mention : $mention</h3>";
echo "<h3>Décision Finale : $decision</h3>";


    ?>
   

</body>
</html>



