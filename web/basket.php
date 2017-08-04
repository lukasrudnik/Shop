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
        <title>Basket Page</title>
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
                <b>Basket user</b>
                <?php 
                    
                // odbieranie id uzytkownika ktorego chcemy usac i wyswietlanie jego danych
                if ($adminSession) {
                            
                      // wyswietlanie danych uzytkownia po odebraniu 'name' z formularza
                      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idUsera'])) {
                                
                          $idUsera  = ($_POST['idUsera']); 
                          $userById = User::loadUserById($connect, $idUsera);   
                            
                          echo '<b> ' . $userById->getName() . ' ' . $userById->getSurname() . '</b>:';
                          
                          echo '<br><br><b>User data:</b><br> id: ' . $idUsera . 
                                 '<br> name: ' . $userById->getName() . 
                                 '<br> surname: ' . $userById->getSurname() . 
                                 '<br> e-mail: ' . $userById->getEmail() .
                                 '<br> address: ' . $userById->getAddress();
                                  
                          echo '<br><br>';
                            
                           // przyciski do usuwania uzytkownika
                           echo('<form action="adminpage.php" method="post">
                            <button type="submit" class="btn btn-primary" name="backPage" 
                             value="' . $idUsera . '">Back</button></form><br>');
                     }
                 }
                
                echo "<b>User basket: </b><br><br>";
                echo "'tu będzie zawartość koszyka'";
                
                 ?>
            </legend>             
        </div>
        </div>      
    </body>
</html>
