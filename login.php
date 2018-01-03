<?php

session_start();
$logged_in_flag = false;

?>


<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/header-content-footer-06162017.css">
	<link rel="stylesheet" href="css/style-login-06162017.css">
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-100622268-1', 'auto');
	  ga('send', 'pageview');
	</script>
</head>

	<?php include "php/header.php" ?>


	<div class="container">
	
		<form class="form-signin" method="post" action="loginprocess.php">
			<h2 class="form-signin-heading">Login</h2>
			<br>
			<label for="inputUsername">Username</label>
			<input type="text" id="inputUsername" name="username" class="form-control">
			<br>
			<label for="inputPassword">Password</label>
			<input type="password" id="inputPassword" name="password" class="form-control">
			<br>
			<div class="submit-button-wrapper">
				<button  type="submit" class="submit-login-button">Submit</button>
			</div>
		</form>
	
	</div>

	<?php include "php/footer.php" ?>