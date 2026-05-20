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

<h1><?= $user->getInitiales() ?></h1>
<h2><?= $user->getNomComplet()?></h2>
<p>Email : <?= $user->getEmail() ?></p>
<p>Role : <?= $user->getRoleLabel() ?></p>
<p>Age : <?= $user->getAge() ?> years old</p>
<p>ancienneter : <?= $user->getAnciennete() ?> days</p>
<p>status : <?= $user->getStatutLabel() ?> </p>

