<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Notes Online-Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profileStyle.css">
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
                    <li class="list-item active"><a href="profile.php">Profile</a></li>
                    <li class="list-item"><a href="#">Help</a></li>
                    <li class="list-item"><a href="#">Contact us</a></li>
                    <li class="list-item"><a href="mynotes.php">My notes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#siginUp-modal"><span class="glyphicon glyphicon-user"></span> Logged in as <b>Admin</b></a></li>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main -->
    <main class="main">
       <div class="container container-profile">
           <div class="row">
               <div class="col-md-offset-3 col-md-6">
                    <h2>General Account Setting</h2>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-condensed table-bordered">
                            <tr data-target="#update-username-modal" data-toggle="modal">
                                <td>Username</td>
                                <td>value</td>
                            </tr>
                            <tr data-target="#update-email-modal" data-toggle="modal">
                                <td>Email</td>
                                <td>Value</td>
                            </tr>
                            <tr data-target="#update-password-modal" data-toggle="modal">
                                <td>Password</td>
                                <td>Value</td>
                            </tr>
                        </table>
                    </div>
               </div>
           </div>
       </div>

        <!-- Update username modal-->
        <div class="modal fade" id="update-username-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Username:</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div> 
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post">
                            <div class="alert alert-danger"></div>
                            <div class="form-group">
                                <label for="email">Username:</label>
                                <input type="email" class="form-control" id="email" value="Username" name="email">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update email modal-->
        <div class="modal fade" id="update-email-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Enter new email:</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div> 
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post">
                            <div class="alert alert-danger"></div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" value="value@email.com" name="email">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update password modal-->
        <div class="modal fade" id="update-password-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Enter Current and New password:</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div> 
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post">
                            <div class="alert alert-danger"></div>
                            <div class="form-group">
                                <label for="email">Your Current Password</label>
                                <input type="email" class="form-control" id="email" placeholder="Password" name="email">
                            </div>
                            <div class="form-group">
                                <label for="email">Choose new password</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter new password" name="email">
                            </div>
                            <div class="form-group">
                                <label for="email">Confirm new password</label>
                                <input type="email" class="form-control" id="email" placeholder="Confirm new password" name="email">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    <!-- Footer -->
    <footer class="footer"></footer>
    <!-- Script -->
    <script src="js/script.js"></script>
</body>
</html>
