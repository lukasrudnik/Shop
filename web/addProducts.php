<?php
session_start();

require_once '../src/initialClass.php';

if(!isset($_SESSION['adminId'])){
    header('Location: loginAdmin.php');
}

// Aktywna sesja adminia
$adminSession = $_SESSION['adminId'];
$admin = Admin::loadByAdminId($connect, $adminSession);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
        <title>Add products page</title>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="col-md-12">
        <nav class="navbar navbar-inverse" role="navigation">	
            <div class="navbar-header"> 
                <a class="navbar-brand">Administrator:
                    <?php
                        echo ' (id: ' . $admin->getId() . ') ';
                        echo ' (mail: ' . $admin->getEmail() . ')'; 
                    ?>
                </a>
                <a class="navbar-brand" href="index.php">Run to main page</a>
            </div>
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                     <?php
                        if (isset($_SESSION['adminId'])) {
                            echo ("<a class=\"dropdown-toggle\" href=\"adminPage.php\">
                                    Back to Administrator page</a>");
                         }
                    ?>
                    </li>
                    <li>
                    <?php	
                        if (isset($_SESSION['adminId'])) {
                                echo ("<a class=\"dropdown-toggle\"
                                        href=\"logoutAdmin.php\">Logout</a>");
                        }             
                    ?>
                   </li>
                </ul>
            </div>
        </nav>
        <div class="jumbotron">  
        <div class="container-fluid">
            <legend>Add new product:</legend>
                <form method="post">
                    <label for="name">Product name</label>
                        <input type="text" class="form-control" name="name" placeholder="add name">
                    <br>  
                    <label for="price">Product price</label>
                        <input type="number" class="form-control" name="price" placeholder="add price"
                               step="0.01">
                    <br>  
                    <label for="amount">Product amount</label>
                        <input type="number" class="form-control" name="amount" placeholder="add amount"
                               step="1">           
                    <br>
                    <label for="description">Product description</label>
                        <input type="text" class="form-control" name="description" 
                               placeholder="add description">            
                    <br>
                    <label for="in_stock">Stock</label>
                        <select class="form-control" name="in_stock"> 
		                    <option>1</option>
		                    <option>0</option>
		                </select>
                    <br>
                    <label for="category_id">Category ID</label>
                        <select class="form-control" name="category_id" placeholder="category id">
                        <?php                             
                            if ($adminSession == true) {
                                
                                // pobieranie z DB i wyświetlanie kategorii           
                                $allCategories = Category::loadAllCategory($connect);
                                                         
                                foreach ($allCategories as $category) {
                                    
                                     echo '<option value = ' . $category->getCategory_id() . '>' .             $category->getCategory_name() . '</option>';    
                                }
                            }                            
                         ?>                       
                        </select>
                        <br>
                        <button type="submit" class="btn btn-success">Add product</button>
                        <br><br>
                </form>
                <form method="post">
                       <br>
                        <!-- dodawanie zdjęcia produktu -->
                        <label for="image">Add product photo</label>
                            <input type="file" name="image" class="btn btn-default">
                        <br>
                        <button type="submit" class="btn btn-primary">Add photo</button>
                        <br><br>
                </form>
        <?php          
        if ($adminSession == true) {
               
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['price'])
                && isset($_POST['amount']) && isset($_POST['description']) && isset($_POST['in_stock']) 
                && isset($_POST['category_id'])) {
        
                $productName = trim($_POST['name']);
                $productPrice = trim($_POST['price']);
                $productAmount = trim($_POST['amount']);               
                $productDescription = trim($_POST['description']);
                $productInStock = trim($_POST['in_stock']);
                $productCategoryId = trim($_POST['category_id']);
                
                $newProduct = new Product();        
                $newProduct -> setName(trim($_POST['name']));
                $newProduct -> setPrice(trim($_POST['price'])); 
                $newProduct -> setAmount(trim($_POST['amount']));                              
                $newProduct -> setDescription(trim($_POST['description']));
                $newProduct -> setIn_stock(trim($_POST['in_stock']));
                $newProduct -> setCategory_id(trim($_POST['category_id']));
                // $newProduct -> save($connect);
                                    
                if ($newProduct -> save($connect)) {                     
                            echo "Added product";
                }
                else {
                    echo "Error!";
                }
            }
        }  
        ?>       
        </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="jumbotron">  
        <div class="container-fluid">
           <legend>Product list:</legend>
            <?php
            if($adminSession == true){
                
                $allProducts = Product::loadAllProducts($connect);  
                
                foreach($allProducts as $product){
                    
                    echo ('<b>id: </b>' . $product->getId() . '  -  ' . 
                         '<b>name: </b>' . $product->getName() . '  -  ' . 
                         '<b>price: </b>' . $product->getPrice() . '  -  ' . 
                         '<b>amount: </b>' . $product->getAmount() . '  -  ' . 
                         '<b>descroption: </b>' . $product->getDescription() . '  -  ' .
                         '<b>stock: </b>' . $product->getIn_stock() . '  -  ' .
                         '<b>category id: </b>' . $product->getCategory_id() . "<br>");
                }
            }
            ?>
        </div>
        </div> 
    </div>
</body>
</html>