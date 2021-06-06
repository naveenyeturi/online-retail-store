<?php 

session_start();

    require 'connection.php';

    if(isset($_SESSION['user'])){
        header("location: product-ui.php");
    }

?>

<!-- Taken From https://codepen.io/colorlib/pen/rxddKy -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="js/register.js"></script>


    <title>Register</title>
    <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .registration-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form label {
        font-family: "Roboto", sans-serif;
        outline: 0;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
        font-weight: bold;
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form .submit {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form .submit:hover,
    .form .submit:active,
    .form .submit:focus {
        background: #43A047;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }

    body {
        background: #76b852;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(right, #76b852, #8DC26F);
        background: -moz-linear-gradient(right, #76b852, #8DC26F);
        background: -o-linear-gradient(right, #76b852, #8DC26F);
        background: linear-gradient(to left, #76b852, #8DC26F);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    </style>
</head>

<body>

    <div class="registration-page">
        <div class="form">
            <form1 class="register-form" id="register-form" method="post">


                <!-- <label for="name">Name</label> -->
                <input type="text" placeholder="Enter Your Name" name="name" id="name" required />

                <!-- <label for="email">Email</label> -->
                <input type="email" placeholder="Enter Your Email" name="emailorphone" id="emailorphone" required />

                <!-- <label for="phone">Phone</label> -->
                <input type="text" placeholder="Enter Your Phone Number" name="phone" id="phone" required />

                <!-- <label for="password">Password</label> -->
                <input type="password" placeholder="Enter Your Password" name="password" id="password" required />


                <!-- <label for="city">City</label> -->
                <!-- <input type="text" placeholder="Enter Your City" name="city" required/> -->


                <input onclick="register()" class="submit" type="submit" name="submit" value="Register" />
                <p class="message">Already registered? <a href="customer-login.php">Sign In</a></p>
            </form1>

        </div>
    </div>



    <!-- <form action="customer-registration.php" method="post">

        <label for="name">Name</label>
        <input type="text" placeholder="Enter Your Name" name="name"/>

        <label for="username">Username</label>
        <input type="text" placeholder="Enter Your Emausernameil" name="username"/>

        <label for="password">Password</label>
        <input type="password" placeholder="Enter Your Name" name="password"/>

        <label for="phone">Phone</label>
        <input type="text" placeholder="Enter Your Phone Number" name="phone"/>

        <label for="city">City</label>
        <input type="text" placeholder="Enter Your City" name="city"/>

        <input type="submit" name="submit" value="Register"/>

    </form> -->

    <?php

        if(isset($_POST['submit'])){

            $custemail = $_POST['email'];
            $custname = $_POST['name'];
            $custphone = $_POST['phone'];
            // $custaddr = $_POST['city'];
            $custpassword = $_POST['password'];

            $con = Connect();

            // echo "Test...";


            $sql = "insert into customer values('$custemail', '$custname', '$custphone', '$custpassword')";

            // $result = mysqli_query($con, $sql);
            $result = $con->query($sql);

            if(!$result){
                // echo "<script type='text/javascript'>alert('Error');
                // window.location='customer-registration.php';
                // </script>";
            }else{
                // echo "<script type='text/javascript'>
                // alert('Registration successful. Please Login to continue');
                // window.location='customer-login.php';
                // </script>";
            }


        }

    ?>






    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
      https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-analytics.js"></script>


    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-storage.js"></script>



    <script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyCHhyRQHmEwF9HQNb3iaM-SXhYGp-Ag31Y",
        authDomain: "mymall-naveen.firebaseapp.com",
        projectId: "mymall-naveen",
        storageBucket: "mymall-naveen.appspot.com",
        messagingSenderId: "1077253083611",
        appId: "1:1077253083611:web:3cd5f1774a68670d3f97fe",
        measurementId: "G-4BQC515TGN"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();

    // Initialize Firebase
    // firebase.initializeApp(firebaseConfig);
    // firebase.analytics();
    </script>

    <script src="js/register.js"></script>









</body>

</html>