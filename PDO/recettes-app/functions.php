<?php
require "db.php";

function selectAllRecipes($pdo){
try{
    $sqlQuerry="SELECT * FROM recipes;";
    $stmts=$pdo->query($sqlQuerry);
    $users=$stmts->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
    // Output the HTML structure for each card
    echo "<div class='card'>";
    echo "<h4><b>" . htmlspecialchars($user['name']) . "</b></h4>";
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