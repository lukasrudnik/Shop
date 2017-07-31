<?php

require_once '/../src/initialClass.php';
require_once '../src/classes/Order.php';

class OrderTest extends PHPUnit_Extensions_Database_TestCase
{

    public function testSaveToDB()
    {
        $order               = new Order();
        $order -> user_id    = "";
        $order -> product_id = "";
        $order -> status     = "Nowe";
        $order -> amount     = "";

        $order -> assertTrue($order -> saveToDB(self::$connection));
    }

    public function testDeleteFromDB()
    {
        $order               = new Order();
        $order -> user_id    = "";
        $order -> product_id = "";
        $order -> status     = "Nowe";
        $order -> amount     = "";

        $order -> assertTrue($order -> deleteFromDB(self::$connection));
    }

    public function testloadAllOrders()
    {
        
    }

    public function testloadOrdersByUserId()
    {
        
    }

    public function testloadOrdersById()
    {
        
    }

}
