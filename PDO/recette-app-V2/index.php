<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
 <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f6f9;
    }

    h1 {
        text-align: center;
        margin: 30px 0;
        color: #333;
    }

    .cards-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
        padding: 20px;
    }

    .card {
        background: #fff;
        width: 260px;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    /* Stagger animation */
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }

    .card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .card h2 {
        margin-bottom: 10px;
        color: #333;
    }

    .card h4 {
        margin: 5px 0;
        color: #666;
        font-weight: normal;
    }

    .edit-btn, .delete-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        color: white;
        font-size: 14px;
        transition: 0.3s;
    }

    .edit-btn {
        background: #667eea;
    }

    .edit-btn:hover {
        background: #5a67d8;
        transform: scale(1.05);
    }

    .delete-btn {
        background: #e53e3e;
        margin-left: 8px;
    }

    .delete-btn:hover {
        background: #c53030;
        transform: scale(1.05);
    }

    /* Animation keyframes */
    @keyframes fadeInUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    .add-btn {
    display: block;
    width: fit-content;
    margin: 20px auto;
    padding: 10px 18px;
    background: #38a169;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-size: 15px;
    transition: background 0.25s ease, transform 0.2s ease;
}

.add-btn:hover {
    background: #2f855a;
    transform: scale(1.05);
}
</style>
</head>
<body>
    <h1>Products</h1>
    <a href="add.php" class="add-btn">+ Add New Article</a>
    

    <?php
    require 'connextion.php';

    try {
        $sql = "SELECT * FROM products";
        $stmt = $pdo->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($products)) {
            echo "<p style='text-align:center; font-size:18px; color:red;'>No products found</p>";
        } else {
            echo "<div class='cards-container'>";
            foreach ($products as $product) {
                echo "<div class='card'>";
                echo "<h2><b>" . htmlspecialchars($product['name']) . "</b></h2>";
                echo "<h4>Price: " . htmlspecialchars($product['price']) . " DH</h4>";
                echo "<h4>Quantity: " . htmlspecialchars($product['quantity']) . "</h4>";
                echo "<a href='edit.php?id=" . $product['id'] . "' class='edit-btn'>Edit</a>";
                echo "<a href='delete.php?id=" . $product['id'] . "' class='delete-btn'>delete</a>";
                echo "</div>";
            }
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

</body>
</html>
