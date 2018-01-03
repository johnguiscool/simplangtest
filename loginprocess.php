<?php

// STEP 1 //
// Check that the username posted is formatted correctly
// If so, set username variable to posted username
// If not, return to login page with error


if (ctype_alnum ( $_POST['username']) && !empty($_POST['username']) ) 
{
	$user_submitted_username = $_POST['username'];
}
else
{
	//error = 1 means "username not found / user not found"
	header("location:login.php?error=1");
}

// STEP 2
// Establish database connection 
// (this creates the $db PDO connection variable)
include  $_SERVER['DOCUMENT_ROOT']."/php/database.php";


// STEP 3
// Search for submitted username in database.  If no such username is found, return with error to login page.

// SQL statements first
$sql = $db->prepare("SELECT * from members WHERE username = ?");

$sql -> bindParam(1, $user_submitted_username,PDO::PARAM_STR);

$sql -> execute();

$result = $sql -> fetch(PDO::FETCH_ASSOC);

//close pdo connection
$sql = null; 
$pdo = null;


// Check that the username result is empty or not
// If empty, then return to login screen with error.

if(empty($result))
{	
	//error = 2 means "username not found"
	header("location:login.php?error=2");
	
	die();
}

// STEP 4: hash user-submitted password

$user_submitted_password = $_POST['password'];

// STEP 5: pull password associated with username.
$database_password = $result['password'];




// STEP 6:  If passwords match do not match, then return to login with error.  If passwords do match then success.

if(!(password_verify($user_submitted_password, $database_password)))
{
	header("location:login.php?error=3");
	die();
}

else{
	

	session_start();
	$_SESSION['username'] = $user_submitted_username;
	$_SESSION['vocab_table'] = $result['vocabulary_table'];
	header("location:welcome.php");
	die();
}