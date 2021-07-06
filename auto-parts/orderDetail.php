<?php
include 'dbconnect.php';
include "User.php";
session_start();

$user = unserialize($_SESSION['user']);
if(!isset($_SESSION['user']) || $user->rank !=2)
{
    header('location:index.php');
}

if(isset($_GET['oid']))
{
    $oid = $_GET['oid'];
    $qry_del = "DELETE FROM orderdetails WHERE orderid='$oid'";
        if($conn->query($qry_del)==TRUE)
        {
            $qry_del = "DELETE FROM orders WHERE orderid='$oid'";
            if($conn->query($qry_del)==TRUE)
            {
                echo '<script>alert("Deleted successfully")</script>';
                header("Refresh:0; url=orderDetail.php");
            }
        }
}
?>
<head>
    <meta charset="UTF-8">
    <title>BestBuy GearMandu Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <!--<link href="css/index.css" rel="stylesheet"/>-->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/footer.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
       <style>
		body{
		background-image:url('img/bg4.jpg');
		background-size:cover; 
		}
        a:visited {

        }

        a:hover {
            cursor: hand;
            text-decoration: none;
        }

        #show table {
            float: left;
            line-height: 30px;
            font-size: 20px;
        }

        #show img {
            height: 200px;
            width: 210px;
            margin-top: 15px;

        }
	

		#slide div {
	
			width: 1050px;
			height:500px;
			position: absolute;
			margin: 0;
		}
		#slide img {
			margin-left: 18px;
			width: 100%;
			height:100%;
			opacity: 0.8;
		}
    </style>



</head>

<!-- header-->
<div class="container-fluid" style= "width: 1240px;text-align:center;">
    <div class="row" style="height:60px; margin-left: 50px;">
        <div class="col-xs-3" style="margin-top: 10px;">
            <a href="admin.php"><img src="img/logo1.png" style="margin-left: -70px; width: 220px; height: 130px"/></a>
        </div>
    </div>
</div>
<!-- navbar -->
<nav class="navbar navbar-inverse" >
    <div class="container-fluid" style= "width: 1140px;text-align:center;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="admin.php">Part Lists</a></li>
                <li><a href="addPart.php?type=1">Add Part</a></li>
                <li><a href="orderDetail.php">Order Detail</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="login.php?type=2"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<h1 style="text-align: center">Order Detail</h1>
<div class="container-fluid" style= "width: 100%">

    <div class="row" >
        <div class="col-sm-18"  >
            <table class='table'   >
                <?php
                $qry_selectall= "SELECT * 
                        FROM orders as o 
                        INNER JOIN user AS ur ON ur.id=o.userid
                        INNER JOIN orderdetails As od ON od.orderid=o.orderid
                        INNER JOIN parts As p On p.id=od.partid
                        ORDER by od.ordertime";
                $result = $conn->query($qry_selectall);
                if($result->num_rows > 0)
                {
                    echo "
      <tr style='text-align: center'>
      <th style='width:10px; text-align: center'>OID</th>
        <th style='width:170px;text-align: center'>Item</th>
                <th style='width:190px;text-align: center'>Item Detail</th>
      <th style='width:80px;text-align: center'>User </th>
            <th style='width:50px;text-align: center'>Phone</th>
      <th style='width:90px;text-align: center'>Price</th>
	   <th style='width:110px;text-align: center'>Total Price</th>
	   <th style='width:40px;text-align: center' >Inventory</th>
	   <th style='width:270px;text-align: center' >Payment Mode</th>
	  <th style='width:100px;text-align: center' >Date of order</th>   
	  <th style='width:90px;text-align: center' >Delivery Status</th>
	    <th style='width:90px;text-align: center' >Delete</th>
	  
	  
	
	</tr>";
                    while($autopart = $result->fetch_assoc())
                    {
                        $oid=$autopart['orderid'];
                        $success= $autopart['success'];
                       date_default_timezone_set("Asia/Kathmandu");
                        $dateNow= date('Y-m-d h:i:s');
                        $deliveryDate=$autopart['delivery_status'];

                        $todaytime = strtotime($dateNow);
                        $deliverytime = strtotime($deliveryDate);

                        $difference=round(($deliverytime-$todaytime) / (60*60*24));

                        echo "<tr style='text-align: center'>
	<td >" . $autopart['orderid'] . "</td>
	<td><img src='items/" . $autopart['partid'] . ".jpg' height='85' width='115' /></td>
		<td style='text-align: left'> " . $autopart['name'] . ", " . $autopart['position'] . "</td>
			<td >" . $autopart['users'] . "<br/> " . $autopart['email'] . "<br/> " . $autopart['address'] . "</td>
				<td > " . $autopart['phone'] . "</td>
		<td > " . $autopart['price'] . " x " . $autopart['number'] . "</td>
			
		<td >NRs " . $autopart['totalprice'] . "</td>
		<td >" . $autopart['inventory'] . "</td>
			<td>   
		 
		";
                        if ($success == 1) {
                            echo "<span style=\"background-color: green;color: white; padding: 4px 5px; width:110px;height: 25px;\">Payment Done</span>";
                        } else {
                            echo "<span style=\"background-color: #00838F;color: white;padding: 4px 5px; width:110px;height: 25px;\">Cash On Delivery</span>";
                        }
                        echo "</td>
		<td >" . $autopart['ordertime'] . "</td>
		
			<td>   ";
                        if ($difference >= 0) {
                            echo "<span style=\"background-color: green;color: white; padding: 4px 5px; width:110px;height: 25px;\"> $difference Days</span>";
                        } else {
                            echo "<span style=\"background-color: red;color: white;padding: 4px 5px; width:110px;height: 25px;\">$difference Days</span>";
                        }
                        echo "</td>

        <td><a href='orderDetail.php?oid=$oid'><i class='fa fa-trash' style='font-size: 18px;'></i></a> 
</td>
     </tr>
";

                    }

                }
                else
                {
                    echo "<h5 style='color: whitesmoke;'>Data not found</h5>";
                }

                echo "<table>";
                ?>
        </div>
    </div>

</div>


<footer class="container-fluid bg-grey py-5" style="height: 270px">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="logo-part">
                            <img src="img/logo1.png" style="margin-top:25px;padding-bottom: 12px;background-color: white;width: 220px; height: 110px" class="w-50 logo-footer" >
                            <a name="contactus"></a>
                            <ul style="margin-top: -25px;">
                                <p> <li><i class="bi bi-geo-alt-fill"></i> <a href="#contactus"><Span style="margin-left: 5px;margin-bottom: 15px;">Kathmandu, Nepal</Span> </a> </li></p>
                                <p> <li><i class="bi bi-telephone-fill"></i><a href="#contactus"> <Span style="margin-left: 5px;margin-bottom: 15px;">+977 9841234567</Span></a> </li></p>
                                <p> <li> <i class="bi bi-envelope-fill"></i><a href="#contactus"> <Span style="margin-left: 5px;margin-bottom: 15px;">bestbuygearmandu11@gmail.com</Span></a> </li></p>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 px-4" style="margin-top: 20px">
                        <h6 style="font-size: 16px;"> About Company</h6>
                        <p>Bestbuy Gearmandu is one stop shop solution for your riding needs. Here the riders can get top quality riding gears and accessories.</p>
                        <a href="#contactus" class="btn-footer"> Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 px-4" style="margin-top: 20px">

                        <div class="row ">
                            <div class="col-md-4"></div>

                            <div class="col-md-6">
                                <h6 style="font-size: 16px;"> Help us</h6>
                                <ul>
                                    <li><a href="admin.php">Part Lists</a></li>
                                    <li><a href="addPart.php">Add Part</a></li>
                                    <li><a href="orderDetail.php">Order Detail</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 " style="margin-top: 20px">
                        <h6 style="font-size: 16px;"> Follow us</h6>
                        <div class="social">
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook" ></i></a>
                            <a href="https://www.instagram.com/"><i class="fa fa-instagram" ></i></a>
                            <a href="https://www.youtube.com/"><i class="fa fa-youtube" ></i></a>
                            <a href="https://www.twitter.com/"><i class="fa fa-twitter" ></i></a>
                        </div>
                        <br/>
                        <p>BestBuy GearMandu, All rights reserved 2021</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

