<?php

$servername = 'localhost';
$username = 'root';
$basename = '';
$password = '';  // połączenie bez hasła

$connect = new mysqli($servername, $username, $basename, $password);

if ($connect->connect_error){
    die("Połączenie nieudane!" . "<br>" . $connect->connect_error); 
}
echo("Połączenie udane." . "<br>");

$sql = "CREATE DATABASE Shop_DB"; 
$result = $connect->query($sql);

if ($result != FALSE){
    echo ("Baza danych Shop_DB została stworzona poprawnie." . "<br>");
}
else{
    echo("Błąd podczas tworzenia bazy danych!" . "<br>" . $connect->error);
}

?>