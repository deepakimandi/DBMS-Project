<?php
session_start();

include "db.php";

$query = "SELECT * FROM user_info WHERE user_id = '$_SESSION[uid]'";
$result = mysqli_query($con, $query);
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
                <!-- <li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li> -->
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
                    <div class="panel-heading"><font size = "4">Edit Address1</font></div>
                        <div class="panel-body">
                            <div class="row">
                            <div class="col-md-12">
                                <label for="provideaddress1"><font size = 5px >Edit here</font></label><br/>
                            </div>
                        </div>

                        <?php
                            while($row = mysqli_fetch_array($result))
                            {
                                echo'
                                <form  action = "update1.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="streetaddress1">Street address</label>
                                <input type="text" id="flat1" name="flat1"class="form-control" value="';
                                echo $row['flat1']; echo '"><br/>
                                <input type="text" id="street1" name="street1"class="form-control" value="';
                                echo $row['street1']; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="city1">City / Town / Village</label>
                                <input type="text" id="city1" name="city1"class="form-control" value="';
                                echo $row['city1']; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="district1">District</label>
                                <input type="text" id="district1" name="district1"class="form-control" value="';
                                echo $row['district1']; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="state1">State</label>
                                <input type="text" id="state1" name="state1"class="form-control" value="';
                                echo $row['state1']; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="pincode1">Pincode</label>
                                <input type="text" id="pincode1" name="pincode1"class="form-control" value="';
                                echo $row['pincode1']; echo '">
                            </div>
                        </div><br/>';
                            }
                        ?>
                        <!--<div class="row">
                            <div class="col-md-2">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                    <a href="" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span></a>
                                </div>
                            </div>
                            <div class="col-md-2"><img src='product_images/imges.jpg'></div>
                            <div class="col-md-2">Product Name</div>
                            <div class="col-md-2"><input type='text' class='form-control' value='1' ></div>
                            <div class="col-md-2"><input type='text' class='form-control' value='5000' disabled></div>
                            <div class="col-md-2"><input type='text' class='form-control' value='5000' disabled></div>
                        </div> -->
                        <!--<div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <b>Total $500000</b>
                            </div> -->
                            <div style="text-align: center;">
                                <input type="submit" align="middle"  name="edit1" class="btn btn-info btn-lg" value="Update" >
                            </div>
        </form>
                        </div>
                    </div>
                    <!-- <div class="panel-footer"></div> -->
                </div>
            </div>
            <div class="col-md-2"></div>

        </div>
</body>
</html>
