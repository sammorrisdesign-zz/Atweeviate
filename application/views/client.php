<?php include('inc/head.php'); ?>

<div class="container">
	
	<?php include('inc/header.php'); ?>
	
	<div id="main" role="main">
	
		<form method="POST" action="<?php echo base_url('twitter/publish'); ?>" class="tweetForm">
		
		  <textarea id="tweet" name="tweet" cols="50" rows="5"></textarea>
		  
		  <input type="submit" name="submit" id="tweetSubmit" value="Tweet">
		  
		</form>
	
	</div>

</div>
	
<a class="logout" href="<?php echo base_url('twitter/logout'); ?>" title="Click here to log out">Log Out</a>

<?php include('inc/footer.php'); ?>