<?php

session_start();

$userid = $_SESSION['user'];

//if (isset($_POST['login'])){
	//header("location: admin_ui.html");
	
	$productid=$_GET['id'];
	$productname=$_POST['hidden_name'];
	$productprice=$_POST['hidden_price'];
	$productquantity=$_POST['quantity'];


	$con1 = mysqli_connect('localhost', 'root', '', 'bigbazaar');


	if (!$con1) {
	  die("Connection failed: " . mysqli_connect_error());
	}



	$sql2 = "select availablequantity from product where productid = '$productid'";
	$res2 = mysqli_query($con1, $sql2);
	$row2 = mysqli_fetch_assoc($res2);

	$availablequantity = $row2['availablequantity'];

	if($productquantity > $availablequantity){

		/*echo "<script type='text/javascript'>alert('Entered Quantity is not available');
			window.location='customer_ui.php';
			</script>";
			exit();*/

			echo "<script type='text/javascript'>alert('Only'+$availablequantity+'are available');
			window.location='customer_ui.php';
			</script>";
			exit();


	}



	$sql1 = "select * from cartdetails where productid = '$productid'
			and custid = $userid";

	$res1 = mysqli_query($con1, $sql1);
	$rows = mysqli_num_rows($res1);

	if($rows>0){

		//$newquantity = $productquantity + $rows['productquantity'];

		/*$rowinfo = mysqli_fetch_field($res1);
		$oldquantity = .$rowinfo -> productquantity;*/

		//$newquantity = $productquantity;
		//$newquantity = 10;

		$sql2 = "update cartdetails set productquantity = '$productquantity' where productid = $productid and custid = $userid";


//header("Location: customer_ui.php");
					//exit();
		if(mysqli_query($con1, $sql2)){
			echo "<script type='text/javascript'>alert('Updated cart Successfully');
			window.location='customer_ui.php';
			</script>";
		}
			
		else{
			 echo "<script type='text/javascript'>alert('Error in Upadting');
			window.location='customer_ui.php';
			</script>";
			//echo '<script>alert("Error in Updating")</script>';
			//echo mysqli_error($con);
		}
		//mysqli_close($con1);

	}

	else{

		$con = mysqli_connect('localhost', 'root', '', 'bigbazaar');

		if (!$con) {
		  die("Connection failed: " . mysqli_connect_error());
		}



		//$sql= "select * from login where email = $email and password = $password";

		//$sql = "insert into cartdetails values(10,10,10,10)";

		$sql = "insert into cartdetails values('$productid','$productname','$productprice','$productquantity', '$userid')";

			//header("Location: customer_ui.php");
			//exit();


		if(mysqli_query($con, $sql)){
			echo "<script type='text/javascript'>alert('Added to cart Successfully');
			window.location='customer_ui.php';
			</script>";
		}
			
		else{
			 echo "<script type='text/javascript'>alert('Error in Adding');
			window.location='customer_ui.php';
			</script>";
			//echo '<script>alert("Error in Adding")</script>';
			//echo mysqli_error($con);
		}
		

	}

	/*$newavailablequantity = $availablequantity - $productquantity;

	$sql3 = "update product set availablequantity = '$newavailablequantity' where productid = $productid";
	$res3 = mysqli_query($con1, $sql3);

	if(!$res3){
		//echo error;
	}*/


	

	mysqli_close($con);
	mysqli_close($con1);
	
//}

?>