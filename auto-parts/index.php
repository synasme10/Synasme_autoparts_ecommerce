<?php
include "User.php";

session_start();
$pageCount = 8;
try {
    $db = new PDO('mysql:host=localhost;dbname=bestbuy_gearmandu', "root", "");
    $rows = $db->query('SELECT COUNT(*) from parts where inventory > 0');
    if ($rows->rowCount() > 0) {
        $row = $rows->fetch();
        $total = (int)$row[0];
        if ($total % $pageCount == 0) {
            $pageNum = $total / $pageCount;
        } else {
            $pageNum = $total / $pageCount + 1;
        }

    }
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    $db = null;
    die();
}
?>

<head>
    <meta charset="UTF-8">
    <title>BestBuy GearMandu</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/index.css" rel="stylesheet"/>
    <link href="css/footer.css" rel="stylesheet"/>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
	
			width: 497px;
			height:500px;

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
	<script>
	$(document).ready(function () {
    var slides = $("#slide").find("div");
    /*
     function description(num){
     $(".description").text($(slides[num]).find("img").attr("alt"));
     }*/
    $(slides[0]).show();
    //description(0);
    for (var i = 1; i < slides.length; i++) {
        $(slides[i]).hide();
    }
    var now = 0;
    setInterval(function(){
        $(slides[now]).fadeOut();
        if(now==slides.length-1){
            now=0;
        }else{
            now+=1;
        }
        $(slides[now]).fadeIn();
    },4000)
    shows(1,5);
    $(".pagination").find("li").each(function() {
            $(this).click(function () {
                var a=$(this).find("a");
                var num=$(a).text();
                shows(num,5);
            });
        }
    );
    bag();


});

function bag(){
    $.post("bag.php",{},function(data){
        $("#bag").text(data);
    });
}

function cart(id){
    $.post("addCart.php",{"id":id},function(data){
        alert("success add in the cart");
    });
    bag();
}

function shows( num, pageCount){
    $.post("list.php",{"page":num,"pageCount":pageCount,"type":1},function(data){
        //alert(data);
        var content=$("#show");
        content.empty();
        //content.append(data);
        var arr = eval('(' + data +')');

        //var cont='<table>';
        for(var i=0;i<$(arr).length;i++){
            var cont='<div class="col-sm-3"><table>';
            cont = cont + '<tr><td><a href="../auto-parts/singlepart.php?id='+arr[i]['id']+'"><img class="img-rounded" src="items/'+arr[i]['id']+'.jpg"/></a></td></tr>';
            cont = cont + '<tr><td style="font-size: 17px; font-weight: bold">' + arr[i]['name'] + '</td></tr>';
            cont = cont + '<tr><td style="font-size: 18px;">' + arr[i]['position'] + '</td></tr>';
            cont = cont + '<tr><td style="font-size: 18px;">' + arr[i]['type'] + '</td></tr>';
            cont = cont + '<tr><td style="font-size: 18px;">NRs ' + arr[i]['price'] + '</td></tr>';
            cont = cont + '<tr><td><button type="button" class="btn btn-primary btn-block" onclick="cart('+arr[i]['id']+')">Add To Cart</button></td></tr>';
            //cont = cont + '</table>';
            cont = cont + '</table></div>';
            content.append(cont);
        }
        //cont = cont + '</table>';
        //content.append(cont);
    });
}

	</script>
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
        <div class="collapse navbar-collapse" id="myNavbar" ata-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
            <ul class="nav navbar-nav" >
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
            <ul class="nav navbar-nav navbar-right" style ="margin-right: 0px;">
                <li><a href="myCart.php"><span class="glyphicon glyphicon-th-large"></span> My Cart &nbsp;<span id="bag" class="badge">7</span></a></li>

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
										<li><a href="history.php" ><span class="glyphicon glyphicon-tag"></span> History</a></li>
                    <li><a href="login.php?type=2" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>

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

<!--content -->
<div class="container-fluid" style="margin-top: 1px;padding: 0;width: 1080px;">
        <div class="row" style=" margin-left: 5px;" >
            <div class="col-xs-6" ><a href="#shopwell"><img src="img/summer.jpg" height="500px" width="540px" ></a></div>
            <div class="col-xs-6" id="slide" >
                <div> <a href="position.php?position=Helmets"><img src="img/helmet1.jpg"></a></div>
                <div> <a href="position.php?position=Helmets"><img src="img/spin1.jpg" ></a></div>
                <div> <a href="position.php?position=Tires"><img src="img/8.jpg" ></a></div>
                <div> <a href="position.php?position=Riding Gears"><img src="img/10.jpg" ></a></div>

            </div>

        </div>
    <div class="row" style="margin-top: 1px; margin-left: 20px;padding: 0;">

        <a href="position.php?position=Helmets"> <img src="img/helmet.jpg" width="1045px" height="240px"  ></a>
    </div>
    <div class="row" style="margin-top: 1px; margin-left: 10px;">


            <div class="col-xs-6" >
                <iframe width="510px" height="420px" src="https://youtube.com/embed/XOGuoHebGFs?t=3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
            </div>
            <div class="col-xs-6"  style="margin-left: -20px;">
                <iframe width="510px" height="420px" src="https://www.youtube.com/embed/e6-pISJoSfQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
            </div>


    </div>
        <div class="col-sm-12" style="margin-top: 5px;margin-left: 3px;">
            <div class="panel panel-danger">
                <div class="panel-heading" style="color: black;"><strong>Search By Type</div>
                <div class="panel-body">
                    <form class="form" role="form" action="searchType.php" method="get">

                        <div class="form-group">
                            <div class="col-sm-1" style="margin-top: 6px;">
                                <label for="position">Product: </label>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="position">
                                    <option>Helmets</option>
                                    <option>Riding Gears</option>
                                    <option>Parts</option>
                                    <option>Accessories</option>
                                    <option>Tires</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="padding: 0px;">
                            <div class="col-sm-1" style="margin-top: 6px;">
                                <label for="position">Type: </label>
                            </div>
                            <div class="col-sm-3">
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
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    <div id="shopwell"></div>
    <div class="row">
        <div class="col-sm-12" id="show">

        </div>
    </div>
    <div class="row">
        <div class=" col-sm-offset-5">
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= (int)$pageNum; $i++) {
                    ?>
                    <li><a><?= $i ?></a></li>
                    <?php
                }
                ?>
            </ul>

        </div>

    </div>


</div>
<div class="container-fluid " style="padding: 25px;padding-left:100px;color: #adadad; background-color: #212121" >
    <h2 style="font-weight: bold;    font-family: 'Roboto', sans-serif;">BESTBUY GEARMANDU</h2>
    <h6 style="padding-right: 150px; font-size:12px ;    font-family: 'Roboto', sans-serif;">BestBuy Gearmandu is one stop shop solution for your riding needs.</h6>

    <h6 style="padding-right: 150px; font-size:12px ;    font-family: 'Roboto', sans-serif;">BestBuy Gearmandu's goal is bringing the best possible shopping experience to any enthusiast
        who visits us online looking for helmets,
        riding gear, parts, accessories, tires & almost everything else that goes on your person or
        your motorcycle. We also attempt to specialize where it makes sense for certain
        specific riding styles such as Sport Touring, Adventure & Sport Touring & Track Day /
        Racing.
        </h6>

    <h6 style="padding-right: 150px; font-size:12px ;    font-family: 'Roboto', sans-serif;">BestBuy Gearmandu's is not just to carry all of the premium brand motorcycle jackets,
        leathers, protection & armor, motorcycle helmets, tires, boots and gear that a rider of
        any style may need, but to provide the customer service and shopping experience
        that a person would expect from a truly customer-focused store.
        </h6>

<div style="
    background: grey;
    margin-left: 110px;
    alignment: center;
    width: 75%;
    height: 1px;
    left: 0;
    margin-top: 50px;
   color: white"></div>
</div>



<footer class="container-fluid bg-grey py-5" style="height: 270px;background-color: #212121;color: #adadad;">
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

                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"  ></i></a>
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
