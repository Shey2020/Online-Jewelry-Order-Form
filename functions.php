<!--no header/footer-->
<!-- post info from form in order-->
<?php
include_once 'dbconnect.php';

$op ='none';
if(isset($_GET['op'])) $op = $_GET['op'];

if($op=='createOrder'){
	createOrder();
}
if($op=='checkLogin'){
	checkLogin($_POST['email'],$_POST['password']);
}
if($op=='logout'){
	logOut();
}

function isStaff(){
    return isset($_SESSION['email']);
}

function logout(){
    session_start();
    session_destroy();		//clear all session variables
    header('Location: /');
}

function checkLogin($email,$password){
	//only one staff
	global $dbConnection;
	$staffQ=mysqli_query($dbConnection,"SELECT * FROM `staff` WHERE `email`='".$email."'");
	
	$staff=mysqli_fetch_assoc($staffQ);
	
	//check
	if($email==$staff['email']&& password_verify($password,$staff['password'])){
		//approved staff go session
		session_start();
		$_SESSION['email']=$email;
		
		//see orders
		header('Location:/allOrders.php');
	}else{
		//not approved go to log in again
		header('Location:/login.php');
	}
}

function createOrder(){
//store order
	global $dbConnection;

	$sql = "INSERT INTO `php_gem`.`order` (
        `client_name`, 
        `client_email`,
         `quantity`, 
         `order_time`, 
         `gem_id`
         ) VALUES (
         '{$_POST['name']}', 
         '{$_POST['email']}',
         {$_POST['quantity']}, 
         '".date('Y-m-d H:i:s')."',
         {$_POST['gem_id']})";

	//store into db and check the storage
	if(mysqli_query($dbConnection, $sql)){
		//order completed
		header('Location:/order.completed.php');
		//update remaining here
		$gemQ=mysqli_query($dbConnection,"SELECT * FROM gem");
		
		$gem=mysqli_fetch_assoc($gemQ);
			if($_POST['quantity']<=$gem['remaining']){
				$remain=$gem['remaining']-$_POST['quantity'];
				
				$sqlRemain="UPDATE gem SET `remaining`=".$remain." WHERE `gem_id` =".$_POST['gem_id'];
				mysqli_query($dbConnection,$sqlRemain);
			}else{
				echo'Out Of Stock';
			}
		
	}else{
		header('Location:/order.failed.php');
}
			 
	//use csv
	/*$myFile=fopen("data.csv","a") or die("cannot open the file");
	$data = $_POST['gem_id'].','.$_POST['name'].','.$_POST['email'].','.$_POST['quantity'].','.date('Y-m-d H:i:s')."\r\n";
    fwrite($myFile, $data);
    fclose($myFile);*/
	//print
	/*echo $_POST ['gem_id']."<br>";
	echo $_POST ['name']."<br>";
	echo $_POST ['email']."<br>";
	echo $_POST ['quantity']."<br>";
	echo date('Y-m-d H:i:s')."<br>";*/

//change page
	//header('Location:/order.completed.php');
}
?>