$(function() {

    const clickOnNotes = function() {
        $(".notes-box").click(function() {
            if(!editMode) {
                activeNote = $(this).attr("id");
                $("#textarea-notes").val($(this).find(".notes-box__header").text());
                showHide([
                    "#notePad",
                    "#all-notes"
                ], [
                    "#notes",
                    "#add-notes",
                    "#edit",
                    "#done"
                ]);
    
                $(".textarea-notes").focus();
            }
        });
    }
    
    let activeNote = 0;
    let editMode = false;

    // Loaded notes
    $.ajax({
        url: "loaded-notes.php",
        success: function(data) {
            $("#notes").html(data);
            clickOnNotes();
        },
        error: function() {
            $("#notes-message").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later!</div>");
        }
    });

    // Functions
    const showHide = function(array1, array2) {
        for(i=0; i<array1.length; i++) {
            $(array1[i]).show();
        };

        for(i=0; i<array2.length; i++) {
            $(array2[i]).hide();
        }
    };


    $("#add-notes").click(function() {
        $.ajax({
            url: "create-note.php",
            success: function(data) {
                if(data == "error") {
                    $("#notes-message").html("<div class='alert alert-danger'>There was an issue inserting the new note in the database!</div>");
                } else {
                    activeNote = data;
                    showHide([
                        "#notePad",
                        "#all-notes"
                    ], [
                        "#notes",
                        "#add-notes",
                        "#edit",
                        "#done"
                    ]);

                    $(".textarea-notes").focus();
                }
            },
            error: function() {
                $("#notes-message").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later!</div>");
            }
        });
    });

    $("#textarea-notes").keyup(function() {
        $.ajax({
            url: "update-notes.php",
            type: "POST",
            data: {note: $(this).val(), id: activeNote},
            success: function(data) {
                if(data == "error") {
                    $("#notes-message").html("<div class='alert alert-danger'>There was an issue updating the note in the database!");
                }
            },
            error: function() {
                $("#notes-message").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later!</div>");
            }
        });
    });

    $("#all-notes").click(function() {
        $.ajax({
            url: "loaded-notes.php",
            success: function(data) {
                $("#notes").html(data);
                showHide([
                    "#notes",
                    "#add-notes",
                    "#edit"
                ], [
                    "#notePad",
                    "#all-notes"
                ]);
                clickOnNotes();
            },
            error: function() {
                $("#notes-message").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later!</div>");
            }
        });
    });

});