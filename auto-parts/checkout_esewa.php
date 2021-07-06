<?php
include 'dbconnect.php';
include "User.php";
session_start();
$user = unserialize($_SESSION['user']);
if(!isset($_SESSION['user']) || $user->rank !=1)
{
    header('location:index.php');
}
if (!isset($_SESSION["user"])) {

    echo "<script language='javascript'>";
    echo "alert(\"Please Login First\");";

    echo "location='login.php'";

    echo "</script>";

    exit();

}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = serialize(array());

}
$cart = unserialize($_SESSION['cart']);
$keys = array_keys($cart);

$product_id='';
$quantity_name='';
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']))
{
    $product_id=$_POST['product_id'];
    $quantity_name=$_POST['quantity_name'];

    $qry_select="Select * from parts Where id='$product_id'";
    $result = $conn->query($qry_select);

    $product= $result->fetch_assoc();
        $orderid = rand(1, 10000);
        $totalprice = $product['price'];
        $calculateprice=$totalprice*$quantity_name;
        $type = $product['type'];
        $inventory = $product['inventory'];
        $name = $product['name'];
        $partid = $product['id'];
        $position = $product['position'];


        date_default_timezone_set("Asia/Kathmandu");
        $date1 = date('Y-m-d h:i:s');
        $date = date('Y-m-d h:i:s', strtotime($date1 . ' + 3 days'));

    foreach($keys as $key){
        $query = "SELECT * from parts where id=$key";
        $result = mysqli_query ($conn,$query)or die('MySQL query error');

        while($row = mysqli_fetch_array($result)){
            $inventory = $row['inventory'];
            $arr3 = $quantity_name;
            if($inventory < $arr3){

                echo "<script>alert('No enough inventory');</script>";
                mysqli_close($conn);
                $_SESSION['cart']=serialize(array());
                $_SESSION['totalprice']=serialize(array());

                echo "<script language='javascript'>";
                echo " location='index.php ';";
                echo "</script>";

            }
            else{

//                echo "<script>alert('Order Placed!');</script>";
            }
        }

    }

        $sql = "insert into orders values ('$user->id',$orderid);";
        $result = mysqli_query($conn, $sql) or die('MySQL query error');

        $sql1 = "insert into orderdetails(orderid, partid, partname,number,totalprice,inventory,delivery_status,success)
 values ($orderid,$partid,'$name','$quantity_name','$calculateprice','$inventory','$date','0');";
        $result = mysqli_query($conn, $sql1) or die('MySQL query11 error');

    $sql2 = "update parts set inventory = inventory - '$quantity_name' where id = '$partid';";
    $result = mysqli_query($conn,$sql2) or die('MySQL query12 error');
    $sql3 = "update orderdetails set inventory = inventory - '$quantity_name' where partid = '$partid';";
    $result = mysqli_query($conn,$sql3) or die('MySQL query12 error');

}
else
{
    header("location:index.php");
}
?>

<head>
    <meta charset="UTF-8">
    <title>BestBuy GearMandu Cart</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/footer.css" rel="stylesheet"/>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.js"/>
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

        #home-hover:hover
        {
            background-color: black;
        }

        .dropdown-menu
        {
            text-decoration: none;
            color:white;
            background-color: black;
        }

        .dropdown-menu li a
        {
            color: white;
        }

        .dropdown-menu li a:hover
        {
            text-decoration: none;
            background-color: #212121;
        }
    </style>

</head>
<body>
<!-- header-->
<!-- header-->
<div class="container-fluid" style= "width: 1240px;text-align:center;">
    <div class="row" style="height:60px; margin-left: 50px;">
        <div class="col-xs-3" style="margin-top: 5px;">
            <a href="index.php"><img src="img/logo1.png" style="margin-top: -30px; margin-left: -70px; width: 220px; height: 130px"/></a>
        </div>
        <div class="col-xs-1">

        </div>
        <div class="col-xs-6" style="margin-left: 280px;">
            <form class="form-inline" role="form" style="margin-top: 14px;margin-left: 40px;" action="searchName.php" method="get">

                <input type="text" class="form-control" style="width: 60%" name="name" placeholder="Search By Item Name">

                <button type="submit" class="btn btn-default" style="color: black;">Search</button>
            </form>
        </div>
    </div>
</div>
<!-- navbar -->
<nav class="navbar navbar-inverse" style="margin: 0px;">
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
                <li><a href="index.php" id="home-hover">Home</a></li>

                <li class="dropdown">
                    <a href="position.php?position=Helmets" class="dropdown-toggle"
                       data-toggle="dropdown" data-hover="dropdown">
                        Helmets <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li ><a href="position.php?position=Helmets">Helmets</a></li>
                        <li ><a href="searchType.php?position=Helmets&type=AGV">AGV</a></li>
                        <li><a href="searchType.php?position=Helmets&type=SHOEI">SHOEI</a></li>
                        <li><a href="searchType.php?position=Helmets&type=LS2">LS2</a></li>
                        <li><a href="searchType.php?position=Helmets&type=Shark">Shark</a></li>
                        <li><a href="searchType.php?position=Helmets&type=Bimola">Bimola</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="searchType.php?position=Riding+Gears&type=AGV" class="dropdown-toggle"
                       data-toggle="dropdown" data-hover="dropdown">
                        Riding Gears <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li ><a href="position.php?position=Riding Gears">Riding Gears</a></li>
                        <li><a href="searchType.php?position=Riding Gears&type=Alpinestar">Alpinestar</a></li>
                        <li><a href="searchType.php?position=Riding Gears&type=Dainese">Dainese</a></li>
                        <li><a href="searchType.php?position=Riding Gears&type=Alpha">Alpha</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="position.php?position=Tires" class="dropdown-toggle"
                       data-toggle="dropdown" data-hover="dropdown">
                        Tires <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li ><a href="position.php?position=Tires">Tires</a></li>
                        <li><a href="searchType.php?position=Tires&type=Pirelli">Pirelli</a></li>
                        <li><a href="searchType.php?position=Tires&type=Dunlop">Dunlop</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="position.php?position=Parts" class="dropdown-toggle"
                       data-toggle="dropdown" data-hover="dropdown">
                        Parts <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li ><a href="position.php?position=Parts">Parts</a></li>
                        <li><a href="searchType.php?position=Parts&type=KTM">KTM</a></li>
                        <li><a href="searchType.php?position=Parts&type=Benelli">Benelli</a></li>
                        <li><a href="searchType.php?position=Parts&type=Honda">Honda</a></li>
                        <li><a href="searchType.php?position=Parts&type=Yamaha">Yamaha</a></li>
                        <li><a href="searchType.php?position=Parts&type=Suzuki">Suzuki</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="position.php?position=Accessories" class="dropdown-toggle"
                       data-toggle="dropdown" data-hover="dropdown">
                        Accessories <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li ><a href="position.php?position=Accessories">Accessories</a></li>
                        <li><a href="searchType.php?position=Accessories&type=Oil & Fluids">Oil & Fluids</a></li>
                        <li><a href="searchType.php?position=Accessories&type=Chain Lubricant">Chain Lubricant</a></li>
                        <li><a href="searchType.php?position=Accessories&type=Engine Oil">Engine Oil</a></li>
                        <li><a href="searchType.php?position=Accessories&type=Exhaust">Exhaust</a></li>
                        <li><a href="searchType.php?position=Accessories&type=Toolkit">Toolkit</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                <li><a href="login.php?type=2"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <li><a href="history.php" ><span class="glyphicon glyphicon-tag"></span> Order Detail</a></li>

            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid" style= "width: 1140px;text-align:center;">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10" style="margin-top: 10px;">
            <div class="panel panel-primary">
                <div class="panel-heading">My Cart</div>
                <div class="panel-body">
                    <?php
                            $orderidselect=$orderid;

                            $qry_selectrow = "SELECT * FROM orderdetails WHERE orderid='$orderidselect'";
                             $result_order = $conn->query($qry_selectrow);
                            $value_row= $result_order->fetch_assoc();
                             $totalprice1=$value_row['totalprice'];
                              $quantity=$value_row['number'];


                        ?>
                        <form class="form-horizontal" role="form" action="checkout.php" method="post" >

                                <div class="form-group" >
                                    <label class="control-label col-sm-2" style="text-align: left;margin-right: -68px;">ID: <?= $orderid ?></label>
                                    <label class="control-label col-sm-2" style="text-align: left;margin-left: -25px;"><img src='items/<?= $partid ?>.jpg' height='100px' width='120px'></label>
                                    <label class="control-label col-sm-2" style="text-align: left;margin-left: -20px;"">Name: <?= $name ?>,  <?= $position ?> </label>
                                    <label class="control-label col-sm-2" style="text-align: left;margin-left: -20px;">Type: <?= $type ?></label>
                                    <label class="control-label col-sm-2" style="text-align: left;margin-left: -20px;">Price: NRs <?= $totalprice ?></label>
                                    <label class="control-label col-sm-2" style="text-align: left;margin-left: -20px;">Quantity: <?= $quantity ?> </label>
                                    <label class="control-label col-sm-2" style="text-align: left;margin-left: -25px;">Total Price: <?= $totalprice1 ?> </label>
                                </div>



                                <?php

                            ?>
                            <div class="form-group">
                                <label class="control-label col-sm-3" id="total"></label>
                            </div>
                        </form>
                        <div class="form-group" style="margin: 0px;">

                            <div class="col-sm-offset-8 col-sm-3" style="margin-bottom: 5px;margin-top:15px; ">
                                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                    <input value="<?php echo $totalprice1;?>" name="tAmt" type="hidden">
                                    <input value="<?php echo $totalprice1;?>" name="amt" type="hidden">
                                    <input value="0" name="txAmt" type="hidden">
                                    <input value="0" name="psc" type="hidden">
                                    <input value="0" name="pdc" type="hidden">
                                    <input value="epay_payment" name="scd" type="hidden">
                                    <input value="<?php echo $orderidselect;?>" name="pid" type="hidden">
                                    <input value="http://localhost/auto-parts/esewa_payment_success.php" type="hidden" name="su">
                                    <input value="http://localhost/auto-parts/esewa_payment_failed.php" type="hidden" name="fu">

                                    <span style="font-size: 20px; font-weight: bold">Pay With</span> <input type="image" src="img/esewa1.jpeg" height="30px" width="55px" >

                                </form>
                            </div>
                        </div>

                    <div class="col-sm-offset-8 col-sm-3">
                        <a href="index.php"><button class="btn btn-default btn-block">Keep Shopping</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js" integrity="sha512-bkRnY+Yd8OOKaLeSQ4ywl+eeJKIbJ5TtBvyWwM2OnsV1qeIZb2yi7E4h2P6XVcAMz3ldrTKAXk/lC5vvZnDkZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.js" integrity="sha512-71NOmf+URzhLUTnRw76rkHDDUZZ9HJzF+CVVej3qrCaUnWG220eW3riAuhozwTrn0RpLnhj5aP0SVn5u0Crw/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>



