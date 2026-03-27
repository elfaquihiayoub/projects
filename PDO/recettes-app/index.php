<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
    }
        .cards-container {
            display: flex;
            flex-wrap: wrap; /* allows multiple rows */
            gap: 20px; /* space between cards */
            }

        .card {
            text-align: center;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            width: 300px; /* Define card size */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }

    </style>
</head>
<body>  
    
</body>
</html>

<?php
require "functions.php";
echo "<div class='cards-container'>";
selectAllRecipes($pdo);
echo "</div>";





?>