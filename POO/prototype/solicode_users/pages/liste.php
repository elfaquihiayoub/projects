<?php
require "../classes/database.php";
require "../classes/user.php";
require "../classes/userRepository.php";

$database=new database();
$pdo=$database->getConnection();
$repository=new UserRepository($pdo);
$users=$repository->findAll();
?>

<table border="1">
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

            <td>
                <?= $user->getInitiales() ?>
            </td>

            <td>
                <?= $user->getNomComplet() ?>
            </td>

            <td>
                <?= $user->getEmail() ?>
            </td>

            <td>
                <?= $user->getRoleLabel() ?>
            </td>

            <td>
                <span >
                    <?= $user->getStatutLabel() ?>
                </span>
            </td>

            <td>
                <a href="profil.php?id=<?= $user->getId()?>">Voir</a>

                  <a href="modifier.php?id=<?=  $user->getId() ?>">Modifier</a>

                <a href="supprimer.php?id=<?= $user->getId() ?>">
                    Supprimer
                </a>
            </td>

        </tr>

        <?php endforeach; ?>

    </tbody>
</table>