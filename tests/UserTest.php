<?php

require_once '/../src/initialClass.php';
require_once '/../src/classes/User.php';

class UserTest extends PHPUnit_Extensions_Database_TestCase
{

    private $user;
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
        return $this -> createFlatXmlDataSet(__DIR__ . '/DataSet/Admin.xml');
    }

    public function testUserLogin()
    {
        $user = User::login(self::$connection, 'user@host.com', 'haslo321');
        $this -> assertEquals(1, $user);
    }

    public function testNewUserCreation()
    {
        $user = new User();
        $user -> setEmail('user@host.com');
        $user -> setPassword('haslo321');
        $this -> assertTrue($user -> save(self::$connection));
    }

    public function testUserRemoval()
    {
        $user = new User();
        $user -> setEmail('user@host.com');
        $user -> setPassword('haslo321');
        $this -> assertTrue($user -> delete(self::$connection));
    }

}
