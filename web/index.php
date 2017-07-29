<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Grocery Store</title>
        <meta name="description" content="Source code generated using layoutit.com">
        <meta name="author" content="LayoutIt!">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-inverse" role="navigation">	
                        <div class="navbar-header"> 
                            <button type="button" class="navbar-toggle" data-toggle="collapse" 
                                    data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                            </button><a class="navbar-brand" href="#">Home</a>
                        </div>	
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="cities">
                                    <a href="fruitsList.php"> Fresch Fruits</a>
                                </li>
                                <li class="cities">
                                    <a href="vegetablesList.php"> Fresch Vegetables</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        More categories <strong class="caret"></strong></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">More products coming soon</a>
                                        </li>			
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">More products coming soon</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control">
                                </div> 
                                <button type="submit" class="btn btn-default">Search</button>
                            </form>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Panels
                                        <strong class="caret"></strong></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href=adminPage.php>Admin Panel</a>
                                        </li>			
                                        <li class="divider"></li>
                                        <li>
                                            <a href="userPage.php">Clients Panel</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="contactPage.php">Contact Us</a>
                                </li>
                            </ul>
                        </div>		
                    </nav>
                    <div class="jumbotron">
                        <center>
                            <div id="carousel-example-generic2" class="carousel slide">

                                <!-- Wskaźniki w postaci kropek -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic2" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic2" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic2" data-slide-to="2"></li>
                                </ol>

                                <!-- Slajdy -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="../images/ima1.jpg" alt="">

                                        <!-- Opis slajdu -->
                                        <div class="carousel-caption">
                                            <!--
                                            <h3>To jest opis</h3>
                                            <p>pierwszego slajdu</p>
                                            -->
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="../images/ima2.jpg" alt="">

                                        <!-- Opis slajdu -->
                                        <div class="carousel-caption">
                                            <!--
                                            <h3>To jest opis</h3>
                                            <p>drugiego slajdu</p>
                                            -->
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="../images/ima3.jpg" alt="">

                                        <!-- Opis slajdu -->
                                        <div class="carousel-caption">
                                            <!--
                                            <h3>To jest opis</h3>
                                            <p>trzeciego slajdu</p>
                                            -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Strzałki do przewijania -->
                                <a class="left carousel-control" href="#carousel-example-generic2" data-slide="prev">
                                    <span class="icon-prev"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic2" data-slide="next">
                                    <span class="icon-next"></span>
                                </a>
                            </div>
                        </center>
                        <br>
                        <center>
                            <h2>We warmly welcome you in our Healthy Food Store! ;)</h2>
                            <br>
                            <p>Please register at the Shop or login to continue shopping</p><br>
                            <p>
                                <a class="btn btn-success" href="login.php">Login</a>
                                <a class="btn btn-warning" href="register.php">Register new Cliet</a>
                            </p>
                        </center>
                    </div>
                </div>
            </div>
            <div class="container" text-align: justify>
                <div class="row">
                    <div class="col-md-4">
                        <h2 style="color:#0F0F0F">Best price</h2>
                        <p>
                            <img src="../images/best_price.jpg" alt="Quality Picture" width="50%" height="50%">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2 style="color:#0F0F0F">Daily delivery</h2>
                        <p>
                            <img src="../images/delivery.jpg" alt="Quality Picture" width="50%" height="50%">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2 style="color:#0F0F0F">Guarantee of quality</h2>

                        <p>
                            <img src="../images/Quality.jpg" alt="Quality Picture" width="50%" height="50%">
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>