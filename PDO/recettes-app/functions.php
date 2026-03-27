<?php
require "db.php";

function selectAllRecipes($pdo){
try{
    $sqlQuerry="SELECT * FROM recipes;";
    $stmts=$pdo->query($sqlQuerry);
    $users=$stmts->fetchAll(PDO::FETCH_ASSOC);
    if(empty($users)){
         echo "<p style='text-align:center; font-size:18px; color:red;'>Aucune recette trouvée</p>";
        return;
    }

    foreach ($users as $user) {
    // Output the HTML structure for each card
    echo "<div class='card'>";
    echo "<h2><b>" . htmlspecialchars($user['name']) . "</b></h2>";
    echo "<img src='" . htmlspecialchars($user['image']) . "' alt='recipe image' >";
    echo "<h4><b>" . htmlspecialchars($user['category']) . "</b></h4>";
    echo "<h4><b>" . htmlspecialchars($user['created_at']) . "</b></h4>";
    
    echo "</div>";
}

}catch(PDOException $errors){
    echo "ERRORS". $errors->getMessage();
}
};



function searchRecipes($pdo,$search){
try{
    $sqlQuerry="SELECT * FROM recipes WHERE name LIKE ? ;";
    $stmts=$pdo->prepare($sqlQuerry);
    $stmts->execute(["%$search%"]);
    $users=$stmts->fetchAll(PDO::FETCH_ASSOC);
        if(empty($users)){
         echo "<p style='text-align:center; font-size:18px; color:red;'>Aucune recette trouvée</p>";
        return;
    }

    foreach ($users as $user) {
    // Output the HTML structure for each card
    echo "<div class='card'>";
    echo "<h2><b>" . htmlspecialchars($user['name']) . "</b></h2>";
    echo "<img src='" . htmlspecialchars($user['image']) . "' alt='recipe image' >";
    echo "<h4><b>" . htmlspecialchars($user['category']) . "</b></h4>";
    echo "<h4><b>" . htmlspecialchars($user['created_at']) . "</b></h4>";
    
    echo "</div>";
}

}catch(PDOException $errors){
    echo "ERRORS". $errors->getMessage();
}
};

function filterByCategory($pdo,$category){
try{
    $sqlQuerry="SELECT * FROM recipes WHERE category = ? ;";
    $stmts=$pdo->prepare($sqlQuerry);
    $stmts->execute(["$category"]);
    $users=$stmts->fetchAll(PDO::FETCH_ASSOC);
        if(empty($users)){
         echo "<p style='text-align:center; font-size:18px; color:red;'>Aucune recette trouvée</p>";
        return;
    }

    foreach ($users as $user) {
    // Output the HTML structure for each card
    echo "<div class='card'>";
    echo "<h2><b>" . htmlspecialchars($user['name']) . "</b></h2>";
    echo "<img src='" . htmlspecialchars($user['image']) . "' alt='recipe image' >";
    echo "<h4><b>" . htmlspecialchars($user['category']) . "</b></h4>";
    echo "<h4><b>" . htmlspecialchars($user['created_at']) . "</b></h4>";
    
    echo "</div>";
}

}catch(PDOException $errors){
    echo "ERRORS". $errors->getMessage();
}
};


function sortRecipes($pdo,$sort){
try{
    $sqlQuerry="SELECT * FROM recipes ";
    if($sort=="time_asc"){
    $sqlQuerry.="ORDER BY created_at ASC ";
    }elseif($sort=="time_desc"){
    $sqlQuerry.="ORDER BY created_at DESC ";
    }
    elseif($sort=="new"){
    $sqlQuerry.="ORDER BY created_at DESC ";
    }elseif($sort=="old"){
    $sqlQuerry.="ORDER BY created_at ASC ";
    }
    





    $stmts=$pdo->query($sqlQuerry);
    $users=$stmts->fetchAll(PDO::FETCH_ASSOC);
        if(empty($users)){
         echo "<p style='text-align:center; font-size:18px; color:red;'>Aucune recette trouvée</p>";
        return;
    }

    foreach ($users as $user) {
    // Output the HTML structure for each card
    echo "<div class='card'>";
    echo "<h2><b>" . htmlspecialchars($user['name']) . "</b></h2>";
    echo "<img src='" . htmlspecialchars($user['image']) . "' alt='recipe image' >";
    echo "<h4><b>" . htmlspecialchars($user['category']) . "</b></h4>";
    echo "<h4><b>" . htmlspecialchars($user['created_at']) . "</b></h4>";
    
    echo "</div>";
}

}catch(PDOException $errors){
    echo "ERRORS". $errors->getMessage();
}
}





?>