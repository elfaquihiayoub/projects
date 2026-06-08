<?php
require_once  __DIR__.'/../config/database.php';
class User{
    private $DbConn;
    public function __construct(){
        $this->DbConn = Database::getInstance()->getConnection();
    }
    // find user by email
    public function findByEmail($email){
        $stmt = $this->DbConn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    // register user 

        public function register($username,$email,$password){
            // check if email already exists
            if($this->findByEmail($email)){
                return ["success" => false, "message" => "Email already exists"];
            // email already exists
            }
            // hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  
            $sql = "INSERT INTO users (username, email, password) 
                    VALUES (:username, :email, :password)";

            $stmt = $this->DbConn->prepare($sql);

            $result = $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);
                if ($result) {
                return ["success" => true];
            } else {
                return ["success" => false, "message" => "Registration failed"];
            }
        }

    // login user
    public function login($email, $password){
        $user=$this->findByEmail($email);
        if(!$user){
            return ["success" => false, "message" => "User not found"];
        }
        //Verify the password
        if(!password_verify($password, $user['password'])){
            return ["success" => false, "message" => "Incorrect password"];
        }
        //login succesful
        return ["success" => true, "user" => $user];
        
       
    }
}
