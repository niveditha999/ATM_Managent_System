<?php
echo "<body style='background: url(bg.png);'>";
?>
<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "atm_system";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

session_start();
$account_no = $_SESSION["acc_no"];
$cheque_no;


//echo "Hello".$account_no."<br>";
	global $account_no;
	$account_no = $_SESSION["acc_no"];

	
	
	$sql_get_pin = "SELECT `cheque_no` FROM `deposit` WHERE `acc_no` = '$account_no'";
	
	$get_pin_result = $conn->query($sql_get_pin);
	
//	echo "Account No :".$account_no;
	//
	//$pin_no = $get_pin_result;

	while($row = $get_pin_result->fetch_assoc()){
			global $cheque_no;
			$cheque_no = $row['cheque_no'];
	}
	//echo "Actual Pin : ".$pin_no;
	


$entered_cheque_no = $_POST["cheque_no"];
$amount = $_POST["amount"];
$balance;

$sql_get_balance = "SELECT `Balance` FROM `Customers` WHERE `AccountNo` = '$account_no'";
$get_balance_result = $conn->query($sql_get_balance);

while($row = $get_balance_result->fetch_assoc()){
		global $balance;
		$balance = $row['Balance'];
}


if(isset($_POST["cheque_no"])&&!empty($_POST["cheque_no"])){
		global $entered_pin_no;
		$entered_pin_no = $_POST["cheque_no"];
}

if(isset($_POST["amount"])&&!empty($_POST["amount"])){
		global $amount;
		$amount = $_POST["amount"];
}
$updated_balance;

// -1 : pins donot match
// 0 : insufficient balance 
// 1 : successful transaction 
$message ;
function deposit(){
		global $balance;
		global $amount;
		global $acc_no;
		global $cheque_no;
		global $entered_pin_no;
		if($cheque_no!=$entered_pin_no){
			global $message ;
			$message = "Cheque No Invalid";
			return -1;
			}
		else{
			global $account_no;
			global $updated_balance;
			$updated_balance = $balance + $amount;
			$_SEESION["updated_balance"] = $updated_balance; 
			$sql = "UPDATE `Customers` SET `Balance` = '$updated_balance' WHERE `AccountNo` = '$account_no'";
			$sql_deposit = "INSERT INTO `deposit` VALUES ('$acc_no','$cheque_no','$updated_balance')";
			global $conn;
			$conn->query($sql);
			$conn->query($sql_deposit);
			global $message ;
			$message = "Successful transaction : Deposited Rs ".$amount ;
			
			return 1;
		}
}
$retval = deposit();
//echo "withdraw Function ".$updated_balance." : ".$retval;

?>
<html>
	<body>
	<br>
	<h3><?= $message ?></h3><br>
	<a href="menu.php">Go back to main menu </a>
	</body>

</html>
