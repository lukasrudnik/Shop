<?php
session_start();

require_once '../src/initialClass.php';

if(!isset($_SESSION['adminId'])){
    header('Location: ../public/loginAdmin.php');
}

$adminSession = $_SESSION['adminId'];
$admin = Admin::loadByAdminId($connect, $adminSession);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteAdmin'])){     
    
    $deleteAdmin = trim($_POST['deleteAdmin']);
     
        // pole wyboru usunięcia użytkownika 
        switch ($deleteAdmin){
            case 'no':
                header("Location: adminPage.php");
                break;
            case 'yes':
                if ($admin->delete($connect)){
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
                   Are you sure to delete Administrator account 
                   <?php 
                        echo $admin -> getEmail() . '?'; 
                   ?>
               </legend>
               <button type="submit" class="btn btn-danger" value="yes" name="deleteAdmin">Yes</button>
               <button type="submit" class="btn btn-success" value="no" name="deleteAdmin">No</button>  
            </form> 
        </div>
        </div>      
    </body>
</html>