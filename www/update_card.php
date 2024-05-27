<?php

## Includes the header.php file so the update process can access the user_id stored in the session data.
include ('header.php');

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

# Check for a card number.
  if ( empty( $_POST[ 'card_number' ] ) )
  { $errors[] = 'Update your card number.' ; }
  else
  { $cn = mysqli_real_escape_string( $link, trim( $_POST[ 'card_number' ] ) ) ; }

# Check for an expiary month.
  if ( empty( $_POST[ 'exp_month' ] ) )
  { $errors[] = 'Update your expiary month.' ; }
  else
  { $exm = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_month' ] ) ) ; }

# Check for an expiary year.
  if ( empty( $_POST[ 'exp_year' ] ) )
  { $errors[] = 'Update your expiary year.' ; }
  else
  { $exy = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_year' ] ) ) ; }

# Check for a cvv.
  if ( empty( $_POST[ 'cvv' ] ) )
  { $errors[] = 'Update your cvv.' ; }
  else
  { $cvv = mysqli_real_escape_string( $link, trim( $_POST[ 'cvv' ] ) ) ; }
  
 if ( empty( $errors ) ) 
  {
	## Acquire the user's ID from the current active session.
	$user_id = $_SESSION['user_id'];
	
	# Update the relevant user information only for the currently active user making the change.
    $q = "UPDATE users SET card_number = '$cn', exp_month = '$exm', exp_year = '$exy', cvv = '$cvv' WHERE user_id = $user_id";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    {
       header("Location: user_profile.php");
    } else {
        echo "Error updating record: " . $link->error;
    }
    
    # Close database connection.
	mysqli_close($link); 
	
    exit();
  }
  # Or report errors.
  else 
  {  
    echo ' 
	';
    # Close database connection.
    mysqli_close( $link );
  } 
  

}