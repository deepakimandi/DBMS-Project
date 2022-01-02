<?php

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
            <div class="col-md-8" id="changepassword_msg">
                <!--Alert from signup form-->
            </div>


            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading"><font size = "4">Change Password</font></div>
                        <div class="panel-body">
                            <div class="row">
                            <div class="col-md-12">
                                <label for="provideaddress1"><font size = 5px >Edit here</font></label><br/>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-12">
                                <label for="password">Enter Password</label>
                                <input type="password" id="password" name="password"class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="newpassword">Enter New Password</label>
                                <input type="password" id="newpassword" name="newpassword"class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="renewpassword">Re-enter New Password</label>
                                <input type="password" id="renewpassword" name="renewpassword"class="form-control" required>
                            </div>
                        </div>

                        <p><br/></p> -->
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
                        <form method = "POST" action="update_password.php">


                        <div class="row">
                            <div class="col-md-12">
                                <label for="oldpassword">Enter Password</label>
                                <input type="password" id="oldpassword" name="oldpassword"class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="newpassword">Enter New Password</label>
                                <input type="password" id="newpassword" name="newpassword"class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="renewpassword">Re-enter New Password</label>
                                <input type="password" id="renewpassword" name="renewpassword"class="form-control" required>
                            </div>
                        </div>


                        <p><br/></p>


                        <div class="row">
                            <div class="col-md-12">
                                <input style="width:50%;" value="Update password" type="submit" name="upadate_pass_button"class="btn btn-success btn-lg">
                            </div>
                        </div>

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

