<?php

require 'connection.php';

session_start();



//echo $_SESSION['user'] ;

$custemail = $_SESSION['user'] ;

if (!isset($_SESSION['user'])) {
        /// your code here

        echo "<script type='text/javascript'>alert('Login to continue');
			window.location='customer-login.php';
			</script>";
 }

// $conn = mysqli_connect('localhost', 'root', '', 'online_mall');
$con = Connect();


if (!isset($_GET['id'])) {
    /// your code here

    echo "<script type='text/javascript'>alert('Error');
        window.location='product-ui.php';
        </script>";
}


$orderid = $_GET['id'];

$sql_orderdetails = "SELECT * from orderdetails where orderid = '$orderid'";
$sql_orders = "SELECT * from orders where orderid = '$orderid'";

//echo "$sql_orderdetails";
// $result_orderdetails = mysqli_query($con, $sql_orderdetails);
$result_orderdetails = $con->query($sql_orderdetails);

// $result_orders = mysqli_query($con, $sql_orders);
$result_orders = $con->query($sql_orders);

// $row_orders = mysqli_fetch_assoc($result_orders);
$row_orders = $result_orders->fetch(PDO::FETCH_ASSOC);


// $num_rows_orderdetails = mysqli_num_rows($result_orderdetails);
$num_rows_orderdetails = $result_orderdetails->rowCount();


// $num_rows_orders = mysqli_num_rows($result_orders);
$num_rows_orders = $result_orders->rowCount();

// echo "<script>console.log('orderid= $orderid , num_rows_orderdetails=$num_rows_orderdetails');</script>";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css"> 
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <title>Order Details</title>


    <style>

        *{
            box-sizing: border-box;
            margin:0;
            padding:0;
        }

        .orderItems{
            padding: 10px;
            
            
        }

        .orderItem{

            padding: 20px;
            
            display: flex;
            justify-content: space-between;

            /* background-color: skyblue; */
            margin: 10px;
        }

        .orderItem img{
            width: 100px;
            max-height: 200px;
        }

        .orderItem .itemDetails{
            width: 400px;
        }

        .orderItem .itemPrice{
            width: 100px;

        }

        .orderItem .itemDeliveryDate{

            width: 200px;

        }

        #myButton {
			margin-top: 20px;
			cursor: pointer; 
            border: 1px solid #3498db; 
            background-color: transparent; 
            padding: 16px 20px;
            width: 10%;
            color: black; 
            /*font-size: 1.5em; */
            box-shadow: 0 6px 6px rgba(0, 0, 0, 0.6);
            position: absolute;
            left: 10px;
            
            /*top: 50px;*/
		}


        @media only screen and (max-width: 450px){
            .orderItems{
                padding:0px;

                margin-top: 10px;
                
                
            }

            .orderItem{

                padding: 0px;

                
                display: flex;
                justify-content: space-between;
                flex-wrap: nowrap;

                align-items: center;

                /* background-color: skyblue; */
                margin: 0px;
            }

            .orderItem img{
                /* margin-top: 40px; */
                width: 70px;
                max-height: 200px;

            }

            .orderItem .itemDetails{
                width: 100px;
            }
            .orderItem .itemDetails h2, h3{
                font-size: 90%;
            }

            .orderItem .itemPrice{
                width: 50px;

            }
            .orderItem .itemPrice h2{
                
                font-size: 80%;
            }

            .orderItem .itemDeliveryDate{

                width: 100px;

            }
            

            .orderItem .itemDeliveryDate h2, h4{
                font-size: 80%;
            }

            #myButton {
                margin-top: 20px;
                cursor: pointer; 
                border: 1px solid #3498db; 
                background-color: transparent; 
                padding: 16px 20px;
                width: 200px;
                color: black; 
                /*font-size: 1.5em; */
                box-shadow: 0 6px 6px rgba(0, 0, 0, 0.6);
                position: absolute;
                left: 10px;
                
                /*top: 50px;*/
            }
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
        <!-- <img src="productimages/temp.jpg" alt="logo" style="width:40%;"> -->
        MyMall
      </a>
    </div>


    <div class="collapse navbar-collapse" id="myNavbar">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>

    </div>
  </div>
</nav>


<div class="orderItems">

    <?php


        while($row_orderdetails = $result_orderdetails->fetch(PDO::FETCH_ASSOC)/*$row_orderdetails = mysqli_fetch_assoc($result_orderdetails)*/){
            
            // echo "<script>console.log('test');</script>";

            $productid = $row_orderdetails['productid'];
            
            // echo "<script>console.log('$productid');</script>";

            $sql_product = "select * from product where productid='$productid'";
            
            // $result_product = mysqli_query($con, $sql_product);
            $result_product = $con->query($sql_product);
            
            // $row_product = mysqli_fetch_assoc($result_product);
            $row_product = $result_product->fetch(PDO::FETCH_ASSOC);

            // $num_rows_products = mysqli_num_rows($result_product);
            $num_rows_products = $result_product->rowCount();


            echo '<div class="orderItem">';

                echo '<div class="itemImage">';
                    // echo "<h3>Test</h3>";
                    // echo "<h1>".$row_product["productimage"]."</h1>";
                    echo "<img src=productimages/".$row_product["productimage"]." alt=".$row_product["productimage"]. "/>";
                echo '</div>';


                echo '<div class="itemDetails">';
                    echo "<h2>".$row_product["productname"]."</h2>";
                    echo "<h4>".$row_product["productdesc"]."</h4>";
                    echo "<h3>Qty: ".$row_orderdetails["quantity"]."</h3>";
                echo '</div>';

                echo '<div class="itemPrice">';
                echo "<h2>₹".$row_product["productprice"]."</h2>";
                echo '</div>';


                echo '<div class="itemDeliveryDate">';
                echo "<h4>Delivery by</h4>";
                echo "<h2>".$row_orders["deliverydate"]."</h2>";
                echo '</div>';


            echo '</div>';


        }


    ?>

</div>



<button id="myButton" class="myButton" onclick="location.href = 'orders.php'">Go Back</button>



    
</body>
</html>