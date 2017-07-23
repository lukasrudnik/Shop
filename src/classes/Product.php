<?php

class Product
{

    private $id;
    private $name;
    private $price;
    private $amount;
    private $description;
    private $in_stock;
    private $category_id;

    public function __construct()
    {
        $this -> id          = -1;
        $this -> name        = '';
        $this -> price       = 0;
        $this -> amount      = 0;
        $this -> description = '';
        $this -> in_stock    = 0;
        $this -> category_id = 0;
    }

    function getId()
    {
        return $this -> category;
    }

    function getName()
    {
        return $this -> name;
    }

    function getPrice()
    {
        return $this -> price;
    }

    function getAmount()
    {
        return $this -> amount;
    }

    function getDescription()
    {
        return $this -> description;
    }

    function getInStock()
    {
        return $this -> inStock;
    }

    function getcategoryId()
    {
        return $this -> productId;
    }

    function setName($name)
    {
        $this -> name = $name;
    }

    function setPrice($price)
    {
        $this -> price = $price;
    }

    function setAmount($amount)
    {
        $this -> amount = $amount;
    }

    function setDescription($description)
    {
        $this -> description = $description;
    }

    function setIn_stock($inStock)
    {
        $this -> inStock = $inStock;
    }

    function setCategory_id($categoryId)
    {
        $this -> categoryId = $categoryId;
    }

    public function saveToDB()
    {
        $sql = sprintf("INSERT INTO Products (`name`, `price`, `amount`, `description`, `inStock`, `category_id`)
                              VALUES ('%s', '%s', '%s', '%s', '%s', '%s');", 
                $this -> getName(), 
                $this -> getPrice(), 
                $this -> getAmount(), 
                $this -> getDescription(), 
                $this -> getIn_stock(), 
                $this -> getCategory_id());
    }

    public function deleteFromDB()
    {
        $sql = "DELETE FROM Products WHERE id = $id";
        if (Product::$connection -> query($sql) === TRUE) {
            return true;
        }
        return false;
    }

    // ładowanie produktów po ich ID +  
    public static function loadProductsById(mysqli $connection, $id)
    {

        $sql = "SELECT * FROM Products JOIN Categories ON Products.category_id = Categories.category_id JOIN Images ON Products.product_id = Images.product_id WHERE Images.type = 1 AND Products.product_id = $id";

        $result = $connection -> query($sql);

        if ($result -> num_rows == 1) {
            $row = $result -> fetch_assoc();

            $product                = new Product();
            $product -> id          = $row['id'];
            $product -> name        = $row['name'];
            $product -> price       = $row['price'];
            $product -> amount      = $row['amount'];
            $product -> description = $row['description'];
            $product -> inStock     = $row['inStock'];
            $product -> categoryId  = $row['categoryId'];

            $product -> path          = $row['path']; // tabela Images
            $product -> category_name = $row['category_name']; // tabela Categories
            return $product;
        } else {
            return false;
        }
    }

    // ładowanie produktów po ID ich kategorii
    public static function loadProductsByCategory(mysqli $connection, $category)
    {

        $sql = "SELECT * FROM Products JOIN Categories ON Products.category_id = Categories.category_id
        JOIN Images ON Products.product_id = Images.product_id WHERE Images.type = 1 AND Categories.category_name = '$category'";

        $result       = $connection -> query($sql);
        $productTable = [];

        if ($result == true && $result -> num_rows > 0) {
            foreach ($result as $row) {

                $product                = new Product();
                $product -> id          = $row['id'];
                $product -> name        = $row['name'];
                $product -> price       = $row['price'];
                $product -> amount      = $row['amount'];
                $product -> description = $row['description'];
                $product -> inStock     = $row['inStock'];
                $product -> categoryId  = $row['categoryId'];

                $product -> path          = $row['path']; // tabela Images
                $product -> category_name = $row['category_name']; // tabela Categories

                $productTable[] = $product;
            }
        }
        return $productTable;
    }

    // ładowanie wszydtkich prodóktów 
    public static function loadAllProducts(mysqli $connection)
    {

        $sql = "SELECT * FROM Products JOIN Categories ON Products.category_id = Categories.category_id JOIN Images ON Products.product_id = Images.product_id WHERE Images.type = 1";

        $result       = $conn -> query($sql);
        $productTable = [];

        if ($result == true && $result -> num_rows > 0) {
            foreach ($result as $row) {

                $product                = new Product();
                $product -> id          = $row['id'];
                $product -> name        = $row['name'];
                $product -> price       = $row['price'];
                $product -> amount      = $row['amount'];
                $product -> description = $row['description'];
                $product -> inStock     = $row['inStock'];
                $product -> categoryId  = $row['categoryId'];

                $product -> path          = $row['path']; // tabela Images
                $product -> category_name = $row['category_name']; // tabela Categories

                $productTable[] = $product;
            }
        }
        return $productTable;
    }

}

?>