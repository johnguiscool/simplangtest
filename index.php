<?php

session_start();

if(isset($_SESSION['username']))
{
	header("location:welcome.php");

	$username = $_SESSION['username'];
	$vocab_table = $_SESSION['vocab_table'];

	$login_message = "<span class='login-text'> Logged in: $username | <a href='logout.php'>Log out</a></span>" ;
}

else
{
	$login_message =
	"	<span class='login-text'><a class = 'login-register-button login-button' href='https://simplang.com/login.php'>Log in</a></span>
		<span class='register-text'><a class = 'login-register-button register-button' href ='https://simplang.com/register.php'>Create an account</a></span>";

}


?>


<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>simplang</title>

	<link href='//fonts.googleapis.com/css?family=Arvo' rel='stylesheet'>
	<link href='//fonts.googleapis.com/css?family=Brawler' rel='stylesheet'>


	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style-main-06162017.css">



	<?php /*include("php/meta.php");*/ ?>


	<meta name="description" content="simplang - A free website for learning foreign languages through dialogues.">
	<meta name="keywords" content="language, language learning, language studying, culture, foreign language">

	<!-- Facebook stuff -->
	<meta property="og:image" content="https://www.simplang.com/img/logofb.png" />
	<meta property="og:description" content="A free website for learning foreign languages." />
	<meta property="og:url"content="http://www.simplang.com" />
	<meta property="og:title" content="simplang" />

	<!-- Adsense stuff -->

	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
		google_ad_client: "ca-pub-9885009135686938",
		enable_page_level_ads: true
		});
	</script>

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

<div class="wrap">


		<div class="banner-container">

			<img src="img/logo.png" class="banner-text" alt="simplang">

			<div class="banner-subtext"> A free website for learning foreign languages.</div>

		</div>

		<div class="sub-banner-container">

			<?php echo $login_message; ?>

		</div>


		<div class ="languages-selector-container">

			<div class ="languages-selector-item"> <a href="/french/">  <img class="flag" src="img/frenchflag.png" alt="Learn French" title="Click here to start learning French"></a>   <div class="languages-label" >Learn French</div> </div>
			<div class ="languages-selector-item"> <a href="/italian/"> <img class="flag" src="img/italianflag.png" alt="Learn Italian" title="Click here to start learning Italian"></a>  <div class="languages-label" >Learn Italian</div></div>
			<div class ="languages-selector-item"> <a href="/portuguese/">  <img class="flag" src="img/portugueseflag.png" alt="Learn Portuguese" title="Click here to start learning Portuguese"></a>  <div class="languages-label" >Learn Portuguese</div></div>


			<div class ="languages-selector-item"> <a href="/russian/">  <img class="flag" src="img/russianflag.png" alt="Learn Russian" title="Click here to start learning Russian"></a>  <div class="languages-label" >Learn Russian</div></div>
			<div class ="languages-selector-item"> <a href="/ukrainian/">  <img class="flag" src="img/ukrainianflag.png" alt="Learn Ukrainian" title="Click here to start learning Ukrainian"></a>  <div class="languages-label" >Learn Ukrainian</div></div>

			<div class ="languages-selector-item"> <a href="/turkish/">  <img class="flag" src="img/turkishflag.png" alt="Learn Turkish" title="Click here to start learning Turkish"></a>  <div class="languages-label" >Learn Turkish</div></div>

			<div class ="languages-selector-item"> <a href="/chinese/">  <img class="flag" src="img/chineseflag.png" alt="Learn Chinese" title="Click here to start learning Chinese"></a>  <div class="languages-label" >Learn Chinese</div></div>


		</div>

</div>

		<div class="promo-container">

			<div class="promo-item promo-item-1">
				<span class="title">Learn how to speak</span>
				<span class="paragraph">The <b>simplang</b> program teaches you how to have <i>real</i> conversations in a foreign language.  Our program focuses on phrases instead of words, so you'll know <i>how to use</i> the vocabulary you've learned.  </span>
			</div>

			<div class="promo-item promo-item-2">
				<span class="title">Learn naturally</span>
				<span class="paragraph">Forget memorizing conjugation tables and long vocabulary lists.  You'll learn by following a story and listening to a new language in context. All of our content is voiced by native speakers, not robots. </span>
			</div>

			<div class="promo-item promo-item-3">
				<span class="title">Learn effectively</span>
				<span class="paragraph">Our online flashcard system is based on the principle of spaced repetition.  You will be quizzed at just the right intervals to memorize what you've learned most efficiently.  </span>
			</div>

			<div class="promo-item promo-item-4">
				<span class="title">Learn for free!</span>
				<span class="paragraph">The <b>simplang</b> site is 100% free to use.  Sign up <a href="https://simplang.com/register.php">here</a> to get started learning a new language!</span>

			</div>

		</div>







<footer class="main-footer">
	Copyright 2017 <p> <a href="about.php">About</a> |  <a href="terms.php">Terms</a> |  <a href="privacy.php">Privacy</a> | <a href="blog/">Blog</a> | <a href="contact.php">Contact</a>
</footer>

</body>
</html>