<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultations List</title>
    <style>
        /* Style sghir bach yban l-jadwel mzyan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<?php
require("function.php");

$consultations = get_consultation();

    if (empty($consultations)) {
        echo "<p class='no-data'>Aucune consultation trouvée.</p>";
    } else {
        echo "<div class='table-responsive'>";
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Sexe</th>
                    <th>Âge</th>
                    <th>Téléphone</th>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Température</th>
                    <th>Tension</th>
                    <th>Poids</th>
                    <th>Taille</th>
                    <th>Symptômes</th>
                </tr>
              </thead>";
        echo "<tbody>";
        
        foreach ($consultations as $c) {
            // Sécurisation des données affichées
            $nom = htmlspecialchars($c["nom"] . " " . $c["prenom"]);
            $symptomes = htmlspecialchars(implode(", ", $c["symptomes"] ?? []));
            
            // Formatage des badges pour les constantes
            $tempBadge = "<span class='badge badge-temp'>{$c['temperature']['temp']}°C ({$c['temperature']['etat']})</span>";
            $tensionVal = $c["tension"]["sys"] . "/" . $c["tension"]["dia"];
            $tensionBadge = "<span class='badge badge-tension'>{$tensionVal}</span>";

            echo "<tr>";
            echo "<td><strong>" . htmlspecialchars($c["id"]) . "</strong></td>";
            echo "<td>{$nom}</td>";
            echo "<td>" . htmlspecialchars($c["sexe"]) . "</td>";
            echo "<td>" . htmlspecialchars($c["age"]) . "</td>";
            echo "<td>" . htmlspecialchars($c["telephone"]) . "</td>";
            echo "<td>" . htmlspecialchars($c["date_consultation"]) . "</td>";
            echo "<td>" . htmlspecialchars($c["motif"]) . "</td>";
            echo "<td>{$tempBadge}</td>";
            echo "<td>{$tensionBadge}</td>";
            echo "<td>" . htmlspecialchars($c["poids"]) . " kg</td>";
            echo "<td>" . htmlspecialchars($c["taille"]) . " m</td>";
            echo "<td>{$symptomes}</td>";
            echo "</tr>";
        }
        
        echo "</tbody></table></div>";
    }
    ?>
</div>

</body>
</html>