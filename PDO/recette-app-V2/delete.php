<?php
require 'connextion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];


    try {
        $sql = "DELETE FROM products WHERE name=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name]);
        echo "Product removed successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete Product</title>
</head>
<body>
    <h1>delete existing Product</h1>
    <form method="POST" action="">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" required><br><br>

   
        <button type="submit">delete Product</button>
    </form>
</body>
</html>
