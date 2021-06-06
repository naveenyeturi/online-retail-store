<?php 

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require 'connection.php';


session_start();

// $temp = $_SESSION['user'];

// echo "<script>console.log('$temp');</script>";




if(!isset($_SESSION['user'])){
  header("location: customer-login.php");
}

?>


<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg> -->


    <!-- from w3 schools -->
    <!-- <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->


    <title> Product UI </title>


    <style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .navbar-brand {
        padding-bottom: 20px;
    }


    body {
        /* background-color:lightgray; */
    }

    .test {
        background-color: lightgray;
    }

    .container {
        /* background-color: green; */
    }

    #myCarousel {
        margin: 10px;
        width: 100%;
        /* background-color:blue; */
    }

    .col-md-3:hover {
        transform: scaleY(1.07);
        /* background-color:lightblue; */
    }

    /* .backgroundBlue:hover{
      transform: scaleY(1.06);
      background-color:lightblue;
     } */

    .row {
        margin: 10px 0 10px 0;
    }

    .col-md-3 {
        padding: 10px 0 10px 0;
    }

    .category-search {
        background-color: lightgray;
        margin: 10px;
        padding: 10px;
    }

    .categories {
        /* padding: 20px; */
        width: 100%;
        /* background-color: lightyellow; */
        background-color: #ffe0e1;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0px 5px 0px 5px;

    }

    .category {
        text-align: center;
    }

    .search {
        padding-bottom: 10px;
        padding-top: 0px;
    }

    .searchbar {
        padding-bottom: 0px;
        border-radius: 10px;
        width: 25%;

        height: 44px;

    }

    .search button {
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        font-size: 20px;
        border: none;
        cursor: pointer;
        background-color: lightgray;
    }

    .search button:hover {
        background-color: gray;
    }

    /* .addtocart{
       background: #ff9f00;
     } */

    .addedtocart {
        color: black;
        background-color: yellow;
    }

    .addedtocart:hover {
        color: black;
        background-color: yellow;
    }

    .pages-class-div {
        display: flex;

        justify-content: center;

    }

    .pages-class {
        border: 1px solid black;
        padding: 10px;
        margin: 5px;

    }

    .previous-next{
        border: 1px solid black;
        padding: 10px 20px 10px 20px;
        margin: 5px;
        width: 90px;
    }
    .previous-next:hover{
      background-color: gray;
      color: white;
    }

    @media only screen and (max-width: 480px) {
        .col-md-3 {
            min-height: 400px;
        }
    }
    </style>
</head>



<body>


    <?php



    //  require 'connection.php';

     $custemail = $_SESSION['user'];

     $con_clear = Connect();

     $sql_clear = "update product set addedtocart='0'";

    //  $res_clear = mysqli_query($con_clear, $sql_clear);
    $res_clear = $con_clear->query($sql_clear);

    //  echo "<script>console.log('Test');</script>";


    // $con_cart = mysqli_connect('localhost', 'root', '', 'online_mall');

    $con_cart = Connect();

    $sql_cart= "select * from cartdetails where custemail = '$custemail'";

    // $res_cart = mysqli_query($con_cart, $sql_cart);
    $res_cart = $con_clear->query($sql_cart);

    // $rows = mysqli_num_rows($res_cart);
    $rows = $res_cart->rowCount();

    // echo "<script>console.log('$rows');</script>";
    $noofproductsincart = $rows;

    


    if ($res_cart->rowCount()/*mysqli_num_rows($res_cart)*/ > 0)
    {
      while($row_cart = $res_cart->fetch(PDO::FETCH_ASSOC)/*$row_cart = mysqli_fetch_assoc($res_cart)*/){

        

        $productid_cart = $row_cart['productid'];


        echo "<script type='text/javascript'>
        /*console.log('$productid_cart');*/
        </script>";


        $con3 = Connect();

        if (!$con3) {
          die("Connection failed: " . mysqli_connect_error());
        }
      
        $sql3 = "update product set addedtocart='1' where productid='$productid_cart'";
    


        if($con3->query($sql3)/*mysqli_query($con3, $sql3)*/){

        }else{
      
          echo "<script type='text/javascript'>alert('Error');
            window.location='product-ui.php';
            </script>";
      
        }
      }
    }

?>

    <?php

    $con_for_name = Connect();
    $sql_for_name = "select custname from customer where custemail='$custemail'";

    // $result_for_name = mysqli_query($con_for_name, $sql_for_name);
    $result_for_name = $con_for_name->query($sql_for_name);

    // $row_for_name = mysqli_fetch_assoc($result_for_name);
    $row_for_name = $result_for_name->fetch(PDO::FETCH_ASSOC);
    
    $username = $row_for_name['custname'];

    // echo "<script>console.log('$username');</script>";

?>


    <!-- From w3 schools -->


    <nav class="navbar navbar-inverse" style="margin-bottom: 0px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="product-ui.php">
                    <!-- <img src="productimages/temp.jpg" alt="logo" style="width:40%;"> -->
                    MyMall
                </a>
            </div>


            <!-- <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="#">HTML</a></li>
        <li><a href="#">CSS</a></li>
        <li><a href="#">JavaScript</a></li>
      </ul>
    </div> -->


            <div class="collapse navbar-collapse" id="myNavbar">

                <!-- <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a href="#">HTML</a></li>
          <li><a href="#">CSS</a></li>
          <li><a href="#">JavaScript</a></li>
        </ul>
      </div> -->


                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#"><?php echo "Hello, ".$username  ?></a></li>
                    <li><a href="cart.php">Cart<strong><sub
                                    style="color:white;"><?php if($noofproductsincart>0) echo "(".$noofproductsincart.")" ?></sub></strong></a>
                    </li>
                    <li><a href="orders.php">Orders</a></li>
                    <li><a href="#" onclick='logout()'>Logout</a></li>
                    <!-- <li><a href="logout.php">Logout</a></li> -->
                </ul>

            </div>
        </div>
    </nav>




    <div class="test">


        <div class="container">

            <!-- From w3 schools -->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img src="productimages/realmenarzo30a-slide.jpg" alt="realmenarzo30a" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="productimages/oneplustv-slide.jpg" alt="oneplustv" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="productimages/pocox3pro-slide.jpg" alt="pocox3pro" style="width:100%;">
                    </div>




                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <!-- <span class="glyphicon glyphicon-chevron-left"></span> -->
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <!-- <span class="glyphicon glyphicon-chevron-right"></span> -->
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>



        <div class="category-search">


            <div class="search">
                <form method="post" action="product-ui.php">
                    <input id="searchbar" class="searchbar" type="search" name="productname"
                        placeholder="Search for products..." required>
                    <!-- <button type="submit" name="search" value="search"><i class="fa fa-search"></i></button> -->

                    <button type="submit" name="search" value="search"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></button>



                </form>
            </div>


            <div class="categories">

                <form class="category" method="post" action="product-ui.php?category=mobiles">
                    <input type="image" src="productimages/mobile-category.png" alt="mobiles" width="48" height="48">
                    <p><b>Mobiles</b></p>
                </form>

                <form class="category" method="post" action="product-ui.php?category=fashion">
                    <input type="image" src="productimages/fashion-category.png" alt="fashion" width="48" height="48">
                    <p><b>Fashion</b></p>
                </form>

                <form class="category" method="post" action="product-ui.php?category=electronics">
                    <input type="image" src="productimages/electronics-category.png" alt="electronics" width="48"
                        height="48">
                    <p><b>Electronics</b></p>
                </form>

                <form class="category" method="post" action="product-ui.php?category=appliances">
                    <input type="image" src="productimages/appliances-category.png" alt="appliances" width="48"
                        height="48">
                    <p><b>Appliances</b></p>
                </form>

                <form class="category" method="post" action="product-ui.php?category=grocery">
                    <input type="image" src="productimages/grocery-category.png" alt="grocery" width="48" height="48">
                    <p><b>Grocery</b></p>
                </form>

            </div>



        </div>

    </div>

    <div class="container" style="width:95%;">

        <!-- Display all products from products table -->
        <?php

// require 'connection.php';
$conn = Connect();

if(isset($_GET["page"])){
  $page = $_GET["page"];
}
else{
  $page = 1;
}

$no_of_products_per_page = 12;

$start_from = ($page - 1)*$no_of_products_per_page;


$sql = "SELECT * FROM product order by productid limit $no_of_products_per_page offset $start_from";

if(isset($_GET['category'])){
  if(!isset($_GET['category'])){
    // $category = true;
    $sql = "SELECT * FROM product order by productid";

  }elseif ($_GET['category'] == "") {
    # code...
    $sql = "SELECT * FROM product order by productid";
  }else{

    $category = $_GET['category'];
    $sql = "SELECT * FROM product where category='$category'";
  }
}

if(isset($_POST['search'])){
  if(!isset($_POST['productname'])){
    $sql = "SELECT * FROM product order by productid";

  }elseif ($_POST['productname'] == "" || $_POST['productname'] == "all") {
    # code...
    $sql = "SELECT * FROM product order by productid";
  }else{

    $productname = $_POST['productname'];
    $sql = "SELECT * FROM product where Lower(productname) like Lower('%$productname%')";

    echo "
    <script>
      document.getElementById('searchbar').value = '$productname';
    </script>
    ";

  }
}




// $sql = "SELECT * FROM product where category='$category'";
// $result = mysqli_query($conn, $sql);
$result = $conn->query($sql);

if ($result->rowCount()/*mysqli_num_rows($result)*/ > 0)
{
  $count=0;

  while($row = $result->fetch(PDO::FETCH_ASSOC)/*$row=mysqli_fetch_assoc($result)*/){
    if ($count == 0)
      echo "<div class='row'>";

    ?>
        <div class="col-md-3 col-sm-6 col-xs-6">

            <form method="get" action="product-ui.php?id=<?php echo $row['productid']; ?>">
                <div class="mypanel" align="center" ;>
                    <img src="productimages/<?php echo $row["productimage"]; ?>" class="img-responsive"
                        style="height:30%; border-radius:17px;">

                    <div class="backgroundBlue">

                        <h4 class="text-dark"><?php echo $row["productname"]; ?></h4>
                        <h5 class="text-info"><?php echo $row["productdesc"]; ?></h5>
                        <h5 class="text-danger">&#8377; <?php echo $row["productprice"];?></h5>
                        <!-- <h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5> -->


                    </div>



                    <input type="hidden" name="hidden_name" value="<?php echo $row['productname']; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $row['productprice']; ?>">
                    <input type="hidden" name="id" value="<?php echo $row['productid'];  ?>">

                    <?php if($row['addedtocart'] == 0) { ?>

                    <input type="submit" name="add" class="btn btn-success addtocart" value="Add to Cart">

                    <?php }else{ ?>

                    <input type="button" onclick="location.href = 'cart.php'" name="viewcart" class="btn addedtocart"
                        value="GO TO CART">

                    <!-- <button onClick="index.html" class="btn addedtocart">GO TO CART</button> -->

                    <?php 
      
      }
      ?>
                </div>
            </form>

        </div>

        <?php
     $count++;
     if($count==4)
     {
       echo "</div>";
       $count=0;
     }
   }
    ?>

    </div>
    </div>

    <?php

      if(!isset($_GET["category"]) and !isset($_POST["search"])){

        $sql_for_total_products = "select * from product";

        $result_for_total_products = $conn->query($sql_for_total_products);

        $row_sql_for_total_products = $result_for_total_products->rowCount();

        $total_pages = ceil($row_sql_for_total_products/$no_of_products_per_page);

        echo "<div class='pages-class-div'> ";

        if($page>1){
          echo "<a class='previous-next btn' href='product-ui.php?page=".($page-1)."'>Previous</a>";
        }

        for($i=1;$i<=$total_pages;$i++){
          echo "<a class='pages-class btn btn-primary' href='product-ui.php?page=".$i."'>$i</a>";
        }

        if($page<$total_pages){
          echo "<a class='previous-next btn' href='product-ui.php?page=".($page+1)."'>Next</a>";
        }

        echo "</div>";

      }

    ?>


    <?php
      }
      else
      {
    ?>

    <div class="container">
        <div class="jumbotron">
            <center>
                <label style="margin-left: 5px;color: red;">
                    <h1>Oops! No products available.</h1>
                </label>
                <p>We'll let u know....:P</p>
            </center>

        </div>
    </div>

    <?php

      } 

    ?>


    <?php



  // session_start();

  $custemail = $_SESSION['user'];


  $conn = Connect();


  if(isset($_GET['add'])){

    $custemail = $_SESSION['user'];
    $productid = $_GET['id'];
    $productname=$_GET['hidden_name'];
	  $productprice=$_GET['hidden_price'];
    // $productquantity=$_GET['quantity'];
    $productquantity=1;


    // echo "<script>alert('$custemail');</script>";


    $con = Connect();

		if (!$con) {
		  die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "insert into cartdetails values('$productid','$productname','$productprice','$productquantity', '$custemail')";

		if($con->query($sql)/*mysqli_query($con, $sql)*/){


      echo "<script type='text/javascript'>
			window.location='product-ui.php';
			</script>";

		}
			
		else{

      echo "<script type='text/javascript'>
			window.location='product-ui.php';
			</script>";
		}
		
	}

?>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
      https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-analytics.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-storage.js"></script>


    <script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyCHhyRQHmEwF9HQNb3iaM-SXhYGp-Ag31Y",
        authDomain: "mymall-naveen.firebaseapp.com",
        projectId: "mymall-naveen",
        storageBucket: "mymall-naveen.appspot.com",
        messagingSenderId: "1077253083611",
        appId: "1:1077253083611:web:3cd5f1774a68670d3f97fe",
        measurementId: "G-4BQC515TGN"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();

    // Initialize Firebase
    // firebase.initializeApp(firebaseConfig);
    // firebase.analytics();
    </script>


    <script src="js/logout.js"></script>


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>