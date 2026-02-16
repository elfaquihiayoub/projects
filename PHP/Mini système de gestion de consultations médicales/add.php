<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

body {
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(to right, #eaf4ff, #f7fbff);
    display: flex;
    justify-content: center;
    padding: 40px;
}

form {
    background: #ffffff;
    width: 550px;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

h2 {
    margin-top: 25px;
    color: #2c3e50;
    border-left: 5px solid #3498db;
    padding-left: 10px;
    font-size: 18px;
}

label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #34495e;
}

input[type="text"],
input[type="date"],
input[type="number"],
input[type="tel"] {
    width: 100%;
    padding: 8px 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #dcdcdc;
    font-size: 14px;
    transition: 0.3s ease;
}

input[type="text"]:focus,
input[type="date"]:focus,
input[type="number"]:focus,
input[type="tel"]:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
}

input[type="radio"] {
    margin-right: 5px;
}

button {
    margin-top: 25px;
    width: 100%;
    padding: 12px;
    background-color: #3498db;
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s ease;
}

button:hover {
    background-color: #2c80b4;
    transform: translateY(-2px);
}

</style>

</head>
<body>

<form action="traitment.php" method="post">

    <h2>Patient Information</h2>
    <label for="name">Full Name</label>
    <input type="text" name="name" id="name" required>

    

    <label>Sex</label>

    <label for="male">Male</label>
    <input type="radio" name="sex" id="male" value="male" required>
    
    <label for="female">Female</label>
    <input type="radio" name="sex" id="female" value="female" required>
    

    <label for="Date_nessance">Date de nessance</label>
    <input type="date" name="date_nessance" id="Date_nessance" required>
    
    <label for="Tel">telephone</label>
    <input type="tel" name="telephone" id="Tel" required>



    <h2>Consultation Information</h2>

    <label for="Date_consultation">Date de consultation</label>
    <input type="date" name="date_consultation" id="Date_consultation" required>

    <label for="Motif">Motif</label>
    <input type="text" name="motif" id="Motif" required> 

    <label for="Temperatur">Temperatur(C)</label>
    <input type="number" step="0.1" name="temperatur" id="Temperatur" required>

    <label for="Tension_systolique">Tension systolique</label> 
    <input type="number" step="1" name="tension_systolique" id="tension_systolique" required>

    <label for="Tension_diastolique">Tension diastolique</label> 
    <input type="number" step="1" name="tension_diastolique" id="Tension_diastolique" required>

    <label for="Poids">Poids(Kg)</label> 
    <input type="number" step="0.1" name="poids" id="Poids" required>

    <label for="Taille">Taille(M)</label> 
    <input type="number" step="0.01" name="taille" id="Taille" required>

    <button type="submit">Save Consultation</button>








</form>
    
</body>
</html>