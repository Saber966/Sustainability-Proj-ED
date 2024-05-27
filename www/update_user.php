<?php
## Includes the header.php file so the update process can access the user_id stored in the session data.
include ('header.php');

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

  # Check for a company name.
  if ( empty( $_POST[ 'company_name' ] ) )
  { $errors[] = 'Update your company name.' ; }
  else
  { $cn = mysqli_real_escape_string( $link, trim( $_POST[ 'company_name' ] ) ) ; }

  # Check for a contact person's name.
  if ( empty( $_POST[ 'contact_person' ] ) )
  { $errors[] = 'Update your contact name.' ; }
  else
  { $cp = mysqli_real_escape_string( $link, trim( $_POST[ 'contact_person' ] ) ) ; }

  # Check for a email.
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Update your email.' ; }
  else
  { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }
  
 if ( empty( $errors ) ) 
  {
	## Acquire the user's ID from the current active session.
	$user_id = $_SESSION['user_id'];
	  
	# Update the relevant user information only for the currently active user making the change.
    $q = "UPDATE users SET company_name = '$cn', contact_person = '$cp', email = '$e' WHERE user_id = $user_id";
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