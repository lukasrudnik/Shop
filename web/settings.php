<?php
session_start();

require_once '../src/initialClass.php';

if(!isset($_SESSION['userId'])){
    header('Location: login.php');
}

$userSession = $_SESSION['userId'];
$user = User::loadUserById($connect, $userSession);

if($_SERVER['REQUEST_METHOD'] == 'POST'){  
    if(isset($_POST['name']) && strlen(trim($_POST['name'])) >= 3 
       && isset($_POST['surname']) && strlen(trim($_POST['surname'])) >= 3 
       && isset($_POST['address']) && strlen(trim($_POST['address'])) >= 6 
       && isset($_POST['email']) && strlen(trim($_POST['email'])) >= 6 
       && isset($_POST['password']) && strlen(trim($_POST['password'])) >= 6   
       && isset($_POST['repeatPassword'])
       && trim($_POST['repeatPassword']) === trim($_POST['password'])){
        
        if(!empty($_POST['email']) . $connect->real_escape_string($_POST['email']) && 
           !empty($_POST['password']) . $connect->real_escape_string($_POST['password'])){ 
      
            // zmiana dnych użytkownka  
            $user->save($connect);
            $user->setName(trim($_POST['name']));
            $user->setSurname(trim($_POST['surname']));
            $user->setEmail(trim($_POST['email']));
            $user->setAddress(trim($_POST['address']));
            $user->setPassword(trim($_POST['password']));
            
            echo 'Data corrected correctly! Your new username is: ' . $_POST['name'] . '<br>';
        }
        else{
            echo 'The given passwords are not identical, data is were not corrected! <br>';
        }
    }
    else{
        echo 'Invalid data provided! <br>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
        <title>Settings page</title>
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
                        echo $user->getName() . " " . $user->getSurname(); 
                    ?> <!-- powitanie zalogowanego użytkownika -->
                </a>
               
            </div>
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                  <li>
                    <?php
                       // przekierowanie na stronę zmiany danych użytkwnika
                        if(isset($_SESSION['userId'])){              
                            echo ("<a class=\"dropdown-toggle\" href=\"userPage.php\">
                                   Back to Client page</a>");
                        }
                    ?>
                    </li>
                    <li>
                    <?php
                        // wylogowanie zalogowanego użytkownika	
                        if(isset($_SESSION['userId'])){
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
                <h4>Your Name:</h4>
                <?php
                    echo $user->getName() . '</b>';
                ?>
                <br>
                <input type="text" class="form-control" name="name" 
                       placeholder="change name here">
            </label>
            <br>
            <label>
                <br><h4>Your Surname:</h4>
                <?php
                    echo $user->getSurname() . '</b>';
                ?>
                <br>
                <input type="text" class="form-control" name="surname" 
                       placeholder="change surname here">
            </label>
            <br>
            <label>
                <br><h4>Your Address:</h4>
                <?php
                    echo $user->getAddress() . '</b>';
                ?>
                <br>
                <input type="text" class="form-control" name="address" 
                       placeholder="change address here">
            </label>
            <br>
            <label>
                <br><h4>Your E-mail:</h4>
                <?php
                    echo $user->getEmail();
                ?>
                <br>
                <input type="email" class="form-control" name="email" 
                       placeholder="change e-mail here">
            </label>
            <br>
            <label>
                <br><h4>Give a new password:</h4> 
                <input type="password" class="form-control" name='password' 
                       placeholder="change password here">
            </label>
            <br>
            <label>
                <br><h4>Repeat password:</h4>
                <input type='password' class="form-control" name="repeatPassword" 
                       placeholder="repeat password here">
                <br><br><br>
                <input role="button" class="btn btn-warning" type="submit" value="Change the values">
            </label>
        </form> 
        <br><br><br>
        <form action="deleteUser.php" method="post">
            <button type="submit" class="btn btn-danger" value="deleteUser">Delete</button>
        </form> 
        </div>
        </div>
     </div>   
    </body>
</html>