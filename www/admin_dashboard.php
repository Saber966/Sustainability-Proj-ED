<?php

	## Handles the deletion request in the event that the deleteRubric modal is fired.
	if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' && isset($_POST['deleteRubric']))
	{
		## Opens database connection.
		require ('connect_db.php');
		
		## Fetch the user_id from what was entered into the deleteRubric field.
		$delete_id = $_POST['user_id'];
		
		$q = "DELETE FROM rubric WHERE user_id = $delete_id";
		$r = mysqli_query($link, $q);
		
		## Close database connection.
		mysqli_close($link); 
		
		## Redirects them back to the admin page to see the deleted result.
		header("Location: admin_dashboard.php");
		exit();
	}
	
	elseif ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' && isset($_POST['deleteUser']))
	{
		## Opens database connection.
		require ('connect_db.php');
		
		## Fetch the user_id from what was entered into the deleteRubric field.
		$delete_id = $_POST['user_id'];
		
		$q = "DELETE FROM users WHERE user_id = $delete_id";
		$r = mysqli_query($link, $q);
		
		## Close database connection.
		mysqli_close($link); 
		
		## Redirects them back to the admin page to see the deleted result.
		header("Location: admin_dashboard.php");
		exit();
		
		
	}
	
	elseif ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' && isset($_POST['changePassword']))
	{
		## Opens database connection.
		require ('connect_db.php');
		
		## Fetch the user_id from what was entered into the deleteRubric field.
		$delete_id = $_POST['user_id'];
		
  # Initialize an error array.
  $errors = array();

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
    $q = "UPDATE users SET pass = SHA2('$password',256) WHERE user_id = '$delete_id'";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    {
       header("Location: admin_dashboard.php");
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
		## Redirects them back to the admin page to see the deleted result.
		header("Location: tes.php");
		exit();
		
		
	}
	

  
?>

<?php

$page_title = 'Booking';

## Links to the header at the top of the page.
include ('header.php');

## Opens database connection.
require ('connect_db.php');

	## Queries all the relevant bookings stored in the booking table that are related to the user with an active session.
	$q = "SELECT * FROM users" ;
	$r = mysqli_query( $link, $q ) ;
	
	## Checks to ensure the number of rows stored in the database is greater than zero. If so, the code executes. Otherwise, an error message will inform the user that there are no currently stored bookings.
	if ( mysqli_num_rows( $r ) > 0 )
	{
		
		## Creates a container and row outside of the 'while' statement to prevent these two div classes from being repeatedly created and ruining alignment.
		echo '<br>
			  <div class = "container">
			  <div class = "row">
			  <div class = "alert alert-dark" alert-dismissible fade show" role = "alert">
			  <center><h1><b>Admin Dashboard</b></h1></center><hr>';
			  
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
	#Format register date 
	$date= $row["reg_date"];
	$day = substr($date, 8,2);
	$month = substr($date, 5,2);
	$year = substr($date, 0,4);
	
    echo '

	<h4><b>User ID:</b> ' .$row['user_id'].'</h4> 
	<b>Company:</b> '.$row['company_name'].'. <br>
	<b>Contact:</b> '.$row['contact_person'].'. <br>
	<b>Date Registered:</b> '.$day.' - '.$month.' - '.$year.'. <br>
	<b>Administrator:</b> '.$row['admin'].'. <br>
	';
	
	## Checking to ensure each user has rubric results.
	$rubricCheck = "SELECT * FROM rubric WHERE user_id = {$row['user_id']}";
	$rubricResult = mysqli_query($link, $rubricCheck);
	if (mysqli_num_rows($rubricResult) > 0)
	{
		echo '<b>Rubric Results:</b> Yes.<hr>';
	}
	else
	{
		echo '<b>Rubric Results:</b> No.<hr>';
	}
  
  }
  	echo '
	<center>
		   <button type="button" class="btn btn-secondary" role="button" onclick="deleteRubric()">Delete Rubric</button>
		   <button type="button" class="btn btn-secondary" role="button" onclick="deleteUser()">Delete User</button>
		   <button type="button" class="btn btn-secondary" role="button" onclick="changePassword()">Change Password</button>
	</center>
	';
  }
    # Informs the user that no purchases of green points have been made and directs them back to the main page.
	else { echo 'In the rare situation no other users are currently active, only the administrator profile will show up here.' ; }
	
	

    # Close database connection.
	mysqli_close($link); 
?>


<!-- Modal 1 — Delete Rubric Results pop-up. -->
<form method="post" action="admin_dashboard.php">
<div class="modal fade" id="deleteRubric" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete a user's sustainability rubric results.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
				<!-- Catches the necessary input for the delete button to work. -->
				<div class = "modal-body">
	  			<div class="form-group">
				<label for = "user_id">Enter User ID:</label>
				<input type="text" name = "user_id" required>
				</div>
				</div>
	  
				<div class="modal-footer">
				<center><input type="submit" class="btn btn-secondary btn-lg btn-block" name = "deleteRubric" value = "Confirm Deletion"></center>
				</form>
				</div>
    </div>
  </div>
 </div>

<!-- Modal 2 — Delete User pop-up. -->
<form method="post" action="admin_dashboard.php">
<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete a user from the website and purge their database records.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
				<!-- Catches the necessary input for the delete button to work. -->
				<div class = "modal-body">
	  			<div class="form-group">
				<label for = "user_id">Enter User ID:</label>
				<input type="text" name = "user_id" required>
				</div>
				</div>
	  
				<div class="modal-footer">
				<center><input type="submit" class="btn btn-secondary btn-lg btn-block" name = "deleteUser" value = "Confirm Deletion"></center>
				</form>
				</div>
    </div>
  </div>
 </div>
 
<!-- Modal 3 — Change User Password pop-up. -->
<form method="post" action="admin_dashboard.php">
<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change a specified user's password.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  			<div class="form-group">
				<label for = "user_id">Enter User ID:</label>
				<input type="t
				ext" name = "user_id" required>
				</div>
				<div class="form-group">
				<label for = "passwordOne">Choose your new password:</label>
				<input type="text" name = "passwordOne" value = "<?php if (isset($_POST['passwordOne'])) echo $_POST['passwordOne']; ?>" required>
				</div>
				<div class="form-group">
				<label for = "passwordTwo">Confirm your new password:</label>
				<input type="text" name = "passwordTwo" value = "<?php if (isset($_POST['passwordTwo'])) echo $_POST['passwordTwo']; ?>" required>
				</div>
				
				<div class="modal-footer">
				<center><input type="submit" class="btn btn-secondary btn-lg btn-block" name = "changePassword" value = "Change Password"></center>
				</form>
				</div>
      </div>
	  </div>
	  </div>
	  </form>
	  
  	<!-- Bootstrap-enabled Javascript to open the modal.-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- The function-script that will actually open the modal. -->
    <script>
        function deleteRubric() {$('#deleteRubric').modal('show');}
		function deleteUser() {$('#deleteUser').modal('show');}
		function changePassword() {$('#changePassword').modal('show');}
    </script>