<!DOCTYPE HTML>
<html lang="en">
<head>
	 
<title>Tech_Watch User Page</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" src="script.js"></script>

</head>
<body>
<?php
	$past = time() - 3600;
	foreach ( $_COOKIE as $key => $value )
	{
	    setcookie( $key, $value, $past, '/' );
	}
?>
<div style="text-align: center;">
	<p>You have successfully signed out</p>
	<a style="color: #3087ff;" href="index.html">Back to login page</a>
</div>

</body>
</html>