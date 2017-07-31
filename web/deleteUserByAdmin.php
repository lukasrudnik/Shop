<?php
session_start();

require_once '../src/initialClass.php';

$adminSession = $_SESSION['adminId'];
$admin = Admin::loadByAdminId($connect, $adminSession);

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
            <legend>
                   <b>Are you sure to delete this account?</b>
                   <?php 
                    
                    // odbieranie id uzytkownika ktorego chcemy usac i wyswietlanie jego danych
                    if ($adminSession) {
                            
                        // wyswietlanie danych uzytkownia po odebraniu 'name' z formularza
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idUsera'])) {
                                
                             $idUsera  = ($_POST['idUsera']); 
                             $userById = User::loadUserById($connect, $idUsera);    
                                
                             echo '<br><br> id: ' . $idUsera . 
                                    '<br> name: ' . $userById->getName() . 
                                    '<br> surname: ' . $userById->getSurname() . 
                                    '<br> e-mail: ' . $userById->getEmail() .
                                    '<br> address: ' . $userById->getAddress();
                                  
                            echo '<br><br>';
                            
                            // przyciski do usuwania uzytkownika
                            echo('<form action="adminpage.php" method="post">
                                <button type="submit" class="btn btn-success" name="backPage" 
                                value="' . $idUsera . '">No!</button></form><br>');
                            
                            echo('<form action="#" method="post">
                                <button type="submit" class="btn btn-danger" name="deleteUser" 
                                value="' . $idUsera . '">Yes!</button></form><br>');      
                        }
   
                        // usuwanie uzytkownika 
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUser'])) {
                            
                            $deleteUser  = ($_POST['deleteUser']); 
                            $userId = new User();
                            $userId = User::loadUserById($connect, $deleteUser);  
                            
                            // echo  ' ' . $userId->getName();
                            $userId->delete($connect);
                            header('Location: adminPage.php');  
            
                        }
                    }
            
                    ?>
            </legend>             
        </div>
        </div>      
    </body>
</html>          
<?php

// wybieranie opcji usuniecia uzytkownika z sesji admin




//if ($adminSession) {
//    
//        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUserByAdmin'])){     
//    
//            $deleteUser = trim($_POST['deleteUserByAdmin']);
//            
//            // pole wyboru usunięcia użytkownika 
//            switch ($deleteUser){
//                case 'no':
//                    header("Location: adminPage.php");
//                    break;
//                case 'yes':
//                    echo'<pre>';          
//                    if ($userById->delete($connect)){
//                        header("Location: adminPage.php");
//                    }
//                    else{
//                        echo 'Something went wrong, please try again! <br>';
//                    }
//                    break;
//            }
//        }
//    
//}

?>