<?php


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

    session_start();

    if(isset($_SESSION['user'])){
        header("location: product-ui.php");
    }

?>

<?php

    require 'connection.php';
    $con = Connect();

    if(isset($_POST["login"])){
        
        // $custid = $_POST['custid'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM customer where custemail= '$email' or custphone='$email' and custpassword='$password'";

        // $rs=mysqli_query($con, $sql);
        $rs = $con->query($sql);

        // echo "rows = ".mysqli_num_rows($rs);

        if($rs->rowCount()/*mysqli_num_rows($rs)*/ > 0){

            // $row = mysqli_fetch_assoc($rs);
            $row = $rs->fetch(PDO::FETCH_ASSOC);

            $custemail = $row['custemail'];

            $_SESSION['user'] = $custemail;

            echo "<script type='text/javascript'>
                window.location='product-ui.php';
                </script>";
            /*echo "<script type='text/javascript'>alert('Login Successful');
                window.location='customer_ui.php';
                </script>";*/
            //$_SESSION["user"] = $email;
            

        }else{

            /*echo '<script>alert("Email and Password doesnot match")
                    </script>';

            //header("location: customer_login.html");*/
            // echo "<script type='text/javascript'>alert('Email and Password doesnot match');
            //     window.location='customer-login.php';
            //     </script>";
        }
        $con->close();
    }

?>


<!-- 
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    
  </head>
  <body>
    <div class="bg-img">

      <div class="customer_login_form">
        <form action="customer-login.php" method="post" class="container">

          <label for="custid"><b>User ID</b></label>
          <input
            type="text"
            placeholder="Enter User Id"
            name="custid"
            required
          />

          <label for="password"><b>Password</b></label>
          <input
            type="password"
            placeholder="Enter Password"
            name="password"
            required
          />

          <br />
          <button type="submit" name="login" class="btn">Login</button>
          <hr />
        </form>
        <button
          onclick="location.href = 'customer-registration.php'"
          name="registration"
          class="btn"
        >
          Create Account
        </button>
      </div>

    </div>
  </body>
</html> -->


<!-- Taken From https://codepen.io/colorlib/pen/rxddKy -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>






    <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .login-page {
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

    <div class="login-page">
        <div class="form">

            <form1 class="login-form">
                <input type="text" placeholder="Email" name="emailorphone" id="emailorphone" required />
                <input type="password" placeholder="password" name="password" id="password" required />
                <!-- <input class="submit" type="submit" value="login" name="login"> -->
                <button class="submit" onclick="validate()">login</button>
                <p class="message">Not registered? <a href="customer-registration.php">Create an account</a></p>
            </form1>
        </div>
    </div>




    <!-- trying postgresql -->


    <!-- <div class="login-page(temp)">
    <div class="form(temp)">

      <form class="login-form1" action="customer-login-postgres.php" method="get">
        <input type="text" placeholder="Email or Phone" name="email" id="email" required/>
        <input type="password" placeholder="password" name="password" id="password" required/>
        <input class="submit" type="submit" value="login" name="login">
        <button class="submit" onclick="validate()">login</button>
        <p class="message">Not registered? <a href="customer-registration.php">Create an account</a></p>
      </form>
    </div>
  </div> -->



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

    <script src="js/login.js"></script>

    <script>
    //console.log('hmmmm...');
    </script>






</body>

</html>