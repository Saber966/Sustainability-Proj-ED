<?php
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

  # Check for their e-mail address.
  if ( empty( $_POST[ 'emailForgot' ] ) )
  { $errors[] = 'Please enter your email address.' ; }
  else
  { $email = mysqli_real_escape_string( $link, trim( $_POST[ 'emailForgot' ] ) ) ; }

  # Check for password and ensure both pass1 & pass2 inputs are identical.
  if (empty( $_POST[ 'passwordOne' ] ) )
  { $errors[] = 'Enter your password.' ; }
  elseif ( $_POST[ 'passwordOne' ] != $_POST[ 'passwordTwo' ] )
	{ $errors[] = 'Passwords do not match!' ; }
  else
	{ $password = mysqli_real_escape_string( $link, trim( $_POST[ 'passwordOne' ] ) ) ; }

 
 if ( empty( $errors ) ) 
  {

	# Update their password and replace the old data stored in the database.
    $q = "UPDATE users SET pass = SHA2('$password',256) WHERE email = '$email'";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    {
       header("Location: login.php");
	   exit();
    }   
	
	else 
  {
    echo '<p>The following error(s) occurred:</p>' ;
    foreach ( $errors as $msg )
    { echo "$msg<br>" ; }
    echo '</div>';
	
    # Close database connection.
    mysqli_close( $link );
	
  }  
    
  
    # Close database connection.
    
	mysqli_close($link); 
    exit();
  }
  # Or report errors.
  

}

?>

