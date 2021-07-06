<?php
include "User.php";
session_start();

$user = unserialize($_SESSION['user']);
if(!isset($_SESSION['user']) || $user->rank !=2)
{
    header('location:index.php');
}
$pageCount = 8;
try {
    $db = new PDO('mysql:host=localhost; dbname=bestbuy_gearmandu', "root", "");
    $rows = $db->query('SELECT COUNT(*) from parts');
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
	<script>
  $(document).ready(function () {
    show(1,5);
    $(".pagination").find("li").each(function() {
            $(this).click(function () {
                var a=$(this).find("a");
                var num=$(a).text();
                show(num,5);
            });
        }
    );

});

function show( num, pageCount){
    $.post("list1.php",{"page":num,"pageCount":pageCount,"type":1},function(data){
        //alert(data);
        var content=$("#show");
        content.empty();
        //content.append(data);
        var arr = eval('(' + data +')');

        //var cont='<table>';
        for(var i=0;i<$(arr).length;i++){
            var cont='<div class="col-sm-3" style="margin-bottom: 10px; alignment: left;font-size: 18px;"><table>';
            cont = cont + '<tr><td><img class="img-rounded" src="items/'+arr[i]['id']+'.jpg"/></td></tr>';
            cont = cont + '<tr><td style="font-size: 16px; font-weight: bold">' + '' + arr[i]['name'] + '</td></tr>';
            cont = cont + '<tr><td style="font-size: 18px;">' + 'Product: '+ arr[i]['position'] + '</td></tr>';
            cont = cont + '<tr><td style="font-size: 18px;">' + 'Product: '+ arr[i]['type'] + '</td></tr>';
            cont = cont + '<tr><td style="font-size: 18px;">' + 'Price: NRs '+ arr[i]['price'] + '</td></tr>';
			cont = cont + '<tr><td style="font-size: 18px;">' + 'Inventory: '+ arr[i]['inventory'] + '</td></tr>';
            cont = cont + '<tr><td><a href="addPart.php?updateType=2&id='+arr[i]['id']+
                '&type='+arr[i]['type']+
                '&name='+arr[i]['name']+
                '&position='+arr[i]['position']+
                '&price='+arr[i]['price']+
				'&inventory='+arr[i]['inventory']+
                '"'+
                '><button type="button" class="btn btn-info btn-block" style="margin-bottom: 5px; ">Update</button></a></td></tr>';
            cont = cont + '<tr><td><a href="delete.php?id='+arr[i]['id']+'"><button type="button" class="btn btn-info btn-block">Delete</button></a></td></tr>';
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
                <li><a href="addPart.php?type=1">Add Part</a></li>
                <li><a href="orderDetail.php">Order Detail</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="login.php?type=2"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<h1 style="text-align: center">Part Lists</h1>
<div class="container-fluid" style= "width: 1140px;text-align:center;">
    <div class="row" >
        <div class="col-sm-17" id="show" >

        </div>
    </div>
    <div class="row">
        <div >
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