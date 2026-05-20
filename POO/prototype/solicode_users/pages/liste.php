<?php
require "../classes/database.php";
require "../classes/user.php";
require "../classes/userRepository.php";

$database=new database();
$pdo=$database->getConnection();
$repository=new UserRepository($pdo);
$users=$repository->findAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #0f172a;
    margin: 0;
    padding: 40px;
    color: white;
}

.table-container {
    background: #1e293b;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #334155;
}

thead th {
    padding: 15px;
    text-align: left;
    color: #e2e8f0;
    font-size: 15px;
}

tbody tr {
    border-bottom: 1px solid #334155;
    transition: 0.3s;
}

tbody tr:hover {
    background: rgba(59,130,246,0.08);
}

tbody td {
    padding: 14px;
    color: #cbd5e1;
}

.status {
    background: #22c55e33;
    color: #22c55e;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: bold;
}

.actions a {
    text-decoration: none;
    margin-right: 10px;
    color: #3b82f6;
    font-weight: bold;
    transition: 0.3s;
}

.actions a:hover {
    color: #60a5fa;
}

.add-btn {
    display: inline-block;
    margin-top: 20px;
    background: #3b82f6;
    color: white;
    padding: 14px 22px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.add-btn:hover {
    background: #2563eb;
    transform: translateY(-2px);
}
    </style>
</head>
<body>
    <div class="table-container">

    <table>
        <thead>
            <tr>
                <th>Initiales</th>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($users as $user): ?>
            <tr>

                <td><?= $user->getInitiales() ?></td>

                <td><?= $user->getNomComplet() ?></td>

                <td><?= $user->getEmail() ?></td>

                <td><?= $user->getRoleLabel() ?></td>

                <td>
                    <span class="status">
                        <?= $user->getStatutLabel() ?>
                    </span>
                </td>

                <td class="actions">
                    <a href="profil.php?id=<?= $user->getId()?>">Voir</a>

                    <a href="modifier.php?id=<?= $user->getId() ?>">Modifier</a>

                    <a href="supprimer.php?id=<?= $user->getId() ?>">
                        Supprimer
                    </a>
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<a class="add-btn" href="ajouter.php">+ Ajouter New</a>
</body>
</html>