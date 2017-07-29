<?php
session_start();

require_once '../src/initialClass.php';

if(!isset($_SESSION['userId'])){
    header('Location: ../public/login.php');
}

$userSession = $_SESSION['userId'];
$loggedUser = User::loadUserById($connect, $userSession);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUser'])){     
    
    $deleteUser = trim($_POST['deleteUser']);
     
        // pole wyboru usunięcia użytkownika 
        switch ($deleteUser){
            case 'no':
                header("Location: userPage.php");
                break;
            case 'yes':
                if ($loggedUser->delete($connect)){
                    header("Location: index.php");
                }
                else{
                    echo 'Something went wrong, please try again! <br>';
                }
                break;
        }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete Page</title>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body> 
        <div class="container">
        <div class="jumbotron"> 
            <form action="" method="post" role="form">
                <legend>
                   Are you sure to delete your account 
                   <?php 
                        echo $loggedUser->getName() . " " . $loggedUser->getSurname() . '?'; 
                   ?>
               </legend>
               <button type="submit" class="btn btn-danger" value="yes" name="deleteUser">Yes</button>
               <button type="submit" class="btn btn-success" value="no" name="deleteUser">No</button>  
            </form> 
        </div>
        </div>      
    </body>
</html>
