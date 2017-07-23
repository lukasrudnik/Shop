<?php

require_once '/../src/initialClass.php';
require_once '/../src/classes/Admin.php';

class AdminTest extends PHPUnit_Extensions_Database_TestCase
{
    private $admin;
    private static $connection;

    public function getConnection()
    {
        $connection = new PDO(
                $GLOBALS['db_host'], 
                $GLOBALS['db_user'], 
                $GLOBALS['db_password']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($connection, $GLOBALS['db_name']);
    }

    public function getDataSet()
    {
        return $this -> createFlatXmlDataSet(__DIR__ . '/DataSet/Admin.xml');
    }

    public function testAdminSave()
    {
        $admin = new Admin();
        $admin -> setEmail('admin@host.com');
        $admin -> setPassword('haslo123');
        $this -> assertTrue($admin -> save(self::$connection));
    }

    public function testAdminDelete()
    {
        $admin = new Admin();
        $admin -> setEmail('admin@host');
        $admin -> setPassword('haslo123');
        $this -> assertTrue($admin -> delete(self::$connection));
    }

}
