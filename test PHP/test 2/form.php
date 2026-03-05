<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="traitemt.php" method="POST">
        <input type="text" name="price" id="" placeholder="prix de produit"> 
        <input type="text" name="quantity" id="" placeholder="quantity"> 
        <input type="text" name="discountValue" id="" placeholder="code promo"> 
         <select name="livraisont" id="color_select">
        <option value="standard">standard</option>
        <option value="express">express</option>
       
    </select>
        <button type="submit">calculer</button>

        </form> 
</body>
</html>