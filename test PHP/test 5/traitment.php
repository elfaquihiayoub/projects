<?php
require "functions.php";
// Check the request method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST["dateDeDebut"]) || empty($_POST["numberGrp"]) ) {
        echo "the fields are requered!!!";
        exit;

    }
    else{
        $dateDeDebut=$_POST["dateDeDebut"];
        $numberGrp=$_POST["numberGrp"];
        $vip=isset($_POST["vip"])??false;

       $dayoff= checkValidation($dateDeDebut,$numberGrp,$vip);

       echo 'la recupiration de '.$numberGrp." end in".$dayoff;

        


        
    }





}
?>