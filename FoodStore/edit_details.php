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

<?php
// include "db.php";
$select = "SELECT * FROM user_info WHERE user_id = '$_SESSION[uid]'";
$query = mysqli_query($con, $select);
$data = mysqli_fetch_assoc($query);
$fn = $data['first_name'];
$ln = $data['last_name'];
$phone = $data['mobile'];
$email = $data['email'];
$f1 = $data['flat1'];
$str1 = addslashes($data['street1']);
$c1 = addslashes($data['city1']);
$d1 = addslashes($data['district1']);
$sta1 = addslashes($data['state1']);
$p1 = addslashes($data['pincode1']);
$f2 = $data['flat2'];
$str2 = addslashes($data['street2']);
$c2 = addslashes($data['city2']);
$d2 = addslashes($data['district2']);
$sta2 = addslashes($data['state2']);
$p2 = addslashes($data['pincode2']);

if(isset($_POST['edit_details_button']))
{
    $fn_ch = $_POST['f_name'];
    $ln_ch = $_POST['l_name'];
    $phone_ch = $_POST['phone'];
    $email_ch = $_POST['email'];
    $f2_ch = addslashes($_POST['flat2']);
    $str2_ch = addslashes($_POST['street2']);
    $c2_ch = addslashes($_POST['city2']);
    $d2_ch = addslashes($_POST['district2']);
    $sta2_ch = addslashes($_POST['state2']);
    $p2_ch = addslashes($_POST['pincode2']);
    $f1_ch = addslashes($_POST['flat1']);
    $str1_ch = addslashes($_POST['street1']);
    $c1_ch = addslashes($_POST['city1']);
    $d1_ch = addslashes($_POST['district1']);
    $sta1_ch = addslashes($_POST['state1']);
    $p1_ch = addslashes($_POST['pincode1']);
    $name = "/^[a-zA-Z ]+$/";
    $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
    $number = "/^[0-9]+$/";

    if(empty($fn_ch) || empty($ln_ch) || empty($phone_ch) ||
    empty($email_ch) || empty($f1_ch) || empty($str1_ch) || empty($c1_ch) || empty($sta1_ch) || empty($d1_ch) || empty($p1_ch))
    {

        echo "
            <div class='alert alert-warning'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
            </div>
        ";
        exit();
    }
    else
    {
        if(!preg_match($name,$fn_ch))
        {
            echo "
                <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>this $f_name is not valid..!</b>
                </div>
            ";
            exit();
        }
        if(!preg_match($name,$ln_ch))
        {
            echo "
                <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>this $l_name is not valid..!</b>
                </div>
            ";
            exit();
        }
        if(!preg_match($emailValidation,$email_ch))
        {
            echo "
                <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>this $email is not valid..!</b>
                </div>
            ";
            exit();
        }
        // if(strlen($password) < 9 ){
        //  echo "
        //      <div class='alert alert-warning'>
        //          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        //          <b>Password is weak</b>
        //      </div>
        //  ";
        //  exit();
        // }
        // if(strlen($repassword) < 9 ){
        //  echo "
        //      <div class='alert alert-warning'>
        //          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        //          <b>Password is weak</b>
        //      </div>
        //  ";
        //  exit();
        // }
        // if($password != $repassword)
        // {
        //     echo "
        //         <div class='alert alert-warning'>
        //             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        //             <b>password is not same</b>
        //         </div>
        //     ";
        // }
        if(!preg_match($number,$phone_ch))
        {
            echo "
                <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Mobile number $mobile is not valid</b>
                </div>
            ";
            exit();
        }
        if(!(strlen($phone_ch) == 10))
        {
            echo "
                <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Mobile number must be 10 digit</b>
                </div>
            ";
            exit();
        }
        //existing email address in our database
        $sql = "SELECT user_id FROM user_info WHERE email = '$email_ch' LIMIT 1" ;
        $check_query = mysqli_query($con,$sql);
        $count_email = mysqli_num_rows($check_query);
        if($count_email > 1)
        {
            echo "
                <div class='alert alert-danger'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Email Address is already available Try Another email address</b>
                </div>
            ";
            exit();
        }
        else
        {
            // echo "$flat2";

            $sql1 = "UPDATE user_info SET first_name = '$fn_ch', last_name = '$ln_ch', email = '$email_ch', mobile = '$phone_ch',
            flat1 = '$f1_ch', street1 = '$str1_ch', city1 = '$c1_ch', district1 = '$d1_ch', state1 = '$sta1_ch', pincode1 = '$p1_ch',
            flat2 = '$f2_ch', street2 = '$str2_ch', city2 = '$c2_ch', district2 = '$d2_ch', state2 = '$sta2_ch', pincode2 = '$p2_ch' WHERE user_id = '$_SESSION[uid]'";
            // $sql1 = "UPDATE `user_info`
            // (`user_id`, `first_name`, `last_name`, `email`,
            //  `mobile`, `state1`, `state2`, `city1`, `city2`, `district1`, `district2`, `pincode1`, `pincode2`, `street1`, `street2`, `flat1`, `flat2`)
            // VALUES (NULL, '$fn_ch', '$ln_ch', '$email',
            //  '$phone_ch', '$sta1_ch', '$sta2_ch', '$c1_ch', '$c2_ch', '$d1_ch', '$d2_ch', '$p1_ch', '$p2_ch', '$str1_ch', '$str2_ch', '$f1_ch', '$f2_ch')";
            // $run_query = mysqli_query($con,$sql1);
            // $sql = "UPDATE user_info SET flat1 = '$flat1', flat2 = '$flat2' WHERE email = '$email'";
            // $run_query = mysqli_query($con,$sql);
            // $_SESSION["uid"] = mysqli_insert_id($con);
            // $_SESSION["name"] = $f_name;
            // $ip_add = getenv("REMOTE_ADDR");
            // $sql = "UPDATE cart SET user_id = '$_SESSION[uid]' WHERE ip_add='$ip_add' AND user_id = -1";
            $_SESSION["name"] = $fn_ch;
            if(mysqli_query($con,$sql1))
            {
                echo "
                <div class='alert alert-success'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <p style='text-align:center;'><b>Profile updated successfully</b></p>
                </div>";

                header("refresh:1.2; url = profile.php");
            }
        }
    }

}
?>


            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading"><font size = "4">Edit your profile</font></div>
                        <div class="panel-body">
<!--                             <div class="row">
                            <div class="col-md-12">
                                <label for="provideaddress1"><font size = 5px >Edit here</font></label><br/>
                            </div>
                        </div> -->

                        <?php
                            // while($row = mysqli_fetch_array($result))
                            // {
                                echo'
                                <form  action = "" method="post">';echo '
                        <div class="row">
                            <div class="col-md-6">
                                <label for="f_name">First Name</label>
                                <input type="text" id="f_name" name="f_name"class="form-control" value="';
                                echo $fn; echo '">
                            </div>
                            <div class="col-md-6">
                                <label for="l_name">Last Name</label>
                                <input type="text" id="l_name" name="l_name"class="form-control" value="';
                                echo $ln; echo '">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email"class="form-control" value="';
                                echo $email; echo '">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone"class="form-control" value="';
                                echo $phone; echo '">
                            </div>
                        </div>

                        <p><br/></p>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="provideaddress1"><font size = 5px >Address1</font></label><br/>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <label for="streetaddress1">Street address</label>
                                <input type="text" id="flat1" name="flat1"class="form-control" value="';
                                echo $f1; echo '"><br/>
                                <input type="text" id="street1" name="street1"class="form-control" value="';
                                echo $str1; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="city1">City / Town / Village</label>
                                <input type="text" id="city1" name="city1"class="form-control" value="';
                                echo $c1; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="district1">District</label>
                                <input type="text" id="district1" name="district1"class="form-control" value="';
                                echo $d1; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="state1">State</label>
                                <input type="text" id="state1" name="state1"class="form-control" value="';
                                echo $sta1; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="pincode1">Pincode</label>
                                <input type="text" id="pincode1" name="pincode1"class="form-control" value="';
                                echo $p1; echo '">
                            </div>
                        </div><br/>';

                        echo '<p><br/></p>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="provideaddress1"><font size = 5px >Address2</font></label><br/>
                            </div>
                        </div>';

                        echo '
                        <div class="row">
                            <div class="col-md-12">
                                <label for="streetaddress1">Street address</label>
                                <input type="text" id="flat2" name="flat2"class="form-control" value="';
                                echo $f2; echo '"><br/>
                                <input type="text" id="street2" name="street2"class="form-control" value="';
                                echo $str2; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="city2">City / Town / Village</label>
                                <input type="text" id="city2" name="city2"class="form-control" value="';
                                echo $c2; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="district1">District</label>
                                <input type="text" id="district2" name="district2"class="form-control" value="';
                                echo $d2; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="state2">State</label>
                                <input type="text" id="state2" name="state2"class="form-control" value="';
                                echo $sta2; echo '">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="pincode2">Pincode</label>
                                <input type="text" id="pincode2" name="pincode2"class="form-control" value="';
                                echo $p2; echo '">
                            </div>
                        </div><br/>
                        ';

                            // }
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

        <input type="submit" style="margin-left:345px;" name="edit_details_button" class="btn btn-info btn-lg" value="Update profile" >
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
