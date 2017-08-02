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
        <nav class="navbar navbar-inverse" role="navigation">	
            <div class="navbar-header"> 
                <a class="navbar-brand">Administrator:
                    <?php
                        echo ' (id: ' . $admin->getId() . ') ';
                        echo ' (mail: ' . $admin->getEmail() . ')'; 
                    ?>
                </a>  
            </div>
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php
                            // przekierowanie na stronę zmiany danych użytkwnika
                            if (isset($_SESSION['adminId'])) {
                                echo ("<a class=\"dropdown-toggle\" href=\"adminPage.php\">
                                        Back to Administrator page</a>");
                            }
                        ?>
                    </li>
                </ul>
         </div>
        </nav>
        <div class="container">
        <div class="jumbotron"> 
            <legend>
                   <b>Are you sure to change data this account?</b>
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
                                value="' . $idUsera . '">No!</button></form><br><br>');
                            
                            /* formularze do zmiany danych uzytkownika - hidden przekazuje
                               zmienna z ID usera ktorego zmieniam dane */
                            echo ('<form method="POST">
                            <label>
                                <input type="text" class="form-control" name="changeName"
                                       placeholder="change user name">
                                <input type="hidden" name="idUsera" value="' . $idUsera . '">         
                            </label>
                            <br>
                            <form action="#" method="post">
                            <input type="hidden" name="idUsera" value="' . $idUsera . '">
                            <button type="submit" class="btn btn-warning" value="idUsera">
                            change value </button></form><br>');
                            
                            echo ('<form method="POST">
                            <label>
                                <input type="text" class="form-control" name="changeSurname"
                                       placeholder="change user surname">
                                <input type="hidden" name="idUsera" value="' . $idUsera . '">         
                            </label>
                            <br>
                            <form action="#" method="post">
                            <input type="hidden" name="idUsera" value="' . $idUsera . '">
                            <button type="submit" class="btn btn-warning" value="idUsera">
                            change value </button></form><br>');
                                                
                            echo ('<form method="POST">
                            <label>
                                <input type="text" class="form-control" name="changeAddress"
                                       placeholder="change user address">
                                <input type="hidden" name="idUsera" value="' . $idUsera . '">         
                            </label>
                            <br>
                            <form action="#" method="post">
                            <input type="hidden" name="idUsera" value="' . $idUsera . '">
                            <button type="submit" class="btn btn-warning" value="idUsera">
                            change value </button></form><br>');
                            
                            
                        }
                                                              
                        // zmiana danych uzytkownika 
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeName']) 
                            && isset($_POST['idUsera'])
                            && strlen(trim($_POST['changeName'])) >= 3) {
                                               
                            $changeName = ($_POST['changeName']); 
                            $idUsera = ($_POST['idUsera']);
                                                   
                            $sql = "UPDATE Users SET name = '$changeName' WHERE id = '$idUsera'";
                            $query = $connect->query($sql);

                            header('Location: adminPage.php'); 
                        }       
                        
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeSurname']) 
                            && isset($_POST['idUsera'])
                            && strlen(trim($_POST['changeSurname'])) >= 3) {
                                               
                            $changeSurname = ($_POST['changeSurname']); 
                            $idUsera = ($_POST['idUsera']);
                                                  
                            $sql = "UPDATE Users SET surname = '$changeSurname' WHERE id = '$idUsera'";
                            $query = $connect->query($sql);

                            header('Location: adminPage.php'); 
                        }  
                        
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeAddress']) 
                            && isset($_POST['idUsera'])
                            && strlen(trim($_POST['changeAddress'])) >= 6) {
                                               
                            $changeAddress = ($_POST['changeAddress']); 
                            $idUsera = ($_POST['idUsera']);
                                                     
                            $sql = "UPDATE Users SET address = '$changeAddress' WHERE id = '$idUsera'";
                            $query = $connect->query($sql);

                            header('Location: adminPage.php'); 
                        }  
                    }   
                
                    ?>
            </legend>             
        </div>
        </div>      
    </body>
</html>