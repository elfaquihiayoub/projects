<?php
require_once "../../includes/auth_check.php";
require_once "../../classes/Place.php";
$placeObj = new Place();
$places = $placeObj->getAllPlaces();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Places</title>
    </head>
    <body>
        <h2>All Places</h2>
        <a href="add.php">Add New Place</a>  

        <!-- success/ error messages -->

        <?php
            if (isset($_SESSION['success'])) {
                echo "<p style='color:green'>" . htmlspecialchars($_SESSION['success']) . "</p>";
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['error'])) {
                echo "<p style='color:red'>" . htmlspecialchars($_SESSION['error']) . "</p>";
                unset($_SESSION['error']);
            }
        ?>
        <hr>
        <?php if (!empty($places)): ?>
            <?php foreach ($places as $place): ?>
                        <div style="border:1px solid #ccc; padding:10px; margin:10px; width:300px; display:inline-block;">

            <!-- IMAGE -->
            <img 
                src="../../<?php echo !empty($place['image']) 
                    ? htmlspecialchars($place['image']) 
                    : 'assets/images/placeholder.jpg'; ?>" 
                width="100%" height="150">

            <!-- TITLE -->
            <h3><?php echo htmlspecialchars($place['name']); ?></h3>

            <!-- CATEGORY -->
            <p><?php echo htmlspecialchars($place['category_name']); ?></p>

            <!-- USER -->
            <small>By <?php echo htmlspecialchars($place['username']); ?></small>

            <br><br>

            <!-- VIEW DETAILS -->
            <a href="details.php?id=<?php echo $place['id']; ?>">
                View Details →
            </a>

        </div>
    <?php endforeach; ?>

    <?php else: ?>
         <p>No places found.</p>
    <?php endif; ?>
        
    </body>
</html>