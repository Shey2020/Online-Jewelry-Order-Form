<?php include_once('header.php'); ?>

	<h1>Jewelry Order</h1>
	<h2><?php echo date('M'); ?> Sale</h2>
	
	<div class="flex-grid">
		<?php
			//print all $gems
			//with link to order
		$gemQ=mysqli_query($dbConnection,"SELECT * FROM `gem`");
		
		while ($gem=mysqli_fetch_assoc($gemQ)){

			echo '<div class="col"> <img src="/images/'.$gem['image'].'" /> <p>
			Name：'.$gem['name'].'<br>
			Price：$'.$gem['price'].'<br>
			<a href="/order.php?gem_id='.$gem['gem_id'].
			'" class="buyBtn">Order '.$gem['name'].'</a><br></div>';
		}
		/*foreach($gems as $key => $gem){
			echo '<div class="col"> <img src="/images/'.$gem['image'].'" /> <p>
			Name：'.$gem['name'].'<br>
			Price：$'.$gem['price'].'<br>
			<a href="/order.php?gem_id='.$gem['gem_id'].
			'" class="buyBtn">Order '.$gem['name'].'</a><br></div>';
		}*/
		?>
	</div>

<?php include_once('footer.php'); ?>