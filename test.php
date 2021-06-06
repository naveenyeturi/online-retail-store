<?php


    require 'connection.php';

    $con = Connect();


    $email = $_POST['email'];
    $name  = $_POST['name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];


    $sql = "insert into customer values('$email','$name','$phone','$password')";

    $result = mysqli_query($con, $sql);


    // if($result){
    //     echo "<script type='text/javascript'>alert('Login to continue');
	// 		window.location='customer-login.php';
	// 		</script>";
    // }




?>