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
            echo " set name complete";
            
        }else{
            echo " invalide name";
        }
    }
    public function setPrenom( string $NewPrenom){
        if(preg_match('/^[a-zA-Z\s]{2,}$/', $NewPrenom)){
            $this->prenom=$NewPrenom;
             echo " set prenome complete";
            
            
        }else{
            echo " invalide Prenom";
        }
    }
    public function setEmail( string $NewEmail){
        if (filter_var($NewEmail, FILTER_VALIDATE_EMAIL)) {
             $this->email=$NewEmail;
              echo " set email complete";
        } else {
        echo(" is not a valid email address");
        }
    }
    public function setRole( string $NewRole){
        if (in_array($NewRole, ['apprenant', 'formateur', 'admin'])) {
            $this->role=$NewRole;
            echo "role updated";
        }else {
            echo "Invalid role";
        }
    }
    // public function setDateNaissance( string $NewsDateNaissance){
    //     if (){
    //         echo "role updated";
    //     }else {
    //         echo "Invalid role";
    //     }
    // }



}