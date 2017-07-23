<html>
    <head>

    </head>
    <body>
        <?php
        foreach ($products as $product) {
            echo '<p>' . $product -> getName() . '</p>';
        }
        ?>
    </body>
</html>

