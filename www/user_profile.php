<?php
include ('header.php');

## Creates a space beneath the header until placement can be fixed with CSS>
echo '<br>';

## Opens database connection.
require ('connect_db.php');

## Obtain details from the 'users' table in the 'sustainability' database.
	$q = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}" ;
	$r = mysqli_query( $link, $q ) ;
			echo '<div class = "container">
			  <div class = "row">';
	if ( mysqli_num_rows( $r ) > 0 )
	{
			  
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {

	## Separates the registration date into specific numbers that can be called later on.
	$date= $row["reg_date"];
	$day = substr($date, 8,2);
	$month = substr($date, 5,2);
	$year = substr($date, 0,4);
	
    echo '
			
			<div class = "col-sm">
			<div class = "alert alert-dark" alert-dismissible fade show" role = "alert">
			</button>
	<h1>  '  . $row['company_name'] . ' '  . $row['contact_person'] . '</h1> 
	   User ID : '  . $row['user_id'] . ' 
	   <hr>
	   Email :  ' . $row['email'] . '
	   <hr>
	   Registration Date : ' . $day . '/' . $month . '/' . $year . '  
	   <hr>
	   
	   <button type = "button" class = "btn btn-secondary btn-block" data-toggle="modal" data-target="#details">
			<i class = "fa fa-edit"></i> Update Details
		</button>
		</div>
		</div>
	';
  }
	
  # Close database connection.
 
}
else { echo 'No user details.' ; }

# Obtaining details from the 'users' table in the 'sustainability' database for credit card details.
	$q = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}" ;
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )
	{

	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	{
	#Format register date 
	$cardNumber = $row["card_number"];
	$subcardNumber = substr($cardNumber,-4);
    echo '
			<div class = "col-sm">
			<div class = "alert alert-dark" alert-dismissible fade show" role = "alert">
	<h1> Card Stored </h1>
	   Card Holder: '  . $row['company_name'] . ' '  . $row['contact_person'] . '
	   <hr>
	   Card Number : **** **** **** '. $subcardNumber . ' </p>
	   <hr>
	   Expire Date : ' . $row['exp_month'] . '  ' . $row['exp_year'] . '
	   <hr>
	   <button type = "button" class = "btn btn-secondary btn-block" data-toggle="modal" data-target="#card">
			<i class = "fa fa-edit"></i> Update Card
		</button>
		</div>
	
	';
  }
}
else { echo 'No card details.' ; }

	echo '</div> </div>';

# Obtaining details from the 'users' table in the 'cinema_db' database for credit card details.
	$q = "SELECT * FROM rubric WHERE user_id = {$_SESSION['user_id']}" ;
	$r = mysqli_query( $link, $q ) ;
				echo '<div class = "container">
			  <div class = "row">';
			  


	if ( mysqli_num_rows( $r ) > 0 )
	{

	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	{
		
	## Calculates the grand total points earned through both results and purchased points.
	$totalResult = ($row['results'] + $row['purchased']);

	## Calculates whether the reward image will be a gold, silver, or bronze picture based on the score contained in the 'points' row.
	if($totalResult >= 70)
	{$imgSrc = "img/goldReward.png";}
	elseif ($totalResult >= 60)
	{$imgSrc = "img\silverReward.png";}
	elseif ($totalResult < 60)
	{$imgSrc = "img/bronzeReward.png";}

	## Calculates the resulting reward to be printed out in the user profile itself.
	if($totalResult >= 70)
	{$reward = "Gold!";}
	elseif ($totalResult >= 60)
	{$reward = "Silver!";}
	elseif ($totalResult < 60)
	{$reward = "Bronze!";}

	    echo '
			<div class = "alert alert-dark" alert-dismissible fade show" role = "alert">
			<h1><center> Sustainability Rubric Results </center></h1><hr>
			<div class = "row">
				<div class = "col-sm-2"> 
					<p>Emissions:</p>
					<p>Water Conservation:</p>
					<p>Sustainable Supply:</p>
					<p>Transportation Choices:</p>
					<p>Employee Sustainability:</p>
				</div>
				<div class = "col-sm-1">
					<p>'.$row['emissions'].' </p>
					<p>'.$row['water_cons'].'</p>
					<p>'.$row['sustain_supply'].'</p>
					<p>'.$row['transport_eco'].'</p>
					<p>'.$row['employee_edu'].'</p>
				</div>
				<div class = "col-sm-2"> 
					<p>Waste Reduction:</p>
					<p>Renewable Energy:</p>
					<p>Ecological Services:</p>
					<p>Ecosystems Compliance:</p>
					<p>Transparency & Reports:</p>
				</div>
				<div class = "col-sm-1">
					<p>'.$row['waste_redu'].'</p>
					<p>'.$row['renew_energy'].'<p>
					<p>'.$row['eco_services'].'</p>
					<p>'.$row['enviro_compl'].'</p>
					<p>'.$row['transparency'].'</p>
				</div>
				
				<div class = "col">
				<p><b>Rubric Results:</b> '.$row['results'].'.</p>
				<p><b>Purchased Points:</b> '.$row['purchased'].'.</p>
				<p><b>Total Result:</b> '.$totalResult.'.</p>
				<p><b>Reward Result: </b>'.$reward.'</p>
				<p><b>Gold Reward: </b>70 points or more. </p>
				<p><b>Silver Reward: </b>60 points or above.</p>
				<p><b>Bronze Reward: </b>Beneath 60 points.</p>
				</div>
				<div class = "col">
				<img src = '.$imgSrc.' alt = "A picture of a reward." width = "175" height = "175">
				</div>

			<br>

	   <button type = "button" class = "btn btn-secondary btn-block" data-toggle="modal" data-target="#deleteRubric">
			<i class = "fa fa-edit"></i> Delete Rubric Results
		</button>
		</div>
		</div>
		</div></div>
	';
	
  }
	
}
else { echo 'You currently do not have any rubric stats to share. Please head over to the Sustainability Rubric page as soon as possible.' ; }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>

<!-- Modal 1 — Credit Card details pop-up. -->
<div class="modal fade" id="card" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update your credit card details.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body">
		<form action="update_card.php" class="was-validated" method="post">
			<div class="form-group">
				<label for = "card_number">Card Number:</label>
				<input type="text" name = "card_number" value = "<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>" required>
			</div>
			<div class="form-group">
				<label for = "exp_month">Exp Month:</label>
				<input type="text" name = "exp_month" value = "<?php if (isset($_POST['exp_month'])) echo $_POST['exp_month']; ?>" required>
			</div>
			<div class="form-group">
				<label for = "exp_year">Exp Year:</label>
				<input type="text" name = "exp_year" value = "<?php if (isset($_POST['exp_year'])) echo $_POST['exp_year']; ?>" required>
			</div>
			<div class="form-group">
				<label for = "cvv">CVV:</label>
				<input type="text" name = "cvv" value = "<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>" required>
			</div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-secondary btn-lg btn-block" value="Update" >
		</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 — User Profile pop-up. -->
<div class="modal fade" id="details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update your user details.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
		<form action="update_user.php" class="was-validated" method="post">
			<div class="form-group">
				<label for = "company_name">Company Name:</label>
				<input type="text" name = "company_name" value = "<?php if (isset($_POST['company_name'])) echo $_POST['company_name']; ?>" required>
			</div>
			<div class="form-group">
				<label for = "contact_person">Contact Person:</label>
				<input type="text" name = "contact_person" value = "<?php if (isset($_POST['contact_person'])) echo $_POST['contact_person']; ?>" required>
			</div>
			<div class="form-group">
				<label for = "exp_year">Email:</label>
				<input type="text" name = "email" value = "<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required>
			</div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-secondary btn-lg btn-block" value="Update" >
		</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal 3 — Delete Rubric pop-up. -->
<div class="modal fade" id="deleteRubric" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deleting your rubric results.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form method = "post" action = "delete_rubric.php">
			<div class="form-group">
				<label>Are you sure you wish to delete your rubric results? The result will be permanent.</label>
			</div>
			<div class="form-group">
				<label>Please make sure to use the sustainability rubric again.</label>
			</div>
			<div class="form-group">

			</div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-secondary btn-lg btn-block" value="Delete" name = "delete_rubric">
		</form>
      </div>
    </div>
  </div>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>