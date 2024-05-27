<?php 
	ini_set('display_errors','1');
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 

  # Initialize an error array.
  $errors = array();

  # Check for company name.
  if ( empty( $_POST[ 'company_name' ] ) )
  { $errors[] = 'Please enter your company name.' ; }
  else
  { $cn = mysqli_real_escape_string( $link, trim( $_POST[ 'company_name' ] ) ) ; }
  
  # Check for a contact person's details.
  if ( empty( $_POST[ 'contact_person' ] ) )
  { $errors[] = 'Enter the name of your company contact.' ; }
  else
  { $cp = mysqli_real_escape_string( $link, trim( $_POST[ 'contact_person' ] ) ) ; }

  # Check for email.
  if (empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email.' ; }
  else
  { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }

  # Check for password and ensure both pass1 & pass2 inputs are identical.
  if (empty( $_POST[ 'pass1' ] ) )
  { $errors[] = 'Enter your password.' ; }
  elseif ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
	{ $errors[] = 'Passwords do not match!' ; }
  else
	{ $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pass1' ] ) ) ; }
	
  # Check for an existing email.
  if ( empty( $errors ) )
  {
	  $q = "SELECT user_id FROM users WHERE email='$e'" ;
	  $r = @mysqli_query ( $link, $q ) ;
	  if (mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. Sign into your account now.' ;
  }
  
  # Check for a card number.
  if (empty( $_POST[ 'card_number' ] ) )
  { $errors[] = 'Enter your card number.' ; }
	else
	{ $card_number = mysqli_real_escape_string( $link, trim( $_POST[ 'card_number' ] ) ) ; }

  # Check for expiry month.
  if (empty( $_POST[ 'exp_month' ] ) )
  { $errors[] = 'Enter your card expiry month.' ; }
	else
	{ $exp_m = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_month' ] ) ) ; }

  # Check for expiry year.
  if (empty( $_POST[ 'exp_year' ] ) )
  { $errors[] = 'Enter your card expiry year.' ; }
	else
	{ $exp_y = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_year' ] ) ) ; }

  # Check for expiry month.
  if (empty( $_POST[ 'cvv' ] ) )
  { $errors[] = 'Enter your three security digits.' ; }
	else
	{ $cvv = mysqli_real_escape_string( $link, trim( $_POST[ 'cvv' ] ) ) ; }
  
   # On success enter all the collected data into the database and notify the user of successful registration.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (company_name, contact_person, email, pass, card_number, exp_month, exp_year, cvv, reg_date) 
	VALUES ('$cn', '$cp', '$e', SHA2('$p', 256), $card_number, $exp_m, $exp_y, $cvv, NOW() )";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '<div class = "container">
			<div class = "alert alert-secondary" role = "alert">
			<h4 class = "alert-heading" Registration Complete.</h4>
			<p>You have successfully registered!</p>
			<a class = "alert-link" href = "login.php">Log-In.</a>
			</div>
			</div>

			<p>Your account has been registered!</p> 
			<a class="alert-link" href="login.php"</a>'; }
  
    # Close database connection.
    mysqli_close($link); 

    exit();
  }
   
  # In the event any problems are encountered, report any errors to the screen.
  else 
  {
    echo '<p>The following error(s) occurred:</p>' ;
    foreach ( $errors as $msg )
    { echo "$msg<br>" ; }
    echo '</div>';
	
    # Close database connection.
    mysqli_close( $link );
	
  }  
}
?>

<!doctype html>
<html lang="en">
  <head>
  
	<!-- Meta tags. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Bootstrap. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
	<!-- Page title. -->
    <title>ediSustainability!</title>
	</head>
	
	<body>
	<!-- The 'ediSustainability' bar. -->
	<nav class="navbar navbar-expand-lg bg-light">
	<div class="container-fluid">
    <a class="navbar-brand" href="index.html">ediSustainability</a>
	</div>
	</nav>
	<br>
	
	<div class = "container">
	<!-- Opens container. -->
		<div class = "row">
			<div class = "col-sm">
				<div class = "card bg-light mb-3">
				<div class = "card-header"><center>Create A New Account</center></div>
				<div class = "card-body">
					<form class = "was-validated" action = "register.php" method = "post">
						<div class = "input-group">
						<input type = "text" name = "company_name" class = "form-control" placeholder = "Enter your company's name!" value = "" required>
						<input type = "text" name = "contact_person" class = "form-control" placeholder = "Enter your contact person's name!" value = "" required>
						</div>
						
						<br>
						
						<div class = "form-group">
						<input type = "email" name = "email" class = "form-control" placeholder = "Email" value = "" required>
						<small id = "emailHelp" class = "form-text text-muted">Your e-mail will never be shared without your consent.</small>
						</div>
						
						<br>
						
						<div class = "form-group">
						<input type = "password" name = "pass1" class = "form-control" placeholder = "Create New Password!" value = "" required>
						</div>
						
						<br>
						
						<div class = "form-group">
						<input type = "password" name = "pass2" class = "form-control" placeholder = "Confirm Your Password!" value = "" required>
						</div>
					<br>

				</div>
				</div>
			</div>
		</div>
		
		<div class = "col-sm">
<div class = "card bg-light mb-3">
	<div class = "card-header"><center>Add Payment Method</center></div>
	<div class = "card-body">
	<div class = "form-group">
	<input class = "form-control" type = "text" name = "card_number" placeholder = "Card Number." value = "" required = "">
	</div>
	<br>
<div class = "input-group">
	<div class = "input-group-prepend">
	<span class = "input-group-text">Card Expiry Date: </span>
	</div>
	<input class = "form-control" type = "text" name = "exp_month" placeholder = "MM" value = "" required = "">
	<input class = "form-control" type = "text" name = "exp_year" placeholder = "YY" value = "" required = "">
</div>
<br>
	<div class = "form-group">
	<input class = "form-control" type = "text" name = "cvv" placeholder = "Enter security code!" value = "" required = "">
</div>
<br>
<center><input class = "btn btn-secondary btn-lg btn-block" type = "submit" value = "Submit"></center>
</div>
</div>
</div>

<!-- Closes container. -->
</div>
</form>	
</body>
	
</html>