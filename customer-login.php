<?php

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
        $emailorphone = $_POST['emailorphone'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM customer where custemail= '$emailorphone' or custphone='$emailorphone' and custpassword='$password'";

        $rs=mysqli_query($con, $sql);

        // echo "rows = ".mysqli_num_rows($rs);

        if(mysqli_num_rows($rs) > 0){

            $row = mysqli_fetch_assoc($rs);

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
            echo "<script type='text/javascript'>alert('Email and Password doesnot match');
                window.location='customer-login.php';
                </script>";
        }
        mysqli_close($con);
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
    .form .submit:hover,.form .submit:active,.form .submit:focus {
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
      background: #76b852; /* fallback for old browsers */
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

      <form class="login-form" action="customer-login.php" method="post">
        <input type="text" placeholder="Email or Phone" name="emailorphone" required/>
        <input type="password" placeholder="password" name="password" required/>
        <input class="submit" type="submit" value="login" name="login">
        <p class="message">Not registered? <a href="customer-registration.php">Create an account</a></p>
      </form>
    </div>
  </div>
  
</body>
</html>
