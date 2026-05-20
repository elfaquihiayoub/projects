<?php
require "../classes/database.php";
require "../classes/user.php";
require "../classes/userRepository.php";

$database=new database();
$pdo=$database->getConnection();
$repository= new UserRepository($pdo);

$id=$_GET["id"];


$user=$repository->findById($id);

if(!$user){
    header("Location: liste.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
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

.profile-card {
    background: #1e293b;
    width: 420px;
    padding: 35px;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    text-align: center;
    color: white;
    transition: 0.3s;
}

.profile-card:hover {
    transform: translateY(-5px);
}

.avatar {
    width: 90px;
    height: 90px;
    margin: auto;
    border-radius: 50%;
    background: #3b82f6;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    font-weight: bold;
    color: white;
    margin-bottom: 20px;
    box-shadow: 0 0 20px rgba(59,130,246,0.4);
}

.profile-card h2 {
    margin-bottom: 25px;
    color: #e2e8f0;
}

.info {
    text-align: left;
}

.info p {
    background: #334155;
    padding: 14px;
    border-radius: 10px;
    margin-bottom: 12px;
    color: #cbd5e1;
}

.status {
    background: #22c55e33;
    color: #22c55e;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: bold;
}
    </style>
</head>
<body>
    <div class="profile-card">
    
        <div class="avatar">
            <?= htmlspecialchars($user->getInitiales()) ?>
        </div>
    
        <h2><?= htmlspecialchars($user->getNomComplet()) ?></h2>
    
        <div class="info">
            <p><strong>Email :</strong> <?= htmlspecialchars($user->getEmail()) ?></p>
            <p><strong>Rôle :</strong> <?= htmlspecialchars($user->getRoleLabel()) ?></p>
            <p><strong>Age :</strong> <?= htmlspecialchars( $user->getAge()) ?> years old</p>
            <p><strong>Ancienneté :</strong> <?= htmlspecialchars($user->getAnciennete()) ?> days</p>
            <p>
                <strong>Status :</strong>
                <span class="status">
                    <?= htmlspecialchars($user->getStatutLabel()) ?>
                </span>
            </p>
        </div>
    
    </div>
    
</body>
</html>
