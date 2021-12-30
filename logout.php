<?php


session_start();
unset($_SESSION["Account_No"]);
unset($_SESSION["PIN"]);
header('location:index1.html');

?>

