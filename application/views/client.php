<?php include('inc/header.php'); ?>

<div class="container">
	
	<header class="header">

		<hgroup>
		
			<h1 class="banner" role="banner">Atweeviate</h1>
			<h2 class="description">Tweet Better</h2>
		
		</hgroup>

		<img src="<?php echo $avatar; ?>" alt="Twitter Profile Image" class="avatar">

	</header>
	
	<div id="main" role="main">
	
		<form method="POST" action="<?php echo base_url('twitter/publish'); ?>" class="tweetForm">
		
		  <textarea id="tweet" name="tweet" cols="50" rows="5"></textarea>
		  
		  <input type="submit" name="submit" id="tweetSubmit" value="Tweet">
		  
		</form>
	
	</div>

</div>
	
<a class="logout" href="<?php echo base_url('twitter/logout'); ?>" title="Click here to log out">Log Out</a>

<?php include('inc/footer.php'); ?>