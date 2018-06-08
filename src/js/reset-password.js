$("#password-reset-form").submit(function(event){ 
    event.preventDefault();
    const datatopost = $(this).serializeArray();
    $("#qwe").hide();

    $.ajax({
        url: "store-reset-password.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            $('#forgot-message').html(data);
        },
        error: function(){
            $("#forgot-message").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });

});           