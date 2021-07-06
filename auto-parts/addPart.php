<?php
include "User.php";
session_start();

$user = unserialize($_SESSION['user']);
if(!isset($_SESSION['user']) || $user->rank !=2)
{
    header('location:index.php');
}

if(isset($_GET["updateType"])){
    $type = $_GET["updateType"];
}else{
    $type=1;
}
?>
<head>
    <meta charset="UTF-8">
    <?php
    if ($type == 1) {
        ?>
        <title>BestBuy GearMandu Admin</title>
        <?php
    } else if ($type == 2) {
        ?>
        <title>Administer Update Parts</title>
        <?php
    }
    ?>
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
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/footer.css" rel="stylesheet"/>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
</head>
<body>
<!-- header-->
<div class="container-fluid" style= "width: 1240px;text-align:center;">
    <div class="row" style="height:60px; margin-left: 50px;">
        <div class="col-xs-3" style="margin-top: 10px;">
            <a href="admin.php"><img src="img/logo1.png" style="margin-left: -70px; width: 220px; height: 130px"/></a>
        </div>
        <div class="col-xs-1">

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
                <li><a href="admin.php">Part Lists</a></li>
                <li><a href="addPart.php">Add Part</a></li>
                <li><a href="orderDetail.php">Order Detail</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="login.php?type=2"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid" style= "width: 1140px;text-align:center;">
    <div class="row" style="margin-top: 10px;">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="panel panel-primary">
                <?php
                if($type==1){
                    ?>

                    <div class="panel-heading">Add Part</div>
                    <?php
                }else if($type==2){
                    ?>
                    <div class="panel-heading">Update Part</div>
                    <?php
                }
                ?>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="form" enctype="multipart/form-data" action="upload.php" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <div class="col-sm-6">
                                <?php
                                if ($type == 1) {
                                    ?>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Part Name" required>
                                    <?php
                                } else if($type==2) {
                                    ?>
                                    <input type="text" class="form-control" name="name" value="<?=$_GET['name']?>" required>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="position">Products:</label>
                            <div class="col-sm-6">
                                <?php
                                if ($type == 1) {
                                    ?>
                                    <select class="form-control" name="position">
                                        <option>Helmets</option>
                                        <option>Riding Gears</option>
                                        <option>Parts</option>
                                        <option>Accessories</option>
                                        <option>Tires</option>
                                    </select>
                                    <?php
                                } else if($type==2){
                                    ?>
                                    <select class="form-control" name="position">
                                        <option> <?=$_GET['position']?></option>
                                        <option>Helmets</option>
                                        <option>Riding Gears</option>
                                        <option>Parts</option>
                                        <option>Accessories</option>
                                        <option>Tires</option>
                                    </select>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="type">Type:</label>
                            <div class="col-sm-6">
                                <?php
                                if ($type == 1) {
                                    ?>
                                    <select class="form-control" name="type">
                                        <option>AGV</option>
                                        <option>SHOEI</option>
                                        <option>LS2</option>
                                        <option>Shark</option>
                                        <option>Bimola</option>
                                        <option>Alpinestar</option>
                                        <option>Dainese</option>
                                        <option>Alpha</option>
                                        <option>KTM</option>
                                        <option>Benelli</option>
                                        <option>Honda</option>
                                        <option>Yamaha</option>
                                        <option>Suzuki</option>
                                        <option>Oil & Fluids</option>
                                        <option>Chain Lubricant</option>
                                        <option>Engine Oil</option>
                                        <option>Exhaust</option>
                                        <option>Toolkit</option>
                                        <option>Pirelli</option>
                                        <option>Dunlop</option>
                                    </select>
                                    <?php
                                } else if($type==2){
                                    ?>
                                    <select class="form-control" name="type">

                                        <option> <?=$_GET['type']?></option>
                                        <option>AGV</option>
                                        <option>SHOEI</option>
                                        <option>LS2</option>
                                        <option>Shark</option>
                                        <option>Bimola</option>
                                        <option>Alpinestar</option>
                                        <option>Dainese</option>
                                        <option>Alpha</option>
                                        <option>KTM</option>
                                        <option>Benelli</option>
                                        <option>Honda</option>
                                        <option>Yamaha</option>
                                        <option>Suzuki</option>
                                        <option>Oil & Fluids</option>
                                        <option>Chain Lubricant</option>
                                        <option>Engine Oil</option>
                                        <option>Exhaust</option>
                                        <option>Toolkit</option>
                                        <option>Pirelli</option>
                                        <option>Dunlop</option>


                                    </select>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="price">price:</label>
                            <div class="col-sm-6">
                                <?php
                                if ($type == 1) {
                                    ?>
                                    <input type="text" class="form-control" name="price" placeholder="Enter price" required>
                                    <?php
                                } else if($type==2){
                                    ?>
                                    <input type="text" class="form-control" name="price"  value="<?=$_GET['price']?>" required>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="inventory">Inventory:</label>
                            <div class="col-sm-6">
                                <?php
                                if ($type == 1) {
                                    ?>
                                    <input type="text" class="form-control" name="inventory" placeholder="Enter inventory" required>
                                    <?php
                                } else if($type==2){
                                    ?>
                                    <input type="text" class="form-control" name="inventory" value="<?=$_GET['inventory']?>" required>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="form-group">

                            <label class="control-label col-sm-2" for="file">Picture:</label>
                            <div class="col-sm-6">
                                <input type="file" name="filename" class="form-control" id="file" />
                            </div>
                        </div>
                        <input type="hidden" name="updateType" value="<?= $type ?>"/>
                        <?php
                        if ($type == 2) {
                            ?>
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>"/>
                            <?php

                        }
                        ?>

                        <!--                        <input type="hidden" name="id" value="--><?//= $_GET['id'] ?><!--"/>-->
                        <div class="form-group" style="float: left; margin-left: 50px;">
                            <div class=" col-sm-2">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>

                    </form>
                    <div class=" col-sm-2" style="float: left;">
                        <a href="admin.php"><button class="btn btn-default">Cancel</button></a>
                    </div>
                </div>
            </div>
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
</body>
<script type="text/javascript">
    $(function () {
        $('#form').validation();//自定义form表单的id
    })
</script>