<div class = "container">
<h1 class = "text-center">Collaborating Corporations:</h1>
<center>
<p>The following organisations are proud supporters of the sustainability principles and practices explored throughout the website and supported by key organisations such as UNESCO.</p>
<p>They are dedicated to achieving their yearly green goals by embracing efficient and effective environmentally friendly practices.</p>
</center>
<div class = "row">

<?php
	# Open database connection.
	require ( 'connect_db.php' ) ;
	
	# Retrieve organisations from the 'organisation' table.
	$q = "SELECT * FROM organisation" ;
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )
	{
		
	# Display body section.
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	{
	echo '
	
		<div class = "col-md-3 d-flex justify-content-center">
		<div class = "card" style = "width: 20 rem;">
		<div class = "card text-center">
		
			<img src= '.$row['img'].' alt = "Organisation" class = "img-thumbnail bg-secondary" style = "width: 600px; height: 200px;">
			'. $row['name'].'<hr>
	
			Location: '. $row['location'].'
			
		</div>
		</div>
		</div>
		';
	}
	# Close database connection.
	mysqli_close( $link) ; 
	}
	# Or display message.
	else { echo '

There are currently no organisations signed up to the project. Please come back soon!

	' ; }
?>