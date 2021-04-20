<?php

// require 'connection.php';

session_start();

//echo $_SESSION['user'] ;

if (!isset($_SESSION['user'])) {
        /// your code here

    echo "<script type='text/javascript'>alert('Login to continue');
		window.location='customer-login.php';
		</script>";
}

$userid = $_SESSION['user'];

// $conn = Connect();

// $sql = "SELECT productid, productname, productprice, productquantity from `cartdetails` where custid = '$userid'";

// //echo "$sql";
// $result = mysqli_query($conn, $sql);
// $num_rows = mysqli_num_rows($result);

?>


<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1" />


<link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


    <!-- <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

	<title>Your Cart</title>

	<style type="text/css">

        .body{
            box-sizing: border-box;
            margin:0px;
            padding:0px;
        }

        /* .navbar{
            position: fixed;
            top: 0;
            width: 100%;
        } */


        .cartItem{
            background-color: skyblue;
            padding: 20px;
            margin:10px;

            width: 50%;
            /* float: left; */
        }

        .cartItem .cartedit{
            display: flex;
        }

        .cartedit input[type=text]{
            text-align: center;
            font-size: 1.1em;
            width: 35px;
            font-weight: bold;
        }

        .cartedit input[type=submit]{
            border : 1px solid transparent;
            border-radius: 50%;
        }

        .cartedit a{
            margin-left: 40px;
            position: relative;
            bottom: 5px;

            text-decoration: none;

        }

        .cartItemImageDetails img{
            width: 100px;
            margin-right:20px;

        }

        .cartItemImageDetails .cartItemDetails h3{
            margin-top:20px;
        }

        .cartItemImageDetails{

            display: flex;

        }


        .totalDetails{
            background-color: green;
            /* float: right; */
            width: 40%;

            position: fixed;
            top: 70px;
            right: 0;
        }

	</style>
</head>
<body>

    <nav class="navbar navbar-inverse" style="margin-bottom: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <a class="navbar-brand" href="product-ui.php">
        Test1
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">test</a></li>
        <li><a href="#">test</a></li>
      </ul>
    </div>
  </div>
</nav>


    <?php

        require 'connection.php';
        $con = Connect();

        echo "<script type='text/javascript'>console.log('Test');
            </script>";

        $sql = "select * from cartdetails";
        $result = mysqli_query($con, $sql);

        $num_rows = mysqli_num_rows($result);

        if($num_rows==0){
					
            echo "<script type='text/javascript'>alert('Cart is Empty');
            window.location='product-ui.php';
            </script>";

        }



    ?>

    
    <div class="container">

        <div class="cart">
            <?php

                $total = 0;

                echo "<h1>test</h1>";

                while ($row = mysqli_fetch_assoc($result)){
                    $productid = $row["productid"];
                    $productname = $row["productname"];
                    $productprice = $row["productprice"];
                    $productquantity = $row["productquantity"];

                    $total = $total + $productquantity * $productprice;


                    $sqlforimage = "select * from product where productid='$productid'";
                    $resultforimage = mysqli_query($con, $sqlforimage);

                    $rowforimage = mysqli_fetch_assoc($resultforimage);

                    $productimage = $rowforimage["productimage"];
                    $productdesc = $rowforimage["productdesc"];

                    echo '<div class="cartItem">';
                        echo '<div class="cartItemImageDetails">';
                            echo "<img src='productimages/$productimage' alt='test'>";
                            echo '<div class="cartItemDetails">';
                                // echo '<h3>'.$row["productname"].'</h3>';
                                echo "<h3>$productname</h3>";
                                echo "<h4>$productdesc</h4>";
                                echo "<h3><span>&#8377;</span> $productprice</h3>";
                            echo "</div>";
                        echo "</div>";
                        echo "<br>";
                        echo '<div class="cartedit">';
                        echo'<form action="cart.php" method="post">';
                            echo '<input type="hidden" name="id" value='.$productid.'>';
                            if($productquantity > 1)
                                echo '<input type="submit" value="-" name="decrease" style="margin-right:10px;">';
                                echo '<input type="text" name="cartValue" readonly value='.$productquantity.'>';
                            if($productquantity < 25)
                                echo '<input type="submit" value="+" name="increase" style="margin-left:10px;">';
                        echo '</form>';
                        echo "<h4><a style='color: black;' href=\"removefromcart.php?id=$row[productid]\" onClick=\"return confirm('Remove Product from cart?')\">Remove</a></h4>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>


    <div class="totalDetails">
            
            <h2>Price Details</h2>
            
            <?php
                echo "<h2>Price (".$num_rows."items)       ".$total."</h2>";
            ?>



    </div>

    </div>



    <?php

        if(isset($_POST['increase'])){

            $cartValue = $_POST['cartValue'];

            $productid = $_POST['id'];

            $con1 = Connect();

            // echo "<script>alert('$productid  and $cartValue');
            //             </script>";

            $sql1 = "update cartdetails set productquantity=".($cartValue+1)." where productid='$productid'";

            $result = mysqli_query($con1, $sql1);

            if($result){
                echo "<script>window.location='cart.php';
                        </script>";
            }else{
                echo "<script>alert('Error');
                        </script>";
            }
        }

        if(isset($_POST['decrease'])){

            $cartValue = $_POST['cartValue'];

            $productid = $_POST['id'];

            $con2 = Connect();

            // echo "<script>alert('$productid  and $cartValue');
            //             </script>";

            $sql2 = "update cartdetails set productquantity=".($cartValue-1)." where productid='$productid'";

            $result1 = mysqli_query($con2, $sql2);

            if($result1){
                echo "<script>window.location='cart.php';
                        </script>";
            }else{
                echo "<script>alert('Error');
                        </script>";
            }
        }

    ?>
    

	
</body>
</html>