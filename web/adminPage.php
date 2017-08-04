<?php
session_start();

require_once '../src/initialClass.php';

if(!isset($_SESSION['adminId'])){
    header('Location: loginAdmin.php');
}

// Aktywna sesja adminia
$adminSession = $_SESSION['adminId'];
$admin = Admin::loadByAdminId($connect, $adminSession);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
        <title>Admin page</title>
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
                    ?> <!-- powitanie zalogowanego admina -->
                </a>
                <a class="navbar-brand" href="index.php">Run to main page</a>
                <a class="navbar-brand" href="addProducts.php">Add new products</a>
            </div>
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                  <li>
                    <?php
                       // przekierowanie na stronę zmiany danych admina
                        if(isset($_SESSION['adminId'])){              
                            echo ("<a class=\"dropdown-toggle\"
                                    href=\"settingsAdmin.php\">Settings</a>");
                        }
                    ?>
                    </li>
                    <li>
                    <?php
                        // wylogowanie zalogowanego admina	
                        if(isset($_SESSION['adminId'])){
                                echo ("<a class=\"dropdown-toggle\"
                                        href=\"logoutAdmin.php\">Logout</a>");
                        }             
                    ?>
                   </li>
                </ul>
            </div>
        </nav>
        <div class="jumbotron">  
        <div class="container-fluid">
        <legend>Users list:</legend>
        <?php
            
        // ładowanie wszystkich użytkowników sklepu
        if($adminSession == true){

            // dobieranie się do loadAllUsers w klasie statycznej User
            $allUsers = User::loadAllUsers($connect);    
            foreach($allUsers as $user){
    
                // widoczni są użytkownicy nie w sesji admina
                if($user->getId() != $adminSession){
                    
                    $idUsera = $user->getId();
        
                    // dane uzytkownikow
                    echo '<b> id: ' . $idUsera . '<br> ' . 
                        'name: ' . $user->getName() . '<br>' . 
                        'surname: ' . $user->getSurname() . '<br>' . 
                        'e-mail: ' . $user->getEmail() . '<br>' . 
                        'address: ' . $user->getAddress() . '</b><br>'; 
                    
                    // wysyłanie wiadomości do usera (na razie nie dziala !!!)
                    echo ('<br><form method="POST">
                        <input type="hidden" name="messageForm" value="messageForm">
                        <input type="text" class="form-control" name="newMessage" 
                        placeholder="only 255 characters"><input type="hidden" name="receiver" 
                        value="' . $user->getId() . '"><input type="submit" class="btn btn-success" value="Send message"></form>' . "<br>");
                    
                    // formularz do zmiany danych uzytkownika
                    echo('<form action="changeUserByAdmin.php" method="post">
                        <button type="submit" class="btn btn-warning" name="idUsera" 
                        value="' . $idUsera . '">Change data</button></form><br>');
    
                    // formularz do usuwania uzytkownika
                    echo('<form action="deleteUserByAdmin.php" method="post">
                        <button type="submit" class="btn btn-danger" name="idUsera" 
                        value="' . $idUsera . '">Delete</button></form><br><hr>');
                }
            }
        }
        ?>                           
        </div>
        </div>
    </div>
        <div class="col-md-12">
        <div class="jumbotron">  
        <div class="container-fluid">
           <legend>Users basket:</legend>
            <?php
            if ($adminSession == true) {
                             
                $allUsers = User::loadAllUsers($connect);    

                foreach($allUsers as $user){
                    
                    if($user->getId() != $adminSession){
                    
                    $idUsera = $user->getId();
        
                    echo('<br><form action="basket.php" method="post">
                         <button type="submit" class="btn btn-primary" name="idUsera" 
                         value="' . $idUsera . '">' . $user->getName() . '</button></form>');
                    }
                }
            }
            ?>
        </div>
        </div> 
    </div>
</body>
</html>