<?php
require 'user.php';
$user = new User();
$user->setNom('Benmoussa');
$user->setPrenom('Ali');
$user->setEmail('ali@solicode.ma');
$user->setRole('apprenant');
$user->setDateNaissance('2000-03-15');
$user->setDateInscription('2024-09-01');
$user->setActif(1);
echo $user->getNomComplet() ."  <br>";  // → Ali BENMOUSSA
echo $user->getAge() ."  <br>";         // → 24
echo $user->getInitiales() ."  <br>";   // → A.B
echo $user->getAnciennete() ."  <br>";  // → nombre de jours depuis le 01/09/2024
echo $user->getStatutLabel() . "  <br>"; //