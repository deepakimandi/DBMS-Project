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
                    <div class="panel-heading"><font size = "4">Edit Address2</font></div>
                        <div class="panel-body">
                            <div class="row">
                            <div class="col-md-12">
                                <label for="provideaddress2"><font size = 5px >Edit here</font></label><br/>
                            </div>
                        </div>

                        <?php
                            while($row = mysqli_fetch_array($result))
                            {
                                echo'
                                <form  action = "update2.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="streetaddress2">Street address</label>
                                <input type="text" id="flat2" name="flat2"class="form-control" value="';
                                echo $row['flat2']; echo '"><br/>
                                <input type="text" id="street2" name="street2"class="form-control" value="';
                                echo $row['street2']; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="city2">City / Town / Village</label>
                                <input type="text" id="city2" name="city2"class="form-control" value="';
                                echo $row['city2']; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="district2">District</label>
                                <input type="text" id="district2" name="district2"class="form-control" value="';
                                echo $row['district2']; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="state2">State</label>
                                <input type="text" id="state2" name="state2"class="form-control" value="';
                                echo $row['state2']; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="pincode2">Pincode</label>
                                <input type="text" id="pincode2" name="pincode2"class="form-control" value="';
                                echo $row['pincode2']; echo '">
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
                            <div class="col-md-2"><input type='text' class='form-control' value='2' ></div>
                            <div class="col-md-2"><input type='text' class='form-control' value='5000' disabled></div>
                            <div class="col-md-2"><input type='text' class='form-control' value='5000' disabled></div>
                        </div> -->
                        <!--<div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <b>Total $500000</b>
                            </div> -->

                            <div style="text-align: center;">
                                <input type="submit" align="middle"  name="edit2" class="btn btn-info btn-lg" value="Update" >
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
