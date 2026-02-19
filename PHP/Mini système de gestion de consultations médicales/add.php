<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 40px 0;
}

form {
    width: 600px;
    margin: auto;
    background-color: #ffffff;
    padding: 25px 30px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

h2 {
    margin-top: 25px;
    margin-bottom: 15px;
    color: #2c3e50;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="date"],
input[type="tel"],
input[type="number"],
select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

input[type="radio"] {
    margin-right: 5px;
}
 </style>

</head>
<body>

<form action="traitment.php" method="post">

    <h2>Patient Information</h2>
    <label for="name">Full Name</label>
    <input type="text" name="name" id="name" >

    

    <label>Sex</label>

    <label for="male">Male</label>
    <input type="radio" name="sex" id="male" value="male" >
    
    <label for="female">Female</label>
    <input type="radio" name="sex" id="female" value="female" required>
    

    <label for="Date_nessance">Date de nessance</label>
    <input type="date" name="date_nessance" id="Date_nessance" >
    
    <label for="Tel">telephone</label>
    <input type="tel" name="telephone" id="Tel" >



    <h2>Consultation Information</h2>

    <label for="Date_consultation">Date de consultation</label>
    <input type="date" name="date_consultation" id="Date_consultation" >

    <label for="Motif">Motif</label>
    <input type="text" name="motif" id="Motif" > 

    <label for="Temperatur">Temperatur(C)</label>
    <input type="number" step="0.1" name="temperatur" id="Temperatur" >

    <label for="Tension_systolique">Tension systolique</label> 
    <input type="number" step="1" name="tension_systolique" id="tension_systolique" >

    <label for="Tension_diastolique">Tension diastolique</label> 
    <input type="number" step="1" name="tension_diastolique" id="Tension_diastolique" >

    <label for="Poids">Poids(Kg)</label> 
    <input type="number" step="0.1" name="poids" id="Poids" >

    <label for="Taille">Taille(M)</label> 
    <input type="number" step="0.01" name="taille" id="Taille" >
    <label for="symptomes">Symptômes</label>
    <select name="symptomes" id="symptomes" >
        <option value="">-- Select Symptom --</option>
        <option value="Fever">Fever</option>
        <option value="Cough">Cough</option>
        <option value="Headache">Headache</option>
        <option value="Fatigue">Fatigue</option>
        <option value="Chest Pain">Chest Pain</option>
    </select>


    <button type="submit" >Save Consultation</button>








</form>
    
</body>
</html>