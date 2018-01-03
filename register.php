<?php

$error = $_GET["error"];

$error_message = "";

if($error == 1)
{
	$error_message = "That email address is already in use by a different account.";
}

if ($error == 2)
{
	$error_message = "Please submit a valid email address.";
}

if ($error == 3)	
{
	$error_message = "Usernames can only consist of alphanumeric characters.";
}

if ($error == 4)
{
	$error_message = "That username has already been taken.";
}

if ($error == 5)
{
	$error_message = "It looks like there was an error in our database!  Please wait a few minutes and try again.";
}



?>

<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
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

		<div class = "error-message"> <?php echo $error_message; ?> </div>

		<form class="form-signin" method="post" action="registerprocess.php">
			<h2 class="form-signin-heading">Create an Account</h2>
			<br>
			<label for="inputUsername">Username</label>
			<input type="text" id="inputUsername" name="username" class="form-control">
			<br>
			<label for="inputEmail">Email Address</label>
			<input type="text" id="inputEmail" name="email" class="form-control">
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