<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        .cards-container {
            margin-top: 3%;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            text-align: center;
            background-color: beige;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            width: 300px;
            transition: background-color 0.3s ease-in-out;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .card:hover {
            background-color: #8a7070;
        }
        
    </style>
</head>
<body>
    <h1>Products</h1>

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
                echo "<h4>Price: $" . htmlspecialchars($product['price']) . "</h4>";
                echo "<h4>Quantity: " . htmlspecialchars($product['quantity']) . "</h4>";
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
