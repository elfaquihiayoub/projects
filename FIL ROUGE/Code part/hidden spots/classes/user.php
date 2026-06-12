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

    // Find user by username (for profile edit uniqueness check)
    public function findByUsername($username) {
        $stmt = $this->DbConn->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    // Find user by ID
    public function findById($id) {
        $stmt = $this->DbConn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Update profile (username + email)
    public function updateProfile($id, $username, $email) {
        // Check if email is taken by another user
        $stmt = $this->DbConn->prepare("SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1");
        $stmt->execute(['email' => $email, 'id' => $id]);
        if ($stmt->fetch()) {
            return ["success" => false, "message" => "Email is already taken."];
        }

        // Check if username is taken by another user
        $stmt = $this->DbConn->prepare("SELECT id FROM users WHERE username = :username AND id != :id LIMIT 1");
        $stmt->execute(['username' => $username, 'id' => $id]);
        if ($stmt->fetch()) {
            return ["success" => false, "message" => "Username is already taken."];
        }

        $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        $stmt = $this->DbConn->prepare($sql);
        $result = $stmt->execute([
            'username' => $username,
            'email' => $email,
            'id' => $id
        ]);

        return $result
            ? ["success" => true, "message" => "Profile updated."]
            : ["success" => false, "message" => "Update failed."];
    }

    // Update password
    public function updatePassword($id, $current_password, $new_password) {
        $user = $this->findById($id);
        if (!$user) {
            return ["success" => false, "message" => "User not found."];
        }

        if (!password_verify($current_password, $user['password'])) {
            return ["success" => false, "message" => "Current password is incorrect."];
        }

        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $this->DbConn->prepare("UPDATE users SET password = :password WHERE id = :id");
        $result = $stmt->execute(['password' => $hashed, 'id' => $id]);

        return $result
            ? ["success" => true, "message" => "Password changed."]
            : ["success" => false, "message" => "Update failed."];
    }
}
