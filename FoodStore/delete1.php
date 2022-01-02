<?php
    session_start();
    include "db.php";
    $sql = "SELECT * FROM user_info a WHERE a.user_id = '$_SESSION[uid]'";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($query);
    $pincode1 = $row['pincode1'];
    $pincode2 = $row['pincode2'];
    $flat1 = addslashes($row['flat1']);
    $flat2 = addslashes($row['flat2']);
    $street1 = addslashes($row['street1']);
    $street2 = addslashes($row['street2']);
    $state1 = $row['state1'];
    $state2 = $row['state2'];
    $district1 = $row['district1'];
    $district2 = $row['district2'];
    $city1 = $row['city1'];
    $city2 = $row['city2'];
    $sql = "UPDATE user_info SET flat1 = '$flat2', street1 = '$street2', city1 = '$city2', district1 = '$district2', state1 = '$state2', pincode1 = '$pincode2' WHERE user_id = '$_SESSION[uid]'";
    mysqli_query($con, $sql);
    $sql = "UPDATE user_info SET flat2 = NULL, street2 = NULL, city2 = NULL, district2 = NULL, state2 = NULL, pincode2 = NULL WHERE user_id = '$_SESSION[uid]'";
    mysqli_query($con, $sql);
    header("refresh:0.0001; url = select_address.php");
?>
