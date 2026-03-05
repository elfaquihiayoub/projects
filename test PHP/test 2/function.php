<?php

function validatePrice($price){

if ((filter_var($price, FILTER_VALIDATE_FLOAT)=== false)
    || $price<=0)   {
    echo " the price is not an valide";

    exit;
    
}
 else{
    return $price;
}
}

function validateQuantity($quantity){

if ((filter_var($quantity, FILTER_VALIDATE_INT)=== false)
    || $quantity<=0)   {
    echo " the quantity is not an valide";

    exit;
    
} else{
    return $quantity ;
}
}


function codePromo($discountValue,$totalPrice,$quantity){
$discount=0;


    if ($discountValue=="DEV10"){
        $discount+=10;


    };
    if ($quantity>=5) {
          $discount+=10;
    }

    if ($totalPrice>=1000) {
          $discount+=15;
    }
    
    
    if ($discountValue=="SUPER20"){
        $discount+=20;


    };
    return $discount;

}

function livraisontOption($livraisont,$totalPrice){

if($totalPrice>1500|| $livraisont==="standard"){
    return 0;

}
else{
    if($livraisont=="express"){
    return 50;

    }
}



    
}






?>