<?php
require "../classes/database.php";
require "../classes/user.php";
require "../classes/userRepository.php";

$database = new database();
$pdo = $database->getConnection();
$repository = new UserRepository($pdo);


if (!isset($_GET['id'])) {
    header("Location: liste.php");
    exit;
}

$id = $_GET['id'];
$user = $repository->findById($id);

if (!$user) {
    header("Location: liste.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $repository->delete($id);

    header("Location: liste.php?message=supprime");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supprimer utilisateur</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background: #1e293b;
            padding: 30px;
            border-radius: 16px;
            width: 400px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
            color: #e2e8f0;
        }

        .card h2 {
            margin-bottom: 15px;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 15px;
        }

        button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            font-size: 15px;
        }

        .delete {
            background: #ef4444;
            color: white;
        }

        .delete:hover {
            background: #dc2626;
        }

        .cancel {
            background: #334155;
            color: white;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 10px;
        }

        .cancel:hover {
            background: #475569;
        }
    </style>
</head>

<body>

<div class="card">
    <h2>Confirmer la suppression</h2>

    <p>Voulez-vous supprimer :</p>
    <h3><?= htmlspecialchars($user->getNomComplet()) ?></h3>

    <form method="POST">
        <div class="btn-group">
            <button type="submit" class="delete">Confirmer</button>
            <a href="liste.php" class="cancel">Annuler</a>
        </div>
    </form>
</div>

</body>
</html>