<?php
require 'connextion.php';
$id = $_GET['id'] ?? null;

if (!$id) {
    die("No product selected");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];


    try {
        $sql = "DELETE FROM products WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
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
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .card h1 {
        font-size: 20px;
        color: #333;
        margin-bottom: 15px;
    }

    .warning {
        font-size: 14px;
        color: #777;
        margin-bottom: 25px;
    }

    .btn-delete {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: #e53e3e;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-delete:hover {
        background: #c53030;
    }

    .btn-cancel {
        margin-top: 10px;
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
    <div class="card">
        <h1>Delete Product</h1>
        <p class="warning">Are you sure you want to delete this product? This action cannot be undone.</p>

        <form method="POST" action="">
            <button type="submit" class="btn-delete">Delete Anyway</button>
        </form>

        <a href="index.php" class="btn-cancel">Cancel</a>
    </div>
</body>
</html>
