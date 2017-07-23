<?php

require_once '/../src/initialClass.php';
require_once '../src/classes/Basket.php';

class BasketTest extends PHPUnit_Extensions_Database_TestCase
{

    private $basket;
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
        return $this -> createFlatXmlDataSet(__DIR__ . '/DataSet/Basket.xml');
    }

}
