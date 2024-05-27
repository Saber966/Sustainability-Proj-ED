<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Page title -->
    <title>ediSustainability!</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ediSustainability!</a>
        </div>
    </nav>
    <br>
    
    <!-- Form for email and password -->
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card bg-light mb-3">
                    <div class="card-header"><center>Sign in to your account.</center></div>
                    <div class="card-body">
                        <form action="login_verification.php" class="was-validated" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email here." value="" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="password" name="pass" class="form-control" placeholder="Enter your password here." value="" required>
                            </div>
                            <br>
                            <center><input type="submit" class="btn btn-secondary btn-lg btn-block" value="Log-in."></center>
                        </form>
                    </div>
                </div>
            </div>
            <a href="#" onclick="openForgotPasswordModal()">Forgot your password?</a>
        </div>
    </div>

    <!-- Modal for Forgot Password -->
    <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot your password? Just reset it here by entering your new one!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_card.php" class="was-validated" method="post">
                        <div class="form-group">
                            <label for="passwordOne">Choose your new password:</label>
                            <input type="text" name="passwordOne" value="<?php if (isset($_POST['passwordOne'])) echo $_POST['passwordOne']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="passwordTwo">Confirm your new password:</label>
                            <input type="text" name="passwordTwo" value="<?php if (isset($_POST['passwordTwo'])) echo $_POST['passwordTwo']; ?>" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary btn-lg btn-block" value="Update">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom script to open modal -->
    <script>
        function openForgotPasswordModal() {
            $('#forgotPassword').modal('show');
        }
    </script>
</body>
</html>

