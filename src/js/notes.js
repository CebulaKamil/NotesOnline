$(function() {
    $.ajax({
        url: "loaded-notes.php",
        success: function(data) {
            $("#notes").html(data);
        }
    });
});