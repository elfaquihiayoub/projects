<?php
require 'connextion.php';
$id = $_GET['id'] ?? null;

if (!$id) {
    die("No product selected");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    try {


        $sql = "UPDATE products SET price=?, quantity=?,name=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$price, $quantity, $name, $id]);
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
    <style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #000000, #49484b);
        font-family: Arial, sans-serif;
    }

    .card {
        background: #fff;
        padding: 30px;
        width: 320px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .card h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 22px;
        color: #333;
    }

    label {
        display: block;
        margin-bottom: 5px;
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
        transition: 0.2s;
    }

    input:focus {
        border-color: #48494d;
        box-shadow: 0 0 5px rgba(50, 51, 54, 0.5);
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: #2f3034;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #727273;
    }
        .btn-cancel {
        margin-left: 40%;
        margin-top: 20px;
        display: inline-block;
        text-decoration: none;
        color: #555;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-cancel:hover {
        color: #000;
    }
</style>
</head>
<body>
<<<<<<< HEAD
    <h1>edit existing Product</h1>
    <form method="POST" action="">
        <label for="name">table id :</label>
        <input type="text" id="id" name="id" required><br><br>
=======
    <div class="card">
        <h1>Edit Product</h1>
        <form method="POST" action="">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
>>>>>>> 3aa8ce2eba6da014539cfa2d3089abe8633b2d64

            <label for="price">New Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>

            <label for="quantity">New Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <button type="submit">Update Product</button>
            <a href="index.php" class="btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
