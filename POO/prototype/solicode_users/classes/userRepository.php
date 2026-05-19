<?php
class UserRepository
{
    private PDO $pdo;
    public function __construct( PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    //findall function
    public function findAll(){
        $stmt=$this->pdo->query("SELECT * FROM users");
        $rows = $stmt->fetchAll();
        $users =[];
        foreach($rows as $row){
               $users[] = $this->hydrater($row);
             

        };

        return $users;
    }

//finbyId function 
    public function findById( int $id){
    $stmt=$this->pdo->prepare("SELECT * FROM users WHERE id= ?");
    $stmt->execute([$id]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row){
        return null;
    }else{
        return $this->hydrater($row);
    }
}
  public function findByEmail(string $email){
    $stmt=$this->pdo->prepare("SELECT * FROM users WHERE email= ?");
    $stmt->execute([$email]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row){
        return null;
    }else{
        return $this->hydrater($row);
    }
}
    
public function save(user $user):void{
    if($user->getId()==0){
        $stmt=$this->pdo->prepare(" INSERT INTO users(nom, prenom, email, role, date_naissance, date_inscription, actif)
         VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $user->getNom(),
            $user->getPrenom(),
            $user->getEmail(),
            $user->getRole(),
            $user->getDateNaissance(),
            $user->getDateInscription(),
            $user->getActive()

        ]);
    }else{
        $stmt=$this->pdo->prepare("UPDATE users SET nom=?,prenom=?,email=?,role=?,date_naissance=? , date_inscription=?,actif=? WHERE id=?");
        $stmt->execute([
             $user->getNom(),
            $user->getPrenom(),
            $user->getEmail(),
            $user->getRole(),
            $user->getDateNaissance(),
            $user->getDateInscription(),
            $user->isActif(),
            $user->getId()
        ]);
    }
}
public function delete(int $id){
    $stmt=$this->pdo->prepare("DELETE FROM users WHERE id=?");
    $stmt->execute([$id]);
}
private function hydrater(array $row): user
{
    $user = new user();

    $user->setId($row['id']);
    $user->setNom($row['nom']);
    $user->setPrenom($row['prenom']);
    $user->setEmail($row['email']);
    $user->setRole($row['role']);
    $user->setDateNaissance($row['date_naissance']);
    $user->setDateInscription($row['date_inscription']);
    $user->setActif($row['actif']);

    return $user;
}
}
