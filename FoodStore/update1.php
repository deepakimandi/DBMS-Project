<?php
    session_start();
    include "db.php";
    $f1 = addslashes($_POST['flat1']);
    $str1 = addslashes($_POST['street1']);
    $c1 = addslashes($_POST['city1']);
    $d1 = addslashes($_POST['district1']);
    $sta1 = addslashes($_POST['state1']);
    $p1 = addslashes($_POST['pincode1']);
    $sql = "UPDATE user_info SET flat1 = '$f1', street1 = '$str1', city1 = '$c1', district1 = '$d1', state1 = '$sta1', pincode1 = '$p1' WHERE user_id = '$_SESSION[uid]'";
    if(mysqli_query($con, $sql))
        header("refresh:0.00001; url = select_address.php");
    else
        echo "Not Updated";
?>
