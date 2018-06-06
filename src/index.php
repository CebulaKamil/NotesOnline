<?php
    session_start();

    include('connection.php');

    include('logout.php');

    include('remember.php');
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Notes Online</title>
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
                    <li class="list-item"><a href="#">Home</a></li>
                    <li class="list-item"><a href="#">Help</a></li>
                    <li class="list-item"><a href="#" >Contact us</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#siginUp-modal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main -->
    <main class="main">
        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1>Notes Online</h1>
            <p>Your Notes with you wherever you go</p>
            <p>Easy to use, protect all your notes!</p>
            <button class="jumbotron__button" type="button" data-toggle="modal" data-target="#siginUp-modal">Sigin up - It's free</button>
        </div>

        <!-- Sigin in modal -->
        <div class="modal fade" id="siginUp-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Sigin up today and Start using uor Online Notes App</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div> 
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post" id="sigin-up-form">
                            <div id="sigin-up-alert-success"></div>
                            <div id="sigin-up-alert-danger"></div>
                            <div class="form-group">
                                <label for="email">Username:</label>
                                <input type=" " class="form-control" id="sigin-up-username" placeholder="Enter username" name="sigin-up-username" maxlength="30">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="sigin-up-email" placeholder="Enter email" name="sigin-up-email" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="sigin-up-password" placeholder="Enter password" name="sigin-up-password" maxlength="30">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Confirm password:</label>
                                <input type="password" class="form-control" id="sigin-up-password2" placeholder="Confirm password" name="sigin-up-password2" maxlength="30">
                            </div>
                            <button type="submit" class="btn btn-primary">Sigin up</button>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login modal -->
        <div class="modal fade" id="login-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Login:</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div> 
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="post" id="login-form">
                                <!-- Errors -->
                                <div id="login-message"></div>
                                <div class="form-group">
                                    <label for="email">Username:</label>
                                    <input type="email" class="form-control" id="login-email" placeholder="Enter username" name="login-email">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input type="password" class="form-control" id="login-password" placeholder="Enter password" name="login-password">
                                </div>
                                <div class="form-group form-check">
                                    <input class="form-check-input" type="checkbox" name="remember-me">
                                    <label class="form-check-label">Remember me</label>
                                    <a class="pull-right forgot-link" data-dismiss="modal" data-target="#forgotPassword-modal" data-toggle="modal" >Forgot Password ?</a>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Forgot Password Modal -->
        <div class="modal fade" id="forgotPassword-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Forgot Password? Enter your email adress:</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div> 
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="post">
                                <div class="alert alert-danger"></div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter username" name="email">
                                </div>
                                <button type="submit" class="btn btn-primary">Send password</button>
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
    <script src="js/index.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
