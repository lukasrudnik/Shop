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
            <form action="" method="post" role="form" enctype="multipart/form-data">
                <legend>Add new product</legend>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name"
                               placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" name="amount"
                               placeholder="amount" step="1">
                    </div>     
                    <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" class="form-control" name="price"
                                   placeholder="price" step="0.01">
                    </div> 
                    <div class="form-group">
                            <label for="">Description</label>
                            <input type="textarea" class="form-control" name="description"
                                   placeholder="description">
                    </div>  
                    <div class="form-group">
                            <label for="">Stock</label>
                            <input type="number" class="form-control" name="in_stock"
                                   placeholder="in stock">
                     </div>
                     <div class="form-group">
                        <label for="">Category ID</label>
                            <select class="form-control" name="category_id"
                                    placeholder="category id">
                        <?php
                                
                            if ($adminSession == true) {
                                
                                // pobieranie i wyświetlanie kategorii           
                                $categories = Category::loadAllCategory($connect);
                                                         
                                foreach ($categories as $category) {
                                    echo '<option value = ' . $category->getCategory_id() . ' >';
                                    echo $category->getCategory_name();
                                    echo '</option>';
                                    
                                    echo $category->getCategory_name();
                                }
                         }
                                
                        ?>                        
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                            <label for="">Add photo</label>
                            <input type="file" name="image" class="btn btn-default">
                    </div>
                    <br>
                        <button type="submit" class="btn btn-success">Add photo</button>
                    </form>
    <?php
            
        if($adminSession == true){
                
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) 
               && !empty($_POST['amount']) && !empty($_POST['price']) 
               && !empty($_POST['description']) && !empty($_POST['in_stock']) 
               //&& !empty($_POST['category_id']))
            ){
        
                    $productName = trim($_POST['name']);
                    $productAmount = trim($_POST['amount']);
                    $productPrice = trim($_POST['price']);
                    $productDescription = trim($_POST['description']);
                    $productInStock = trim($_POST['in_stock']);
                   // $productCategoryId = trim($_POST['category_id']);
                
                    $newProduct = Product::createProduct($productName, $productPrice, $productAmount, 
                                           $productDescription, $productInStock);
                // , $productCategoryId
                        
                        $newProduct -> setName(trim($_POST['name']));
                        $newProduct -> setAmount(trim($_POST['amount']));
                        $newProduct -> setPrice(trim($_POST['price']));                      
                        $newProduct -> setDescription(trim($_POST['description']));
                        $newProduct -> setInStock(trim($_POST['in_stock']));
                       // $newProduct->setCategory_id($productCategoryId);
                        $newProduct -> saveToDB($connect);
                                    
                        if ($newProduct->saveToDB()) {
                            
                            echo "OK";
                
                        }
                }
            }
                    
    ?>       
        </div>
        </div>
    </div>  
</body>
</html>