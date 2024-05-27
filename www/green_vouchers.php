<?php
include ('header.php');
	# Open database connection.
	require ( 'connect_db.php' ) ;

    # Perform a check when the voucher button is pressed. 
if (isset($_POST['redeemVoucher'])) 
{
    # Update the rubric database with purchased points.
	$addPoints = 5;
	$rubricQuery = "UPDATE rubric SET purchased = purchased + $addPoints WHERE user_id = {$_SESSION['user_id']}";


    // Implement the changes
    if (mysqli_query($link, $rubricQuery)) 
	{
        echo "Voucher added successfully!";
    } else 
	{
        echo "The voucher could not be redeemed: " . mysqli_error($link);
    }
}
?>

<title>Green Vouchers</title>
<div class = "container">
<h1 class = "text-center">Activity Vouchers:</h1>
<center>
<p>Companies that have kept up with their sustainability principles and kept track of their goals are entitled to free vouchers.</p>
<p>Each voucher rewards five points. Press the button to redeem your green voucher for your good work!</p>
</center>
<div class = "row">

	<div class="col-md-3 d-flex justify-content-center">
    <div class="card" style="width: 20rem;">
        <div class="card text-center">
            <img src="img/energy.jpg" alt="Organisation" class="img-thumbnail bg-secondary" style="width: 600px; height: 200px;">
            Renewable Energy Usage<hr>
            Green voucher for five points.
            <button type="button" class="btn btn-secondary" role="button" onclick="firstChoice()">REDEEM VOUCHER</button>
        </div>
    </div>
	</div>

	<div class="col-md-3 d-flex justify-content-center">
    <div class="card" style="width: 20rem;">
        <div class="card text-center">
            <img src="img/water.jpeg" alt="Organisation" class="img-thumbnail bg-secondary" style="width: 600px; height: 200px;">
            Water Conservation.<hr>
            Green voucher for five points.
            <button type="button" class="btn btn-secondary" role="button" onclick="secondChoice()">REDEEM VOUCHER</button>
        </div>
    </div>
	</div>

	<div class="col-md-3 d-flex justify-content-center">
    <div class="card" style="width: 20rem;">
        <div class="card text-center">
            <img src="img/wasteReduction.jpg" alt="Organisation" class="img-thumbnail bg-secondary" style="width: 600px; height: 200px;">
            Waste Reduction.<hr>
            Green voucher for five points.
            <button type="button" class="btn btn-secondary" role="button" onclick="thirdChoice()">REDEEM VOUCHER</button>
        </div>
    </div>
	</div>
	
	<div class="col-md-3 d-flex justify-content-center">
    <div class="card" style="width: 20rem;">
        <div class="card text-center">
            <img src="img/education.jpg" alt="Organisation" class="img-thumbnail bg-secondary" style="width: 600px; height: 200px;">
            Employee Sustainability Education.<hr>
            Green voucher for five points.
            <button type="button" class="btn btn-secondary" role="button" onclick="fourthChoice()">REDEEM VOUCHER</button>
        </div>
    </div>
	</div>

<!-- Modal 1 — Organisation 1 pop-up. -->
<form method="post" action="green_vouchers.php">
<div class="modal fade" id="firstChoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Press the button to redeem a green activity voucher and obtain five points!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-footer">
        <center><input type="submit" class="btn btn-secondary btn-lg btn-block" name = "redeemVoucher" value = "Redeem Voucher"></center>
		</form>
		
      </div>
    </div>
  </div>
  </div>
  

<!-- Modal 1 — Voucher 2 pop-up. -->
<form method="post" action="green_vouchers.php">
<div class="modal fade" id="secondChoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Press the button to redeem a green activity voucher and obtain five points!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-footer">
        <center><input type="submit" class="btn btn-secondary btn-lg btn-block" name = "redeemVoucher" value = "Redeem Voucher"></center>
		</form>
      </div>
    </div>
  </div>
  </div>
</form>
  
<!-- Modal 1 — Voucher 3 pop-up. -->
<form method="post" action="green_vouchers.php">
<div class="modal fade" id="thirdChoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Press the button to redeem a green activity voucher and obtain five points!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-footer">
        <center><input type="submit" class="btn btn-secondary btn-lg btn-block" name = "redeemVoucher" value = "Redeem Voucher"></center>
		</form>
      </div>
    </div>
  </div>
  </div>
</form>
  
<!-- Modal 1 — Voucher 4 pop-up. -->
<form method="post" action="green_vouchers.php">
<div class="modal fade" id="fourthChoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Press the button to redeem a green activity voucher and obtain five points!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-footer">
        <center><input type="submit" class="btn btn-secondary btn-lg btn-block" name = "redeemVoucher" value = "Redeem Voucher"></center>
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
        function firstChoice() {$('#firstChoice').modal('show');}
		function secondChoice() {$('#secondChoice').modal('show');}
		function thirdChoice() {$('#thirdChoice').modal('show');}
		function fourthChoice() {$('#fourthChoice').modal('show');}
    </script>