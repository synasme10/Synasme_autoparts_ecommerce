<?php
include "User.php";
session_start();

$user = unserialize($_SESSION['user']);
if(!isset($_SESSION['user']) )
{
    header('location:index.php');
}
?>

<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/footer.css" rel="stylesheet"/>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/account.js"></script>

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
    </style>

</head>
<body>
<!-- header-->
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
                <li><a href="myCart.php"><span class="glyphicon glyphicon-th-large"></span> My Cart &nbsp;<span id="bag"
                                                                                                                class="badge">9</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid" style= "width: 1300px;text-align:center;">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-offset-2 col-sm-5" style="margin-top: 10px;">
            <div class="panel panel-primary">

                <div class="panel-heading">Your Account</div>


                <div class="panel-body">
                    <div id="registerForm">
                        <span id="errorinfo"></span>
                        <!--action="php/login_chk.php" method="post"-->
                        <input type="hidden" value="<?=$user->id?>" id="id"/>
                        <input type="hidden" value="<?=$user->rank?>" id="rank"/>
                        <div class="form-group">
                            <label for="email">Name :</label>
                            <input type="text" name="users" class="form-control" value="<?=$user->users?>" id="users" >
                        </div>
                        <div class="form-group">
                            <label for="email">Phone Number :</label>
                            <input type="text" name="phone" class="form-control" value="<?=$user->phone?>" id="phone" >
                        </div>
                        <div class="form-group">
                            <label for="email">Address :</label>
                            <input type="text" name="address" class="form-control"  value="<?=$user->address?>" id="address" >
                        </div>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="text" class="form-control" value="<?=$user->email?>" id="email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="text" name="" class="form-control" value="<?=$user->password?>" id="password_r">
                        </div>
                        <div class="form-group">
                            <label for="c_password">Confirm Password: </label>
                            <input type="text" name="c_password" class="form-control" value="<?=$user->password?>" id="c_password">
                        </div>
                        <div class="col-sm-offset-0">
                            <input type="submit" name="submit" class="btn btn-success" value="Update"
                                   id="register_chk">
                        </div>
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
</body>
