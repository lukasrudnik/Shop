<?php

// autoloader wszystkich klas w pliku classes.php
require_once 'database/connectionToDB.php';

spl_autoload_register(function($class){
    require_once "classes/{$class}.php";
});

?>