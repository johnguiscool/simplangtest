<?php

session_start();

?>

<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>simplang</title>
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/header-content-footer-06162017.css">
	<link rel="stylesheet" href="/css/style-about-06162017.css">


	<script
		src="https://code.jquery.com/jquery-2.2.4.min.js"
		integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		crossorigin="anonymous">
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

	<!-- 3-block body structure:

	[header]
	[container] of content
	[footer]

	-->

	<?php include "php/header.php" ?>

	<div class="container">

		<div class = "simplang-description">

		<h2>About</h2>

		<b>simplang</b> is a free language-learning platform built by polyglots. Each lesson of a <b>simplang</b> language course consists of a simple dialogue (fully-voiced by native speakers) and a concise explanation of the grammar used in the dialogue.  Additionally, when you register an account, you can make use of our flashcard system to review what you've learned. 		

		</div>

		<h1>The Team</h1>

		<div class = "pictures-row">
			<div class = "person">
				<img src="/img/john.png" alt="John Gu">
				<p><b>John</b><br>Co-founder</p>
			</div>

			<div class = "person">
				<img src="/img/emre.png" alt="Emre Boran">
				<p><b>Emre</b><br>Co-founder</p>
			</div>

			<div class = "person">
				<img src="/img/xavier.jpg" alt="Xavier Delouvrier">
				<p><b>Xavier</b><br>Course Content</p>
			</div>

			<div class = "person">
				<img src="/img/clotilde.jpg" alt="Clotilde Barral">
				<p><b>Clotilde</b><br>Course Content</p>
			</div>

			<div class = "person">
				<img src="/img/natalya.jpg" alt="Natalya Astaptseva">
				<p><b>Natalya</b><br>Art<br><a href="http://artcardbook.blogspot.com/">Website</a></p>
			</div>

			<div class = "person">
				<img src="/img/elisa.jpg" alt="Elisa Rosso">
				<p><b>Elisa</b><br>Course Content</p>
			</div>

			<div class = "person">
				<img src="/img/hanna.jpg" alt="Hanna Karpenko">
				<p><b>Hanna</b><br>Voice Talent</p>
			</div>

			<div class = "person">
				<img src="/img/rostyslav.jpg" alt="Rostyslav Zhuravchak">
				<p><b>Rostyslav</b><br>Course Content</p>
			</div>

			<div class = "person">
				<img src="/img/jack.jpg" alt="Rostyslav Zhuravchak">
				<p><b>Jack</b><br>Intern</p>
			</div>


		</div>

		<h1>Collaborators</h1>

		<div class="pictures-row">
			<div class = "person">
				<img src="/img/ani.jpg" alt="Ani Alipaj">
				<p><b>Ani</b><br><a href="https://www.fiverr.com/anialipaj">Audio Mixing and Editing</a><br><a href="https://www.facebook.com/IntoThinAir/">IntøThinAir</a></p>
			</div>

			<div class = "person">
				<img src="/img/chiara.jpg" alt="Chiara Ribolzi">
				<p><b>Chiara</b><br><a href="https://www.fiverr.com/chiararibolzi/record-an-italian-voice-over-with-my-accent-free-voice">Voice Talent</a></p>
			</div>

			<div class = "person">
				<img src="/img/giovanni.jpg" alt="Giovanni Giudice">
				<p><b>Giovanni</b><br><a href="https://www.fiverr.com/giovannigiudice/do-italian-voice-overs-for-commercial-jingle-or-whatever">Voice Talent</a></p>
			</div>

			<div class = "person">
				<img src="/img/marian.jpg" alt="Marian Marseau">
				<p><b>Marian</b><br><a href="https://www.fiverr.com/anialipaj">Voice Talent</a><br>Meryas Studio</p>
			</div>



		</div>

	</div>
	<?php include 'php/footer.php'; ?>



</body>






</html>