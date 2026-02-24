

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Consultations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f6f9;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<?php


require("
.php");

$consultations=getConsultations();



echo "<body>";
echo "<h2>Consultations List</h2>";

// Check if there are consultations
if (empty($consultations)) {
    echo "<p>No consultations found.</p>";
} else {
    
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Sex</th>
            <th>Birth Date</th>
            <th>Telephone</th>
            <th>Consultation Date</th>
            <th>Motif</th>
            <th>Temperature (°C)</th>
            <th>Tension</th>
            <th>Poids (Kg)</th>
            <th>Taille (M)</th>
            <th>Symptomes</th>
          </tr>";

    
    foreach ($consultations as $consultation) {
        echo "<tr>";
        echo "<td>" . $consultation["id"] . "</td>";
        echo "<td>" . $consultation["patiend"]["name"] . "</td>";
        echo "<td>" . $consultation["patiend"]["sex"] . "</td>";
        echo "<td>" . $consultation["patiend"]["birthday"] . "</td>";
        echo "<td>" . $consultation["patiend"]["tel"] . "</td>";
        echo "<td>" . $consultation["consultation"]["date_cosultation"] . "</td>";
        echo "<td>" . $consultation["consultation"]["motif"] . "</td>";
        echo "<td>" . $consultation["consultation"]["temperature"] . "</td>";
        echo "<td>" . $consultation["consultation"]["tension_systolique"] . " / " . $consultation["consultation"]["tension_diastolique"] . "</td>";
        echo "<td>" . $consultation["consultation"]["poids"] . "</td>";
        echo "<td>" . $consultation["consultation"]["taille"] . "</td>";
        echo "<td>" . $consultation["consultation"]["symptomes"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

echo "</body>";
    


?>

