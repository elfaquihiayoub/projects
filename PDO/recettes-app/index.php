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
            margin-top: 3%;
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

<form  method="get">
     <input type="text" name="search" placeholder="Search..." onchange="this.form.submit()">
     <select name="category" onchange="this.form.submit()">
         
         <option value="">--------</option>
         <option value="Entree">Entree</option>
         <option value="Plat">Plat</option>
         <option value="Dessert">Dessert</option>
     </select>
     <select name="sort" onchange="this.form.submit()">
        <option value="">Default</option>
        <option value="time_asc">croissant</option>
        <option value="time_desc">décroissant</option>
        <option value="new">récentes</option>
        <option value="old">anciennes</option>
    </select>
</form>
    
</body>
</html>

<?php
require "functions.php";
echo "<div class='cards-container'>";
$search = $_GET['search'] ?? '';
$category=$_GET['category']?? "";
$sort=$_GET['sort']?? "";

if($category){
    filterByCategory($pdo,$category);
}
elseif($search){
    searchRecipes($pdo,$search);
}elseif($sort){
    sortRecipes($pdo,$sort);
}
else{
     selectAllRecipes($pdo);
}


echo "</div>";





?>