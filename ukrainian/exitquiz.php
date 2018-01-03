<?php

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

 
 //////////////////////////////////////
//
//   GET CURRENT TIME
//
//////////////////////////////////////

$current_time = date('Y-m-d G:i:s');



/////////////////////////////////////////
//
//   GET PARAMETERS
//
////////////////////////////////////////////

$dialogues_to_update = $_POST['exit_quiz_parameters'];
$dialogues_to_reset  = $_POST['exit_quiz_parameters_forgotten'];
$quiz_language		 = $_POST['exit_quiz_language'];


//////////////////////////////////////////////////////////
//
//  FIRST LOOP
//
//  UPDATE THE VOCAB PHRASES THAT THE USER GOT CORRECT
//  INCREASE THE QUIZ INTERVAL BY ONE
//  UPDATE THE NEXT QUIZ DATE FIELD
//
//////////////////////////////////////////////////////////

///////////////////////
//                   //
// loop starts here  //
//                   //
///////////////////////


$loop_length = strlen($dialogues_to_update) / 2;

$n =0;

while($n<$loop_length)
{
	
	// Step 1 Get the right dialogue and row number to update from the POST variables
	
	$dialogue_number_passed = $dialogues_to_update[0].$dialogues_to_update[1];
	$dialogue_number_passed = intval($dialogue_number_passed);
	
	$row_number_passed = $dialogues_to_update[2].$dialogues_to_update[3];
	$row_number_passed = intval($row_number_passed);
	
	
	
	// Step 2 Pull the interval length with SQL
	
	$sql = "SELECT * FROM flashcards_of_members WHERE member ='$member' AND dialogue_number = ".$dialogue_number_passed." AND row_number = ".$row_number_passed." AND language = '".$quiz_language."';";
		
	foreach ($db->query($sql) as $row)
	
	{
		$old_interval = $row["quiz_interval"];
		$old_interval = (int) $old_interval;
    }
  
	
	
	$new_interval = $old_interval + 1;

	
	
	// Step 3 Updates the table of the user.  (The name of the table is [username] ).
	//        First update the quiz_interval length, this is the time until the next testing
	$sql = "UPDATE flashcards_of_members SET quiz_interval = ".$new_interval." WHERE member = '$member' AND dialogue_number = ".$dialogue_number_passed." AND row_number = ".$row_number_passed." AND language = '".$quiz_language."';";
		
	$resultb = $db->query($sql);
	
	
	// Step 4 Then update the TIMESTAMP field
	
	$next_quiz_date = strtotime("now");
	$next_quiz_date = $next_quiz_date + 86400 * (2 ** $old_interval);
	
	$mysqldate = date( 'Y-m-d H:i:s', $next_quiz_date);
	
	$next_quiz_date = date("Y-m-d h:i:sa",$next_quiz_date);
	
	$sql = "UPDATE flashcards_of_members SET next_quiz_date = '".$mysqldate."' WHERE member = '$member' AND dialogue_number = ".$dialogue_number_passed." AND row_number = ".$row_number_passed." AND language ='".$quiz_language."';";
	

	
	$resultc = $db->query($sql);
	
	
	// Step 5 Chop down string
	$dialogues_to_update = substr($dialogues_to_update,4);
	$n = $n+1;
        
}

////////////////////
///loop ends here
///////////////////




////////////////////////////////////////////////////////
//
//  SECOND LOOP
//
//  UPDATE THE VOCAB PHRASES THAT THE USER GOT WRONG
//  SET THE QUIZ TESTING INTERVAL TO ONE
//  UPDATE THE NEXT QUIZ DATE FIELD TO TOMORROW
//
////////////////////////////////////////////////////////

////////////////////////
//                    //
// loop starts here   //
//                    //
////////////////////////

$loop_length = strlen($dialogues_to_reset) / 2;

$n = 0;

while ($n < $loop_length)
{

	// Step 1:  Get the right dialogue and row number to update from the POST variables
	
	$dialogue_number_passed = $dialogues_to_reset[0].$dialogues_to_reset[1];
	$dialogue_number_passed = intval($dialogue_number_passed);

	$row_number_passed = $dialogues_to_reset[2].$dialogues_to_reset[3];
	$row_number_passed = intval($row_number_passed);



	// Step 2:  Update the table of the user.  Set the quiz interval length to zero.

	$zero = 0;
	$sql = "UPDATE flashcards_of_members SET quiz_interval = ".$zero." WHERE member = '$member' AND dialogue_number = ".$dialogue_number_passed." AND row_number = ".$row_number_passed." AND language = '".$quiz_language."';";
	$resultd = $db->query($sql);
	

	// Step 3:  Update the "next_quiz_date" field
	
	$next_quiz_date = strtotime("now");
	$next_quiz_date = $next_quiz_date + 86400;

	$mysqldate = date( 'Y-m-d H:i:s', $next_quiz_date);

	
	$sql = "UPDATE flashcards_of_members SET next_quiz_date = '".$mysqldate."' WHERE member = '$member' AND dialogue_number = ".$dialogue_number_passed." AND row_number = ".$row_number_passed." AND language = '".$quiz_language."';";

	$resulte = $db->query($sql);


	// Step 4: Chop down string
	
	$dialogues_to_reset = substr($dialogues_to_reset,4);
	$n = $n + 1;

}

header("location:lessons.php");