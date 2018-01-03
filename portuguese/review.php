<?php

////////////////////////////////////
//
//  DIALOGUE NUMBER VARIABLE
//
////////////////////////////////////

$dialogue_number = $_GET['id'];

$dialogue_next   = $dialogue_number + 1;



if($dialogue_number > 9)
{
	$dialogue_index  = $dialogue_number;
}

else
{
	$dialogue_index  = "0".$dialogue_number;
}


if($dialogue_next > 9)
{
	$dialogue_next_index  = $dialogue_next;
}

else
{
	$dialogue_next_index  = "0".$dialogue_next;
}


/////////////////////////////////////////
//
//  SET SESSION VARIABLES
//
///////////////////////////////////////////

session_start();
$member = $_SESSION['username'];


/////////////////////////////////////////
//
//  LOG INTO THE DATABASE
//
///////////////////////////////////////

// Establish database connection
// (this creates the $db PDO connection variable)
 include  $_SERVER['DOCUMENT_ROOT']."/php/database.php";


/////////////////////////////////////////////////////////////////////
//
//  GET THE NUMBER OF PHRASES TO TEST
//
///////////////////////////////////////////////////////////////////

$language = $_GET['language'];


/////////////////////////////////////////////////////////////////////
//
//  GET THE NUMBER OF PHRASES TO TEST
//
///////////////////////////////////////////////////////////////////

$texts_path	 = "texts/";

$foreign_phrases_path    =$texts_path.$language."phrases".$dialogue_index.".txt";
$tested_phrases_path    =$texts_path."testedphrases".$dialogue_index.".txt";

if(file_exists($tested_phrases_path))
{
	$tested_phrases       = file_get_contents($tested_phrases_path,true);
	$tested_phrases_array = explode(",", $tested_phrases);

}

//If there is no specific testedphrases file associated with a particular dialogue, then create one automatically of all the
else
{
	$tested_phrases_array =[];

	$foreign_phrases = file_get_contents($foreign_phrases_path,true);
	$foreign_phrases_array = explode("\n", $foreign_phrases);
	$m = count($foreign_phrases_array);

	for($n=1; $n <= $m; $n++)
	{
		array_push($tested_phrases_array, $n);
	}
}

$number_of_phrases       = count($tested_phrases_array);


/////////////////////////////////////////////
//
//  USE SQL TO UPDATE THE DATABASE
//
////////////////////////////////////////////

$n = 0;

for($n=0; $n < $number_of_phrases; $n++)
{

	$sql =
	"SELECT id FROM flashcards_of_members WHERE member = '".$member."' AND language = '".$language."' AND dialogue_number = ".$dialogue_number." AND row_number = ".$tested_phrases_array[$n].";";


	$result = $db->query($sql);


	if($result->num_rows == 0)
	{

		$sql =
		"INSERT INTO flashcards_of_members (member,language,dialogue_number, row_number, next_quiz_date, quiz_interval) VALUES ('".$member."','".$language."',".$dialogue_number.",".$tested_phrases_array[$n].",'2000-01-01 12:00:00',0);";


		$db->query($sql);


	}
}

//close pdo connection
$sql = null;
$db = null;



header("location:lessons.php?dialogue=$dialogue_number");