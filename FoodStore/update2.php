<?php
    session_start();
    include "db.php";
    $f2 = addslashes($_POST['flat2']);
    $str2 = addslashes($_POST['street2']);
    $c2 = addslashes($_POST['city2']);
    $d2 = addslashes($_POST['district2']);
    $sta2 = addslashes($_POST['state2']);
    $p2 = addslashes($_POST['pincode2']);
    $sql = "UPDATE user_info SET flat2 = '$f2', street2 = '$str2', city2 = '$c2', district2 = '$d2', state2 = '$sta2', pincode2 = '$p2' WHERE user_id = '$_SESSION[uid]'";
    if(mysqli_query($con, $sql))
        header("refresh:0.00001; url = select_address.php");
    else
        echo "Not Updated";
?>
