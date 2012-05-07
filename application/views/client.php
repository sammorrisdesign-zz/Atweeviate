<?php include('inc/head.php'); ?>

<div class="container">
	
	<?php include('inc/header.php'); ?>
	
	<div id="main" role="main">
	
		<form method="POST" action="tweet.php" class="tweetForm">
		
		  <textarea id="tweet" name="tweet" cols="50" rows="5"></textarea>
		  
		  <input type="submit" name="submit" id="tweetSubmit" value="Tweet">
		  
		</form>
	
	</div>

</div>
	
<a class="logout" href="clearsessions.php" title="Click here to log out">Log Out</a>

<?php include('inc/footer.php'); ?>