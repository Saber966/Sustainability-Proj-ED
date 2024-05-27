<?php
	include ('header.php');
	
	# Initialize grand total variable.
	$total = 0; 

	
	# Open database connection.
	require ('connect_db.php');

	# Initialize the points variable to prevent any errors arising when there is no amount of points selected.
	if (!isset($_SESSION['points'])) {
    $_SESSION['points'] = 0;
}
	if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ; 

	# Display body section using a form and table.
	  echo '<div class = "container">
			<div class = "row">
			<div class = "col-sm">
				<div class = "card bg-light mb-3">
				<div class = "card-header">
					<h5 class = "card-title">Shopping Cart</h5>
				</div>
				<div class = "card-body">
	  ';
	  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
        if (isset($_POST['points'])) {
            // Store the entered points value in a session variable
            $_SESSION['points'] = $_POST['points'];
        }
    }

    // Calculating the total cost based on the number of points being purchased by the user. Each point will cost £10.
    $total = $_SESSION['points'] * 10; 


    # Display the row/s and allow for the user to enter their required number of points and update it.
    echo " <ul class = \"list-group list-group-flush\">
				<li class = \"list-group-item\">
				<div class = \"form-group row\">
				<label for = \"movie_title\" class = \"col-sm-12 col-form-label\">Bronze Threshold: 50.</label>
				</div>
				</li>
				
				<li class = \"list-group-item\">
				<div class = \"form-group row\">
				<label for = \"show time\" class = \"col-sm-12 col-form-label\">Silver Threshold: 60.</label>
				</div>
				</li>
				
				<li class = \"list-group-item\">
				<div class = \"form-group row\">
				<label for = \"show time\" class = \"col-sm-12 col-form-label\">Gold Threshold: 70.</label>
				</div>
				</li>
				
				<li class = \"list-group-item\">
				<div class = \"form-group row\">
				<label for = \"show time\" class = \"col-sm-12 col-form-label\">A single point costs £10.</label>
				</div>
				</li>
			   </ul>
	
			   <br>
					<form action=\"\" method=\"post\">
					<p>How many points do you wish to purchase?</p>
					<div class =\"input-group mb-3\">
						<input type=\"text\" class=\"form-control\" name=\"points\" value=\"{$_SESSION['points']}\" aria-label=\"Recipient's username\" aria-describedby=\"basic-addon2\">
					<div class =\"input-group-append\">
						<input type=\"submit\" name=\"submit\" class = \"btn btn-secondary\" value=\"Update\">
					</div>
					</div>
					</form>";

   # Display the total.
  echo '<ul class = "list-group list-group-flush">
				<li class = "list-group-item">
				<div class = "form-group row">
				<label for = "Total" class = "col-sm-12 col-form-label">Payment required: &pound '.number_format($total,2).'</label>
				</div>
				</li>
				
				<li class = "list-group-item">
				
				<a href = "checkout.php?points='.$_SESSION['points'].'"><center><button type = "button" class = "btn btn-secondary">Checkout!</button></center></a>
				</li>
				</ul>
				</form>
				</div>
				</div>
				</div>
				</div>
				</div>
	   ';

?>