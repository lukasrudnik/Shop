<?php

require_once '/../src/initialClass.php';
require_once '../src/classes/Image.php';

class ImageTest extends PHPUnit_Extensions_Database_TestCase
{

    private $image;
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
        return $this -> createFlatXmlDataSet(__DIR__ . '/DataSet/Image.xml');
    }

    public function testNewImageAdding()
    {
        $image = new Image();
        $image -> setProduct_id(1);
        $image -> setPath('path');

        $this -> assertTrue($image -> save(self::$connection));
    }

    public function testImagesLoadingFromDB()
    {
        $images = Image::loadImagesByProductId(self::$connection, 1);
        $this -> assertCount(8, $images);
    }

}
