<?php


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);


require 'connection.php';

echo "<script>alert('inside register.php');</script>";

        if(isset($_POST['submit'])){

            $custemail = $_POST['email'];
            $custname = $_POST['name'];
            $custphone = $_POST['phone'];
            // $custaddr = $_POST['city'];
            $custpassword = $_POST['password'];

            $con = Connect();

            $sql = "insert into customer values('$custemail', '$custname', '$custphone', '$custpassword')";

            $result = mysqli_query($con, $sql);

            // if(!$result){
            //     echo "<script type='text/javascript'>alert('Error');
            //     window.location='customer-registration.php';
            //     </script>";
            // }else{
            //     echo "<script type='text/javascript'>
            //     alert('Registration successful. Please Login to continue');
            //     window.location='customer-login.php';
            //     </script>";
            // }


        }

    ?>