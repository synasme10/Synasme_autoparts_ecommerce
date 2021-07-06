
$(document).ready(function () {
    var position=$("#position").text();
    var t=$("#t").text();
    //alert(name);
    show(1,5,position,t);
    $(".pagination").find("li").each(function() {
            $(this).click(function () {
                var a=$(this).find("a");
                var num=$(a).text();
                show(num,5,position,t);
            });
        }
    );
    bag();

});

function show( num, pageCount,position,t){
    $.post("list.php",{"page":num,"pageCount":pageCount,"position":position,"t":t,"type":4},function(data){
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
            cont = cont + '<tr><td style="font-size: 18px;"> Product: ' + arr[i]['position'] + '</td></tr>';
            cont = cont + '<tr><td style="font-size: 18px;"> Type: ' + arr[i]['type'] + '</td></tr>';
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