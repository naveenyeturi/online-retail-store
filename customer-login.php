<?php

    session_start();

    if(isset($_SESSION['user'])){
        header("location: product-ui.php");
    }

?>

<?php

    require 'connection.php';
    $con = Connect();

    if(isset($_GET["login"])){
        
        $custid = $_GET['custid'];
        $password = $_GET['password'];

        $sql = "SELECT * FROM customer where custid= '$custid' and custpassword='$password'";

        $rs=mysqli_query($con, $sql);

        // echo "rows = ".mysqli_num_rows($rs);

        if(mysqli_num_rows($rs) > 0){

            $_SESSION['user'] = $custid;

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

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    
  </head>
  <body>
    <div class="bg-img">

      <div class="customer_login_form">
        <form action="customer-login.php" method="get" class="container">

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

          <!--<div>
          <a class="forgot" href="forgot_password.html">Forgot password?</a>  
        </div>-->
          <br />
          <button type="submit" name="login" class="btn">Login</button>
          <hr />
        </form>
        <button
          onclick="location.href = 'customer_registration.html'"
          name="registration"
          class="btn"
        >
          Create Account
        </button>
      </div>

    </div>
  </body>
</html>
