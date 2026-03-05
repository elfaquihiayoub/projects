<?php
require "function.php";
// Check if the form has been submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $price=$_POST["price"];
    $quantity=$_POST["quantity"];
    $discountValue=$_POST["discountValue"];
    $livraisont=$_POST["livraisont"];



    $totalPrice=validatePrice($price);
    $totalQuantity=validateQuantity($quantity);

    $totalDicount=codePromo($discountValue,$totalPrice,$totalQuantity);
    $fraisLivraisont=livraisontOption($livraisont,$livraisont);

    $priceOfDiscount= ($totalPrice * $totalQuantity)*$totalDicount/100;
    $finalPrice=($totalPrice * $totalQuantity)-$priceOfDiscount;
    


    echo " total price is ".($totalPrice * $totalQuantity) . "<br>" ;
    echo "  Pourcentage total de réduction appliqué $totalDicount. %  <br>";
    echo "  Montant de la réduction .$priceOfDiscount  <br>";
    echo "  Frais de livraison $fraisLivraisont  <br> ";
    echo "  Total final. $finalPrice  <br>";




   





 
    
}
?>