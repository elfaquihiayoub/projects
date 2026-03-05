<?php
require "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $password=$_POST["password"];
    if (empty($password) ?? "") {
        echo "you have to write a password ";
        exit;
        
    }
    else{
        $scoreOfPass=verifyPasswordScore($password);

        if($scoreOfPass>=90){
            echo "you pass is Très fort $scoreOfPass";


        }elseif($scoreOfPass>=70){
            echo "you pass is bon $scoreOfPass";


        }elseif($scoreOfPass>=40){
            echo "you pass is moyen $scoreOfPass";


        }else{
            echo "you pass is low $scoreOfPass";


        }

    }
    
   
}
?>

<!-- HTML form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    PASSWORD: <input type="text" name="password"><br>
    <input type="submit" value="Vérifier">
</form>