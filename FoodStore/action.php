<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";


if(isset($_POST["supplier"])){
	$supplier_query = "SELECT * FROM suppliers";
	$run_query = mysqli_query($con,$supplier_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Suppliers</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$sid = $row["supplier_id"];
			$supplier_name = $row["supplier_title"];
			echo "
					<li><a href='#' class='supplier' sid='$sid'>$supplier_name</a></li>
			";
		}
		echo "</div>";
	}
}
// if(isset($_POST['select_address'])){
// 	session_start(); // Start the session

// 	// $_SESSION['name'] = htmlentities($_POST['name']);
// 	// $_SESSION['email'] = htmlentities($_POST['email']);

// 	header('Location: select_address.php');
// }

// if(isset($_POST['payment1'])){
// 	session_start(); // Start the session

// 	// $_SESSION['name'] = htmlentities($_POST['name']);
// 	// $_SESSION['email'] = htmlentities($_POST['email']);

// 	header('Location: payment1.php');
// }

// if(isset($_POST['payment2'])){
// 	session_start(); // Start the session

// 	// $_SESSION['name'] = htmlentities($_POST['name']);
// 	// $_SESSION['email'] = htmlentities($_POST['email']);

// 	header('Location: payment2.php');
// }

// if(isset($_POST["brand"])){
// 	$brand_query = "SELECT * FROM brands";
// 	$run_query = mysqli_query($con,$brand_query);
// 	echo "
// 		<div class='nav nav-pills nav-stacked'>
// 			<li class='active'><a href='#'><h4>Brands</h4></a></li>
// 	";
// 	if(mysqli_num_rows($run_query) > 0){
// 		while($row = mysqli_fetch_array($run_query)){
// 			$bid = $row["brand_id"];
// 			$brand_name = $row["brand_title"];
// 			echo "
// 					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
// 			";
// 		}
// 		echo "</div>";
// 	}
// }
// if(isset($_POST['edit1'])){
// 	session_start(); // Start the session

// 	// $_SESSION['name'] = htmlentities($_POST['name']);
// 	// $_SESSION['email'] = htmlentities($_POST['email']);

// 	header('Location: edit1.php');
// }


if(isset($_POST["page"])){
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}
if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_sup   = $row['product_supplier'];
			// $pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>Rs.$pro_price.00
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
								</div>
							</div>
						</div>
			";
		}
	}
}
if(isset($_POST["get_seleted_Supplier"]) ||
	// isset($_POST["selectBrand"]) ||
	isset($_POST["search"])){
	if(isset($_POST["get_seleted_Supplier"])){
		$id = $_POST["supplier_id"];
		$sql = "SELECT * FROM products WHERE product_supplier = '$id'";
	}
	// else if(isset($_POST["selectBrand"])){
	// 	$id = $_POST["brand_id"];
	// 	$sql = "SELECT * FROM products WHERE product_brand = '$id'";
	// }
	else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products WHERE product_keywords LIKE '%$keyword%'";
	}

	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_sup   = $row['product_supplier'];
			// $pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$pro_price.00
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
								</div>
							</div>
						</div>
			";
		}
	}



	if(isset($_POST["addToCart"])){


		$p_id = $_POST["proId"];


		if(isset($_SESSION["uid"])){

		$user_id = $_SESSION["uid"];

		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			";//not in video
		} else {
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`)
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
			}
		}
		}else{
			$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = mysqli_query($con,$sql);
			if (mysqli_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Product is already added into the cart Continue Shopping..!</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`)
			VALUES ('$p_id','$ip_add','-1','1')";
			if (mysqli_query($con,$sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Your product is Added Successfully..!</b>
					</div>
				";
				exit();
			}

		}




	}

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}

	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Count User cart item



if(isset($_POST["paymentMethods2"]))
{
	$sql = "SELECT a.pincode1, a.pincode2, a.flat1, a.flat2, a.street1, a.street2,
			a.state1, a.state2, a.district1, a.district2, a.city1, a.city2 FROM user_info a WHERE a.user_id = '$_SESSION[uid]'";
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	$pincode1 = $row['pincode1'];
	$pincode2 = $row['pincode2'];
	$flat1 = $row['flat1'];
	$flat2 = $row['flat2'];
	$street1 = $row['street1'];
	$street2 = $row['street2'];
	$state1 = $row['state1'];
	$state2 = $row['state2'];
	$district1 = $row['district1'];
	$district2 = $row['district2'];
	$city1 = $row['city1'];
	$city2 = $row['city2'];
	echo '
		<div class="row" >
			<div class="col-md-6 col-xs-6" ><font size="5">Order delivering to :</font></div>
		</div>'.'<br/>';
	echo '<div class="row">
			<div class="col-md-6">'.$flat2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$street2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$city2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$district2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$state2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$pincode2.'</div>
		</div>';
	echo '<br/>
		<form name = "methods" action = "payment_handler.php" method = "post">

		    <input type="radio" name="method" value="Card"> Debit / Credit Card<br><br/>
    		<input type="radio" name="method" value="Net"> Net Banking<br><br/>
    		<input type="radio" name="method" value="Upi"> UPI<br><br/>

    		<p><input type="submit" class="btn btn-info btn-lg"></p>
		</form>';
}

if(isset($_POST["paymentMethods1"]))
{
	$sql = "SELECT a.pincode1, a.pincode2, a.flat1, a.flat2, a.street1, a.street2,
			a.state1, a.state2, a.district1, a.district2, a.city1, a.city2 FROM user_info a WHERE a.user_id = '$_SESSION[uid]'";

	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	$pincode1 = $row['pincode1'];
	$pincode2 = $row['pincode2'];
	$flat1 = $row['flat1'];
	$flat2 = $row['flat2'];
	$street1 = $row['street1'];
	$street2 = $row['street2'];
	$state1 = $row['state1'];
	$state2 = $row['state2'];
	$district1 = $row['district1'];
	$district2 = $row['district2'];
	$city1 = $row['city1'];
	$city2 = $row['city2'];
	$total_cost = 0;
	$cost = "SELECT SUM(c.qty * p.product_price) AS total_cost FROM cart c, user_info u, products p WHERE u.user_id = $_SESSION[uid] AND c.user_id = $_SESSION[uid] AND c.p_id = p.product_id ";
	$query = mysqli_query($con,$cost);
	$row = mysqli_fetch_array($query);
	$total_cost = $row['total_cost'];
	// $sql1 = "UPDATE cart c SET c.cost = c.qty *";
	// $query = mysqli_query($con,$cost);
	$sql1 = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
	$query1 = mysqli_query($con,$sql1);
	$row1 = mysqli_fetch_array($query1);
	$cart_count = $row1["count_item"];
	echo '
		<div class="row" >
			<div class="col-md-6 col-xs-6" ><font size="5">Order delivering to :</font></div>
		</div>'.'<br/>';
	echo '<div class="row">
			<div class="col-md-6">'.$flat1.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$street1.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$city1.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$district1.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$state1.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$pincode1.'</div>
		</div>';
	echo '<br/>

		<form name = "methods" action = "payment_handler.php" method = "post">

		    <input type="radio" name="method" value="Card"> Debit / Credit Card<br><br/>
    		<input type="radio" name="method" value="Net"> Net Banking<br><br/>
    		<input type="radio" name="method" value="Upi"> UPI<br><br/>
    		<input type="radio" name="method" value="COD"> Cash on Delivery<br><br/>';
    if($cart_count == 0){
    	echo '<p><input type="submit" class="btn btn-info btn-lg" value = "Proceed to pay Rs.0"></p>';
    }
    else{
    	echo '<p><input type="submit" class="btn btn-info btn-lg" value = "Proceed to pay Rs.'.$total_cost.'"></p>';
    }
		echo '</form>';

}



if(isset($_POST["addressDetails"]))
{
// 	echo '
// 	<script type="text/javascript">
//   function submitForm(action) {
//     var form = document.getElementById("form1");
//     form.action = action;
//     form.submit();
//   }
// </script>';
	$sql = "SELECT * FROM user_info a WHERE a.user_id = '$_SESSION[uid]'";
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	$pincode1 = $row['pincode1'];
	$pincode2 = $row['pincode2'];
	$flat1 = $row['flat1'];
	$flat2 = $row['flat2'];
	$street1 = $row['street1'];
	$street2 = $row['street2'];
	$state1 = $row['state1'];
	$state2 = $row['state2'];
	$district1 = $row['district1'];
	$district2 = $row['district2'];
	$city1 = $row['city1'];
	$city2 = $row['city2'];
	echo '
		<div class="row" >
			<div class="col-md-6 col-xs-6" ><font size="5">Select a delivery address</font></div>
		</div>'.'<br/>';
		echo '
		<div class="row">
			<div class="col-md-6">'.$flat1.'</div>
			<div class="col-md-6">'.$flat2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$street1.'</div>
			<div class="col-md-6">'.$street2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$city1.'</div>
			<div class="col-md-6">'.$city2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$district1.'</div>
			<div class="col-md-6">'.$district2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$state1.'</div>
			<div class="col-md-6">'.$state2.'</div>
		</div>
		<div class="row">
			<div class="col-md-6">'.$pincode1.'</div>
			<div class="col-md-6">'.$pincode2.'</div>
		</div>';
		echo '<br/>';
		// echo '<form method="post" action="payment1.php" >
		// 	<input type="submit" style="float:left;" name="payment1" class="btn btn-info btn-lg" value="Deliver to this address" >
		// 	</form>';

		// echo '<div class="row">
		// 					<div class="col-md-2">
		// 						<div class="btn-group">
		// 							<a href="payment1.php"  class="btn btn-info btn-lg">Deliver to this address</a>


		// 						</div>

		// 					</div>
		// 					<div class="col-md-2">
		// 						<div class="btn-group">
		// 							<a href="payment1.php" style="margin-left:290px;" class="btn btn-info btn-lg">Deliver to this address</a>


		// 						</div>
		// 					</div>
		// 					</div>';
		echo '
		<div class="btn-group">
    <a href="payment1.php" class="btn btn-info btn-lg" role="button">Deliver to this address</a>
    </div>';
    if($city2 != NULL){
    echo '
    <div class="btn-group">
    <a href="payment2.php" style="margin-left:273px;" class="btn btn-info btn-lg" role="button">Deliver to this address</a>
    </div>';
}
							echo '<br/>';
							echo '<br/>';
							// echo '<br/>';

		// echo '<div class="row">
		// 					<div class="col-md-2">
		// 						<div class="btn-group">
		// 							<a href="payment1.php"  class="btn btn-info btn-lg">Edit</a>


		// 						</div>

		// 					</div>

		// 					<div class="col-md-2">
		// 						<div class="btn-group">
		// 							<a href="payment1.php" style="margin-left:30px;"  class="btn btn-info btn-lg">Edit</a>


		// 						</div>
		// 					</div>

		// 					<div class="col-md-2">
		// 						<div class="btn-group">
		// 							<a href="payment1.php" style="margin-left:150px;" class="btn btn-info btn-lg">Delete</a>


		// 						</div></div>

		// 						<div class="col-md-2">
		// 						<div class="btn-group">
		// 							<a href="payment1.php" style="margin-left:200px;" class="btn btn-info btn-lg">Delete</a>


		// 						</div>
		// 						</div></div>';

		echo '
		<div class="btn-group">
    <a href="edit1.php" class="btn btn-info btn-lg" role="button">Edit</a>
    </div>';
    if($city2 != NULL){
    echo '
    <div class="btn-group">
    <a href="delete1.php" style="margin-left:57px;" class="btn btn-info btn-lg" role="button">Delete</a>
    </div>';
}

    if($city2 != NULL){
    echo '
    <div class="btn-group">
    <a href="edit2.php" style="margin-left:273px;" class="btn btn-info btn-lg" role="button">Edit</a>
    </div>
    <div class="btn-group">

    <a href="delete2.php" style="margin-left:57px;" class="btn btn-info btn-lg" role="button">Delete</a>
  </div>';}


		// if($pincode2 != NULL)
		// {
		// 	// echo '
		// 	// <form method="post" action="payment2.php">
		// 	// <input type="submit" style="margin-left:230px;" name="payment2" class="btn btn-info btn-lg" value="Deliver to this address" >
		// 	// </form>';

		// }
		// echo '<br/>';
		// echo '<br/>';
		// // echo '<br/>';
		// echo '

		// <div class="col-md-1"><form method="post" action = "edit1.php">
		// 	<input type="submit"  style="float:left;" name="edit1" class="btn btn-info btn-lg" value="Edit " >
		// </form></div>
		// <div class="col-md-1">
		// <form method="post" action = "delete1.php">
		// 	<input type="button" style="margin-left:55px;"  name="delete1" class="btn btn-info btn-lg" value="Delete " >
		// </form>';



		// if($pincode2 != NULL)
		// {
		// 	echo '<form method="post" action = "edit2.php">
		// 	<input type="submit" style="margin-left:100px;" name="edit2" class="btn btn-info btn-lg" value="Edit" >
		// 	</form>
		// 	<form method="post" action = "delete2.php">
		// 	<input type="submit" style="margin-left:128px;" name="delete2" class="btn btn-info btn-lg" value="Delete " >
		// 	</form></div>
		// 	';
		// }
		if($city2 == NULL)
		{
			echo '
			<form method="post" action="add.php">
			<div style="text-align: center;">
                <input type="submit" align="middle"  name="add" class="btn btn-info btn-lg" value="Add another one" >
            </div>
			</form>

			';
		}



}

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"]))
{

	if (isset($_SESSION["uid"]))
	{
		//When user is logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
	}
	else
	{
		//When user is not logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"]))
	{
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0)
		{
			$n = 0;
			while ($row=mysqli_fetch_array($query))
			{
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row">
						<div class="col-md-3">'.$n.'</div>
						<div class="col-md-3"><img class="img-responsive" src="product_images/'.$product_image.'" /></div>
						<div class="col-md-3">'.$product_title.'</div>
						<div class="col-md-3">Rs.'.$product_price.'</div>
					</div>';
				echo '<br/>';
				echo '<br/>';

			}
			?>
				<a style="float:right;" href="cart.php" class="btn btn-warning">Edit / Checkout&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span></a>
			<?php
			exit();
		}
		else
		{
			echo '<br/><pre><div style="font-size:1.25em;color:red">        Your Food cart is Empty</div></pre>';
			echo '<br/>';
		}
	}
	if (isset($_POST["checkOutDetails"]))
	{
		if(mysqli_num_rows($query) ==0)
		{
			echo '<br/>';
			echo '<pre><div style="font-size:2.25em;color:red">              Your Food cart is Empty</div></pre>';
			echo '<br/>';
		}
		if (mysqli_num_rows($query) > 0)
		{
			//display user cart item with "Ready to checkout" button if user is not login
			echo "<form method='post' action='login_form.php'>";
			$n=0;
			while ($row=mysqli_fetch_array($query))
			{
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];

				echo
					'<div class="row">
							<div class="col-md-2">
								<div class="btn-group">
									<a href="#" remove_id="'.$product_id.'" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
									<a href="#" update_id="'.$product_id.'" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign"></span></a>
								</div>
							</div>
							<input type="hidden" name="product_id[]" value="'.$product_id.'"/>
							<input type="hidden" name="" value="'.$cart_item_id.'"/>
							<div class="col-md-2"><img class="img-responsive" src="product_images/'.$product_image.'"></div>
							<div class="col-md-2" style="font-size:1.5em;">'.$product_title.'</div>
							<div class="col-md-2"><input type="text" style="font-size:1.5em;" class="form-control qty" value="'.$qty.'" ></div>
							<div class="col-md-2"><input type="text" style="font-size:1.5em;" class="form-control price" value="'.$product_price.'" readonly="readonly"></div>
							<div class="col-md-2"><input type="text" style="font-size:1.5em;" class="form-control total" value="'.$product_price.'" readonly="readonly"></div>
						</div>';
					echo '<br/>';
					echo '<br/>';
			}

			echo '<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-12">
							<b class="net_total" style="font-size:20px;float:right;"> </b>
				</div>';

			if (!isset($_SESSION["uid"]))
			{
				echo '<br/>';
				echo '<br/>';
				echo '<br/>';
				echo '<input type="submit" style="margin-left:708px;" name="login_user_with_product" class="btn btn-info btn-lg" value="Ready to Checkout" >
						</form>';

			}
			else if(isset($_SESSION["uid"]))
			{
				echo '<br/>';
				echo '<br/>';
				echo '<br/>';
				//Paypal checkout form

				// echo '
				// 	</form>
				// 	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				// 		<input type="hidden" name="cmd" value="_cart">
				// 		<input type="hidden" name="business" value="shoppingcart@Foodstore.com">
				// 		<input type="hidden" name="upload" value="1">';

						// $x=0;
						// $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
						// $query = mysqli_query($con,$sql);
						// while($row=mysqli_fetch_array($query)){
						// 	$x++;
						// 	echo
						// 		'<input type="hidden" name="item_name_'.$x.'" value="'.$row["product_title"].'">
						// 	  	 <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
						// 	     <input type="hidden" name="amount_'.$x.'" value="'.$row["product_price"].'">
						// 	     <input type="hidden" name="quantity_'.$x.'" value="'.$row["qty"].'">';
						// 	}

						// echo
						// 	'<input type="hidden" name="return" value="http://localhost/FoodStore/payment_success.php"/>
				  //               <input type="hidden" name="notify_url" value="http://localhost/FoodStore/payment_success.php">
						// 		<input type="hidden" name="cancel_return" value="http://localhost/FoodStore/cancel.php"/>
						// 		<input type="hidden" name="currency_code" value="USD"/>
						// 		<input type="hidden" name="custom" value="'.$_SESSION["uid"].'"/>
						// 		<input style="float:right;margin-right:80px;" type="image" name="submit"
						// 			src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal Checkout"
						// 			alt="PayPal - The safer, easier way to pay online">
						// 	</form>';
				echo '</form>
					<form method="post" action="select_address.php">
						<input type="submit" style="margin-left:708px;" name="select_address" class="btn btn-info btn-lg" value="Proceed to pay" >
					</form>';

			}
		}
	}
}



//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is removed from cart</b>
				</div>";
		exit();
	}
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is updated</b>
				</div>";
		exit();
	}
}


?>






