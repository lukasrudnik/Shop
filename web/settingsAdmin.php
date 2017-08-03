<?php
session_start();

require_once '../src/initialClass.php';

if(!isset($_SESSION['adminId'])){
    header('Location: login.php');
}

$adminSession = $_SESSION['adminId'];
$admin = Admin::loadByAdminId($connect, $adminSession);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['email']) && strlen(trim($_POST['email'])) >= 6 
        && isset($_POST['password']) && strlen(trim($_POST['password'])) >= 6 
        && isset($_POST['repeatPassword']) 
        && trim($_POST['repeatPassword']) === trim($_POST['password'])) {

        if(!empty($_POST['email']) . $connect -> real_escape_string($_POST['email']) 
            && !empty($_POST['password']) . $connect -> real_escape_string($_POST['password'])){

            // zmiana dnych admina 
            $admin->email = $row['email'];
            $admin->password = $row['password'];
            $user -> save($connect);

            if ($user -> save($connect) == TRUE) {
                $message = '<script language="javascript"> alert("Data changed successfully") </script>';
                echo $message;
            } else {
                $message = '<script language="javascript"> alert("Error!") </script>';
                echo $message;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"> 
        <title>Admin settings page</title>
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="col-md-12">
            <nav class="navbar navbar-inverse" role="navigation">	
            <div class="navbar-header"> 
                <a class="navbar-brand">Administrator:
                    <?php
                        echo ' (id: ' . $admin->getId() . ') ';
                        echo ' (mail: ' . $admin->getEmail() . ')';
                    ?> <!-- powitanie zalogowanego użytkownika -->
                </a>
                <a class="navbar-brand" href="index.php">Run to main page</a>
            </div>
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?php
                            if (isset($_SESSION['adminId'])) {
                                echo ("<a class=\"dropdown-toggle\" href=\"adminPage.php\">
                                   Back to Administrator page</a>");
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            // wylogowanie zalogowanego użytkownika	
                            if (isset($_SESSION['adminId'])) {
                                echo ("<a class=\"dropdown-toggle\" href=\"logout.php\">Logout</a>");
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="jumbotron"> 
                <div class="container-fluid">
                    <form method="POST">
                        <label>
                           <h4>Administrator e-mail:</h4>
                            <?php
                            echo $admin -> getEmail();
                            ?>
                            <br>
                            <input type="email" class="form-control" name="email" 
                                   placeholder="change e-mail here">
                        </label>
                        <br>
                        <label>
                            <br><h4>Give a new administrator password:</h4> 
                            <input type="password" class="form-control" name='password' 
                                   placeholder="change password here">
                        </label>
                        <br>
                        <label>
                            <br><h4>Repeat password:</h4>
                            <input type='password' class="form-control" name="repeatPassword" 
                                   placeholder="repeat password here">
                            <br><br>
                            <input role="button" class="btn btn-warning" type="submit" value="Change the values">
                        </label>
                    </form> 
                    <br><br>
                    <form action="deleteAdmin.php" method="post">
                        <button type="submit" class="btn btn-danger" value="deleteAdmin">Delete</button>
                    </form> 
                </div>
            </div>
        </div>   
    </body>
</html>