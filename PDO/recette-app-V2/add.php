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
    <style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f4f6f9;
        font-family: Arial, sans-serif;
    }

    .card {
        background: #fff;
        padding: 30px;
        width: 320px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .card h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 22px;
        color: #333;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
        color: #555;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        outline: none;
        transition: border 0.2s ease, box-shadow 0.2s ease;
    }

    input:focus {
        border-color: #667eea;
        box-shadow: 0 0 5px rgba(102, 126, 234, 0.4);
    }

    .btn-add {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: #38a169;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.25s ease, transform 0.2s ease;
    }

    .btn-add:hover {
        background: #2f855a;
        transform: scale(1.03);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        text-decoration: none;
        color: #555;
        font-size: 14px;
    }

    .back-link:hover {
        color: #000;
    }
</style>
</head>
<body>
    <div class="card">
        <h1>Add Product</h1>

        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <button type="submit" class="btn-add">Add Product</button>
        </form>

        <a href="index.php" class="back-link">← Back to products</a>
    </div>
</body>
</html>

</html>
