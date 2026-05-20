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
         $newUser['nom'] = trim($_POST['nom']);
        $newUser['prenom'] = trim($_POST['prenom']);
        $newUser['email'] = trim($_POST['email']);
        $newUser['role'] = $_POST['role'];
        $newUser['date_naissance'] = $_POST['date_naissance'];
        $newUser['actif'] = isset($_POST['actif']) ? 1 : 0;

        if(empty($newUser['nom'])){
        $errors['nom']="plaise enter the name ";
    }
    if(empty($newUser['prenom'])){
        $errors['prenom']="plaise enter the prenom ";
    }
    if(!filter_var($newUser['email'],FILTER_VALIDATE_EMAIL)){
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


    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter</title>
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

.form-container {
    background: #1e293b;
    padding: 30px;
    border-radius: 16px;
    width: 400px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.form-container label {
    color: #e2e8f0;
    font-weight: bold;
}

.form-container input,
.form-container select {
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: #334155;
    color: white;
    font-size: 15px;
    outline: none;
    transition: 0.3s;
}

.form-container input:focus,
.form-container select:focus {
    box-shadow: 0 0 0 2px #3b82f6;
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 10px;
    color: white;
}

button {
    background: #3b82f6;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: 0.3s;
}

button:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

.error {
    color: #f87171;
    font-size: 14px;
}
    </style>
</head>
<body>
    <form method="POST" class="form-container">
    
    <label>Nom</label>
    <input type="text" name="nom" value="<?=htmlspecialchars( $newUser['nom']) ?>">
    <span class="error"><?= $errors["nom"] ?? '' ?></span>

    <label>Prénom</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($newUser['prenom']) ?>">
    <span class="error"><?= $errors["prenom"] ?? '' ?></span>

    <label>Email</label>
    <input type="text" name="email" value="<?= htmlspecialchars($newUser['email']) ?>">
    <span class="error"><?= $errors["email"] ?? '' ?></span>

    <label>Role</label>
    <select name="role">
     <option value="admin"
        <?=htmlspecialchars( $newUser['role']=="admin" ? "selected" : "") ?>>
        Admin
    </option>

    <option value="apprenant"
        <?= htmlspecialchars($newUser['role']=="apprenant" ? "selected" : "") ?>>
        Apprenant
    </option>

    <option value="formateur"
        <?= htmlspecialchars($newUser['role']=="formateur" ? "selected" : "") ?>>
        Formateur
    </option>
    </select>

    <label>Date naissance</label>
    <input type="date" name="date_naissance"
    value="<?= htmlspecialchars($newUser['date_naissance']) ?>">

    <div class="checkbox-group">
        <label>Actif</label>
        <input type="checkbox" name="actif"
        <?= htmlspecialchars($newUser['actif'] ? "checked" : "") ?>>
    </div>

    <button type="submit">Ajouter</button>

</form>


</body>
</html>




   