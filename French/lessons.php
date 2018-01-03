<?php

session_start();
$logged_in_flag = false;


include("php/dialoguegenerator.php");
include("php/settings.php");

$login_message ="";

if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$member = $_SESSION['username'];
	$logged_in_flag = true;



	////////////////////////////////////////////
	//
	//  CHECKS FOR PHRASEBOOK-RELATED MESSAGES
	//
	////////////////////////////////////////////

	$language_to_check = $language;

	/*Log in to database */
	include  $_SERVER['DOCUMENT_ROOT']."/php/database.php";

	/*Query using the dialogue number*/
	$sql = "SELECT * FROM flashcards_of_members WHERE member = '$member' AND language = '$language_to_check' AND dialogue_number = ".$dialogue_number.";";



	/*if   query is empty then login message is add
	  else 					   login message is checkmark */


	$result = $db->query($sql);
	$row = $result -> fetch();

	if(empty($row))
	{

		$login_message = "<a class = 'add-phrase-button' href='review.php?id=$dialogue_number&language=$language_to_check'>Add Dialogue $dialogue_number Phrases to Phrasebook</a>";
	}
	else
	{
		$login_message = "<img src ='http://www.simplang.com/img/checkmark.png' > <span class = 'phrases-added-message'> Dialogue $dialogue_number phrases have been added to your phrasebook. </span>";
	}


	$db = null;
	$sql=null;

	////////////////////////////////////////////
	//
	//  END CHECKS FOR PHRASEBOOK-RELATED MESSAGES
	//
	////////////////////////////////////////////
}



$previous_dialogue_number = $dialogue_number -1;
$next_dialogue_number = $dialogue_number +1;

if ($previous_dialogue_number >0)
{
	$previous_lesson_button = "<button class = 'previous-lesson-button' id = 'previous-lesson-button' onclick = 'previousLesson()'> Previous Lesson </button>";
}
else
{
	$previous_lesson_button = "<button hidden class = 'previous-lesson-button' id = 'previous-lesson-button' onclick = 'previousLesson()'> Previous Lesson </button>";
}

if ($next_dialogue_number <= $number_of_dialogues_total)
{
	$next_lesson_button = "<button class = 'next-lesson-button' id = 'next-lesson-button' onclick = 'nextLesson()'> Next Lesson </button>";
}
else
{
	$next_lesson_button = "<button hidden class = 'next-lesson-button' id = 'next-lesson-button' onclick = 'nextLesson()'> Next Lesson </button>";
}


?>

<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>simplang - <?php echo $language_formatted ?> Lesson <?php echo $dialogue_number; ?> </title>
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/header-content-footer-10122017.css">
	<link rel="stylesheet" href="/css/style-lessons-09062017.css">
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

			<div class="content-item" > <img class="lesson-picture" src="<?=$pics_path?>"></div>


			<div>

				<div class="audio-button-container">
					<button class = "audio-button" onclick="playAllDialogue()"><img class = 'audio-button-image' id="audio-button-image" src ='/img/playbutton.png'>
					</button>
					<span class="audio-button-text"><i>Click to play dialogue audio.</i></span>
				</div>

				<table class="lesson-dialogue-table" id="lesson-dialogue-table">
				<?php

					for($i=0; $i< count($phrases_french_total); $i++)
					{

						echo "<tr onclick='playAudio($i)'> ";
						echo "<td> <b>" . $speaker_total[$i] . "</b></td> ";
						echo "<td> " . $phrases_french_total[$i];

						if ($show_literal_definitions_flag == true) {
							echo "<div hidden id = 'literal-definition-sentence' class ='literal-definition-sentence'>".$phrases_literal_definitions_total[$i] ."</div> </td> ";;
						}

						echo "<td> " . $phrases_english_total[$i] . "</td> ";

						echo "</tr>";
					}

				?>
				</table>

				<p>

				<?php echo $literal_definitions_button; ?>

				<?php echo $transliteration_button; ?>

				<p> <?php echo $login_message; ?> </p>


			</div>





			<div class="grammar-explanation-container">
				<div class="grammar-explanation-content">
					<h3>Grammar Notes</h3>
					<div id="grammar-explanation">
						<p><?php echo $grammar ?></p>
					</div>
				</div>
			</div>

			<div class="navigation-buttons">
			<?php
				echo $previous_lesson_button;
				echo $next_lesson_button;
			?>
			</div>

		</div>








			<div class="empty-column column">

				<?php echo $advertising_copy; ?>

				<?php

					for($i=1; $i<= count($phrases_french_total); $i++)
					{

						$audio_index = $i;

						if($i<10){$audio_index = "0".$i;}

						echo "<audio id = 'song-1' preload class = 'songs'>";
						echo "<source src='$audio_path-$audio_index.mp3' type='audio/mpeg' />";
						echo "</audio>";

					}

				?>


			</div>

		</div>



	<?php include 'php/footer.php'; ?>



</body>






<script>

var show_transliterated = 0;

//stop_mode variable determines whether:
// (a) there is currently no audio playing, the play button is displaying and we are ready to play the full audio; this is stop_mode = 0;
// (b) there is currently audio playing, and it will continue playing until the end of the dialogues is reached; this is stop_mode = 1;
var stop_mode = 0;

// notes about stop mode:
//
/* when the play (all) audio button is pushed while stop mode = 1, this resets stop_mode to 0, and we also need to exit the audio play loop in the playAllDialogue function
   that was triggered when the play audio button was pushed.  this is why there is a check for stop_mode that returns (exits) out of the function during the audio playing

	 when an individual line of dialogue is played while stop_mode = 1 (by function call to playAudio()), the function will not do anything so as not to disrupt the
	 playAllDialogue() function.
*/

function playAudio(i)
{

	//prevents the function from playing any audio or doing anything if the dialogue audio is currently playing.
	if (stop_mode ==0)
	{

		var audioArray = document.getElementsByClassName('songs');

		audioArray[i].load();
		audioArray[i].play();
	}
}

function playAllDialogue()
{
	var audioArray = document.getElementsByClassName('songs');


	var play_all = 1;


	if (stop_mode == 1)
	{

		//stop all audio.
		play_all = 0;
		for(i=0; i<audioArray.length; i++) {audioArray[i].pause(); audioArray[i].currentTime=0;};

		//change picture
		document.getElementById("audio-button-image").src = "/img/playbutton.png";

		stop_mode = 0;

	}

	else if (stop_mode == 0)
	{
		stop_mode = 1;

		document.getElementById("audio-button-image").src = "/img/stopbutton.png";



	<?php

		for($i=0; $i<count($phrases_french_total); $i++ )
		{


			echo 	"audioArray[{$i}].load();";

		}


		echo "audioArray[0].play();";


		for($i=0; $i<count($phrases_french_total)-1; $i++ )
		{

			$j = $i+1;

			echo "	audioArray[{$i}].onended = function() ";
			echo "{";

			//exits the function early when stop_mode == 0, this signifies that the stop button has been pushed, so we need to stop playing the audio
			echo "if(stop_mode ==0)";
			echo "{return;}";

			echo "if(play_all == 1) {";
			echo 	"audioArray[{$j}].play();";

			if ($i == count($phrases_french_total)-2)
			{
				echo "play_all = 0;";
			}

			echo "}";
			echo "};";


			if ($i == count($phrases_french_total)-2)
			{

				echo "	audioArray[{$j}].onended = function() ";
				echo "{";
				echo "stop_mode = 0;";
				echo "document.getElementById('audio-button-image').src = '/img/playbutton.png'";
				echo "};";
			}


		}



	?>

	}
}

function nextLesson()
{

	<?php if($next_dialogue_number <= $number_of_dialogues_total)
			{
				echo "location.href = 'lessons.php?dialogue=$next_dialogue_number';";
			}
	?>
}

function previousLesson()
{

	<?php if($previous_dialogue_number > 0)
			{
				echo "location.href = 'lessons.php?dialogue=$previous_dialogue_number';";
			}
	?>
}

function toggleDefinitions()
{
    $( ".literal-definition-sentence" ).toggle();
}


function toggleTransliteration()
{

	var normal_text = " <?php

						if($transliteration_flag == true)
						{

						$output ="";

						for($i=0; $i< count($phrases_french_total); $i++)
						{

							$output .= "<tr onclick='playAudio($i)'> ";
							$output .= "<td> <b>" . $speaker_total[$i] . "</b></td> ";
							$output .= "<td> " . $phrases_french_total[$i];

							if ($show_literal_definitions_flag == true) {
								$output .= "<div hidden id = 'literal-definition-sentence' class ='literal-definition-sentence'>".$phrases_literal_definitions_total[$i] ."</div> </td> ";;
							}

							$output .= "<td> " . $phrases_english_total[$i] . "</td> ";

							$output .= "</tr>";
						}

						$output = preg_replace( "/\r|\n|\n\r/", "", $output );

						echo $output;

						}
						?>";

	var normal_grammar = "<?php
						if($transliteration_flag == true)
						{
							echo  preg_replace( "/\r|\n|\n\r/","",$grammar);
						}
						?>";

	var transliterated_text = " <?php

						if($transliteration_flag == true)
						{

						$output ="";

						for($i=0; $i< count($phrases_french_total); $i++)
						{

							$output .= "<tr onclick='playAudio($i)'> ";
							$output .= "<td> <b>" . $speaker_total[$i] . "</b></td> ";
							$output .= "<td> " . $phrases_french_transliterated_total[$i];

							if ($show_literal_definitions_flag == true) {
								$output .= "<div hidden id = 'literal-definition-sentence' class ='literal-definition-sentence'>".$phrases_literal_definitions_total[$i] ."</div> </td> ";;
							}

							$output .= "<td> " . $phrases_english_total[$i] . "</td> ";

							$output .= "</tr>";
						}

						$output = preg_replace( "/\r|\n|\n\r/", "", $output );

						echo $output;

						}
						?>";

	var transliterated_grammar = "<?php
							if($transliteration_flag == true)
						{

						echo preg_replace( "/\r|\n|\n\r/","",$grammar_transliterated);

						}
						?> ";



	<?php if ($transliteration_flag == true) {echo "
	if(show_transliterated == 0)
		{
			document.getElementById('lesson-dialogue-table').innerHTML = transliterated_text;
			document.getElementById('grammar-explanation').innerHTML = transliterated_grammar;
			show_transliterated = 1;
		}
	else if(show_transliterated == 1)
		{
			document.getElementById('lesson-dialogue-table').innerHTML = normal_text;
			document.getElementById('grammar-explanation').innerHTML = normal_grammar;
			show_transliterated = 0;
	}";}
	?>
}






</script>

</html>
