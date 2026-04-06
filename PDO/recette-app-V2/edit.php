<?php
require 'connextion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    try {
        $sql = "UPDATE products SET price=?, quantity=? WHERE name=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$price, $quantity, $name]);
        echo "Product updated successfully!";
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
    <title>update Product</title>
</head>
<body>
    <h1>edit existing Product</h1>
    <form method="POST" action="">
        <label for="name">table name :</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price"> new Price:</label>
        <input type="number" step="0.01" id="price" name="price" required><br><br>

        <label for="quantity"> newQuantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
