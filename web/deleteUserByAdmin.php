<?php
session_start();

require_once '../src/initialClass.php';

$adminSession = $_SESSION['adminId'];
$admin = Admin::loadByAdminId($connect, $adminSession);

if ($adminSession) {
    
    $allUsers = User::loadAllUsers($connect);    
    foreach($allUsers as $user){
    
    $user = User::loadUserById($connect, $user->getId());
        
        /// var_dump 
        echo"<pre>";
        var_dump($user);
    
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUserByAdmin'])){     
    
            $deleteUser = trim($_POST['deleteUserByAdmin']);
     
            // pole wyboru usunięcia użytkownika 
            switch ($deleteUser){
                case 'no':
                    header("Location: adminPage.php");
                    break;
                case 'yes':
                    echo'<pre>';       
                    if ($user->delete($connect)){
                        header("Location: adminPage.php");
                    }
                    else{
                        echo 'Something went wrong, please try again! <br>';
                    }
                    break;
            }
        }
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
                   Are you sure to delete this account?
                    <?php 
                        echo '<br><br> id: ' . $user->getId() . '<br> name: ' . $user->getName() 
                            . '<br> surname: ' . $user->getSurname() . '<br> e-mail: ' 
                            . $user->getEmail(); 
                   ?>
               </legend>
               <button type="submit" class="btn btn-danger" value="yes"
                       name="deleteUserByAdmin">Yes</button>
               <button type="submit" class="btn btn-success" value="no"
                       name="deleteUserByAdmin">No</button>  
            </form> 
        </div>
        </div>      
    </body>
</html>