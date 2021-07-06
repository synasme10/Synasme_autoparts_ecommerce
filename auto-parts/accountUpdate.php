<?php
include "User.php";
session_start();

$users = $_POST["users"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$password = $_POST["password"];
$email = $_POST["email"];
$id= $_POST['id'];
$rank = $_POST['rank'];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "bestbuy_gearmandu";

$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

if (!$con)
{
    echo "Failed to connect to MySQL: ";
}


    $sql = "update user set users='$users',phone='$phone',address='$address',password = '$password' where id = $id";

    $result = mysqli_query($con,$sql) or die('MySQL query error');
    $user = new User();
    $user->id = (int)$id;
    $user->users = $users;
    $user->phone = $phone;
    $user->address = $address;
    $user->email = $email;
    $user->password = $password;
    $user->rank =$rank;
    $_SESSION["user"] = serialize($user);
    echo 'success';

mysqli_close($con);