<?php

class Admin{
    
    private $id;
    private $email;
    private $password;
    
    public function __construct(){
        $this->id = -1; 
        $this->email = "";
        $this->password = "";
    }
    
    
    function getId(){
        return $this->id;
    }
        
    function getEmail(){
        return $this->email;
    }
    
    function setEmail($email){
        $this->email = $email;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    // funkcja haszująca hasło + dodatkowa sól
    function setPassword($password){
        $optionSalt = ['cost'=>11]; 
        
        if(is_string($password) && strlen(trim($password)) >=6 ){
            $newPassword = password_hash($password, PASSWORD_BCRYPT, $optionSalt);
            $this->password = $newPassword;
        }
    }
    
    // ładowanie poprzez id admina 
    public static function loadByAdminId (mysqli $connection, $id){
        
        $sql = "SELECT * FROM Admins WHERE id = $id";
        $result = $connection->query($sql);
        
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            
            $admin = new Admin();
            $admin->id = $row['id'];
            $admin->email = $row['email'];
            $admin->password = $row['password']; 
            return $admin;   
        }
        else{
            return false;
        }
    }
    
    // ładowanie pooprzez email admina
    public static function loadByAdminEmail(mysqli $connection, $email, $password){
        
        $email = $connection->real_escape_string($email);
        
        $sql = "SELECT * FROM Admins WHERE email = '" . $email . "'";
        $result = $connection->query($sql);    
        $row = $result->fetch_assoc();
        
        if(isset($row['id']) && $row['id'] > 0){  
            if(password_verify($password, $admin['password'])){
                return $row['id'];
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    
    // zapisywanie do DB
    public function save(mysqli $connection){
        
        if($this->id == -1){
            $sql = "INSERT INTO Admins(email, password) 
                    VALUES('{$this->email}' , '{$this->password}')";
            
            $result = $connection->query($sql);
            
            if($result){
                $this->id = $connection->insert_id;
                return true;
            }
        }
        // lub aktualizacja danych w DB
        else{
            $sql = "UPDATE Admins SET email = '{$this->email}' , password = '{$this->password}' 
                    WHERE id = {$this->id}";
            
            $result = $conn->query($sql);
            if($result){
                return true;
            }
        }
        return false;
    }
    
    // usuwanie z DB
    public function delete(mysqli $connection){
        
        if($this->id != -1){
            $sql = "DELETE FROM Users WHERE id = {$this->id}";
            
            $result = $connection->query($sql);
           
            if($result == true){
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}

?>