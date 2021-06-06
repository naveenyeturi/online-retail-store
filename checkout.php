<?php


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);


    require 'connection.php';

	session_start();

	$custemail = $_SESSION['user'];

	// $con = mysqli_connect('localhost', 'root', '', 'online_mall');
    $con = Connect();

	if (!$con) {
	  die("Connection failed: " . mysqli_connect_error());
	}

	$orderid = rand(10000,100000) ;

	//$d=strtotime("now");
	//$orderdate = date("Y-m-d h:i:sa", $d);
	//$orderdate = echo 'date("Y-m-d")';

	$d=strtotime("now");
	// $orderdate =  date("Y-m-d", $d) . "<br>";
	$orderdate =  date("Y-m-d", $d) ;

    $deliverydate = date('Y-m-d', strtotime($orderdate. ' + 7 days'));

    // echo "<script>console.log('$deliverydate');</script>";

	// $sql1 = "select empid from employee order by rand() limit 1";
	// $result1 = mysqli_query($con, $sql1);
	// $row1 = mysqli_fetch_assoc($result1);
	// $empid = $row1['empid'];






	$sql_add_quantity = "SELECT productid, productname, productprice, productquantity from cartdetails where custemail = '$custemail'";

	//echo "$sql";
	// $result_add_quantity = mysqli_query($con, $sql_add_quantity);
	$result_add_quantity = $con->query($sql_add_quantity);

	while ($row_add_quantity = $result_add_quantity->fetch(PDO::FETCH_ASSOC)/*$row_add_quantity = mysqli_fetch_assoc($result_add_quantity)*/) {

		/*$product_price = $row["productprice"] * $row["productquantity"];
		$total_order_amount = $total_order_amount + $product_price ;*/

		$productid = $row_add_quantity["productid"];
		$productquantity = $row_add_quantity["productquantity"];


		$sql2 = "select availablequantity from product where productid = '$productid'";
		// $res2 = mysqli_query($con, $sql2);
		$res2 = $con->query($sql2);

		// $row2 = mysqli_fetch_assoc($res2);
		$row2 = $res2->fetch(PDO::FETCH_ASSOC);

		$availablequantity = $row2['availablequantity'];


		if($productquantity > $availablequantity){

			echo "<script type='text/javascript'>alert('Entered Quantity is not available');
			window.location='product-ui.php';
			</script>";
			exit();
			// continue;

		}



		$newavailablequantity = $availablequantity - $productquantity;

		$sql3 = "update product set availablequantity = '$newavailablequantity' where productid = $productid";
		// $res3 = mysqli_query($con, $sql3);
		$res3 = $con->query($sql3);


		if(!$res3){
			//echo error;
		}



		/*$sql_order_details = "insert into orderdetails values('$orderid', '$productid', '$productquantity')";

		$result_order_details = mysqli_query($con, $sql_order_details);*/
		
	}




	$sql_cart_details = "SELECT productid, productname, productprice, productquantity from cartdetails where custemail = '$custemail'";

	//echo "$sql";
	// $result_cart_details = mysqli_query($con, $sql_cart_details);
	$result_cart_details = $con->query($sql_cart_details);

	$total_order_amount = 0;

	while ($row_cart_details = $result_cart_details->fetch(PDO::FETCH_ASSOC)/*$row_cart_details = mysqli_fetch_assoc($result_cart_details)*/) {

		$product_price = $row_cart_details["productprice"] * $row_cart_details["productquantity"];

		$total_order_amount = $total_order_amount + $product_price ;
					
	}

    if($total_order_amount>50000){
        $total_order_amount = $total_order_amount - (5*$total_order_amount/100);

    }



	/*if (mysqli_num_rows($result1) > 0) {
	  // output data of each row
	  while($row = mysqli_fetch_assoc($result1)) {
	    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	  }
	} else {
	  echo "0 results";
	}*/

	$sql = "insert into orders values ('$orderid', '$orderdate', 
	'$total_order_amount', '$custemail', '$deliverydate') ";

	// $result = mysqli_query($con, $sql);
	$result = $con->query($sql);

	if($result){
		/*echo "<script type='text/javascript'>alert('Order Successful');
			window.location='product-ui.php';
			</script>";*/
	}else{
		 //mysqli_error($con);
		//echo '<script>alert("Error")</script>';
		echo "<script type='text/javascript'>alert('Error');
			window.location='product-ui.php';
			</script>";
	}




	$sql_cart_details = "SELECT productid, productname, productprice, productquantity from cartdetails where custemail = '$custemail'";

	//echo "$sql";
	// $result_cart_details = mysqli_query($con, $sql_cart_details);
	$result_cart_details = $con->query($sql_cart_details);

	while ($row_cart_details = $result_cart_details->fetch(PDO::FETCH_ASSOC)/*$row_cart_details = mysqli_fetch_assoc($result_cart_details)*/) {

		/*$product_price = $row["productprice"] * $row["productquantity"];
		$total_order_amount = $total_order_amount + $product_price ;*/

		$productid = $row_cart_details["productid"];
		$productquantity = $row_cart_details["productquantity"];


		$sql_order_details = "insert into orderdetails values('$orderid', '$productid', '$productquantity')";

		// $result_order_details = mysqli_query($con, $sql_order_details);
		$result_order_details = $con->query($sql_order_details);
		


	}



	$sql_clear_cart = "delete from cartdetails where custemail='$custemail'";

	// $result_clear_cart = mysqli_query($con, $sql_clear_cart);
	$result_clear_cart = $con->query($sql_clear_cart);



	//getting name from useremail

	$sql_name = "select * from customer where custemail='$custemail'";
	// $result_name = mysqli_query($con, $sql_name);
	$result_name = $con->query($sql_name);

	// $row_name = mysqli_fetch_assoc($result_name);
	$row_name = $result_name->fetch(PDO::FETCH_ASSOC);

	$custname = $row_name['custname'];



	//sending mail using phpmailer...check github for code and details



	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;


	$mail = new PHPMailer(true);



	try {
		//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'ffaakkee.praneeth@gmail.com';                     //SMTP username
		$mail->Password   = 'praneethsquare';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Recipients
		$mail->setFrom('ffaakkee.praneeth@gmail.com', 'MyMall');
		$mail->addAddress($custemail, $custname);     //Add a recipient

		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'You order has been placed';
		$mail->Body    = 'Hello '.$custname.', Yor order has been placed successfully.
		Order ID: '.$orderid.' Total: '.$total_order_amount.'. Click <a href="#">here</a> to view your orders.';


		$mail->send();
		echo 'Message has been sent';

	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}





	if($result){
		echo "<script type='text/javascript'>alert('Order Successful');
			window.location='product-ui.php';
			</script>";
	}


	mysqli_close($con);

?>
