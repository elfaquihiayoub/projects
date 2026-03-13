<?php

function checkValidation( $dateDeDebut,$numberGrp,  $vip){
$timestamp = strtotime($dateDeDebut);
$dayName = date('l', $timestamp);
$dayTime=date("H:i",$timestamp);
$totalTimeForGrp=30;



if ($dayName=="Saturday" || $dayName=="Sunday") {
       echo "error thats the weekend!!";
       exit;


}else{ 
    if($dayTime<="09:30"){
        echo "u cant reserve time before 9:30";
        exit;
    }

    // reverve good
    else{
        if($vip){
            $totalTimeForGrp=45;
            $dateOFFin=($numberGrp*$totalTimeForGrp)*60-15*60; // secounds
            $newTimestamp=$timestamp+$dateOFFin;
            $newdaytime=date("H:i",$newTimestamp);


            if($newdaytime>="18:30"){
                echo "the time is past the 6:30";
                exit;
            }

        }
        else{
            $dateOFFin=($numberGrp*$totalTimeForGrp)*60; // secounds
            $newTimestamp=$timestamp+$dateOFFin;
            $newdaytime=date("H:i",$newTimestamp);
        }

    }

}


return $newdaytime;
    
}

?>