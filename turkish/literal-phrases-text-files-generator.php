<?php

for ($dialogue_number = 1; $dialogue_number <= 23; $dialogue_number++)
{
	
	
	// Appends a zero "0" before the dialogue number if it's less than 10.  For example, "5" => "05", etc.
	if($dialogue_number > 9)
	{
		$dialogue_index  = $dialogue_number;
	}

	else 
	{
		$dialogue_index  = "0".$dialogue_number;
	}
	
	
	
	$texts_path	 = $_SERVER['DOCUMENT_ROOT']."/turkish/texts/";
	$french_path    =$texts_path."turkishphrases".$dialogue_index.".txt";

	$phrases_french       = file_get_contents($french_path,true);
	$phrases_french_total = explode("\n", $phrases_french);



	
	/////////////////////////////////////////////////////
	//
	//  WORD FOR WORD TRANSLATION
	//
	///////////////////////////////////////////////////////
			
			

	$phrases_literal_definitions_total = [];
			
	foreach ($phrases_french_total as $value) 
	{
		
		$sentence = "";
		
		$words_array = preg_split("/[,.;\[\]!?–«»� ]/",$value);

		
		
		foreach($words_array as $engword)
		{
		
			$sentence = $sentence ." " . english_definition($engword);
		}
		
		$phrases_literal_definitions_total[] = $sentence;
		
		   
	}


	$filename = 'literaldefinitions'.$dialogue_index.'.txt';
		
	$myfile = fopen($filename, "w");
		
	foreach ($phrases_literal_definitions_total as $row)
	{
		fwrite($myfile, ltrim($row)."\r\n");	
	}

	fclose($myfile);
}

function english_definition ($word)
	{

		// Establish database connection 
		// (this creates the $db PDO connection variable)
		 include  $_SERVER['DOCUMENT_ROOT']."/php/database.php";
		 
		 
		 $word = trim($word);
		 $word = strtolower($word);
		 
		// Check if there any phrases from this dialogue in the user's table
		$sql = 
		"SELECT english FROM DICTIONARYturkish WHERE turkish LIKE \"".$word."\" Turkish_CI_AS;";
		
	
		
		if ($db->query($sql)) 
		{ 	

		
			foreach( $db->query($sql) as $row)
			{
				
				//close pdo connection
				$sql = null; 
				$db = null;

				return $row["english"];
			}
		}
		
		return $word;
	}