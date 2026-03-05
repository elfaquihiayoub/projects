<?php

function verifyPasswordScore($password){
    $score=0;
    $largeur =strlen($password);
    $specialCaracter=[ '~','!','@', "#" ,"$", "%" ,"^", "&", "*", "(" ,")"  ,":" ,";" ];
    $blackList=["123456", "azerty", "password", "admin"];
    $isRigularPass=false;

    foreach ($blackList as $blackPass) {
        if ($password===$blackPass) {
           $isRigularPass=true;
           break;
   
        }
        }




        if ($isRigularPass) {
            return 0;
        }






        else{

    if($largeur>=12 ){
        $score+=30;

    }elseif($largeur>=8){
     $score+=20;
    };

    // lowercase check
    if($password!==strtoupper($password)){
         $score+=15;
    }

   

    if($password!==strtolower($password)){
         $score+=15;
    }


    if (preg_match('/\d/', $password)) {
         $score+=15;
    
    } 

    for ($i=0; $i <count($specialCaracter) ; $i++) {
        if (str_contains($password, $specialCaracter[$i])) {
         $score+=15;
         break;
            } 
        
    }
   if (!preg_match('/\s/', $password)) {
     $score+=10;
   }

   if($score>100){
    $score=100;
    return $score;
   }
   else{
    return $score;
   }
        }


    



    
  



    







};

    
   

?>