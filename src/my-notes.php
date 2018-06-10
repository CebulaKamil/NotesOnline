<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Notes Online-My Notes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">Notes Online</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="list-item"><a href="profile.php">Profile</a></li>
                    <li class="list-item"><a href="#">Help</a></li>
                    <li class="list-item"><a href="#">Contact us</a></li>
                    <li class="list-item active"><a href="mynotes.php">My notes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#siginUp-modal"><span class="glyphicon glyphicon-user"></span> Logged in as <b><?php echo ($_SESSION['userName'])?></b></a></li>
                    <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main -->
    <main class="main">
       <div class="container container-notes">
           <div class="row">
               <div class="col-md-offset-3 col-md-6">
                    <div id="notes-message"></div>
                    <div class="container-buttons">
                       <button class="btn btn-info btn-lg" type="button" id="add-notes">Add Note</button>
                       <button class="btn btn-info btn-lg pull-right" type="button" id="edit">Edit</button>
                       <button class="btn btn-success btn-lg pull-right" type="button" id="done">Done</button>
                       <button class="btn btn-info btn-lg" type="button" id="all-notes">All Notes</button>
                    </div>
                    <div id="notePad">
                        <textarea id="textarea-notes" class="textarea-notes" placeholder="Place your note" rows="10"></textarea>
                    </div>
                    <div id="notes" class="notes"> 
                        <!-- Ajax call to a php file -->
                    </div>
               </div>
           </div>
       </div>
    </main>
    <!-- Footer -->
    <footer class="footer"></footer>
    <!-- Script -->
    <script src="js/script.js"></script>
    <!-- Ajax -->
    <script src="js/notes.js"></script>
</body>
</html>
