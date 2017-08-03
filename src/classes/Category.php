<?php

class Category {

    private $id;
    private $category_id;
    private $category_name;
  
    private function __construct() {
        
        $this -> id  = -1;
        $this->category_id = 0;
        $this->category_name = '';
    }
    
    // getery i setery
    function getId() {
        return $this->id;
    }
    
    public function getCategory_id() {
        return $this->category_id;
    }
    
    public function getCategory_name() {
        return $this->category_name;
    }
    
    function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }
    
    function setCategory_name($category_name) {
        $this->category_name = $category_name;
    }
        
    // tworzenie kategorii
    public static function createCategory($category_name) {
        
        $sql = "SELECT * FROM Categories WHERE category_name = '$category_name'";
        
        $result = CreateCategory::$connect->query($sql);
        
        if ($result->num_rows == 0) {
            
            $sql = "INSERT INTO Categories(category_name) values '$category_name'";
            
            if (Category::$connect->query($sql) === true) {
                
                return new Category(Category::$connect->insert_id, $category_name);
            }
        }
        return null;
    }
    
    // ładowanie wszystkich kategorii   
        static public function loadAllCategory(mysqli $connection){
        
        $sql = "SELECT * FROM Categories";
        
        $result = $connection->query($sql);
        $categoryTable = [];
        
        if($result->num_rows > 0){
            foreach ($result as $row){
                
                $category = new Category();
                $category->id = $row['id'];
                $category->category_id = $row['$category_id'];
                $category->category_name = $row['$category_name'];

                $categoryTable[] = $category;
            }
        }
        return $categoryTable;
    }
    
    // usuwanie kategorii
    public static function deleteCategory($deleteId) {
        
        $sql = "DELETE FROM Categories WHERE id = '$deleteId'";
        
        if (Category::$connect->query($sql) === true) {
            return true;
        }
        return false;
    }

    // pobieranie id 
    public static function getCategory($category_id) {
        
        $sql = "SELECT * FROM Catoegries where id = '$category_id'";
        
        $result = Category::$connect->query($sql);
        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            return new ProductGroup($id, $row['category_name']);
        }
        return null;
    }
    
    // zapisywanie do DB
    public function save() {
        $sql = "UPDATE Categories SET category_name = '{$this->category_name}' 
                WHERE category_id = {$this->category_id}";
        
        return Category::$connect->query($sql);
    }
        
}