<?php
session_start();
include "User.php";
include 'dbconnect.php';

$user = unserialize($_SESSION['user']);
if(!isset($_SESSION['user']))
{
    header('location:index.php');
}
if (!isset($_SESSION["user"])) {

    echo "<script language='javascript'>";
    echo "alert(\"Please Login First\");";

    echo "location='index.php'";

    echo "</script>";

    exit();

}

$id = $_GET['id'];

$qry_sel = "SELECT * FROM parts where id = '$id'";
$result = $conn->query($qry_sel);
$parts = $result->fetch_array();

if(isset($_POST['comments']))
{
    $userid=$user->id;
    $id=$_GET['id'];
    $comments=$_POST['comment'];
    $qry_ask = "INSERT INTO comments VALUES ('','$id','$userid','$comments')";
    if($conn->query($qry_ask)==FALSE)
    {
        die("Error: ".$conn->error);
    }
    echo '<script>alert("Comment Added")</script>';
}

if(isset($_GET['cid']))
{
    $cid=$_GET['cid'];
    $id=$_GET['id'];
    $qry_delete = "DELETE from comments WHERE cid='$cid'";
    if($conn->query($qry_delete) == FALSE)
    {
        die("Error: ".$conn->error);
    }
   echo '<script>alert("Deleted successfully")</script>';
    header("Refresh:0; url=singlepart.php?id=$id");
}
?>
<head>
    <meta charset="UTF-8">
    <title>BestBuy GearMandu</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/footer.css" rel="stylesheet"/>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/position.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

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

        html, body {
            height: 100%;
            width: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px;
            display: flex;
        }

        .left-column {
            width: 35%;
            position: relative;
        }

        .right-column {
            width: 55%;
            margin-top: 60px;
        }


        .product-description {
            border-bottom: 1px solid #E1E8EE;
            margin-bottom: 20px;
        }
        .product-description span {
            font-size: 12px;
            color: #358ED7;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
        }
        .product-description h1 {
            font-weight: 300;
            font-size: 52px;
            color: #43484D;
            letter-spacing: -2px;
        }
        .product-description p {
            font-size: 16px;
            font-weight: 300;
            color: #86939E;
            line-height: 24px;
        }
        .product-color {
            margin-bottom: 30px;
        }

        .cable-choose {
            margin-bottom: 20px;
        }

        .cable-choose button {
            border: 2px solid #E1E8EE;
            border-radius: 6px;
            padding: 13px 20px;
            font-size: 14px;
            color: #5E6977;
            background-color: #fff;
            cursor: pointer;
            transition: all .5s;
        }

        .cable-choose button:hover,
        .cable-choose button:active,
        .cable-choose button:focus {
            border: 2px solid #86939E;
            outline: none;
        }

        .cable-config {
            border-bottom: 1px solid #E1E8EE;
            margin-bottom: 20px;
        }

        .cable-config a {
            color: #358ED7;
            text-decoration: none;
            font-size: 12px;
            position: relative;
            margin: 10px 0;
            display: inline-block;
        }
        .cable-config a:before {
            content: &amp;quot;?&amp;quot;;
            height: 15px;
            width: 15px;
            border-radius: 50%;
            border: 2px solid rgba(53, 142, 215, 0.5);
            display: inline-block;
            text-align: center;
            line-height: 16px;
            opacity: 0.5;
            margin-right: 5px;
        }
        .product-price {
            display: flex;
            align-items: center;
        }

        .product-price span {
            font-size: 26px;
            font-weight: 300;
            color: #43474D;
            margin-right: 20px;
        }


        @media (max-width: 940px) {
            .container {
                flex-direction: column;
                margin-top: 60px;
            }

            .left-column,
            .right-column {
                width: 100%;
            }

            .left-column img {
                width: 300px;
                right: 0;
                top: -65px;
                left: initial;
            }
        }

        @media (max-width: 535px) {
            .left-column img {
                width: 220px;
                top: -85px;
            }
        }
    </style>
</head>

<!-- header-->
<div style="display: none;" id="position"><?=$_GET['position']?></div>
<div class="container-fluid" style= "width: 1240px;text-align:center;">
    <div class="row" style="height:60px; margin-left: 50px;">
        <div class="col-xs-3" style="margin-top: 10px;">
            <a href="index.php"><img src="img/logo1.png" style="margin-left: -70px; width: 220px; height: 130px"/></a>
        </div>
        <div class="col-xs-7" style="margin-top: 35px;">
            <form class="form-inline" role="form" style="margin-top: 14px; margin-left: -35px;" action="searchName.php" method="get">

                <input type="text" class="form-control" style="width: 80%" name="name" placeholder="Search By Item Name">

                <button type="submit" class="btn btn-info" ">Search</button>
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
                <li><a href="myCart.php"><span class="glyphicon glyphicon-th-large"></span> My Cart &nbsp;<span id="bag" class="badge"></span></a></li>
                <?php
                if (!isset($_SESSION["user"])) {
                    ?>
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a data-toggle="modal" data-target="#myModal" id="login"><span
                                class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                    <li><a href="login.php?type=2" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <li><a href="history.php" ><span class="glyphicon glyphicon-tag"></span> Order Detail</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <form class="form-horizontal" role="form" action="login.php?type=1" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="pwd" placeholder="Enter password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="product-description" style="margin-left: 45%;margin-top: 20px;margin-right: 40%;">
    <?php
    $positions=$parts['position'];
    $types=$parts['type'];
    echo "<a href='position.php?position=$positions'><span>".$parts['position']."</span></a> > <a href='searchType.php?position=$positions & type=$types'><span>".$parts['type']."</span></a>";

    ?>
</div>
<div class="container">
    <div class="left-column" style="margin-left: 50px;">
        <?php
        echo"<img src='items	/".$parts['id'].".jpg'
            height='250' width='250'  />" ;
?>
    </div>

    <div class="right-column" style="margin-top: -5px; margin-left: 50px;">

        <!-- Product Description -->
        <div class="product-description">
            <?php
            echo " <h1>".$parts['name']."</h1>";
              ?>
        </div>

        <div class="product-price" style="margin-top: -15px;">
            <?php
            echo "<span> Rs ".$parts['price']."</span>";
            ?>
        </div>
        <div class="cable-config" style="margin-top: 10px;">
            <?php
            $inventory=$parts['inventory'];

            if ($inventory>0){
                echo " <button class='btn btn-primary' >In Stock</button>";
            }else
            {
                echo "<button  class='btn btn-danger' >Out of Stock</button>";
            }
            ?>
        </div>


    </div>
    <div style="margin-top: 25px;">
    <form method="post" action="checkout_esewa.php">
        <input type="hidden" name="product_id" value="<?php echo $id;?>">
        <label class="product-price col-sm-2"><span style="font-size: 17px;">Quantity:
</span>
        </label>
        <div class="col-sm-5" style="margin-left: 15px;">
            <input type="text" class="form-control" name="quantity_name" value="1" required>  <br/>
        </div>

        <input type="submit" name="submit" value="Buy Now" class="btn btn-success" style="margin-left: 85px;margin-top: 10px;  ">
    </form>
    </div>
</div>


<div class="container"
<div class="row">
    <h4>Comments</h4>

</div>
<div class="row" style="margin-left: 50px;" >
    <div class="left-column" style="margin-left: 120px;width: 65%">
<form method="POST">
    <textarea class="form-control" placeholder="Comments" name="comment" rows="4" cols="80" required></textarea><br/>
    <button type="submit" class="btn btn-primary" id="comment" name="comments">POST COMMENT</button> <br/> <br/>
</form>
    </div>
</div>

<div class="row" style="margin-left: 50px;" >
    <?php
    $id = $_GET['id'];
    $begin=0;
    $maximum=8;
    $qry_comments="select * from comments where pid='$id' ";
    $result=$conn->query($qry_comments);
    $total=$result->num_rows;
    $pages=ceil($total/$maximum);
    if(isset($_GET['pages']))
    {
        $begin=($_GET['pages']-1)*$maximum;
    }
    $select_comments="SELECT * FROM comments As c 
                        INNER JOIN user AS u ON u.id=c.uid
                        where pid='$id' 
                        LIMIT $begin,$maximum
                        ";
    $result_comments=$conn->query($select_comments);
    while ($data=$result_comments->fetch_assoc())
    {
        $commentes=$data['comments'];
        $commentid=$data['cid'];
        $username=$data['users'];
        $uid=$data['uid'];
        $productid=$data['pid'];
        $userid=$user->id;
        echo "<div class='product-description' style='margin-left: 110px;margin-right:110px;'>
                     <h5><span>Comments:</span> $commentes</h5>
                   <p style='font-size: 13px;margin-top: -10px;'>By $username";
        if ($uid==$userid)   {
            echo "<a href='singlepart.php?id=$productid & cid=$commentid'><i class='fa fa-trash' style='font-size: 18px; color: black;margin-left: 20px;'></i></a>";
        }
        else{
            echo "";
        }
       echo "</p>" ;


              echo"      </div>";

    }

    ?>

</div>
</div>
<div class="row">
    <div class=" col-sm-offset-5">
        <ul class="pagination">
            <?php
            for ($p=1;$p<=$pages;$p++) {

                echo "<a href='singlepart.php?id=$id & pages=".$p."'>$p</a> ";

            }
            ?>
        </ul>

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
                                    <li><a href="index.php">Home</a></li>
                                    <li><a  href="position.php?position=Helmets">Helmets</a></li>
                                    <li><a  href="position.php?position=Riding Gears">Riding Gears</a></li>
                                    <li><a  href="position.php?position=Tires">Tires</a></li>
                                    <li><a  href="position.php?position=Parts">Parts</a></li>
                                    <li><a  href="position.php?position=Accessories">Accessories</a></li>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js" integrity="sha512-bkRnY+Yd8OOKaLeSQ4ywl+eeJKIbJ5TtBvyWwM2OnsV1qeIZb2yi7E4h2P6XVcAMz3ldrTKAXk/lC5vvZnDkZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.js" integrity="sha512-71NOmf+URzhLUTnRw76rkHDDUZZ9HJzF+CVVej3qrCaUnWG220eW3riAuhozwTrn0RpLnhj5aP0SVn5u0Crw/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>