<?php

$page_title = 'Booking';

## Links to the header at the top of the page.
include ('header.php');

## Opens database connection.
require ('connect_db.php');

	## Queries all the relevant bookings stored in the booking table that are related to the user with an active session.
	$q = "SELECT * FROM bookings WHERE user_id = {$_SESSION['user_id']}" ;
	$r = mysqli_query( $link, $q ) ;
	
	## Checks to ensure the number of rows stored in the database is greater than zero. If so, the code executes. Otherwise, an error message will inform the user that there are no currently stored bookings.
	if ( mysqli_num_rows( $r ) > 0 )
	{
		
		## Creates a container and row outside of the 'while' statement to prevent these two div classes from being repeatedly created and ruining alignment.
		echo '<div class = "container">
			  <div class = "row">';
			  
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
	#Format register date 
	$date= $row ["booking_date"];
	$day = substr($date, 8,2);
	$month = substr($date, 5,2);
	$year = substr($date, 0,4);
	
    echo '
			<div class = "col-md">
			<div class = "alert alert-dark" alert-dismissible fade show" role = "alert">
			<center>
	<h4>Booking '.$row['booking_id'].':</h4> 
	   User ID: ' .$row['user_id'].' 
	   <br>Date Booked: 
	   <br>'.$day.' - '.$month.' - '.$year.'  
	   <br>Points Purchased: '.$row['points'].'
	   <hr>
	   Total Cost: £'.$row['cost'].'
		</div>
		</div>
		</center>
	';
  }
  }
    # Informs the user that no purchases of green points have been made and directs them back to the main page.
else { echo 'No green point purchases have currently been made. Please head on over to the "User Profile" section or purchase them directly through the checkout system!' ; }


?>