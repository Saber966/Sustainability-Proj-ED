<?php
  include ('header.php');
  # Open database connection.
  require('connect_db.php');
  

if ( isset( $_GET['points'] ) && ( $_GET['points'] > 0 ) && (!empty($_SESSION['points']) ) )
{
  
  # Generate the 'total' cost by taking the amount of points purchased and multiplying them by 10.
  $cost = $_SESSION['points'] * 10;
  
  
  # Ticket reservation and points in 'bookings' database table.
  $q = "INSERT INTO bookings ( user_id, points, cost, booking_date ) VALUES (".$_SESSION['user_id'].", ".$_GET['points'].", ".$cost.", NOW())";
  $r = mysqli_query ($link, $q);
  
  # Retrieve current booking number.
  $booking_id = mysqli_insert_id($link) ;

	# Adding purchased points to the 'purchased' value back on the user profile.
	$totalPoints = $_SESSION['points'];
	$rubricQuery = "UPDATE rubric SET purchased = purchased + $totalPoints WHERE user_id = {$_SESSION['user_id']}";
	
	# Implement the changes.
	if(mysqli_query($link, $rubricQuery)) 
	{
    echo "Rubric table updated successfully!";
	} else 
	{
    echo "Error updating rubric table: " . mysqli_error($link);
	}

  # Display order number.
	echo '<center>
	<div class="container">
	<div class="alert alert-dark" alert-dismissible fade show" role="alert">
	<h3><center>Thank you for your purchase! A reminder has been sent to your e-mail.</center></h3>
	</div>';

}
# Or display a message.
else { echo 'Something went wrong.' ; }

# Retrieve items from 'bookings' database table.
$q = "SELECT * FROM bookings WHERE user_id = {$_SESSION['user_id']} ORDER BY booking_date DESC LIMIT 1";
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
  
  echo '
	  <div class="col-md-8">
	    <div class="card-body">  ';

  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
    echo '<center>Booking Reference:  #' . $booking_id . ' 
		 <br>Points purchased: '. $_SESSION['points'] . '
		 <br>Total Paid:   £ '. $_SESSION['points'] * 10 . ' 
		 <br><small>' . $row['booking_date'] . '</small><hr>
		 If you have any questions or complaints or would like to request a refund, do not hesitate to contact us!</center>
	</div></div></div></center>';
  }
	
# Remove previously purchased points.  
  $_SESSION['points'] = NULL ;
  
  # Close database connection.
  mysqli_close( $link ) ; 
}
?>