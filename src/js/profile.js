$("#update-username-form").submit(function(event) {
    event.preventDefault();
    const dataToPost = $(this).serializeArray();
    $("#update-username-loader").show();
    $("#update-username-button").hide();


    $.ajax ({
        url: "update-username.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if(data) {
                $("#update-username-message").html(data);
                $("#update-username-loader").hide();
                $("#update-username-button").show();
            } else {
                location.reload();
            }
        },
        error: function() {
            $("#update-username-messagee").html("<div class='alert alert-danger'>There was an error the Ajax Call. Please try again later</div>");
            $("#update-username-loader").hide();
            $("#update-username-button").show();
        }
    })
})