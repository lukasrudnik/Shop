<?php

class Image{
    
    private $id;
    private $product_id;
    private $path;
    
    public function __construct(){
        $this->id = -1;
        $this->product_id = '';
        $this->path = '';
    }
    
    
    function getId(){
        return $this->id;
    }
    
    function getProduct_id(){
        return $this->productId;
    }
    
    function getPath(){
        return $this->path;
    }
    
    
    function setProduct_id($productId){
        $this->productId = $productId;
    }
    
    function setPath($path){
        $this->path = $path;
    }

    
    // ładowanie obrazka po ID produktu
    public static function loadImagesByProductId(mysqli $connection, $id){
        
        $sql = "SELECT * FROM Images WHERE Product_id = $id";
        
        $result = $connection->query($sql);
        $imageTable = [];
        
        if($result == true && $result->num_rows > 0){
            foreach ($result as $row){
                
                $image = new Image();
                $image->id = $row['id'];
                $image->productId = $row['product_id'];
                $image->path = $row['path'];
                $image->type = $row['type'];
                $imageTable[] = $image;
            }
        }
        return $imageTable;
    }
    

    // zapisywanie do DB
    public function save(mysqli $connection){
        
        if($this->imgId == -1){
            $sql = "INSERT INTO Images(product_id, path, type)
                    VALUES('{$this->product_id}' , '{$this->path}' , '{$this->type}')";
            
            $result = $connection->query($sql);
            
            if($result){
                $this->id = $connection->insert_id;
                return true;
            }
        
        }
        // lub aktualizacja 
        else{
            $sql = "UPDATE Images SET productId = '{$this->product_id}' , path = '{$this->path}' , 
                    type = '{$this->type}' WHERE id = '{$this->id}'";
            
            $result = $connection->query($sql);
            
            if($result){
                return true;
            }
        }
        return false;
    }

}

?>