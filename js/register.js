$(document).ready(function(){
    $("#registerForm").submit(function(e){
        e.preventDefault();
        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            url: "php/register.php",
            type: "POST",
            dataType: "json",
            data: { username: username, email: email, password: password },
            success: function(response){
                if(response.status === "success"){
                    $("#registerMessage").text(response.message).css("color","green");
                    setTimeout(function(){ window.location.href = "login.html"; }, 1500);
                } else {
                    $("#registerMessage").text(response.message).css("color","red");
                }
            },
            error: function(xhr){
                $("#registerMessage").text("Server error — check console").css("color","red");
                console.log(xhr.responseText);
            }
        });
    });
});
