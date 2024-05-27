<?php 

## Includes the header which connects the page to the rest of the website and offers current $_SESSION data.
include ('header.php'); 

## Checks to ensure that the request method is post and then builds an error array, checking through each input field to ensure a valid input is entered.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
	# Connects to the database.
	require ('connect_db.php');
	
	# Initialize an error array.
	$errors = array();
	
	# Check for contact name.
	if (empty( $_POST[ 'contact_name' ]))
	{$errors[] = 'Please enter your contact name!';}
	else
	{$contactName = mysqli_real_escape_string( $link, trim( $_POST[ 'contact_name' ] ) ) ; }
	
	# Check for email address.
	if (empty( $_POST[ 'email_address' ]))
	{$errors[] = 'Please enter your email address!';}
	else
	{ $emailAddress = mysqli_real_escape_string( $link, trim( $_POST[ 'email_address' ] ) ) ; }

	# Check for phone number.
	if (empty( $_POST[ 'phone_number' ]))
	{$errors[] = 'Please enter your phone number!';}
	else
	{ $phoneNumber = mysqli_real_escape_string( $link, trim( $_POST[ 'phone_number' ] ) ) ;}

	# Check for satisfaction rating - yes or no.
	if ( empty( $_POST[ 'satisfaction' ] ) )
	{$errors[] = 'Please enter your email address!' ;}
	else
	{ $userSatisfaction = mysqli_real_escape_string( $link, trim( $_POST[ 'satisfaction' ] ) ) ; }

	# Check for any feedback comments.
	if ( empty( $_POST[ 'comments' ] ) )
	{$errors[] = 'Please remember to leave a comment!' ;}
	else
	{ $userComments = mysqli_real_escape_string( $link, trim( $_POST[ 'comments' ] ) ) ; }
	
	# On success enters all the collected data into the database and notifies the user of successful registration.
	if ( empty( $errors ) ) 
	{
    $q = "INSERT INTO feedback (contact_name, email_address, phone_number, satisfaction, comments) 
	VALUES ('$contactName', '$emailAddress', '$phoneNumber', '$userSatisfaction', '$userComments')";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '<div class = "container">
			<div class = "alert alert-secondary" role = "alert">
			<h4 class = "alert-heading" Your feedback has successfully been submitted.</h4>
			<p>An administrator will be in touch with you soon!</p>
			<a class = "alert-link" href = "home.php">Return to the home page.</a>
			</div>
			</div>

			<p>Your feedback has been submitted!</p> 
			<a class="alert-link" href="home.php"</a>'; }
  
    # Closes the database connection.
    mysqli_close($link); 

    exit();
	}
   
	# In event of any problems, reports errors to the screen.
	else 
	{
    echo '<p>The following error(s) have occurred:</p>' ;
    foreach ( $errors as $msg )
    { echo "$msg<br>" ; }
    echo '</div>';
	
    # Close database connection.
    mysqli_close( $link );
	
	} 
}
?>

<!DOCTYPE html> 
<html lang="en"> 

<head> 
		<meta charset="UTF-8"> 
		<meta name="viewport" content="width=device-width,initial-scale=1.0"> 
		<title>Sustainability Feedback Page</title> 
	
		<link rel="stylesheet" href= 
		"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
		<link rel="stylesheet" href="feedback.css"> 
</head> 

<body> 
	<center>
		<h1>Sustainability Project — Contact Us.</h1> 
		<h4>Want to get in touch with an administrator? Send us a message here!</h4> 
		
		<br>
		<div class="form-box"> 
			<form method = "post"> 
				<label for="uname"> 
					<i class="fa fa-solid fa-user"></i> Contact Name
				</label> 
				<input type="text" name="contact_name" required> 
				
				<label for="email"> 
				<i class="fa fa-solid fa-envelope"></i> Email Address 
				</label> 
				
				<input type="email" name="email_address" required> 
				
				<label for="phone"> 
				<i class="fa-solid fa-phone"></i> Phone Number 
				</label> 
				
				<input type="tel" name="phone_number" required> 
				
				<label> 	
				Are you satisfied with the sustainability project?
				</label> 
			
			<div class="radio-group"> 
				<input type="radio" id="yes" name="satisfaction" value="yes" checked> 
				<label for="yes">Yes</label> 

				<input type="radio" id="no" name="satisfaction" value="no"> 
				<label for="no">No</label> 
			</div> 

			<label for="msg"> 
				<i class="fa-solid fa-comments"
				style="margin-right: 3px;"></i> 
				Share any comments you have here: 
			</label> 
				<textarea name="comments" rows="4" cols="10" required></textarea> 
				
			<input class = "btn btn-secondary btn-lg btn-block" type = "submit" value = "Submit">
		</form> 
		</div> 
	</center>
</body> 
</html>
