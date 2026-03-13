<?php
function calculTarit($poids,$villeDepart,$villeDarive,$envoi): mixed{
 $tarifTotal=0;
$tarifBase=20;
$tarifAgmonter=0;
if($envoi=="Express"){
    $tarifAgmonter+=$tarifBase*0.2;
}
if($villeDepart!==$villeDarive){
    $tarifAgmonter+=$tarifBase*0.5;
}
if($poids>5){
   $tarifAgmonter+=($poids-5)* 5;
}
$tarifTotal=$tarifAgmonter+$tarifBase;

return $tarifTotal;







}



?>