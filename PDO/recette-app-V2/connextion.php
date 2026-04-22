<?php



$host="localhost";
$dbname="recettev2";
$user="root";
$password="";


try{
    $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $errors){
    echo $errors->getMessage();
    
   
}




?>
