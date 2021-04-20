<?php 

require 'connection.php';

session_start();


if(!isset($_SESSION['user'])){
  header("location: customer-login.php");
}

?>


<html>

  <head>

  <meta name="viewport" content="width=device-width, initial-scale=1" />


    <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
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

    *{
      box-sizing: border-box;
      padding:0;
      margin:0;
    }

    .navbar-brand{
      padding-bottom: 20px;
    }

    body{
      /* background-color:lightgray; */
    }

    .test{
      background-color: lightgray;
    }

    .container{
      /* background-color: green; */
    }

     #myCarousel{
       margin: 10px;
       width:100%;
       /* background-color:blue; */
     }

     .col-md-3:hover{
      transform: scaleY(1.07);
      /* background-color:lightblue; */
     }

     /* .backgroundBlue:hover{
      transform: scaleY(1.06);
      background-color:lightblue;
     } */

     .row{
       margin:10px 0 10px 0;
     }
     .col-md-3{
       padding:10px 0 10px 0;
     }

     .category-search{
       background-color: lightgray;
       margin: 10px;
       padding: 10px;
     }

     .categories{
       /* padding: 20px; */
       width:100%;
       /* background-color: lightyellow; */
       background-color: #ffe0e1;
       height: 100px;
       display: flex;
       align-items: center;
       justify-content: space-between;
       padding: 0px 5px 0px 5px;

     }

     .category{
       text-align: center;
     }

     .search{
       padding-bottom:10px;
       padding-top: 0px;
     }

     .searchbar{
       padding-bottom: 0px;
       border-radius: 10px;
       width: 25%;

       height: 44px;

     }

     .search button{
      padding: 6px 10px;
      margin-top: 8px;
      margin-right: 16px;
      font-size: 20px;
      border: none;
      cursor: pointer;
      background-color:lightgray;
     }

     .search button:hover{
       background-color: gray;
     }

     /* .addtocart{
       background: #ff9f00;
     } */

     .addedtocart{
       color:black;
       background-color:yellow;
     }

     .addedtocart:hover{
      color:black;
       background-color:yellow;
     }


    </style>
  </head>



  <body>


     <?php


    //  require 'connection.php';

     $userid = $_SESSION['user'];

     $con_clear = Connect();

     $sql_clear = "update product set addedtocart='0'";

     $res_clear = mysqli_query($con_clear, $sql_clear);


    // $con_cart = mysqli_connect('localhost', 'root', '', 'online_mall');

    $con_cart = Connect();

    $sql_cart= "select * from cartdetails where custid = $userid";

    $res_cart = mysqli_query($con_cart, $sql_cart);

    $rows = mysqli_num_rows($res_cart);

    if (mysqli_num_rows($res_cart) > 0)
    {
      while($row_cart = mysqli_fetch_assoc($res_cart)){

        $productid_cart = $row_cart['productid'];


        echo "<script type='text/javascript'>
        console.log('$productid_cart');
        </script>";


        $con3 = Connect();

        if (!$con3) {
          die("Connection failed: " . mysqli_connect_error());
        }
      
        $sql3 = "update product set addedtocart='1' where productid='$productid_cart'";
      
        
        // echo "<script type='text/javascript'>
        // console.log('$productid_cart');
        // </script>";


        if(mysqli_query($con3, $sql3)){


        //   echo "<script type='text/javascript'>
        // console.log('$productid_cart');
        // </script>";


          // echo "<script type='text/javascript'>alert('Test1');
          //   window.location='product-ui.php';
          //   </script>";
      
        }else{
      
          // echo "<script type='text/javascript'>alert('Error');
          //   window.location='product-ui.php';
          //   </script>";
      
        }
      }
    }

?>















  
    <!-- <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function  (){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script> -->


    <!-- <nav class="navbar navbar-expand-md navbar-light bg-light">
      <a href="#" class="navbar-brand">MyMall</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navlinks">
       <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navlinks">
       <ul class="navbar-nav ml-auto" >
        <li class="nav-item">
         <a href="#" class="nav-link">Link1</a>
        </li>
        <li class="nav-item">
         <a href="#" class="nav-link">Link2</a>
        </li>
        <li class="nav-item">
         <a href="#" class="nav-link">Link3</a>
        </li>
       </ul>
      </div>
    </nav> -->




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
        Test1
      </a>
    </div>


    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        

      <!-- <li class="active">
          <div class="search">
      <form method="get" action="product-ui.php">
        <input class="searchbar" type="search" name="productname" placeholder="Search for products..." required>
        <button type="submit" name="search" value="search"><i class="fa fa-search"></i></button>
      </form>
    </div>
    </li> -->


        <li class="active"><a href="index.html">Home</a></li>
        <li><a href="#">test</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="cart.php">Cart</a></li>
      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul> -->
    </div>
  </div>
</nav>









<!-- <div class="jumbotron">
  <div class="container text-center">
    <h1>Welcome To MyMall</h1>      
    <p>All the things u need in one place</p>
    <a href="index.html">Home</a>
  </div>
</div> -->


<div class="test">


  <div class="container">
   <!-- <div id="carouselslides" class="carousel slide" data-bs-ride="carousel">
     <div class="carousel-inner">
       <div class="carousel-item active">
         <img src="productimages/lays.jpg" style="width:20%"  alt="...">
       </div>
       <div class="carousel-item">
         <img src="productimages/boost.jpg" style="width:20%" alt="...">
       </div>
       <div class="carousel-item">
         <img src="productimages/oreo.jpg" style="width:20%" alt="...">
       </div>
     </div>
    <a class="carousel-control-prev" href="#carouselslides" role="button" data-slide="prev">
           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
           <span class="sr-only">Previous</span>
   </a>
   <a class="carousel-control-next" href="#carouselslides" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
   </a>
   </div> -->



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
      <!-- <div class="item active">
        <img src="productimages/lays.jpg" alt="Lays" style="width:10%;">
      </div>

      <div class="item">
        <img src="productimages/boost.jpg" alt="boost" style="width:10%;">
      </div>
    
      <div class="item">
        <img src="productimages/oreo.jpg" alt="oreo" style="width:10%;">
      </div> -->


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
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>



  <div class="category-search">

      
   <div class="search">
      <form method="post" action="product-ui.php">
        <input class="searchbar" type="search" name="productname" placeholder="Search for products..." required>
        <!-- <button type="submit" name="search" value="search"><i class="fa fa-search"></i></button> -->

        <button type="submit" name="search" value="search"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
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
        <input type="image" src="productimages/electronics-category.png" alt="electronics" width="48" height="48">
        <p><b>Electronics</b></p>
      </form>

      <form class="category" method="post" action="product-ui.php?category=appliances">
        <input type="image" src="productimages/appliances-category.png" alt="appliances" width="48" height="48">
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

<!-- Display all Food from food table -->
<?php

// require 'connection.php';
$conn = Connect();

$sql = "SELECT * FROM product";


// if(isset($_GET['category'])){
//   $category = $_GET['category'];
// }


if(!isset($_GET['category'])){
  // $category = true;
  $sql = "SELECT * FROM product";

}elseif ($_GET['category'] == "") {
  # code...
  $sql = "SELECT * FROM product";
}else{

  $category = $_GET['category'];
  $sql = "SELECT * FROM product where category='$category'";
}

if(isset($_POST['search'])){
  if(!isset($_POST['productname'])){
    $sql = "SELECT * FROM product";

  }elseif ($_POST['productname'] == "" || $_POST['productname'] == "all") {
    # code...
    $sql = "SELECT * FROM product";
  }else{

    $productname = $_POST['productname'];
    $sql = "SELECT * FROM product where productname like '%$productname%'";
  }
}




// $sql = "SELECT * FROM product where category='$category'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
  $count=0;

  while($row = mysqli_fetch_assoc($result)){
    if ($count == 0)
      echo "<div class='row'>";

    ?>
    <div class="col-md-3 col-sm-6 col-xs-6">

     <form method="get" action="product-ui.php?id=<?php echo $row['productid']; ?>">
      <div class="mypanel" align="center";>
      <img src="productimages/<?php echo $row["productimage"]; ?>" class="img-responsive"  style="height:30%; border-radius:17px;">
      
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

            <input type="button" onclick="location.href = 'cart.php'" name="viewcart" class="btn addedtocart" value="GO TO CART">

            <!-- <button onClick="index.html" class="btn addedtocart">GO TO CART</button> -->

        <?php }?>


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
}
else
{
  ?>

  <div class="container">
    <div class="jumbotron">
      <center>
         <label style="margin-left: 5px;color: red;"> <h1>Oops! No products available.</h1> </label>
        <p>We'll let u know....:P</p>
      </center>
       
    </div>
  </div>

  <?php

}

?>


<?php



session_start();

$userid = $_SESSION['user'];


  // require 'connection.php';
  $conn = Connect();

  // echo "<script type='text/javascript'>alert('Test');</script>";

  if(isset($_GET['add'])){

    // echo "Hello ".$_GET['id'];


    $userid = $_SESSION['user'];


    $productid = $_GET['id'];

    $productname=$_GET['hidden_name'];
	  $productprice=$_GET['hidden_price'];


    $productquantity=$_GET['quantity'];


    // echo "<script type='text/javascript'>alert('$productid');</script>";
    // echo "<script type='text/javascript'>console.log('test')</script>";



    // $con1 = mysqli_connect('localhost', 'root', '', 'online_mall');

    $con1 = Connect();

	// $con1 = mysqli_connect('localhost', 'root', '', 'bigbazaar');


	// $sql2 = "select availablequantity from product where productid = '$productid'";
	// $res2 = mysqli_query($con1, $sql2);
	// $row2 = mysqli_fetch_assoc($res2);

	// $availablequantity = $row2['availablequantity'];

	// if($productquantity > $availablequantity){

	// 	  echo "<script type='text/javascript'>alert('Entered Quantity is not available');
	// 		window.location='customer_ui.php';
	// 		</script>";
	// 		exit();

	// 		// echo "<script type='text/javascript'>alert('Only'+$availablequantity+'are available');
	// 		// window.location='customer_ui.php';
	// 		// </script>";
  //     // exit();


	// }



	// $sql1 = "select * from cartdetails where productid = '$productid'
	// 		and custid = $userid";

	// $res1 = mysqli_query($con1, $sql1);
	// $rows = mysqli_num_rows($res1);

	// if($rows>0){

    // echo "<script type='text/javascript'>alert('Inside Update Cart');</script>";


		// $sql2 = "update cartdetails set productquantity = '$productquantity' where productid = $productid and custid = $userid";

		// if(mysqli_query($con1, $sql2)){
			// echo "<script type='text/javascript'>alert('Updated cart Successfully');
			// window.location='product-ui.php';
			// </script>";


      // echo "<script type='text/javascript'>
			// window.location='product-ui.php';
			// </script>";



      // header("location: product-ui.php");


		// }
			
		// else{
			//  echo "<script type='text/javascript'>alert('Error in Upadting');
			// window.location='product-ui.php';
			// </script>";


      // echo "<script type='text/javascript'>
			// window.location='product-ui.php';
			// </script>";


      // header("location: product-ui.php");

		// }

	}

	else{

    // echo "<script type='text/javascript'>alert('Inside Added Cart');</script>";


		// $con = mysqli_connect('localhost', 'root', '', 'online_mall');

    $con = Connect();

		if (!$con) {
		  die("Connection failed: " . mysqli_connect_error());
		}


    // echo "<script type='text/javascript'>alert('Inside Added Cart before sql');</script>";


    // echo "<script type='text/javascript'>
    
    
    // alert('id= $productid, name= $productname, price= $productprice, quantity= $productquantity, userid= $userid');  
    
    // </script>";


		$sql = "insert into cartdetails values('$productid','$productname','$productprice','$productquantity', '$userid')";


    // echo "<script type='text/javascript'>alert('Inside Added Cart after sql');</script>";




		if(mysqli_query($con, $sql)){
			// echo "<script type='text/javascript'>alert('Added to cart Successfully');
			// window.location='product-ui.php';
			// </script>";


      echo "<script type='text/javascript'>
			window.location='product-ui.php';
			</script>";


      // header("location: product-ui.php");
		}
			
		else{
			//  echo "<script type='text/javascript'>alert('Error in Adding');
			// window.location='product-ui.php';
			// </script>";

      echo "<script type='text/javascript'>
			window.location='product-ui.php';
			</script>";


      // header("location: product-ui.php");

      

			//echo '<script>alert("Error in Adding")</script>';
			//echo mysqli_error($con);
		}
		

	}


  // echo "<script type='text/javascript'>
	// 		alert('Test');
	// 		</script>";


  // $sql_cart= "select * from cartdetails where custid = $userid";

	// $res_cart = mysqli_query($con1, $sql_cart);

  // if (mysqli_num_rows($res_cart) > 0)
  // {
  //   while($row_cart = mysqli_fetch_assoc($res_cart)){

  //     $productid_cart = $res_cart['productid'];


  //     echo "<script type='text/javascript'>
	// 		console.log('test');
	// 		</script>";


  //     $con3 = Connect();

  //     if (!$con3) {
  //       die("Connection failed: " . mysqli_connect_error());
  //     }
    
  //     $sql3 = "update product set addedtocart='1' where productid='$productid_cart'";
    
    
  //     if(mysqli_query($con3, $sql3)){
    
    
  //     }else{
    
  //       echo "<script type='text/javascript'>alert('Error');
  //         window.location='product-ui.php';
  //         </script>";
    
  //     }
  //   }
  // }






  // $con3 = Connect();

  // if (!$con3) {
  //   die("Connection failed: " . mysqli_connect_error());
  // }

  // $sql3 = "update product set addedtocart='1' where productid='$productid'";


  // if(mysqli_query($con3, $sql3)){


  // }else{

  //    echo "<script type='text/javascript'>alert('Error');
	// 		window.location='product-ui.php';
	// 		</script>";

  // }




  mysqli_close($con);
	mysqli_close($con1);
  mysqli_close($con3);



  }

  


?>


<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->

</body>
</html>