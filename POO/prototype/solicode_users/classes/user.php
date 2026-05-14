<?php

class user{
    private int $id ;
    private string $nom ;
    private string $prenom ;
    private string $email ;
    private string $role ;
    private string $dateNaissance ; //(format YYYY-MM-DD)
    private string $dateInscription ; //(format YYYY-MM-DD)
    private int $actif ; // (0 ou 1)


    //getters 

    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    
    public function getEmail(){
        return $this->email;
    }
    public function getRole(){
        return $this->role;
    }
    public function getDateNaissance(){
        return $this->dateNaissance;
    }
    public function getDateInscription(){
        return $this->dateInscription;
    }
    public function getActive(){
        if($this->actif==0){
        return "not-active";
        }else{
            return "active";
        }
        
    }

    // setters
    public function setNom( string $newName){
        if(preg_match('/^[a-zA-Z\s]{2,}$/', $newName)){
            $this->nom=$newName;
            echo " set name complete <br>" ;
            
        }else{
            echo " invalide name  <br>";
        }
    }
    public function setPrenom( string $NewPrenom){
        if(preg_match('/^[a-zA-Z\s]{2,}$/', $NewPrenom)){
            $this->prenom=$NewPrenom;
             echo " set prenome complete  <br>";
            
            
        }else{
            echo " invalide Prenom  <br>";
        }
    }
    public function setEmail( string $NewEmail){
        if (filter_var($NewEmail, FILTER_VALIDATE_EMAIL)) {
             $this->email=$NewEmail;
              echo " set email complete  <br>";
        } else {
        echo(" is not a valid email address  <br>");
        }
    }
    public function setRole( string $NewRole){
        if (in_array($NewRole, ['apprenant', 'formateur', 'admin'])) {
            $this->role=$NewRole;
            echo "role updated  <br>";
        }else {
            echo "Invalid role  <br>";
        }
    }
       public function setDateNaissance(string $newDateNaissance) {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $newDateNaissance)) {

            $birthDate = new DateTime($newDateNaissance);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;

            if ($age >= 16 && $age <= 60) {
                $this->dateNaissance = $newDateNaissance;
                echo "date de naissance changed succesfuly  <br>";
            } else {
                echo "Âge invalide  <br>";
            }

        } else {
            echo "Format invalide (YYYY-MM-DD)  <br>";
        }
    }
           public function setDateInscription(string $NewDateInscription) {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $NewDateInscription)) {

            $dateInscription = new DateTime($NewDateInscription);
            $today = new DateTime();
            $diffrence = $today->diff($dateInscription)->days;

            if ($diffrence<0) {
              echo "date inscription invalide invalide  <br>";
            } else {
                  $this->dateInscription = $NewDateInscription;
                echo "date d inscreption changed succesfuly  <br>";
            }

        } else {
            echo "Format invalide (YYYY-MM-DD)  <br>";
        }
    }
       public function setActif(int $newActif) {
        if($newActif ==0 || $newActif ==1){
            $this->actif=$newActif;
             echo "actif changed   <br>";
        }else{
            echo "enter 1 for actif or 0 for inactif  <br>";
        }
        
        //getters
    }
    public function getAge(){ 
            $birthDate = new DateTime($this->dateNaissance);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;
            return $age;
    }
    public function getNomComplet(){ 
        $nomComplet= $this->prenom ." ". strtoupper($this->nom);
           
            return $nomComplet ;
    }
    public function getInitiales(){
        $initiales=strtoupper($this->prenom[0]) ."." . strtoupper($this->nom[0]);
        return $initiales;
    }
  
    public function getAnciennete(){
           $dateInscreption = new DateTime($this->dateInscription);
            $today = new DateTime();
            $anciennte = $today->diff($dateInscreption)->days;
            return $anciennte;
       
    }
      public function isActif(){
        if($this->actif===1){
            return true;
        }else{
            return false;
        }
    }
    public function getStatutLabel(){
        if($this->isActif()){
            return "actif";

        }else{
            return "inactif";
        }
    }
    public function getRoleLabel(){
        return ' " '. $this->getRole(). ' " ';
    }
    
    


  



}