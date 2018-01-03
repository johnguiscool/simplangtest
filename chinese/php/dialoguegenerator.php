<?php

///////////////////////////////////////////////////////////
//
//  INITIALIZE DIALOGUE VARIABLE
//
////////////////////////////////////////////////////////////




$dialogue_number = 1;

// Set the $dialogue_number variable to the value passed through the URL.  If no value is set, use the default value =1 from above.
$dialogue_number_try = $_GET["dialogue"];

if(isset($dialogue_number_try))
{
	$dialogue_number = $dialogue_number_try;
}


$dialogue_next   = $dialogue_number + 1;


// Appends a zero "0" before the dialogue number if it's less than 10.  For example, "5" => "05", etc.
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



$audio_path	 = "audio/dialogue-cn-".$dialogue_index;
$pics_path	 = "img/".$dialogue_index.".png";
$texts_path	 = $_SERVER['DOCUMENT_ROOT']."/chinese/texts/";


$english_path      =$texts_path."englishphrases".$dialogue_index.".txt";
$french_path    =$texts_path."chinesephrases".$dialogue_index.".txt";
$speaker_path      =$texts_path."speaker".$dialogue_index.".txt";
$grammar_path 	= $texts_path."grammarexplanation".$dialogue_index.".txt";

$transliteration_path = $texts_path."chinesephrasesraw".$dialogue_index.".txt";


//$literal_path = $texts_path."literaldefinitions".$dialogue_index.".txt";



/////////////////////////////////////////////////////
//
//	ENGLISH
//
///////////////////////////////////////////////////////

$phrases_english       = file_get_contents($english_path,true);
$phrases_english_total = explode("\n", $phrases_english);


////////////////////////////////////////////////////////
//
//	FRENCH
//
/////////////////////////////////////////////////////////

$phrases_french       = file_get_contents($french_path,true);
$phrases_french_total = explode("\n", $phrases_french);


/////////////////////////////////////////////////////
//
//	SPEAKER
//
///////////////////////////////////////////////////////

$speaker         = file_get_contents($speaker_path,true);
$speaker_total = explode("\n", $speaker);



/////////////////////////////////////////////////////
//
//	GRAMMAR
//
///////////////////////////////////////////////////////

if (file_exists($grammar_path)) {
    $grammar         = file_get_contents($grammar_path,true);
}
else {
	$grammar ="<i>No grammar notes for this lesson.</i>";
}


/////////////////////////////////////////////////////
//
//	LITERAL DEFINITIONS
//
///////////////////////////////////////////////////////

//$literal         = file_get_contents($literal_path,true);
//$phrases_literal_definitions_total = explode("\n", $literal);


//////////////////////////////////////////////////////
//
//  TRANSLITERATION
//
//////////////////////////////////////////////////////


//Transliteration of the dialogue table text

$phrases_french_transliterated = file_get_contents($transliteration_path,true);
$phrases_french_transliterated_total = explode("\n", $phrases_french_transliterated);