<?php

require 'connection.php';

session_start();

//if (isset($_POST['login'])){
	//header("location: admin_ui.html");
	$con = Connect();

	$custemail = $_SESSION['user'];


	if (!$con) {
	  die("Connection failed: " . mysqli_connect_error());
	}


	$id=$_GET['id'];

	//$sql= "select * from login where email = $email and password = $password";

	$sql = "delete from cartdetails where productid='$id' and custemail='$custemail' ";


	if($con->query($sql)/*mysqli_query($con, $sql)*/){
		/*echo '<script>alert("Successful")</script>';
		header("Location: cart.php");
		exit;*/
		//exit();
        echo "<script type='text/javascript'>
			window.location='cart.php';
			</script>";	
	}
		
	else{
        echo "<script type='text/javascript'>alert('Error');
			window.location='product-ui.php';
			</script>";	
		//echo '<script>alert("Error")</script>';
		//echo mysqli_error($con);
	}
	mysqli_close($con);
	
	
//}

?>