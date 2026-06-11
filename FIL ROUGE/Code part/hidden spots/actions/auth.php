<?php
session_start();
require_once __DIR__.'/../includes/csrf.php';
require_once __DIR__.'/../classes/user.php';
$userObj=new User();

//handling login

    if (isset($_POST['action']) && $_POST['action'] === "login") {
        requireCsrfToken('../pages/auth/login.php');

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $result=$userObj->login($email,$password);
        if($result['success']){
            // 🔒 Regenerate session ID to prevent session fixation
            session_regenerate_id(true);

            $_SESSION['user_id'] = $result['user']['id'];
            $_SESSION['username'] = $result['user']['username'];
            $_SESSION['email'] = $result['user']['email'];
             header("Location: ../pages/home.php");
             exit;

        }

        else {
        $_SESSION['error'] = $result['message'];
        header("Location: ../pages/auth/login.php");
        exit;
       }
            
    }

//handling registration
if (isset($_POST['action']) && $_POST['action'] === "register") {
    requireCsrfToken('../pages/auth/register.php');

    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result=$userObj->register($username,$email,$password);
    
   if ($result && $result['success']){
        $_SESSION['success'] = "Registration successful! Please log in.";
        header("Location: ../pages/auth/login.php");
        exit;
    }
    else {
        $_SESSION['error'] = $result['message'];
        header("Location: ../pages/auth/register.php");
        exit;
       }
}
