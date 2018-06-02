$("#sigin-up-form").submit(function(event) {
    event.preventDefault();
    const dataToPost = $(this).serializeArray();

    $.ajax({
        url: "sigin-up.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if(data) {
                $("#sigin-up-alert-success").html(data);
            }
        },
        error: function() {
            $("#sigin-up-alert-danger").html("<div class='alert alert-danger'>There was an error the Ajax Call. Please try again later</div>");
        }
    })
})

$("#login-form").submit(function(event) {
    event.preventDefault();
    const dataToPost = $(this).serializeArray();

    $.ajax({
        url: "login.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if(data == "success") {
                window.location = "my-notes.php";
            } else {
                $("#login-message").html(data);
            }
        },
        error: function() {
            $("#sigin-up-alert-danger").html("<div class='alert alert-danger'>There was an error the Ajax Call. Please try again later</div>");
        }
    })
})