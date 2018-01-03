<?php

///////////////////////////////////////////////////////////
//
//  INITIALIZE DIALOGUE VARIABLE
//
////////////////////////////////////////////////////////////




$grammar_lesson_number = 1;


// Set the $dialogue_number variable to the value passed through the URL.  If no value is set, use the default value =1 from above.
$grammar_lesson_number_try = $_GET["grammarlesson"];

if(isset($grammar_lesson_number_try))
{
	$grammar_lesson_number = $grammar_lesson_number_try;
}


// Appends a zero "0" before the dialogue number if it's less than 10.  For example, "5" => "05", etc.
if($grammar_lesson_number > 9)
{
	$grammar_lesson_index  = $grammar_lesson_number;
}

else
{
	$grammar_lesson_index  = "0".$grammar_lesson_number;
}



$texts_path	 = $_SERVER['DOCUMENT_ROOT']."/turkish/texts/";


$grammar_rules_path 	= $texts_path."GRAMMAR-rules".$grammar_lesson_index.".txt";

$grammar_examples_foreign_path = $texts_path."GRAMMAR-examples-turkish".$grammar_lesson_index.".txt";
$grammar_examples_english_path = $texts_path."GRAMMAR-examples-english".$grammar_lesson_index.".txt";




/////////////////////////////////////////////////////
//
//	GRAMMAR RULES (GRAMMARrules)
//
///////////////////////////////////////////////////////

$grammar_rules       = file_get_contents($grammar_rules_path,true);

////////////////////////////////////////////////////////
//
//	GRAMMAR EXAMPLES (GRAMMARexamples)
//
/////////////////////////////////////////////////////////

//$grammar_examples_foreign_path       = file_get_contents($grammar_examples_foreign_path,true);
//$grammar_examples_foreign_all = explode("\n", $grammar_examples_foreign_path);

//$grammar_examples_english_path       = file_get_contents($grammar_examples_english_path,true);
//$grammar_examples_english_all = explode("\n", $grammar_examples_english_path);
