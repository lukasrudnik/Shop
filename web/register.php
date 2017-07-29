<?php
require_once '../src/initialClass.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && strlen(trim($_POST['name'])) >= 3 
        && isset($_POST['surname']) && strlen(trim($_POST['surname'])) >= 3 
        && isset($_POST['address']) && strlen(trim($_POST['address'])) >= 6 
        && isset($_POST['email']) && strlen(trim($_POST['email'])) >= 3 
        && isset($_POST['password']) && strlen(trim($_POST['password'])) >= 3 
        && isset($_POST['repeadPassword']) 
        && trim($_POST['repeadPassword']) === trim($_POST['password'])) {
        //Powtórzenie hasła do rejestracji

        if (!empty($_POST['email']) . $connect -> real_escape_string($_POST['email']) &&
                !empty($_POST['password']) . $connect -> real_escape_string($_POST['password'])) {
            // usuwanie znaków specjalnych jeśli hasło i email nie są puste
            
            // zapisywanie nowego klienta 
            $user = new User();
            $user -> setName(trim($_POST['name']));
            $user -> setSurname(trim($_POST['surname']));
            $user -> setEmail(trim($_POST['email']));
            $user -> setAddress(trim($_POST['address']));
            $user -> setPassword(trim($_POST['password']));

            if ($user -> save($connect)) {
                echo("<script>alert('New user has been successfully registered!')</script>");
                echo("<script>window.location = 'login.php';</script>"); 
            } else {
                $message = '<script language="javascript"> alert("Error while creating new user") </script>';
                echo $message;
            }
        } else {
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
                    <h2>Please register at the store to continue shopping</h2><br>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" 
                               placeholder="min. 3 characters"><br>
                        <label for="Surname">Surname:</label>
                        <input type="text" class="form-control" name="surname" 
                               placeholder="min. 3 characters"><br>
                        <label for="Address">Full Address:</label>
                        <input type="text" class="form-control" name="address" 
                               placeholder="Country, City, Street"><br>
                        <label for="E-mail">E-mail:</label>
                        <input type="email" class="form-control" name="email" 
                               placeholder="min. 6 characters"><br>
                        <label for="Password">Password:</label>
                        <input type="password" class="form-control" name="password"
                               placeholder="***"><br>
                        <label for="Repeat_password">Repeat password:</label>
                        <input type="password" class="form-control" name="repeadPassword"                        placeholder="***"><br>
                    </div>
                    <div class="form-group"><br>
                        <input class="btn btn-success" type="submit" value="Register new Client">
                        <a class="btn btn-warning" href="login.php">Click to move to Login Page</a>
                        <a class="btn btn-primary" href="index.php">
                            Click to move to Main Shop Page</a>
                    </div>
                </div>
            </div>
        </form>    
    </body>
</html>