<?php
session_start();
include ("connect.php");
$acc_no = $_SESSION["acc_no"];

$sql_withdraw = "SELECT `Amount`,`Balance` FROM `Withdraw` WHERE `AccountNo` = '$acc_no'";
$sql_deposit = "SELECT `cheque_no`,`amount` FROM `deposit` WHERE `acc_no` = '$acc_no'";
$sql_balance = " SELECT `Balance` FROM `Customers` WHERE `AccountNo` = '$acc_no' " ;

global $conn;

$res_sql_withdraw = $conn->query($sql_withdraw);
$res_sql_deposit = $conn->query($sql_deposit);

?>

<!DOCTYPE html>
<html>
    <head>
	<title>Transaction</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
            body{
                background-image:url(t.jpg);
                background-size: cover;
                background-attachment: fixed;
            }
            </style>
    </head>
      <body>
    <h2 style="text-align:center;">Withdraw</h2>
        <table class="table"style="border:1px solid blue;">
  <thead>
    <tr>
      <th>#</th>
      <th>Account Number </th>
      <th>Amount</th>
      <th>Updated Balance</th>
    </tr>
  </thead>
  <tbody>
   <?php
   global $res_sql_withdraw;
   global $res_sql_deposit;
   global $acc_no;
   global $account_no;
   // global $Account_No;
   $count=1;
   $sql_select = "SELECT `account_no`,`amount`,`updated_balance` FROM `withdraw` WHERE `account_no` = '$acc_no'"; 
$res_sql_withdraw = $conn->query($sql_select);
  while(($row=$res_sql_withdraw->fetch_assoc())){
	  $amount = $row["amount"];
	  $bal = $row["updated_balance"];
	  echo "<tr>
      <th scope='row'>$count</th>
      <td>$acc_no</td>
      <td>$amount</td>
      <td>$bal</td>
    </tr>";
    global $count;
    $count = $count+1;
	}
   ?> 
   
</tbody>
</table>
        <br>
    <h2 style="text-align:center;">Deposit</h2>
    <table class="table" style="border:1px solid blue;">
  <thead>
    <tr>
      <th>#</th>
            <th>Account Number</th>
      <th>Cheque Number</th>
      <th>Amount</th>
      
      </tr>
  </thead>
  <tbody>


  //<?php
// global $res_sql_deposit;
//  global $account_no;
//  $count=1;
//  $sql_select = "SELECT `acc_no`,`cheque_no`,`amount` FROM deposit WHERE `acc_no` = '$account_no'"; 
// $res_sql_deposit = $conn->query($sql_select);
//while(($row=$res_sql_deposit->fetch_assoc())){
//	  $amount = $row["updated_balance"];
//	  echo "<tr>
//      <th scope='row'>$count</th>
//   <td>$acc_no</td>
//   <td>$amount</td>
//     <td>$cheque_no</td>
//   </tr>";
//    global $count;
//  $count = $count+1;
//	}
//   ?>
       <?php
   global $res_sql_withdraw;
   global $res_sql_deposit;
   global $acc_no;
   global $account_no;
   // global $Account_No;
   $count=1;
   $sql_select =  "SELECT `acc_no`,`cheque_no`,`amount` FROM `deposit` WHERE `acc_no` = '$acc_no'";  
$res_sql_deposit = $conn->query($sql_select);
  while(($row=$res_sql_deposit->fetch_assoc())){
//       $amount = $row["amount"];
	  $cheque_no = $row["cheque_no"];
	  $amount = $row["amount"];
//  $bal = $row["amount"];
	  echo "<tr>
      <th scope='row'>$count</th>
      <td>$acc_no</td>
      
      <td>$cheque_no</td>
          <td>$amount</td>
    </tr>";
    global $count;
    $count = $count+1;
	}
   ?> 
  </tbody>
</table>
	<a href="menu.php"><button class="btn-default" style="align:center;">Go back To Main Menu </button></a>
    </body>

</html>
