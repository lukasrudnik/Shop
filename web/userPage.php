<?php
session_start();

require_once '../src/initialClass.php';

if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
}

// Aktywna sesja użytkownika
$userSession = $_SESSION['userId'];
$loggedUser  = User::loadUserById($connect, $userSession);
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
        <div class="col-md-12">
            <nav class="navbar navbar-inverse" role="navigation">	
                <div class="navbar-header"> 
                    <a class="navbar-brand">Hello,
                        <?php
                        echo $loggedUser -> getName() . " ";
                        echo $loggedUser -> getSurname();
                        ?> <!-- powitanie zalogowanego użytkownika -->
                    </a>
                    <a class="navbar-brand" href="index.php">Click to run to Shop page</a>
                </div>
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?php
                            // przekierowanie na stronę zmiany danych użytkwnika
                            if (isset($_SESSION['userId'])) {
                                echo ("<a class=\"dropdown-toggle\" href=\"settings.php\">Settings</a>");
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            // wylogowanie zalogowanego użytkownika	
                            if (isset($_SESSION['userId'])) {
                                echo ("<a class=\"dropdown-toggle\" href=\"logout.php\">Logout</a>");
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="jumbotron">
            <div class="col-md-12">
            <?php
             if($loggedUser == true){
                 
                 echo "'Tu będzie się wyświetlał koszyk klienta " . $loggedUser->getName() ."'";
             }
            ?>     
            </div>
            </div>
        </div>
    </body>
</html>