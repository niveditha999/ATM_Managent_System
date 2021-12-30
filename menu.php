<?php
echo "<body style='background: url(m5.jpg);'>";
?>
<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "atm_system";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
global $AccountNo;
$AccountNo = $_SESSION['acc_no'] ;
global $Balance;
global $CustomerName;
global $Address;
$sql_select ="SELECT AccountNo,CustomerName,PIN,Address,Balance FROM customers WHERE AccountNo = '$AccountNo'";
$sql_select_result = $conn->query($sql_select);
while($row = $sql_select_result->fetch_assoc()){
    $Address = $row['Address'];

	$cust_name = $row['CustomerName'];
	$CustomerName = $cust_name ;

	$bal = $row['Balance'];
	global $Balance ;
	$Balance = $bal ;      
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

<style>

body
{
	background-color: #F0F0F0  ;
}
	
.User_Table
{
	height: 200px;
	width: 70%;
	position: relative;
	left: 15%;
	background-color: white;
}
/*
.Logout
{
	height: 30px;
	width: 5%;
	position: absolute;
	left: 80%;
	background-color: #008CBA;
	border-radius: 3px;
	color: white;
}*/

.Withdraw
{
	height: 70px;
	width: 20%;
	position: relative;
	left: 10%;
	background-color: #4CAF50;
	border-style: solid;
	border-radius: 10px;
	border-color: white;
	text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 25px;
    color: white;
}

.Withdraw:hover
{
	background-color: green;
	cursor: pointer;
}

.Deposit
{
	height: 70px;
	width: 20%;
	position: relative;
	left: 10%;
	background-color: #4CAF50;
	border-style: solid;
	border-radius: 10px;
	text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 25px;
    color: white;
}

.Deposit:hover
{
	background-color: green;
	cursor: pointer;
}

.History
{
	height: 70px;
	width: 20%;
	position: relative;
	left: 10%;
	background-color: #4CAF50;
	border-style: solid;
	border-radius: 10px;
	text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 25px;
    color: white;
}

.History:hover
{
	background-color: green;
	cursor: pointer;
}

.Pin_Change
{
	height: 70px;
	width: 20%;
	position: relative;
	left: 10%;
	background-color: #4CAF50;
	border-style: solid;
	border-radius: 10px;
	text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 25px;
    color: white;
}

.Pin_Change:hover
{
	background-color: green;
	cursor: pointer;
}

.Current_Balance
{
	height: 70px;
	width: 30%;
	position: relative;
	left: 35%;
	top: 10%;
	background-color: #008CBA;
	color: white;
	font-size: 25px;
	text-align: center;
    text-decoration: none;
    display: inline-block;
    border-style: solid;
    border-radius: 10px;
}
</style>
</head>
<body>
<!--<button class="Logout"><a href = "index1.html"><font style="color:white ; ">Logout</font></a></button>-->
<h1 align="center">
<u>Welcome </u>
</h1>
<br>
<br>
<!--Tabular Representation of Customer Details-->
<table class="User_Table" border="4px">
<tr>
<td><b>Account Number  </b></td>
<td><?php echo $AccountNo ; ?></td>
</tr>
<tr>
<td><b>Customer Name  </b></td>

<td><?php echo $CustomerName ; ?></td>
</tr>
<tr>
<td><b>Address  </b></td>
<td><?php echo $Address ; ?> </td>
</tr>
</table>
<br>
<br>
<a href="withdraw.html"><button class = "Withdraw">Withdraw Amount</button></a>
<a href="deposit.html"><button class = "Deposit">Deposit Amount</button></a>
<a href="transaction.php"><button class = "History">Transaction History</button></a>
<a href="pinChange.html"><button class = "Pin_Change">Pin Change</button></a>;
<br>
<br>
<button class = "Current_Balance">Current Balance : <?php echo $Balance ; ?></button>
</body>
</html>
