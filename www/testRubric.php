<?php 
include ('header.php');

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
  $emission = $_POST['emissions'];
  switch($emission) {
	  case 'poor':
			$emission = 0;
			break;
	  case 'decent':
			$emission = 5;
			break;
	  case 'good':
			$emission = 10;
			break;
	  default: 
	        $emission = "Invalid operator.";
  }
  
  # Check for company name.
  $waste = $_POST['waste_redu'];
  switch($waste) {
	  case 'poor':
			$waste = 0;
			break;
	  case 'decent':
			$waste = 5;
			break;
	  case 'good':
			$waste = 10;
			break;
	  default: 
	        $waste = "Invalid operator.";
  }
			
  # Check for company name.
  $water = $_POST['water_cons'];
  switch($water) {
	  case 'poor':
			$water = 0;
			break;
	  case 'decent':
			$water = 5;
			break;
	  case 'good':
			$water = 10;
			break;
	  default: 
	        $water = "Invalid operator.";
  }
  
  $renew = $_POST['renew_energy'];
  switch($renew) {
	  case 'poor':
			$renew = 0;
			break;
	  case 'decent':
			$renew = 5;
			break;
	  case 'good':
			$renew = 10;
			break;
	  default: 
	        $renew = "Invalid operator.";
  }
  
    $sustain = $_POST['sustain_supply'];
  switch($sustain) {
	  case 'poor':
			$sustain = 0;
			break;
	  case 'decent':
			$sustain = 5;
			break;
	  case 'good':
			$sustain = 10;
			break;
	  default: 
	        $sustain = "Invalid operator.";
  }
  
    $services = $_POST['eco_services'];
  switch($services) {
	  case 'poor':
			$services = 0;
			break;
	  case 'decent':
			$services = 5;
			break;
	  case 'good':
			$services = 10;
			break;
	  default: 
	        $services = "Invalid operator.";
  }
  
    $transport = $_POST['transport_eco'];
  switch($transport) {
	  case 'poor':
			$transport = 0;
			break;
	  case 'decent':
			$transport = 5;
			break;
	  case 'good':
			$transport = 10;
			break;
	  default: 
	        $transport = "Invalid operator.";
  }
  
    $enviro = $_POST['enviro_compl'];
  switch($enviro) {
	  case 'poor':
			$enviro = 0;
			break;
	  case 'decent':
			$enviro = 5;
			break;
	  case 'good':
			$enviro = 10;
			break;
	  default: 
	        $enviro = "Invalid operator.";
  }
  
    $employee = $_POST['employee_edu'];
  switch($employee) {
	  case 'poor':
			$employee = 0;
			break;
	  case 'decent':
			$employee = 5;
			break;
	  case 'good':
			$employee = 10;
			break;
	  default: 
	        $employee = "Invalid operator.";
  }
  
    $transparent = $_POST['transparency'];
  switch($transparent) {
	  case 'poor':
			$transparent = 0;
			break;
	  case 'decent':
			$transparent = 5;
			break;
	  case 'good':
			$transparent = 10;
			break;
	  default: 
	        $transparent = "Invalid operator.";
  }
  

  # Obtains the current active user's ID from $_SESSION data.
  $user_id = $_SESSION['user_id'];
  
   # On success enter all the collected data into the database and notify the user of successful registration.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO rubric (emissions, waste_redu, water_cons, renew_energy, sustain_supply, eco_services, transport_eco, enviro_compl, employee_edu, transparency, user_id) 
	VALUES ('$emission', '$waste', '$water', '$renew', '$sustain', '$services', '$transport', '$enviro', '$employee', '$transparent', '$user_id')";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '<div class = "container">
			<div class = "alert alert-secondary" role = "alert">
			<h4 class = "alert-heading" Registration Complete.</h4>
			<p>You have successfully registered!</p>
			<a class = "alert-link" href = "home.php">Log-In.</a>
			</div>
			</div>

			<p>Your account has been registered!</p> 
			<a class="alert-link" href="home.php"</a>'; }
  
    # Close database connection.
    mysqli_close($link); 

    exit();
  }
   
  # In event of problems, report errors to the screen.
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
	
	<style>
	.red {color: red; font-weight: bold;}
	.orange {color: orange; font-weight: bold;}
	.green {color: green; font-weight: bold;}
	</style>
	</head>
	
	<body>
	<br>
	
	<form class = "was-validated" action = "" method = "post">
	<div class = "container">
	<!-- Opens container. -->
		<div class = "input-group">
			<div class = "col-sm">
				<div class = "card bg-light mb-3">
				<div class = "card-header"><center>Enter your sustainability values!</center></div>
				<div class = "card-body">
				<div class = "row">
					<div class = "col-sm-3">
						<p><label for = "emissions">Enter your emissions: </label></p>
						<p><label for = "waste_redu">Enter your waste reduction: </label></p>
						<p><label for = "water_cons">Enter your water conservation: </label></p>
						<p><label for = "renew_energy">Enter your renewable energy usage: </label></p>
						<p><label for = "sustain_supply">Enter your sustainable supply chain: </label></p>
					</div>
					<div class = "col-sm-2">
						<p>
						<select name = "emissions" id = "emissions">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
						
						<p>
						<select name = "waste_redu" id = "waste_redu">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
						
						<p>
						<select name = "water_cons" id = "water_cons">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
						
						<p>
						<select name = "renew_energy" id = "renew_energy">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
						
						<p>
						<select name = "sustain_supply" id = "sustain_supply">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
					</div>
					
					<div class = "col-sm-4">
						<p><label for = "eco_services">Eco-friendly products & services: </label></p>
						<p><label for = "transport_eco">Enter your transport sustainability: </label></p>
						<p><label for = "enviro_compl">Enter your environmental compliance: </label></p>
						<p><label for = "employee_edu">Enter your employee sustainability education: </label></p>
						<p><label for = "transparency">Enter your transparency: </label></p>
					</div>
					
					<div class = "col-sm-1">
						<p>
						<select name = "eco_services" id = "eco_services">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
						<p>
						<select name = "transport_eco" id = "transport_eco">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
						<p>
						<select name = "enviro_compl" id = "enviro_compl">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
						<p>
						<select name = "employee_edu" id = "employee_edu">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
						<p>
						<select name = "transparency" id = "transparency">
							<option value="poor" class = "red">Poor</option>
							<option value="decent" class = "orange">Intermediate</option>
							<option value="good" class = "green">Great</option>
						</select>
						</p>
					</div>
				</div> <br>
				<!-- Row five closes. -->
				
				<!-- Submits the results to the database. -->
				<center><input class = "btn btn-secondary btn-lg btn-block" type = "submit" value = "Submit"></center>
				</div>
				</div>
			</div>
		</div>
	</div>

<!-- Closes container. -->
</form>	
</body>
	
</html>