<?php

include_once 'connectionToDB.php';

// Tabele:

$sql = "CREATE TABLE Admins ( 
        id int AUTO_INCREMENT NOT NULL,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL UNIQUE,
        password varchar(60) NOT NULL,
        PRIMARY KEY(id)
        )";

$result = $connect->query($sql);
if($result === TRUE){
    echo ("Tabela Admin została stworzona poprawine.");
}
else{
    ("Błąd podczas tworzenia tabeli Admin!" . "<br>" . $connect->error);
}
echo "<br>";


$sql = "CREATE TABLE Users (
        id int AUTO_INCREMENT NOT NULL,
        name varchar(255) NOT NULL,
        surname varchar(255) NOT NULL,
        email varchar(255) NOT NULL UNIQUE,
        address varchar(255) NOT NULL,
        password varchar(60) NOT NULL,
        PRIMARY KEY(id)
        )";

$result = $connect->query($sql);
if($result === TRUE){
    echo ("Tabela Users została stworzona poprawine.");
}
else{
    ("Błąd podczas tworzenia tabeli Users!" . "<br>" . $connect->error);
}
echo "<br>";


$sql = "CREATE TABLE Products ( 
        id int AUTO_INCREMENT NOT NULL,
        name varchar(255) NOT NULL,
        price decimal(5,2) NOT NULL,
        amount int(5) NOT NULL,
        descritpion varchar(255) NOT NULL,
        in_stock int NOT NULL,
        category_id int(3),
        PRIMARY KEY(id) 
        )";

$result = $connect->query($sql);
if($result === TRUE){
    echo ("Tabela Products została stworzona poprawine.");
}
else{
    ("Błąd podczas tworzenia tabeli Products!" . "<br>" . $connect->error);
}
echo "<br>";


$sql = "CREATE TABLE Images ( 
        id int AUTO_INCREMENT NOT NULL,
        product_id int NOT NULL,
        path varchar(255) NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(product_id) REFERENCES Products(id)
        )";

$result = $connect->query($sql);
if($result === TRUE){
    echo ("Tabela Images została stworzona poprawine.");
}
else{
    ("Błąd podczas tworzenia tabeli Images!" . "<br>" . $connect->error);
}
echo "<br>";


$sql = "CREATE TABLE Orders ( 
        id int AUTO_INCREMENT NOT NULL,
        user_id int NOT NULL,
        product_id int NOT NULL,
        status varchar(60) NOT NULL,
        amount int(5) NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(user_id) REFERENCES Users(id),
        FOREIGN KEY(product_id) REFERENCES Products(id)
        )";

$result = $connect->query($sql);
if($result === TRUE){
    echo ("Tabela Orders została stworzona poprawine.");
}
else{
    ("Błąd podczas tworzenia tabeli Orders!" . "<br>" . $connect->error);
}
echo "<br>";

$sql = "CREATE TABLE Categories ( 
        id int AUTO_INCREMENT NOT NULL,
        category_id int(3) NOT NULL,
        category_name varchar(30) NOT NULL,
        PRIMARY KEY(id)
        )";

$result = $connect->query($sql);
if($result === TRUE){
    echo ("Tabela Categories została stworzona poprawine.");
}
else{
    ("Błąd podczas tworzenia tabeli Categories!" . "<br>" . $connect->error);
}
echo "<br>";

// ENGINE=InnoDB, CHARACTER SET=utf8

?>