<?php
require "function.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the 'username' field from the form is NOT empty
    if (empty($_POST['villeDepart'])||empty($_POST['villeDarive'])||empty($_POST['envoi'])|| empty($_POST['poids']) ) {
        echo "all the fields are requerd" ;
        exit;
    } else {
        $poids=$_POST['poids'];
        if ($poids<0) {
            
            echo "poids should be >0" ;
            exit;

        }
        else{
            $villeDepart=$_POST['villeDepart'];
            $villeDarive=$_POST['villeDarive'];
            $envoi=$_POST['envoi'];
            $tarifTotal=calculTarit($poids,$villeDepart,$villeDarive,$envoi);
          
            
$html = <<<HTML
<table border="1">
    <tr>
        <th>Devis de livraison</th> 
    </tr>
     <tr>
        <th>Ville de départ:$villeDepart</th>
    </tr>
     <tr>
        <th>Ville d’arrivée :$villeDarive</th>
    </tr>
     <tr>
        <th>Poids:$poids</th>
    </tr>
     <tr>
        <th>Livraison :$envoi</th>
    </tr>
     <tr>
        <th>Total à payer :$tarifTotal</th>
    </tr>
 
</table>
HTML;

echo $html;

        }

       
    }
}
?>