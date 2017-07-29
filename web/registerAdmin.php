<?php
require_once '../src/initialClass.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['email']) && strlen(trim($_POST['email'])) >= 3
        && isset($_POST['password']) && strlen(trim($_POST['password'])) >= 3 
        && isset($_POST['repeadPassword']) 
        && strlen(trim($_POST['repeadPassword']) === trim($_POST['password']))) {
        //Powtórzenie hasła do rejestracji

        if (!empty($_POST['email']) . $connect -> real_escape_string($_POST['email']) &&
                !empty($_POST['password']) . $connect -> real_escape_string($_POST['password'])) {
            // usuwanie znaków specjalnych jeśli hasło i email nie są puste
            
            // zapisywanie nowego klienta 
            $admin = new Admin();
            $admin -> setEmail(trim($_POST['email']));
            $admin -> setPassword(trim($_POST['password']));

            if ($admin -> save($connect)) {
                $message = '<script language="javascript"> alert("New admin has been successfully registered") </script>';
                echo $message;
            }
            else {
                $message = '<script language="javascript"> alert("Error while creating new admin") </script>';
                echo $message . $connect -> connect_error;
            }
        }
        else {
            echo ("Incorrect data in form, validate and try again!");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Register Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body> 
        <form method ='POST'>
            <div class="container">
                <div class="jumbotron">
                    <h2>Register new Administrator!</h2><br>
                    <div class="form-group">
                        <label for="E-mail">E-mail:</label>
                        <input type="email" class="form-control" name="email" 
                               placeholder="administrator e-mail"><br>
                        <label for="Password">Password:</label>
                        <input type="password" class="form-control" name="password"
                               placeholder="***"><br>
                        <label for="Repeat_password">Repeat password:</label>
                        <input type="password" class="form-control" name="repeadPassword"                        placeholder="***"><br>
                    </div>
                    <div class="form-group"><br>
                        <input class="btn btn-danger" type="submit" value="Register new Administrator">
                    </div>
                </div>
            </div>
        </form>    
    </body>
</html>