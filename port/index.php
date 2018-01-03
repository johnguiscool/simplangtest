<?php 

session_start();
$logged_in_flag = false;

include "php/settings.php";

$login_message ="";

if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$vocab_table = "TABLE".$_SESSION['username'];
	$logged_in_flag = true;
	
}

?>

<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>simplang - <?php echo $language_formatted;?> Course </title>
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/header-content-footer-06162017.css">
	<link rel="stylesheet" href="/css/style-lessons-09062017.css">
	<link rel="stylesheet" href="/css/style-splash-09042017.css">



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

		<?php include 'php/lesson-links.php'; ?>

	
		<div class="lesson-content column">
		
			<div class="content-item" > <img class="lesson-picture" src="<?php echo "../img/$splash_image" ?> " alt = "<?php echo "$language_formatted Course"; ?> " ></div>
			
			<h2>simplang <?php echo $language_formatted; ?> Course</h2>
			
			<div class="language-about-text"> <?php echo $splash_screen_about_text; ?> </div>

			



		

						
			<div class="next-lesson-button">
			
			<a class="continue-link-button" href="lessons.php">Go to Lessons</a>
			
			</div>
			
		</div>
			
		
		
			
			
			

			
			<div class="empty-column column">
			
			</div>
			
		</div>
			
		
	
	<?php include 'php/footer.php'; ?>


	
</body>


</html>