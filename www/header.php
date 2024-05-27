<?php

# Initiating the session.
session_start(); 

# Redirecting the user if they are not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

## Double-check whether the logged-in user is an administrator or an ordinary user.
$adminUser = false;
$currentUser = $_SESSION['user_id'];

## Opens database connection.
require ('connect_db.php');

## Begins the admin user check.
$q = "SELECT admin FROM users WHERE user_id = $currentUser AND admin = 'yes'";
$r = mysqli_query($link, $q);

if ($r && mysqli_num_rows($r) == 1)
{
	$adminUser = true;
}


?>

<!doctype html>
<html lang="en">
<head>
  
	<!-- Meta tags. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Page title. -->
	
	<!-- Bootstrap. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
	
	<!-- HEADER BEGINS. -->
    <nav class="navbar navbar-expand-lg bg-light">
	<ul class = "nav navbar-nav mr-auto">
	
	
	<!-- ediSustainability logo. -->
	<li class = "nav-item dropdown">
	<a class = "navbar-brand nav-link" id = "navbarDropdownMenuLink" href = "home.php" role = "button" data-toggle="dropdown" aria-haspopup = "true" aria-expanded = "false">
	ediSustainability</a>
	</li>
	
	<!-- User Dropdown Menu & Session. -->
	<li class = "nav-item dropdown">
	<a class = "navbar-brand nav-link dropdown-toggle" href = "#" role = "button" data-bs-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">
	<?php echo " {$_SESSION['company_name']} <i class=\"bi bi-house\"></i> "; ?>

	</a>
	<ul class="dropdown-menu">
	<li><a class = "dropdown-item" href = "home.php">Home</a></li>
	<!-- Only displays this page if the user is registered as an administrator of the website.-->
	<?php if ($adminUser): ?>
	<li><a class = "dropdown-item" href = "admin_dashboard.php">Admin Dashboard</a></li>
	<?php endif; ?>
	<li><a class = "dropdown-item" href = "user_profile.php">User Profile</a></li>
	<li><a class = "dropdown-item" href = "mission_statement.php">Mission Statement</a></li>
	<li><a class = "dropdown-item" href = "sustainability_details.php">Sustainability Details</a></li>
	<li><a class = "dropdown-item" href = "sustainability_rubric.php">Sustainability Rubric</a></li>
	<li><a class = "dropdown-item" href = "booking.php">Purchase Points</a></li>
    <li><a class = "dropdown-item" href = "organisations.php">Corporate Credentials</a></li>
    <li><a class = "dropdown-item" href = "booking_history.php">Booking History</a></li>
	<li><a class = "dropdown-item" href = "feedback.php">Feedback</a></li>
	<li><a class = "dropdown-item" href = "logout.php">Logout</a></li>
	<li><a class = "dropdown-item" href = "green_vouchers.php">Green Vouchers</a></li>
	</ul>
	</li>
	</nav>
	
	
    <!-- Scripts to provide Javascript plugins to bootstrap and to provide pop-up functionality for modals. -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  </body>
</html>