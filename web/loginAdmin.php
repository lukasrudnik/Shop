<?php
session_start();

require_once '../src/initialClass.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' 
   && isset($_POST['email']) && (strlen(trim($_POST['email'])) >= 3)
   && isset($_POST['password']) && (strlen(trim($_POST['password'])) >= 3)){
       
    if(strlen(trim($_POST['email'])) && strlen(trim($_POST['password'])) < 3){
        echo ("e-mail and password must be have minimum 3 characters! <br>");
    }
   
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);    
    
    if(!empty($_POST['email']) . $connect->real_escape_string($email)
       && !empty($_POST['password']) . $connect->real_escape_string($password)){        
       // usuwanie znaków specjalnych jeśli hasło i email nie są puste
        
        $sql = "SELECT * FROM Admins WHERE email = '$email'"; 
        $query = $connect->query($sql);
        // połączenie do email w tabeli Users
    
        // sprawdzenie czy podany email lub hasło są w bazie danych 
        if(!`mysqli_num_rows` > 0){
            echo "Please check the correctness of contents! <br>";
        }
        
        // pobieranie rzędu w tablicy assocjacyjnej
        if($query->num_rows > 0){
            $row = $query->fetch_assoc();  
             
            // sprawdzenie podanego w formularzu hasła z hasłem zapisanym w bazie danych
            $adminPassword = $row['password'];
            $checkPassword = password_verify($password, $adminPassword);
            
            // ustawienie sesji i przekierowanie na stronę klienta        
            if($checkPassword){
                $_SESSION['adminId'] = $row['id'];
                header('Location: adminPage.php');         
            }
            else{
                echo ("Wrong e-mail or password, please check password and try again! <br>");
            }   
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
       <link rel="stylesheet"
       href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
       integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
       crossorigin="anonymous">
</head>
<body>
    <form method="POST">
        <div class="container">
            <div class="jumbotron">
                <h2>Administrator login:</h2><br>
            <div class="form-group">
               <label for="E-mail">Administrator e-mail:</label>
               <input type="email" class="form-control" name="email" placeholder="Your e-mail">
               <br>
               <label for="Password">Administrator password:</label>
               <br>
               <input type="password" class="form-control" name="password" placeholder="Your password">   
               <br><br><br>
               <input class="btn btn-success" type="submit" value="Login In">
                <a class="btn btn-primary" href="index.php">Click to move to Main Shop Page</a>
            </div>
            </div>
       </div>
    </form>
</body>
</html>