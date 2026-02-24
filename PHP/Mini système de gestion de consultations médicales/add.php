<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Consultation</title>
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
</head>
<body>

    <h2>Ajouter une Consultation Médicale</h2>

    <form action="taritement.php" method="POST">

        <h3>Informations Patient</h3>

        <label>Nom :</label><br>
        <input type="text" name="nom"><br><br>

        <label>Prénom :</label><br>
        <input type="text" name="prenom"><br><br>

        <label>Date de naissance :</label><br>
        <input type="date" name="date_naissance"><br><br>

        <label>Sexe :</label><br>
        <select name="sexe">
            <option value="">-- Choisir --</option>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select><br><br>

        <label>Téléphone :</label><br>
        <input type="text" name="telephone"><br><br>


        <h3>Données de la Consultation</h3>

        <label>Date de consultation :</label><br>
        <input type="date" name="date_consultation"><br><br>

        <label>Motif de consultation :</label><br>
        <textarea name="motif_de_consultation"></textarea><br><br>

        <label>Température (°C) :</label><br>
        <input type="number" step="0.1" name="temperature"><br><br>

        <label>Tension systolique :</label><br>
        <input type="number" name="tension_systolique"><br><br>

        <label>Tension diastolique :</label><br>
        <input type="number" name="tension_diastolique"><br><br>

        <label>Poids (kg) :</label><br>
        <input type="number" step="0.1" name="poids"><br><br>

        <label>Taille (m) :</label><br>
        <input type="number" step="0.01" name="taille"><br><br>

        <label>Symptômes :</label><br>
        <select name="symptomes[]" multiple>
            <option value="Fièvre">Fièvre</option>
            <option value="Toux">Toux</option>
            <option value="Fatigue">Fatigue</option>
            <option value="Douleur">Douleur</option>
            <option value="Maux de tête">Maux de tête</option>
        </select><br><br>

        <button type="submit">Enregistrer</button>

    </form>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
new TomSelect("select[name='symptomes[]']", {
    plugins: ['remove_button'],
    placeholder: "Choisir les symptômes...",
    maxItems: null, 
    hideSelected: true
});
</script>
</body>
</html>