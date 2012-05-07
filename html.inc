<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Atweeviate</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width">
	<link href='http://fonts.googleapis.com/css?family=Abel|Droid+Sans+Mono|Inconsolata' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css">
	
	<script src="js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body>
<header>
</header>
<div id="main" role="main">
<div id="main-head">
<div id="main-head-logo"></div>
<h1>Atweeviate</h1>
<h2>Get it? Like abbreviate</h2>
</div>
<?php print_r($content); ?>

<script type='text/javascript'>
	$("#tweet").keyup(function() {
    var text = $('#tweet').val(); } );
	document.write(text);
</script>

</div>
<a class="logout" href="clearsessions.php">Log Out</a>
<footer>

</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

<!-- scripts concatenated and minified via ant build script-->
<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
<!-- end scripts-->

</body>
</html>