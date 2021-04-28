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
$conn = Connect();

$sql = "SELECT * from `orders` where custemail = '$custemail'";

//echo "$sql";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);


if($num_rows==0){
					
	echo "<script type='text/javascript'>alert('You have no orders');
	window.location='product-ui.php';
	</script>";

}


?>

<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css"> 
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

	<title>Orders</title>

	<style type="text/css">

		body{
			width: 100%;
			height: 100px;
			margin: 0px;
		}


		.divider{
			width: 100%;
			height: 100%;
			background-color: lightyellow;
		}
		


		table {
			/*margin-top: 100px;*/
			/*margin: 0px;*/
		  border-collapse: collapse;
		  width: 100%;
		  font-family: 'Montserrat', sans-serif;
		}

		th, td {
		  text-align: center;
		  padding: 8px;
		}

		tr:nth-child(even){background-color: #f2f2f2}
		tr:hover {background-color:#76D7C4;}

		th {
		  background-color: #4CAF50;
		  color: white;
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



		.topnav {
		  overflow: hidden;
		  /*background-color: #e9e9e9;*/
		  background-color: skyblue;
		}

		.topnav img {
			margin: 2px;
		  float: left;
		}

		.topnav  .logoutbtn {
		  font-size: 16px;  
		  border: none;
		  outline: none;
		  color: white;
		  padding: 14px 16px;
		  background-color: green;
		  font-family: inherit;
		  margin: 5px;
		  float: right;
		  min-width: 130px;


		}

		.topnav .navbar a:hover, .logoutbtn:hover {
		  background-color: red;
		}



	</style>





</head>
<body>


	<!-- <div class="topnav">

	    <button class="logoutbtn" onclick="location.href ='log_out.php'">

	    	LogOut
	      
	    </button >
	</div> -->


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


	
	<div class="divider">

		<table>
			<tr>

				<th align = "center">Order ID</th>
		
				<th align = "center">Order Date</th>
				<th align = "center">Order Total</th>
				<th align = "center">Delivery Date</th>
				
				<th align = "center">Options</th>
			</tr>

			<?php


			if($num_rows==0){
					
					echo "<script type='text/javascript'>alert('You have no orders');
					window.location='product-ui.php';
					</script>";

				}else{

                    // echo "<script>alert('test');</script>";

					while ($row = mysqli_fetch_assoc($result)) {

                        // echo "<script>alert('test1');</script>";

						// $empid = $row["empid"];
						// $sql1 = "select empname from employee where empid = '$empid'";
						// $result1 = mysqli_query($conn, $sql1);
						// $row1 = mysqli_fetch_assoc($result1);
						// $empname = $row1['empname'];



						echo "<tr><td>".$row["orderid"]
										."</td><td>".$row["orderdate"]
										."</td><td>₹".$row["ordertotal"]
										."</td><td>".$row["deliverydate"]."</td>";

						echo "<td><a href=\"order-details.php?id=$row[orderid]\">(View More)</a></td></tr>";

						//echo '<td><a href="deleteemp.php?id='.$row['empid'].'">delete</a></td></tr>';

					}

				}


			?>

		</table>



		<button id="myButton" class="myButton" onclick="location.href = 'product-ui.php'">Go Back</button>

	</div>
		
	
</body>
</html>