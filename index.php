<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <?php

        if(!isset($_SESSION['user'])){
            header("location: customer-login.php");
        }else{
            header("location: customer-registration.php");
        }


    ?>
</body>
</html>