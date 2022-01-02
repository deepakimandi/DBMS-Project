<?php
session_start();
// function handle()
include "db.php";
if (isset($_POST["f_name"])) {

	$f_name = $_POST["f_name"];
	$l_name = $_POST["l_name"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$mobile = $_POST['mobile'];
	$state1 = $_POST['state1'];
	$state2 = $_POST['state2'];
	$city1 = $_POST['city1'];
	$city2 = $_POST['city2'];
	$district1 = $_POST['district1'];
	$district2 = $_POST['district2'];
	$pincode1 = $_POST['pincode1'];
	$pincode2 = $_POST['pincode2'];
	$street1 = $_POST['street1'];
	$street2 = $_POST['street2'];
	$flat1 = $_POST['flat1'];
	$flat2 = $_POST['flat2'];
	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";

if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
	empty($mobile) || empty($flat1) || empty($street1) || empty($city1) || empty($state1) || empty($district1) || empty($pincode1)){

		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($name,$f_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $f_name is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($name,$l_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $l_name is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
		exit();
	}
	// if(strlen($password) < 9 ){
	// 	echo "
	// 		<div class='alert alert-warning'>
	// 			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	// 			<b>Password is weak</b>
	// 		</div>
	// 	";
	// 	exit();
	// }
	// if(strlen($repassword) < 9 ){
	// 	echo "
	// 		<div class='alert alert-warning'>
	// 			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	// 			<b>Password is weak</b>
	// 		</div>
	// 	";
	// 	exit();
	// }
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>password is not same</b>
			</div>
		";
	}
	if(!preg_match($number,$mobile)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $mobile is not valid</b>
			</div>
		";
		exit();
	}
	if(!(strlen($mobile) == 10)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number must be 10 digit</b>
			</div>
		";
		exit();
	}
	//existing email address in our database
	$sql = "SELECT user_id FROM user_info WHERE email = '$email' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Email Address is already available Try Another email address</b>
			</div>
		";
		exit();
	} else {
		// echo "$flat2";
		$password = md5($password);
		$flat1 = addslashes($flat1);
		$flat2 = addslashes($flat2);
		$street1 = addslashes($street1);
		$street2 = addslashes($street2);
		$sql = "INSERT INTO `user_info`
		(`user_id`, `first_name`, `last_name`, `email`,
		`password`, `mobile`, `state1`, `state2`, `city1`, `city2`, `district1`, `district2`, `pincode1`, `pincode2`, `street1`, `street2`, `flat1`, `flat2`)
		VALUES (NULL, '$f_name', '$l_name', '$email',
		'$password', '$mobile', '$state1', '$state2', '$city1', '$city2', '$district1', '$district2', '$pincode1', '$pincode2', '$street1', '$street2', '$flat1', '$flat2')";
		$run_query = mysqli_query($con,$sql);
		// $sql = "UPDATE user_info SET flat1 = '$flat1', flat2 = '$flat2' WHERE email = '$email'";
		// $run_query = mysqli_query($con,$sql);
		$_SESSION["uid"] = mysqli_insert_id($con);
		$_SESSION["name"] = $f_name;
		$ip_add = getenv("REMOTE_ADDR");
		$sql = "UPDATE cart SET user_id = '$_SESSION[uid]' WHERE ip_add='$ip_add' AND user_id = -1";
		if(mysqli_query($con,$sql)){
			echo "register_success";
			exit();
		}
	}
	}

}



?>






















































