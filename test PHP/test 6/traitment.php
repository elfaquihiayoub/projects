<?php
require "functions.php";
// Check the request method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $X=$_POST["x"];
    $Y=$_POST["y"];
    $firstX=$X;
    $firstY=$Y;

    $instructionsSpaces=$_POST["instructions"];
    $instructions=$strippedString = str_replace(' ', '', $instructionsSpaces);
    $instructionsArray=explode(",",$instructions,);
    $left="left";
    $right="right";
    $down="down";
    $up="up";

    $xAndy= movmentPin($X,$Y,$instructionsArray,$right,$left,$up,$down);
  

    //affichage :
    //1)
    echo " the couple is[ $xAndy[0],$xAndy[1]]  ";?>

 



<!DOCTYPE html>
<html>
<head>
    <title>5x5 PHP Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 200px;
        }
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .end{
            background-color: red;
        }
        .start{
            background-color: green;
        }
    </style>
</head>
<body>

<?php
echo '<table>';


for ($row = 0; $row <= 4; $row++) {
    echo '<tr>';
  

    for ($col = 0; $col <= 4; $col++) {
          if($row==$firstY && $col==$firstX){

              echo '<td class="start">' . $col . '</td>';
              continue;
              

       }


        if($row==$xAndy[1] && $col==$xAndy[0]){

              echo '<td class="end">' . $col . '</td>';
             continue;
       }
    
      
        echo '<td>' . $col . '</td>';
      
    }
      
       

    echo '</tr>';
}

echo '</table>';  }?>


</body>
</html>






   
  






