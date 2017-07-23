<?php

require_once 'Money.php';

class Basket{
    
    private $products; // tablica z produktami 
    
    public function __construct(){
        $this->products = [];
    }
    
    function getProducts(){
        return $this->products;
    }
    
    // dodawanie produktów do koszyka
    public function addNewProduct($product, $amount){
        
        // dodawanie produktów tylko w sesji zalogowanego użytkownika
        if(isset($_SESSION['loggedUser'])){
            
            // dodawanie jeśli tablica z produktami jest pusta 
            if(count($this->products) == 0){   
                $this->products[] = [$product->getId(),// [$i][1]  
                                     $product->getName(),
                                     $product->path, // ścieżka obrazka
                                     $product->getPrice(), // [$i][4]
                                     $amount,
                                     $product->getPrice() * $amount];
            }
            // lub dodaje dodatkowe produkty do istniejących w koszyku  
            else{
                for($i = 0; $i < count($this->products); $i++){
                    
                    if($this->products[$i][1] == $product->getId()){
                        $this->products[$i][4] += $amount; // dodawanie ilosci do ceny produktu
                        $addNewProduct = false;
                        break;
                    }
                    else{
                        $addNewProduct = true;
                    }
                }
            }
        } 
        
    }
    
    // usuwanie produktów
    public function deleteProduct($id){
        
        for($i = 0; $i < count($this->products); $i++){
            if($this->products[$i][1] == $id){
                array_splice($this->products, $i, 1);
            }
        }
    }
    
    // wyświetlanie informacji o koszyku
    public function printBasketInfo(){
        $money = 0;
        
/*  HTML DO ZMIANY !!!
        echo "<table class='table table-condensed text-center table-vertical-align'>";
        echo "<tr class='active'>";
        echo "<td></td>";
        echo "<td>nazwa</td>";
        echo "<td>cena</td>";
        echo "<td>ilosc</td>";
        echo "<td>cena total</td>";
        echo "<td></td>";
        echo "</tr>";
*/        
        
        foreach($this->products as $row){    
            $money += $row[5];  
            
/*  HTML DO ZMIANY !!!      
            echo "<tr><td class='tdKosz'><div><img class='imgKosz' src='../../" . $row[0] . "'></div></td>";
            echo "<td class='tdItem'>$row[2]</td>";
            echo "<td class='tdItem'>" . moneyFormat($row[3]) . "</td>";
            echo "<td class='tdItem'>$row[4]</td>";
            echo "<td class='tdItem'>" . moneyFormat($row[5]) . "</td>";
            echo "<td class='tdItem' id='deleteFromBox'><a href='main-koszyk.php?remove=$row[1]'><span class='glyphicon glyphicon-remove aria-hidden='true'></span></a></td></tr>";
*/            
        }
        
/*  HTML DO ZMIANY !!!
        echo "<tr><td><td><td><td><td class='danger'>" . moneyFormat($money) . "</td></td></td></td></td></tr>";
        echo "</table>";
*/
     
    }
    
}

?>