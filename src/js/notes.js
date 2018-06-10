$(function() {

    let activeNote = 0;
    let editMode = false;

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

    // Loaded notes
    $.ajax({
        url: "loaded-notes.php",
        success: function(data) {
            $("#notes").html(data);
            clickOnNotes();
            clickOnDelete();
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
                clickOnDelete();
            },
            error: function() {
                $("#notes-message").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later!</div>");
            }
        });
    });

    $("#edit").click(function() {
        editMode = true;
        showHide([
            "#done",
            ".note-delete"
        ], [
            "#edit"
        ]);

    });

    const clickOnDelete = function() {
        $(".note-delete").click(function() {

            const deleteButton = $(this);

            $.ajax({
                url: "delete-note.php",
                type: "POST",
                data: {id: deleteButton.next().attr("id")},
                success: function(data) {
                    if(data == "error") {
                        $("#notes-message").html("<div class='alert alert-danger'>There was an issue delete the note from the database!");
                    } else {
                        deleteButton.parent().remove();
                    }
                },
                error: function(){
                    $("#notes-message").html("There was an error with the Ajax Call. Please try again later.");
                }
            });
        });
    };


    $("#done").click(function() {
        editMode = false;
        showHide([
            "#edit"
        ], [
            "#done",
            ".note-delete"
        ])
    })
    
});