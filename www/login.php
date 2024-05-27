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
    <a class="navbar-brand" href="index.html">ediSustainability!</a>
	</div>
	</nav>
	<br>
	
	<!-- Contains the fields that let the user enter their email and password. --> 
    <div class = "container">
	<div class = "row">
	<!-- Opens container. -->
	
	<div class = "col-sm">
	<div class = "card bg-light mb-3">
		<div class = "card-header"><center>Sign in to your account.</center></div>
		<div class = "card-body">
		<form action = "login_verification.php" class = "was-validated" method = "post">
			<div class = "form-group">
			<input type = "email" name = "email" class = "form-control" placeholder = "Enter your email here." value = "" required>
			</div>
			
			<br>
			
			<div class = "form-group">
			<input type = "password" name = "pass" class = "form-control" placeholder = "Enter your password here." value = "" required>
			</div>
			
			<br>

		<center><input type = "submit" class = "btn btn-secondary btn-lg btn-block" value = "Log-in."></center>
		</form>
	    </div>
	</div>
	</div>
	
	 <a href = "#" onclick = "forgotPassword()">Forgot your password?</a>
	<!-- Closes container. -->
	</div>
	</div>

<!-- Modal 1 — Forgot Password facility pop-up. -->
<div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot your password? Just reset it here by entering your new one!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body">
		<form action="forgot_password.php" class="was-validated" method="post">
			<div class="form-group">
				<label for = "emailForgot">Please enter your e-mail address:</label>
				<input type="text" name = "emailForgot" value = "<?php if (isset($_POST['emailForgot'])) echo $_POST['emailForgot']; ?>" required>
			</div>
			<div class="form-group">
				<label for = "passwordOne">Choose your new password:</label>
				<input type="text" name = "passwordOne" value = "<?php if (isset($_POST['passwordOne'])) echo $_POST['passwordOne']; ?>" required>
			</div>
			<div class="form-group">
				<label for = "passwordTwo">Confirm your new password:</label>
				<input type="text" name = "passwordTwo" value = "<?php if (isset($_POST['passwordTwo'])) echo $_POST['passwordTwo']; ?>" required>
			</div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-secondary btn-lg btn-block" value="Update" >
		</form>
      </div>
    </div>
  </div>
</div>

	<!-- Bootstrap-enabled Javascript to open the modal.-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- The function-script that will actually open the modal. -->
    <script>
        function forgotPassword() {$('#forgotPassword').modal('show');}
    </script>
</body>
</html>

