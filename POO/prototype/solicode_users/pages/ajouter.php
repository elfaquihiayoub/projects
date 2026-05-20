<?php
require "../classes/database.php";
require "../classes/user.php";
require "../classes/userRepository.php";

$database=new database();
$pdo=$database->getConnection();
$repository=new UserRepository($pdo);

$errors=[];
$newUser=[
    'nom'=>'',
    'prenom'=>'',
    'email'=>'',
    'role'=>'',
    'date_naissance'=>'',
    'actif'=>0    ];

    //collect data via post

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $newUser['nom']=$_POST['nom'];
        $newUser['prenom']=$_POST['prenom'];
        $newUser['email']=$_POST['email'];
        $newUser['role']=$_POST['role'];
        $newUser['date_naissance']=$_POST['date_naissance'];
        $newUser['actif']=isset($_POST['actif']) ? 1 : 0;
    }

    if(empty($newUser['nom'])){
        $errors['nom']="plaise enter the name ";
    }
    if(empty($newUser['prenom'])){
        $errors['prenom']="plaise enter the prenom ";
    }
    if(empty(!filter_var($newUser['email'],FILTER_VALIDATE_EMAIL))){
        $errors['email']="email invalide ";
    }
    if($repository->findByEmail($newUser['email'])){
        $errors['email']="this email already in use ";
    }
    if(empty($newUser['role'])){
        $errors['role']="select a role ";
    }
    if(empty($newUser['date_naissance'])){
        $errors['date_naissance']="Date obligatoire  ";
    }


    //start saving (if no errors )
    if (empty($errors)){
        $user=new user();
         $user->setNom($newUser['nom']);
        $user->setPrenom($newUser['prenom']);
        $user->setEmail($newUser['email']);
        $user->setRole($newUser['role']);
        $user->setDateNaissance($newUser['date_naissance']);

        $user->setDateInscription(date('Y-m-d'));

        $user->setActif($newUser['actif']);

        $repository->save($user);

        header("Location: liste.php");
        exit;
    }




?>

<form method="POST">
    Nom: 
    <input type="text" name="nom" value="<?= $newUser['nom'] ?> <?= $errors["nom"] ?? '' ?>">
    prenom: 
    <input type="text" name="prenom" value="<?= $newUser['prenom'] ?> <?= $errors["prenom"] ?? '' ?>">
    email: 
    <input type="text" name="email" value="<?= $newUser['email'] ?> <?= $errors["email"] ?? '' ?>">
    Role:
    <select name="role">
        <option value="">choose :</option>
        <option value="admin">
            admin </option>
        <option value="apprenant">
            apprenant </option>
        <option value="formateur">
            formateur </option> 
    </select>
    <br>
      Date naissance :
    <input type="date"
           name="date_naissance">
           <br>

    actif:
          <input type="checkbox"
           name="actif">
           <br>
            <button type="submit"> Ajouter</button>




</form>





   