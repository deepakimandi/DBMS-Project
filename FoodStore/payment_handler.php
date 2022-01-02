<?php
session_start();
include "db.php";
  echo '<head>
        <meta charset="UTF-8">
        <title>Food Store</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <script src="js/jquery2.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="main.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
<body>
<div class="wait overlay">
    <div class="loader"></div>
</div>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
                    <span class="sr-only">navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Food Store</a>
            </div>
        <div class="collapse navbar-collapse" id="collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
            </ul>
        </div>
    </div>
    </div>
    <p><br/></p>
    <p><br/></p>
    <p><br/></p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" id="cart_msg">
                <!--Cart Message-->
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading"><font size = "4">Payment</font></div>
                        <div class="panel-body">';
$sql1 = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
$query1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_array($query1);
$cart_count = $row1["count_item"];
if(isset($_POST['method'])){
    $method = $_POST['method'];
  }
  else{
    $method = NULL;
  }
  if($method != NULL && $cart_count != 0)
  {
    // $cost = "SELECT SUM(c.qty * p.product_price) AS total_cost FROM cart c, user_info u, products p WHERE u.user_id = $_SESSION[uid] AND c.user_id = $_SESSION[uid] AND c.p_id = p.product_id ";
    // $query = mysqli_query($con,$cost);
    // $row = mysqli_fetch_array($query);
    // echo $row['total_cost'];



    if($method == "Net"){
        //$sql = "UPDATE cart SET time_stamp = time() WHERE c.user_id = $_SESSION[uid]";
        // mysqli_query($con,$sql);

        $sql1 = "INSERT INTO `orders` (`user_id`, `product_id`, `qty`, `cost`, `payment_mode`) SELECT c.user_id, c.p_id, c.qty, c.cost, 'Net' FROM cart c WHERE c.user_id = $_SESSION[uid]";
        mysqli_query($con,$sql1);
        $sql2 = "DELETE FROM cart WHERE user_id = '$_SESSION[uid]'";
        mysqli_query($con,$sql2);
        $sql3 = "UPDATE orders SET orders.cost = ordres.qty * products.product_price WHERE orders.product_id = products.product_id";
        mysqli_query($con,$sql2);
        // $sql = "select o.order_id, o.user_id, o.product_id, o.qty, o.time_stamp, o.cost, p.product_price from orders o left join products p on o.product_id = p.product_id";
        echo "Payment done through Net Banking";
        echo '<br/>';
        echo "Your order has been placed";
        exit();
    }
    else if($method == "Upi"){
        //$sql = "UPDATE cart SET time_stamp = time() WHERE c.user_id = $_SESSION[uid]";
        // mysqli_query($con,$sql);
        $sql1 = "INSERT INTO `orders` (`user_id`, `product_id`, `qty`, `cost`, `payment_mode`) SELECT c.user_id, c.p_id, c.qty, c.cost, 'Upi' FROM cart c WHERE c.user_id = $_SESSION[uid]";
        mysqli_query($con,$sql1);
        $sql2 = "DELETE FROM cart WHERE user_id = '$_SESSION[uid]'";
        mysqli_query($con,$sql2);
        $sql3 = "UPDATE orders SET orders.cost = ordres.qty * products.product_price WHERE orders.product_id = products.product_id";
        mysqli_query($con,$sql2);
        echo "Payment done through UPI";
        echo '<br/>';
        echo "Your order has been placed";
        exit();
    }
    else if($method == "COD"){
        //$sql = "UPDATE cart SET time_stamp = time() WHERE c.user_id = $_SESSION[uid]";
        // mysqli_query($con,$sql);
        $sql1 = "INSERT INTO `orders` (`user_id`, `product_id`, `qty`, `cost`, `payment_mode`) SELECT c.user_id, c.p_id, c.qty, c.cost, 'COD' FROM cart c WHERE c.user_id = $_SESSION[uid]";
        mysqli_query($con,$sql1);
        $sql2 = "DELETE FROM cart WHERE user_id = '$_SESSION[uid]'";
        mysqli_query($con,$sql2);
        $sql3 = "UPDATE orders SET orders.cost = ordres.qty * products.product_price WHERE orders.product_id = products.product_id";
        mysqli_query($con,$sql2);
        echo "Payment will be done through Cash on Delivery";
        echo '<br/>';
        echo "Your order has been placed";
        exit();
    }
    else
    {
        //$sql = "UPDATE cart SET time_stamp = time() WHERE c.user_id = $_SESSION[uid]";
        // mysqli_query($con,$sql);
        $sql1 = "INSERT INTO `orders` (`user_id`, `product_id`, `qty`, `cost`, `payment_mode`) SELECT c.user_id, c.p_id, c.qty, c.cost, 'card' FROM cart c WHERE c.user_id = $_SESSION[uid]";
        mysqli_query($con,$sql1);
        $sql2 = "DELETE FROM cart WHERE user_id = '$_SESSION[uid]'";
        mysqli_query($con,$sql2);
        $sql3 = "UPDATE orders SET orders.cost = ordres.qty * products.product_price WHERE orders.product_id = products.product_id";
        mysqli_query($con,$sql2);
        echo "Payment done through Card";
        echo '<br/>';
        echo "Your order has been placed";
        exit();
    }
}
  else{
    if($cart_count == 0)
        echo 'Your cart is empty! <br/> Go to Home to add some items into cart.';
    else
        echo "You must select a payment method to place your order";
  }
  echo '
                        <!--<div class="row">
                            <div class="col-md-2">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                    <a href="" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span></a>
                                </div>
                            </div>
                            <div class="col-md-2"><img src="product_images/imges.jpg"></div>
                            <div class="col-md-2">Product Name</div>
                            <div class="col-md-2"><input type="text" class="form-control" value="1" ></div>
                            <div class="col-md-2"><input type="text" class="form-control" value="5000" disabled></div>
                            <div class="col-md-2"><input type="text" class="form-control" value="5000" disabled></div>
                        </div> -->
                        <!--<div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <b>Total $500000</b>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="panel-footer"></div> -->
                </div>
            </div>
            <div class="col-md-2"></div>

        </div>
</body>';

?>
