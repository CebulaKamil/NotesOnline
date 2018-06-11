$("#sigin-up-form").submit(function(event) {
    event.preventDefault();
    const dataToPost = $(this).serializeArray();
    $("#sigin-in-loader").show();
    $("#sigin-in-button").hide();


    $.ajax ({
        url: "sigin-up.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if(data) {
                $("#sigin-up-message").html(data);
                $(".loader").hide();
                $("#sigin-in-button").show();
            }
        },
        error: function() {
            $("#sigin-up-message").html("<div class='alert alert-danger'>There was an error the Ajax Call. Please try again later</div>");
            $("#sigin-in-loader").hide();
            $("#sigin-in-button").show();
        }
    })
})

$("#login-form").submit(function(event) {
    event.preventDefault();
    const dataToPost = $(this).serializeArray();
    $("#login-loader").show();
    $("#login-button").hide();

    $.ajax ({
        url: "login.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if(data == "success") {
                window.location = "my-notes.php";
            } else {
                $("#login-message").html(data);
                $("#login-loader").hide();
                $("#login-button").show();
            }
        },
        error: function() {
            $("#login-message").html("<div class='alert alert-danger'>There was an error the Ajax Call. Please try again later</div>");
            $("#login-loader").hide();
            $("#login-button").show();
        }
    })
})

$("#forgotPassword-form").submit(function(event) {
    event.preventDefault();
    const dataToPost = $(this).serializeArray();
    $("#forgot-loader").show();
    $("#forgot-button").hide();

    $.ajax ({
        url: "forgot-password.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            $("#forgot-message").html(data);
            $("#forgot-loader").hide();
            $("#forgot-button").show();
        },
        error: function() {
            $("#forgot-message").html("<div class='alert alert-danger'>There was an error the Ajax Call. Please try again later</div>");
            $("#forgot-loader").hide();
            $("#forgot-button").show();
        }
    })
})