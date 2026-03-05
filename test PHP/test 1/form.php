<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <label for="email">email</label>
        <input type="email" name="email">
        <label for="password" >password</label>
        <input type="password" name="password">    
        <label for="validation_number">rewrite the following number :   
            <?php
            $random=random_int(1000,9999);
            echo $random;
            
            ?>    
    </label>
        <input type="number" hidden name="captcha" value="<?php  echo $random; ?>">
        <input type="number" name="number_validation">   
        <button type="submit">send</button>
    </form>
    
</body>
</html>



