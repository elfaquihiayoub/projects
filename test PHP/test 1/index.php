
<?php

if ($_SERVER["REQUEST_METHOD"]==="POST"){
// 
    $email=$_POST["email"];
    $password=$_POST["password"];
    $number_validation=$_POST["number_validation"];
    $domain="ofppt.ma";
    $captcha_value=$_POST["captcha"];
    $form_is_valide=true;

    
    // validation address email

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo " format invalid ";
        $form_is_valide=false;
        exit;
    }    
    else{
        $email_domain=explode("@",$email);
        if($email_domain[count($email_domain)-1]!=$domain){
            echo " the email domain invalide";
              $form_is_valide=false;
            exit;
        }
    }

    // validation password

    if(!strlen($password)>=8 || !str_contains(strtolower($password), "php")){
        $form_is_valide=false;
        echo " the password is invalide";
        exit;
    }

    // validation captcha 
    if($captcha_value!==$number_validation){
        echo "the number is not valide";
        $form_is_valide=false;
        exit;
    }


    if($form_is_valide){
        echo " you loging seccefuly";
    }


}


