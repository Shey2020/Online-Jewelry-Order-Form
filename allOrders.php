<?php include_once('header.php'); 
include_once('functions.php'); 
	//session_start();
	
	/*if(!isset($_SESSION['email'])){
		header('Location:/login.php');
	}*/
	if(!isStaff()){
		header('Location:/login.php');
	}
	
?>
<h1>Order Received</h1>
<h2>Your Login email is: <?php echo $_SESSION['email']; ?></h2>

<?php
	/*$orderData=file_get_contents('data.csv');
	$orders=str_getcsv($orderData,"\r\n");*/
	
	//read from db
	$orderQ=mysqli_query($dbConnection,"SELECT * FROM `order`");
	
	while ($order=mysqli_fetch_assoc($orderQ)){
		$gemQ=mysqli_query($dbConnection,"SELECT * from`gem` WHERE gem_id=".$order['gem_id']);
		$gem=mysqli_fetch_assoc($gemQ);
		
		echo '<div class="order"><p>';
		echo 'Client Name : '.$order['client_name'].'<br/>';
		echo 'Client Email : '.$order['client_email'].'<br/>';
		echo 'Ordered : '.$gem['name'].' X '.$order['quantity'].' piece <br/>';
		echo 'Order Time : '.$order['order_time'].'<br/>';
		echo '</p></div>';
	}
	//show all
	/*foreach($orders as $order){
		$singleOrder=explode(",",$order);
		
		//print details in a div
		echo '<div class="order"><p>';
		echo 'Client Name: '.$singleOrder[1].'<br>';
		echo 'Client Email: '.$singleOrder[2].'<br>';
		echo 'Ordered: '.$gems[$singleOrder[0]-1]['name'].'X'.$singleOrder[3].'piece <br>';
		echo 'Order Time: '.$singleOrder[4].'<br>';
		echo '</p></div>';
	}*/
?>

<?php include_once_once_once('footer.php'); ?>