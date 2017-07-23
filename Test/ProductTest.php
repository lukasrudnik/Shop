<?php

require_once '/../src/initialClass.php';
require_once '../src/classes/Product.php';

class ProductTest extends PHPUnit_Extensions_Database_TestCase
{

    private $product;
    private static $connection;

    public function getConnection()
    {
        $connection = new PDO(
                $GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($connection, $GLOBALS['db_name']);
    }

    public function getDataSet()
    {
        return $product -> createFlatXmlDataSet(__DIR__ . '/DataSet/Product.xml');
    }

    public function testSaveToDB()
    {
        $product                   = new Product();
        $product -> setPrice       = 1;
        $product -> setAmount      = 1;
        $product -> setDescription = 'sample description';
        $product -> setIn_stock    = 1;
        $product -> category_id    = 1;

        $product -> assertTrue($product -> saveToDB(self::$connection));
    }

    public function testDeleteFromDB()
    {
        $product                   = new Product();
        $product -> setPrice       = 1;
        $product -> setAmount      = 1;
        $product -> setDescription = 'sample description';
        $product -> setIn_stock    = 1;
        $product -> category_id    = 1;
        
        $this -> assertTrue($product -> deleteFromDB(self::$connection));
    }


}
