$(document).ready(function(){
    var email = localStorage.getItem("email");
    if(!email){
        alert("No user logged in");
        window.location.href = "login.html";
    }
    $("#email").val(email);

    // Fetch profile
    $.ajax({
        url: "php/profile.php",
        type: "POST",
        dataType: "json",
        data: { email: email },
        success: function(res){
            if(res.status === "success" && res.data){
                $("#age").val(res.data.age);
                $("#dob").val(res.data.dob);
                $("#contact").val(res.data.contact);
            }
        }
    });

    $("#profileForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "php/profile.php",
            type: "POST",
            dataType: "json",
            data: {
                email: email,
                age: $("#age").val(),
                dob: $("#dob").val(),
                contact: $("#contact").val()
            },
            success: function(res){
                $("#profileMessage").text(res.message).css("color","green");
            },
            error: function(xhr){
                $("#profileMessage").text("Server error").css("color","red");
                console.log(xhr.responseText);
            }
        });
    });
});
