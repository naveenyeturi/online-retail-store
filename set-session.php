<?php

session_start();

echo "<script>console.log('inside set-session.php');</script>";

$_SESSION['user'] = $_POST['email'];


?>