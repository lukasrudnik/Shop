<?php
session_start();

require_once '../src/initialClass.php';

if(!isset($_SESSION['userId'])){
    header('Location: ../public/login.php');
}

$userSession = $_SESSION['userId'];
$loggedUser = User::loadUserById($connect, $userSession);


echo " strona zmiany danych klienta - dokończe jutro ";