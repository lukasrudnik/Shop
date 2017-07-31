<?php
require_once '../src/initialClass.php';

$categoryTable = ['Vegetables', 'Fruits'];

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Grocery Store</title>
        <meta name="description" content="Source code generated using layoutit.com">
        <meta name="author" content="LayoutIt!">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <center>
        <h1> Available fruits</h1>
    </center>
    <div class="container" align="center">
        <img src="../images/fruits/Arbuz.jpg" width="10%" height="10%">
        <img src="../images/fruits/ananas.jpg" width="10%" height="10%">
        <img src="../images/fruits/banan.jpg" width="10%" height="10%">
        <img src="../images/fruits/gruszka.jpg" width="10%" height="10%">
        <img src="../images/fruits/jablko.jpeg" width="10%" height="10%">
        <img src="../images/fruits/truskawka.jpg" width="10%" height="10%">
    </div>
            <?php
            $sql    = "SELECT * FROM Products WHERE category_id = 2";
            $result = $connect -> query($sql);

            if ($result -> num_rows > 0) {
                // output data of each row
                while ($row = $result -> fetch_assoc()) {
                    echo "Product name: " . $row["name"] . ", Price: " . $row["price"] . "<br>";
                    
                }
            } else {
                echo "0 results";
            }
            $connect -> close();
            ?>
        
    </body>
</html>