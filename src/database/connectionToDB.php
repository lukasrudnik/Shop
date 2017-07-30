<?php

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "Shop_DB";

//$db_host = "localhost";
//$db_username = "root";
//$db_password = "coderslab";
//$db_name = "Shop_DB";

$connect = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($connect->connect_error) {
    die("Połączenie nieudane! Błąd: " . $connect->connect_error);
}

?>