
$(document).ready(function()
{
    $("#register_chk").click(function()
    {
        var users=$('#users').val();
        var phone=$('#phone').val();
        var address=$('#address').val();
        var password = $('#password_r').val();
        var password_chk = $('#c_password').val();
        var id= $('#id').val();
        var rank = $("rank").val();
        var email = $('#email').val();
        if(users == "")
        {
            $('#errorinfo').text('Please enter full name.');
        }
        else if(phone == "")
        {
            $('#errorinfo').text('Please enter phone number.');
        }
        else if(address == "")
        {
            $('#errorinfo').text('Please enter Address.');
        }
        else if(email == "")
        {
            $('#errorinfo').text('Please enter email.');
        }
        else if (password == "")
        {
            $('#errorinfo').text('Please enter password.');
        }
        else if (!phone.match(/[789][0-9]{9}/))
        {
            $('#errorinfo').text('Please enter valid phone.');
        }
        else if (!email.match("@"))
        {
            $('#errorinfo').text('Please enter valid email.');
        }
        else if (!password.match(/[A-Za-z]/) || !password.match(/[0-9]/) || !password.length > 7)
        {
            $('#errorinfo').text('Please enter valid password. Must contain one or more uppercase letters and lowercase letters, and at least 8 letters.');
        }
        else if (password != password_chk)
        {
            $('#errorinfo').text('Please confirm your password again.');
        }
        else
        {
            $.ajax(
                {
                    url:"accountUpdate.php",
                    data: " password=" + password +"&users="+ users +"&phone=" +phone+ "&address=" +address+ "& email=" + email +"&id="+id +"&rank=" +rank,
                    type : "POST",
                    success:function(msg)
                    {
                        if(msg == "success")
                        {
                            window.alert("Updated successfully");
                            window.location.href="../auto-parts/account.php";

                        }
                    },
                    error:function(xhr)
                    {
                        alert('Ajax request 發生錯誤');
                    },
                    complete:function()
                    {

                    }
                });
        }
    });
    bag();
});
function bag(){
    $.post("bag.php",{},function(data){
        $("#bag").text(data);
    });
}