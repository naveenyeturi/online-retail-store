<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require 'connection.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);


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
$conn = Connect();

$sql = "SELECT * from orders where custemail = '$custemail'";

//echo "$sql";
// $result = mysqli_query($conn, $sql);
$result = $conn->query($sql);

// $num_rows = mysqli_num_rows($result);
$num_rows = $result->rowCount();


if($num_rows==0){
					
	echo "<script type='text/javascript'>alert('You have no orders');
	window.location='product-ui.php';
	</script>";

}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <style>
        /* .glyphicon { margin-right:5px; }
        .thumbnail
        {
            margin-bottom: 20px;
            padding: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .item.list-group-item
        {
            float: none;
            width: 100%;
            background-color: #fff;
            margin-bottom: 10px;
        }
        .item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
        {
            background: #428bca;
        }

        .item.list-group-item .list-group-image
        {
            margin-right: 10px;
        }
        .item.list-group-item .thumbnail
        {
            margin-bottom: 0px;
        }
        .item.list-group-item .caption
        {
            padding: 9px 9px 0px 9px;
        }
        .item.list-group-item:nth-of-type(odd)
        {
            background: #eeeeee;
        }

        .item.list-group-item:before, .item.list-group-item:after
        {
            display: table;
            content: " ";
        }

        .item.list-group-item img
        {
            float: left;
        }
        .item.list-group-item:after
        {
            clear: both;
        }
        .list-group-item-text
        {
            margin: 0 0 11px;
        }


        img{
            width: 50px;
        } */

        body {
        /* margin: 40px; */
        }

        .wrapper {
        display: grid;
        grid-template-rows: 150px 150px;
        grid-template-columns: 150px 150px 150px 150px 150px;
        grid-gap: 45px;
        background-color: #fff;
        color: #444;

        margin: 50px;

        padding: 50px;
        background-color: lightgray;
        }

        .box {
            /* margin: 20px; */
        background-color: #444;
        color: #fff;
        border-radius: 5px;
        /*   padding: 20px; */
        /* font-size: 150%; */
        cursor: pointer;
        
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        opacity: 0.8;
        }

        .box:hover{
            opacity: 1.0;
            transform: scale(1.1);
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

        @media only screen and (max-width: 480px){
            .wrapper {
            display: grid;
            grid-template-rows: 150px 150px;
            grid-template-columns: 150px 150px;
            grid-gap: 15px;
            background-color: #fff;
            color: #444;

            margin: 10px;

            padding: 10px;
            background-color: lightgray;
            }

            .box {
                /* margin: 20px; */
            background-color: #444;
            color: #fff;
            border-radius: 5px;
            /*   padding: 20px; */
            /* font-size: 150%; */
            cursor: pointer;
            
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            opacity: 0.8;
            }

            .box:hover{
                opacity: 1.0;
                transform: scale(1.1);
            }

            #myButton {
                margin-top: 20px;
                cursor: pointer; 
                border: 1px solid #3498db; 
                background-color: transparent; 
                padding: 16px 20px;
                width: 100px;
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
    <div>
        <div class="container">

            <!-- <div id="products" class="row list-group wrapper"> -->
            <div id="products" class="wrapper">
                <?php

                while ($row = $result->fetch(PDO::FETCH_ASSOC)/*$row = mysqli_fetch_assoc($result)*/){
                    
                    // $orderid = $row["orderid"];

                    // $sql_for_id = "select * from orderdetails where orderid='$orderid' order by productid";

                    // $result_for_id = $conn->query($sql_for_id);

                    // $row_for_id = $result_for_id->fetch(PDO::FETCH_ASSOC);

                    // $productid_for_image = $row_for_id["productid"];

                    // $sql_for_order_image = "select * from product where productid='$productid_for_image'";
                    // $result_for_order_image = $conn->query($sql_for_order_image);
                    // $row_for_order_image = $result_for_order_image->fetch(PDO::FETCH_ASSOC);

                    // $productimage = $row_for_order_image["productimage"];


                    // echo "".$row["orderid"];
                    echo '
                    <div class="box" id="box" onclick="boxClick('.$row["orderid"].')">

                        <h3>#'.$row["orderid"].'</h3>

                        <p>'.$row["orderdate"].'</p>
                        
                        <h4>₹'.$row["ordertotal"].'</h4>

                    </div>
                    ';
                }
                ?>                
            </div>
        </div>
    </div>

    <button id="myButton" class="myButton" onclick="location.href = 'product-ui.php'">Go Back</button>

    <script>  


        function boxClick(orderid){

            // console.log(orderid);
            window.location.href = "order-details.php?id="+orderid;
        }


        
      
    </script>
</body>
</html>