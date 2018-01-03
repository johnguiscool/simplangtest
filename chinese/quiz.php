<?php

include("php/settings.php");

/////////////////////////////////////////
//
//  SET SESSION VARIABLES
//
///////////////////////////////////////////


session_start();



if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$member = $_SESSION['username'];
	$logged_in_flag = true;
}

$dialogue_items = array();
$dialogue_items_length = 0;

/////////////////////////////////////////
//
//  LOG INTO THE DATABASE
//
///////////////////////////////////////

// Establish database connection
// (this creates the $db PDO connection variable)
 include  $_SERVER['DOCUMENT_ROOT']."/php/database.php";


 //////////////////////////////////////
//
//   GET CURRENT TIME
//
//////////////////////////////////////

$current_time = date('Y-m-d G:i:s');



///////////////////////////////////////////////////////////////
//
//   GATHER INDIVIDUAL USER TABLE
//
///////////////////////////////////////////////////////////////

$sql = "SELECT * FROM flashcards_of_members WHERE member = '$member' AND language = '$language' AND next_quiz_date <= '".$current_time."';";




    // output data of each row
    foreach ($db->query($sql) as $row) {
        array_push($dialogue_items, array($row["dialogue_number"],$row["row_number"]));
        $dialogue_items_length = count($dialogue_items);
    }



//close pdo connection
$sql = null;
$db = null;


/////////////////////////////////////////////////////////
//
//   PULL THE DIALOGUES INTO A TABLE
//
/////////////////////////////////////////////////////////

$dialogue_number=1;
$row_number=0;

// All the phrases to be quizzed on will be put into these arrays
$quizzed_phrases_array_english = [];
$quizzed_phrases_array_foreign = [];
$quizzed_phrases_array_audio = [];



////////////
/// Loop starts here
///////////

for ($i =0; $i < $dialogue_items_length; $i++)
{

	$dialogue_number = (int) $dialogue_items[$i][0];
	$row_number      = (int) $dialogue_items[$i][1];
	$row_number_audio= $row_number;

		if($row_number_audio > 9)
	{
		$row_index_audio  = $row_number_audio;
	}

	else
	{
		$row_index_audio  = "0".$row_number_audio;
	}


	// adjust row number so that it is indexed at 0, instead of 1
	$row_number = $row_number - 1;

	if($dialogue_number > 9)
	{
		$dialogue_index  = $dialogue_number;
	}

	else
	{
		$dialogue_index  = "0".$dialogue_number;
	}


	// select the text file by the dialogue number
	$texts_path	 = "texts/";
	$audio_path	 = "audio/dialogue-".$abbreviation."-".$dialogue_index."-".$row_index_audio.".mp3";

	$english_path      =$texts_path."englishphrases".$dialogue_index.".txt";
	$foreign_path    =$texts_path.$language."phrases".$dialogue_index.".txt";
	$speaker_path      =$texts_path."speaker".$dialogue_index.".txt";

	$phrases_english         = file_get_contents($english_path,true);
	$phrases_english_array   = explode("\n", $phrases_english);

	echo "\r\n";

	$phrases_foreign       = file_get_contents($foreign_path,true);
	$phrases_foreign_array = explode("\n", $phrases_foreign);

	// select the correct line from the text file by the row number
	$selected_phrase_english   = $phrases_english_array[$row_number];
	$selected_phrase_foreign = $phrases_foreign_array[$row_number];

	// add the phrase to the list of phrases that will actually show up on the quiz
	array_push($quizzed_phrases_array_english,$selected_phrase_english);
	array_push($quizzed_phrases_array_foreign,$selected_phrase_foreign);
	array_push($quizzed_phrases_array_audio, $audio_path);

}

//////////
//  Loop ends here
//////////
?>


<html>

<head>

<meta name="viewport" content="width=device-width,initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="/css/style-quiz.css">
<link rel="stylesheet" href="/css/normalize.css">
<link rel="stylesheet" href="/css/header-content-footer-10122017.css">

</head>

<body>

<?php include 'php/header.php' ?>

<title> Quiz </title>

<div class="container">
	<div><div class="qa quiz-card">

		<h3 color = "blue"><p id="english" class="english-prompt"> </p></h3>
		<h3><p id="answer" class = "foreign-answer"> <br> </p><h3>

	</div></div>


	<audio controls id="audio" hidden>
	  <source id="audioSource" src="audio/dialogue-<?php echo $abbreviation; ?>-01-01.mp3" type="audio/mp3">
	Your browser does not support the audio element.
	</audio>

	<div class = "answer-panel">
		<div class = "check-answer-anchor" id="checkAnswer"><button type="button" onclick="myFunction()" id="buttonLabel" class="check-answer-button">Check Answer</button></div>

		<!-- NEW FORGOT BUTTON -->
		<div id="forgotPhrase" class="forgot-phrase-anchor"></div>


		<!-- NEW AUDIO REPLAY BUTTON -->
		<div id="replayAudio" class="replay-audio-anchor"></div>
	</div>

	<div class="exit-quiz-anchor" >
	<form action="exitquiz.php" method="POST" id="exit_quiz_form">
		<input type="hidden" id="exit_quiz_parameters"           name="exit_quiz_parameters" value="">
		<input type="hidden" id="exit_quiz_parameters_forgotten" name="exit_quiz_parameters_forgotten" value="">
		<input type="hidden" id="exit_quiz_language" 			 name="exit_quiz_language" value="<?php echo $language;?>">
		<input type="submit" value="Exit Quiz and Save Results">
	</form>
	</div>




</div>


<?php include 'php/footer.php'; ?>


</body>

<script src="https://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" charset="utf-8"> </script>

<script>
//Initialize Values
var m= 2;

var englishPhrase =    <?php echo json_encode($quizzed_phrases_array_english); ?>;
var foreignPhrase =  <?php echo json_encode($quizzed_phrases_array_foreign); ?>;
var audioPhrase =      <?php echo json_encode($quizzed_phrases_array_audio); ?>;

// Index of phrase tested
// reviewed_indices  => phrases that will be marked as reviewed and whose review date will be pushed to later on.
// forgotten_indices => phrases that will be marked as reviewed and whose review date will be reset
var reviewed_indices = "";
var forgotten_indices = "";

var d_number = "999";
var r_number = "888";

var updated_indices = <?php echo json_encode( $dialogue_items) ?>;

var updated_indices_as_string = "";

for (i = 0; i <updated_indices.length;i++)
{
	updated_indices_as_string = updated_indices_as_string.concat(updated_indices[i][0]);
	updated_indices_as_string = updated_indices_as_string.concat(updated_indices[i][1]);
}


var audio = document.getElementById("audio");

var n = 0;


// showAnswerFlag=1 => Displaying the Question only.  When the button is pressed and showAnswerFlag=1, the answer will show up.
// showAnswerFlag=0 => Displaying the Question and Answer.  When the button is pressed and showAnswerFlag=0, the next question will show up.

var showAnswerFlag=1;

	document.getElementById("english").innerHTML = englishPhrase[n];

// Show a "no phrases to test message" if the array of phrases to test is empty
if(englishPhrase == null || typeof englishPhrase == "undefined" || englishPhrase.length <1)
{
	document.getElementById("english").innerHTML = "No Phrases to Review Today";
	document.getElementById("checkAnswer").innerHTML = "";
}





function myFunction()

{

	// When you have cycled through all the phrases, then say that there are no more phrases to review, and clear out everything.
	if(n == englishPhrase.length )
	{
	document.getElementById("english").innerHTML = "No More Phrases to Review Today";
	document.getElementById("answer").innerHTML = " <br> ";
	document.getElementById("audio").innerHTML = " <br>";



	document.getElementById("buttonLabel").innerHTML = "";
	document.getElementById("forgotPhrase").innerHTML="";

	$( "#buttonLabel" ).hide();
	$( "#forgotPhrase" ).hide();
	$( "#replayAudio" ).hide();


	new_index = d_number + r_number;
	reviewed_indices = reviewed_indices + new_index;

	document.getElementById("exit_quiz_parameters").value = reviewed_indices;
	$("#exit_quiz_parameters").val(reviewed_indices);

	// Exit the function because the AnswerFlag does not matter;
	return;
	}


	document.getElementById("english").innerHTML = englishPhrase[n];

// showAnswerFlag=0 => Displaying the Question and Answer.  When the button is pressed and showAnswerFlag=0, the next question will show up.
	if (showAnswerFlag==0)
	{
		document.getElementById("answer").innerHTML = " <br> ";
		document.getElementById("audio").innerHTML = " <br>";
		$("#audio").hide();


		showAnswerFlag=1;
		document.getElementById("buttonLabel").innerHTML = "Check Answer";
		document.getElementById("forgotPhrase").innerHTML="";
		document.getElementById("replayAudio").innerHTML="";




		new_index = d_number + r_number;
		reviewed_indices = reviewed_indices + new_index;


	}

// showAnswerFlag=1 => Displaying the Question only.  When the button is pressed and showAnswerFlag=1, the answer will show up.
	else if (showAnswerFlag==1)
	{
		document.getElementById("answer").innerHTML = foreignPhrase[n];
		document.getElementById("audio").innerHTML = " <source src=\""+ audioPhrase[n]+ "\" type=\"audio/mp3\">";

			$("#audio").show();

		document.getElementById("forgotPhrase").innerHTML="<button class = \"forgot-phrase-button\" type=\"button\" onclick=\"forgotFunction()\">Forgot Phrase</button>";
		document.getElementById("replayAudio").innerHTML="<button class = \"replay-audio-button\" type=\"button\" onclick=\"replayAudio()\">Replay Audio</button>";


		audio.load();
		audio.play();
		showAnswerFlag=0;

		if( parseInt(updated_indices[n][0]) < 10)
			{
			d_number = "0".concat(updated_indices[n][0]);
			}
		else
			{
			d_number = updated_indices[n][0];
			}

		if( parseInt(updated_indices[n][1]) < 10)
			{
			r_number = "0".concat(updated_indices[n][1]);
			}
		else
			{
			r_number = updated_indices[n][1];
			}

		n = n+1;
		document.getElementById("buttonLabel").innerHTML = "Correct - Next Phrase";

	}


	document.getElementById("exit_quiz_parameters").value = reviewed_indices;
	$("#exit_quiz_parameters").val(reviewed_indices);



}

function replayAudio()
{
	document.getElementById('audio').play();
}

function forgotFunction()
{

// showAnswerFlag=0 => Displaying the Question and Answer.  When the button is pressed and showAnswerFlag=0, the next question will show up.
   if (showAnswerFlag==0)
	{
		document.getElementById("answer").innerHTML = " <br> ";
		document.getElementById("audio").innerHTML = " <br>";

	 $("#audio").hide();


		showAnswerFlag=1;
		document.getElementById("buttonLabel").innerHTML = "Check Answer";
		document.getElementById("forgotPhrase").innerHTML="";
		document.getElementById("replayAudio").innerHTML="";


		new_index = d_number + r_number;
		forgotten_indices = forgotten_indices + new_index;

		if(n+1 <= englishPhrase.length)
		{
			englishPhrase.splice(n+1,0,englishPhrase[n-1]);
			foreignPhrase.splice(n+1,0,foreignPhrase[n-1]);
			audioPhrase.splice(n+1,0,audioPhrase[n-1]);

			/////////////////////////////////////////
			//
			//    THE FOLLOWING CODE EXISTS ONLY TO INSERT THE FORGOTTEN PHRASE INTO THE "updated_indices" ARRAY
			//
			////////////////////////////////////////

			empty_array = [["0","0"]];
			empty_array.pop();

			console.log(n);


			for (j=0; j< n+1; j++)
			{
				empty_array.push(updated_indices[j]);
			}

			empty_array.push(updated_indices[n-1]);

			for (j=n+1; j<englishPhrase.length-1;j++)
			{
				empty_array.push(updated_indices[j])
			}


			updated_indices = empty_array.slice(0);

			console.log(updated_indices);

			/////////////////////////////////////////////
			//
			//    END OF COPY CODE
			//
			////////////////////////////////////////////
		}

		else if(n+1 > englishPhrase.length)
		{

			englishPhrase.push(englishPhrase[n-1]);
			foreignPhrase.push(foreignPhrase[n-1]);
			audioPhrase.push(audioPhrase[n-1]);
			updated_indices.push(updated_indices[n-1]);
			console.log(n);
			console.log(updated_indices);

		}


	}

// showAnswerFlag=1 => Displaying the Question only.  When the button is pressed and showAnswerFlag=1, the answer will show up.
   if (showAnswerFlag==1)
	{
		//Do nothing
	}

	document.getElementById("english").innerHTML = englishPhrase[n];
	document.getElementById("exit_quiz_parameters_forgotten").value = forgotten_indices;
	$("#exit_quiz_parameters_forgotten").val(forgotten_indices);


}



</script>
</html>