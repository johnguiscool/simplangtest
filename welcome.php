<?php

session_start();
$logged_in_flag = false;

$login_message = "Welcome back!";

if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$vocab_table = $_SESSION['vocab_table'];
	$logged_in_flag = true;
	$login_message = "Welcome back $username!";
}

if(isset($_GET['status']))
{

	if($_GET['status'] == "registered")
	{
		$login_message = "Congratulations, your account was registered successfully.";
	}
}

?>

<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome</title>
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/header-content-footer-06162017.css">
	<link rel="stylesheet" href="/css/style-welcome-06062017.css">


	<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-100622268-1', 'auto');
	  ga('send', 'pageview');
	</script>

</head>


<body>

	<!-- 3-block body structure:

	[header]
	[container] of content
	[footer]

	-->

	<?php include "php/header.php" ?>

	<div class="container">

		<div class = "login-message-container"  >
			<?php echo $login_message; ?>
		</div>

		<div class = "current-language-container">
		</div>


		<div class ="languages-selector-container">

			<div class ="languages-selector-item"> <a href="/french/">  <img class="flag" src="img/francesplash.png"></a>   <div class="languages-label" >Learn French</div> </div>
			<div class ="languages-selector-item"> <a href="/italian/"> <img class="flag" src="img/italysplash.png"></a>  <div class="languages-label" >Learn Italian</div></div>
			<div class ="languages-selector-item"> <a href="/portuguese/"> <img class="flag" src="img/portugalsplash.png"></a>  <div class="languages-label" >Learn Portuguese</div></div>


			<div class ="languages-selector-item"> <a href="/russian/"> <img class="flag" src="img/russiasplash.png"></a>  <div class="languages-label" >Learn Russian</div></div>
			<div class ="languages-selector-item"> <a href="/ukrainian/"> <img class="flag" src="img/ukrainesplash.png"></a>  <div class="languages-label" >Learn Ukrainian</div></div>

			<div class ="languages-selector-item"> <a href="/turkish/"> <img class="flag" src="img/turkeysplash.png"></a>  <div class="languages-label" >Learn Turkish</div></div>

		</div>





	</div>



	<div class="main-footer">

	Copyright 2017

	</div>



</body>






</html>