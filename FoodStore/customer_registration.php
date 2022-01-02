<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php

if (isset($_GET["register"])) {

	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Food Store</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Food Store</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<!-- <li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li> -->
			</ul>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Customer SignUp Form</div>
					<div class="panel-body">

					<form id="signup_form" onsubmit="return false" method = "POST" >
						<div class="row">
							<div class="col-md-6">
								<label for="f_name">First Name</label>
								<span class="error">* </span>
								<input type="text" id="f_name" name="f_name" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label for="f_name">Last Name</label>
								<input type="text" id="l_name" name="l_name"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="email">Email</label>
								<input type="text" id="email" name="email"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="password">password</label>
								<input type="password" id="password" name="password"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="repassword">Re-enter Password</label>
								<input type="password" id="repassword" name="repassword"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="mobile">Phone</label>
								<input type="text" id="mobile" name="mobile"class="form-control">
							</div>
						</div>

						<p><br/></p>

						<div class="row">
							<div class="col-md-12">
								<label for="provideaddress1"><font size = 5px >Provide address</font></label><br/>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label for="streetaddress1">Street address</label>
								<input type="text" id="flat1" name="flat1"class="form-control"><br/>
								<input type="text" id="street1" name="street1"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="city1">City / Town / Village</label>
								<input type="text" id="city1" name="city1"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="district1">District</label>
								<input type="text" id="district1" name="district1"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="state1">State</label>
								<input type="text" id="state1" name="state1"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="pincode1">Pincode</label>
								<input type="text" id="pincode1" name="pincode1"class="form-control">
							</div>
						</div>

						<p><br/></p>

						<div class="row">
							<div class="col-md-12">
								<label for="provideaddress1"><font size = 5px >Provide optional address</font></label><br/>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label for="streetaddress2">Street address</label>
								<input type="text" id="flat2" name="flat2"class="form-control"><br/>
								<input type="text" id="street2" name="street2"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="city2">City / Town / Village</label>
								<input type="text" id="city2" name="city2"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="district2">District</label>
								<input type="text" id="district2" name="district2"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="state2">State</label>
								<input type="text" id="state2" name="state2"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="pincode2">Pincode</label>
								<input type="text" id="pincode2" name="pincode2"class="form-control">
							</div>
						</div>

						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
								<input style="width:100%;" value="Sign Up" type="submit" name="signup_button"class="btn btn-success btn-lg">
							</div>
						</div>

					</div>
					</form>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
	<?php
}



?>






















