<?php

function movmentPin($X,$Y,$instructionsArray,$right,$left,$up,$down){

if($X>4 || $Y >4 || $X<0 || $Y<0 ){
    echo "the locations arentvalide";
    exit;


}
else{
    $i=0;
   
    while($X<=4 && $Y<=4 && $X>=0 && $Y>=0 && $i<=count($instructionsArray)-1 ){
        
            if(strtolower(($instructionsArray[$i]))==$right){
                $X+=1;
                $i++;
                
            }
            elseif(strtolower($instructionsArray[$i])==$left){
                $X=$X-1;
                $i++;

            }
            elseif(strtolower($instructionsArray[$i])==$up){
                $Y-=1;
                $i++;
            }
            elseif(strtolower($instructionsArray[$i])==$down){
                 $Y+=1;
                 $i++;
            }

            if($X>4 || $Y>4 || $X<0 || $Y<0){
            echo "le movment $i est impossible <br> ";
            break;
            }

    }
    
}
return [$X,$Y];
  
}



?>