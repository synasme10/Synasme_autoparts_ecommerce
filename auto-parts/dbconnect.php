<?php
$conn = new mysqli("localhost","root","","bestbuy_gearmandu");

if(!mysqli_select_db($conn,"bestbuy_gearmandu"))
{
    header("location:index.php");
    die();
}
if($conn->connect_error)
{
    die("Connection Failed: ".$conn->connect_error);
}
?>