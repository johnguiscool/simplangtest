<?php

session_start();
$logged_in_flag = false;

include("php/grammargenerator.php");
include("php/settings.php");

$login_message ="";

if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$member = $_SESSION['username'];
	$logged_in_flag = true;
}

//need to repurpose this to put checkmark for grammar topics
/*	////////////////////////////////////////////
	//
	//  CHECKS FOR PHRASEBOOK-RELATED MESSAGES
	//
	////////////////////////////////////////////

	$language_to_check = $language;

	/*Log in to database */
//	include  $_SERVER['DOCUMENT_ROOT']."/php/database.php";

	/*Query using the dialogue number*/
//	$sql = "SELECT * FROM flashcards_of_members WHERE member = '$member' AND language = '$language_to_check' AND dialogue_number = ".$dialogue_number.";";



	/*if   query is empty then login message is add
	  else 					   login message is checkmark */


//	$result = $db->query($sql);/
//	$row = $result -> fetch();

//	if(empty($row))
//	{

//		$login_message = "<a class = 'add-phrase-button' href='review.php?id=$dialogue_number&language=$language_to_check'>Add Dialogue $dialogue_number Phrases to Phrasebook</a>";/
//	}
//	else
//	{
//		$login_message = "<img src ='http://www.simplang.com/img/checkmark.png' > <span class = 'phrases-added-message'> Dialogue $dialogue_number phrases have been added to your phrasebook. </span>";
//	}


//	$db = null;
//	$sql=null;

	////////////////////////////////////////////
	//
	//  END CHECKS FOR PHRASEBOOK-RELATED MESSAGES
	//
	////////////////////////////////////////////

?>

<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>simplang - <?php echo $language_formatted ?> Lesson <?php echo $dialogue_number; ?> </title>
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/header-content-footer-10122017.css">
	<link rel="stylesheet" href="/css/style-grammar.css">
	<link rel="stylesheet" href="/css/style-lesson-links.css">

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

			<div class="grammar-explanation-container">
				<div class="grammar-explanation-content">
					<h3>Grammar Appendix</h3>
					<div id="grammar-explanation">
						<p><?php echo $grammar_rules; ?></p>
					</div>
				</div>
			</div>

		</div>








			<div class="empty-column column">

				<?php echo $advertising_copy; ?>

				<?php

/*					for($i=1; $i<= count($phrases_french_total); $i++)
					{

						$audio_index = $i;

						if($i<10){$audio_index = "0".$i;}

						echo "<audio id = 'song-1' preload class = 'songs'>";
						echo "<source src='$audio_path-$audio_index.mp3' type='audio/mpeg' />";
						echo "</audio>";

					}*/

				?>


			</div>

		</div>



	<?php include 'php/footer.php'; ?>



</body>

</html>