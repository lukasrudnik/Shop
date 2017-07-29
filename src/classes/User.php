<?php

class User{
    
    private $id;
    private $name;
    private $surname;
    private $email;
    private $address;
    private $password;
    
    public function __construct(){
        $this->id = -1;
        $this->name = "";
        $this->surname = "";
        $this->email = "";
        $this->address = "";
        $this->password = "";
    }
    
    
    function getId(){
        return $this->id;
    }
    
    function getName(){
        return $this->name;
    }
    
    function getSurname(){
        return $this->surname;
    }
    
    function getEmail(){
        return $this->email;
    }
    
    function getAddress(){
        return $this->address;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function setName($name){
        $this->name = $name;
    }

    function setSurname($surname){
        $this->surname = $surname;
    }
    
    function setEmail($email){
        $email = strtolower($email);
        $this->email = $email;
    }
    
    function setAddress($address){
        $this->address = $address;
    }
    
    // funkcja haszująca hasło + dodatkowa sól
    function setPassword($password){
        $optionSalt = ['cost'=>11]; 
        
        if(is_string($password) && strlen(trim($password)) >= 3){
            $newPassword = password_hash($password, PASSWORD_BCRYPT, $optionSalt);
            $this->password = $newPassword;
        }
    }
    
    // funkcja pokazująca adres użytkownika
    public function showAddress(){
        $address = $this->address;
        return $showUserAddress = explode(' ', $address);
    }
     
    // zapisywanie do DB
    public function save(mysqli $connection){
        
        if($this->id == -1){
            $sql = "INSERT INTO Users (email, password, name, surname, address) 
                    VALUES ('{$this->email}' , '{$this->password}' , '{$this->name}' ,
                    '{$this->surname}' , '{$this->address}')";
            
            $result = $connection->query($sql);
            if($result == true){
                $this->id = $connection->insert_id;
                return true;
            }
            return false;
        }
        // lub aktualizacja 
        else{
            $sql = "UPDATE Users SET email = '{$this->email}', 
                                     password = '{$this->password}',
                                     name = '{$this->name}',
                                     surname = '{$this->surname}', 
                                     address = '{$this->address}' 
                    WHERE id = '{$this->id}'";
            
            if($connection->query($sql)){
                return true;
            }
            return false;
        }      
    }
        
    // ładowanie wszytkich użytkowników 
    public static function loadAllUsers(mysqli $connection){
        
        $sql = "SELECT * FROM Users";
        
        $result = $connection->query($sql);
        $userTable = [];
        
        if($result->num_rows > 1){
            foreach ($result as $row){
                
                $user = new User();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->surname = $row['surname'];
                $user->email = $row['email'];
                $user->address = $row['address'];
                // bez hasła
                $userTable[] = $user;
            }
        }
        return $userTable;
    }
    
    // ładowanie użytkownika po jego ID 
    public static function loadUserById(mysqli $connection, $id){
        
        $sql = "SELECT * FROM Users WHERE id = $id";
        $result = $connection->query($sql);
        
        if ($result->num_rows == 1){
            $row = $result->fetch_assoc();
            
            $user = new User();
            $user->id = $row['id'];
            $user->name = $row['name'];
            $user->surname = $row['surname'];
            $user->email = $row['email'];
            $user->address = $row['address'];
            $user->password = $row['password'];
            return $user;
        }
        else{
            return false;
        }
    }
    
    // logowanie użytkownika poprzez mail i hasło
    public static function login(mysqli $connection, $email, $password){
        
        $email = $connection->real_escape_string($email);
        
        $sql = "SELECT * FROM Users WHERE email = '" . $email . "'";
        
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        
        if(isset($row['id']) && $row['id'] > 0){
            if(password_verify($password, $row['password'])){
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