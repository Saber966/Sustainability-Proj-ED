<?php
## Includes the header.php file so the update process can access the user_id stored in the session data.
include ('header.php');

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
	## Acquire the user's ID from the current active session.
	$user_id = $_SESSION['user_id'];
	echo "User ID: " . $_SESSION['user_id'];
	  
	# Update the relevant user information only for the currently active user making the change.
    $q = "DELETE FROM rubric WHERE user_id = $user_id";
    $r = mysqli_query ( $link, $q ) ;
	
	if (!$r) {
    die("Error deleting record: " . mysqli_error($link));
	}
    
  
    # Close database connection.
    
	mysqli_close($link); 
	
	# Redirect the user back to the user profile.
	header("Location: user_profile.php");
	exit();
  }




?>