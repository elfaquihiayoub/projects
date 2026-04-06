<?php
require 'connextion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    try {
        $sql = "INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $price, $quantity]);
           echo "<p style='text-align:center; font-size:18px; color:green;'>Product added successfully!</p>";
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
    <title>Add Product</title>
</head>
<body>
    <h1>Add a New Product</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
