<?php 

// STEP 0
// Check that the email posted is formatted correctly
// If so, set email variable to posted email
// If not, return to login page with error
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['email']))
{
	$user_submitted_email = $_POST['email'];
}

else
{
	//error = 2 means "improperly formatted email"
	header("location:register.php?error=2");
	die();
}


// Check that the submitted username is alphanumeric
if (ctype_alnum ( $_POST['username']) && !empty($_POST['username']))
{
	$user_submitted_username = $_POST['username'];
}
else
{
	//error = 3 means "improperly formatted username"
	header("location:register.php?error=3");
	die();
}


// Step 1
// Establish database connection 
// (this creates the $db PDO connection variable)
include  $_SERVER['DOCUMENT_ROOT']."/php/database.php";


// STEP 2
// Search for submitted email in database.  If an such email is found, return with error to registration page.
// SQL statements first
$sql = $db->prepare("SELECT * from members WHERE email = ?");

$sql -> bindParam(1, $user_submitted_email,PDO::PARAM_STR);

$sql -> execute();

$result = $sql -> fetch(PDO::FETCH_ASSOC);

if(!empty($result))
{
	//error = 1 means "email already in use"
	header("location:register.php?error=1");
	die();
}

// Search for submitted username in database.  If an such username is found, return with error to registration page.
$sql = $db->prepare("SELECT * from members WHERE username = ?");

$sql -> bindParam(1, $user_submitted_username,PDO::PARAM_STR);

$sql -> execute();

$result_two = $sql -> fetch(PDO::FETCH_ASSOC);

if(!empty($result_two))
{
	//error = 4 means "username already in use"
	header("location:register.php?error=4");
	die();
}



// STEP 3
// Create (dumb) Table name

$tablename = "TABLE".$user_submitted_username;


// STEP 4
// Hash the user submitted password

$user_submitted_password = $_POST['password'];
$hashed_user_submitted_password = password_hash($user_submitted_password, PASSWORD_DEFAULT);




// Step 5
// Run the query to insert the new user into the members table


		$query = "INSERT INTO members (email, password,salt,vocabulary_table,username) VALUES (?, ?, ?,?,?)";
		$sql = $db->prepare($query);
		
		$sql->bindValue(1,	$user_submitted_email,		PDO::PARAM_STR);
		$sql->bindValue(2,$hashed_user_submitted_password,	PDO::PARAM_STR);
		$sql->bindValue(3,	$hashed_user_submitted_password,	PDO::PARAM_STR);

		$sql->bindValue(4,	$tablename,	PDO::PARAM_STR);
		$sql->bindValue(5,	$user_submitted_username,	PDO::PARAM_STR);

		if($sql->execute())
		{
			
			//Create table for new user
			$sql = "CREATE TABLE " . $tablename . " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, language VARCHAR(255), dialogue_number INT(6), row_number INT(6),	next_quiz_date TIMESTAMP, quiz_interval INT(6));";
		 	$db->query($sql);
			
			
			//close pdo connection
			$sql = null; 
			$pdo = null;
			
			session_start();
			
			$_SESSION['username'] = $user_submitted_username;

			header("location:welcome.php?status=registered");
			die();
		}
		else
		{	
			//close pdo connection
			$sql = null; 
			$pdo = null;

			header("location:register.php?error=5");
			die();
		}
		
/*====================
  SUMMARY OF ERRORS
  ====================
  1) Email already in use.
  2) Improperly formatted user submitted email.  Possibly empty or not recognized as an email address.
  3) Improperly formatted user name.  Either not alphanumeric or empty.
  4) Username already in use.
  5) There was an error in the database set up.*/