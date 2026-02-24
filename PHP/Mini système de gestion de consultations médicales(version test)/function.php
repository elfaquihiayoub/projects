<?php
$errors=[];

define("DATA_FILE","data/consultations.json");

function validation($name,$sex,$birth_date,$tel,$dateConsultation,$motif,$temperature,
$tension_systolique,$tension_diastolique,$poids,$taille,
$symptomes){
     global $errors;

    if (empty($name)|| $name==="") {
        array_push($errors,"Name field invalid");
    }
     if (empty($sex)|| $sex==="") {
        array_push($errors,"sex field invalid");
    }
    if (empty($birth_date)|| $birth_date>=date("Y-m-d")) {
        array_push($errors," birth_date field invalid");
    }
     if ($tel===""|| !is_numeric($tel)) {
        array_push($errors,"tel field invalid");
    }
      if (empty($dateConsultation)|| $dateConsultation > date("Y-m-d")) {
        array_push($errors," dateConsultation field invalid");

    }
    if (empty($motif)|| $motif==="") {
        array_push($errors,"motif field invalid");
    }
     if ($temperature===""|| !is_numeric($temperature)|| $temperature<35 || $temperature>42) {
        array_push($errors,"temperature field invalid");

    }
     if ($tension_systolique===""|| !is_numeric($tension_systolique)|| $tension_systolique<80 || $tension_systolique>200) {
        array_push($errors,"tension_systolique field invalid");

    }
     if ($tension_diastolique===""|| !is_numeric($tension_diastolique)|| $tension_diastolique<40 || $tension_diastolique>130) {
        array_push($errors,"tension_diastolique field invalid");

    }
     if ($poids===""|| !is_numeric($poids)|| $poids<2 || $poids>250) {
        array_push($errors,"poids field invalid");

    }
     if ($taille===""|| !is_numeric($taille)|| $taille<0.5 || $taille>2.5) {
        array_push($errors,"taille field invalid");
        

    }

    if ($symptomes === "") {
        $errors[] = "Symptomes field invalid";
    }
// need check
    if(empty($errors)){
        return true;
    }else{
        return $errors;
    }


}


function getConsultations(){
    if (!file_exists(DATA_FILE)) {
        return [];
        
    };

    $data=file_get_contents(DATA_FILE);

    if(empty($data)){
        return[];
    };

    $consultation=json_decode($data,true);
    return $consultation;


};











?>