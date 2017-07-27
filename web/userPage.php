<?php
session_start();

require_once '../src/initialClass.php';

if(!isset($_SESSION['userId'])){
    header('Location: login.php');
}

// Aktywna sesja użytkownika
$userSession = $_SESSION['userId'];
$loggedUser = User::loadUserById($connect, $userSession);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
        <title>User page</title>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header navbar-left">
                <a class="navbar-brand">Hello,
                <?php
                    echo $loggedUser->getName() . " "; 
                    echo $loggedUser->getSurname() . "! ;)"; 
                ?> <!-- powitanie zalogowanego użytkownika -->
                </a> 
                <ul>     
                    <a href="index.php">
                    <?php
                        echo "Shop page";
                    ?> <!-- przekierowanie na stronę główną --> 
                    </a>                    
                    <br>
                    <?php
                        // przekierowanie na stronę zmiany danych użytkwnika
                         if(isset($_SESSION['userId'])){              
                             echo "<a href='settings.php'>Settings page</a> <br>";
                         }
                        
                        if(isset($_SESSION['userId'])){
                            echo "<a href='logout.php'>Logout</a>";
                        } 
                    ?> <!-- Wylogowanie zalogowanego użytkownika -->   
                </ul> 
            </div>
        </div>
    </nav>
    <div class="container">
    <div class="jumbotron">  
    
dokończe jutro
   
    </div>
    </div>
 </body>
</html>