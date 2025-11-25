$(document).ready(function(){
    $("#loginForm").submit(function(e){
        e.preventDefault();
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            url: "php/login.php",
            type: "POST",
            dataType: "json",
            data: { email: email, password: password },
            success: function(response){
                if(response.status === "success"){
                    localStorage.setItem("email", email);
                    window.location.href = "profile.html";
                } else {
                    $("#loginMessage").text(response.message).css("color","red");
                }
            },
            error: function(xhr){
                $("#loginMessage").text("Server error — check console").css("color","red");
                console.log(xhr.responseText);
            }
        });
    });
});
