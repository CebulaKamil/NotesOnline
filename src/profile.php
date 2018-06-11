<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("location: index.php");
    }

    include('connection.php');
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = mysqli_query($link, $sql);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $username = $row['userName'];
        $email = $row['userEmail'];
    } else {
        echo "There was an error retrieving the username and email from the database!";
    }
?>
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
                    <li class="list-item"><a href="my-notes.php">My notes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#siginUp-modal"><span class="glyphicon glyphicon-user"></span> Logged in as <b><?php echo $username ?></b></a></li>
                    <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
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
                                <td><?php echo $username?></td>
                            </tr>
                            <tr data-target="#update-email-modal" data-toggle="modal">
                                <td>Email</td>
                                <td><?php echo $email?></td>
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
                        <form method="post" id="update-username-form">
                            <div id="update-username-message"></div>
                            <div class="form-group">
                                <label for="update-username">Username:</label>
                                <input type="text" class="form-control" id="update-username-value" value="<?php echo $username?>" name="update-username-value">
                            </div>
                            <button id="update-username-button"type="submit" class="btn btn-primary">Submit</button>
                            <div class="loader" id="update-username-loader"></div>
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
                        <form method="post" id="update-email-modal">
                            <div class="update-email-message"></div>
                            <div class="form-group">
                                <label for="update-email-value">Email:</label>
                                <input type="email" class="form-control" id="update-email-value" value="<?php echo ($_SESSION['userEmail'])?>" name="email">
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
                        <form method="post" id="update-password-form">
                            <div id="update-password-message"></div>
                            <div class="form-group">
                                <label for="update-password-current">Your Current Password</label>
                                <input type="password" class="form-control" id="update-password-current" placeholder="Password" name="update-password-current">
                            </div>
                            <div class="form-group">
                                <label for="update-password-new">Choose new password</label>
                                <input type="password" class="form-control" id="update-password-new" placeholder="Enter new password" name="update-password-new">
                            </div>
                            <div class="form-group">
                                <label for="update-password-new-2">Confirm new password</label>
                                <input type="password" class="form-control" id="update-password-new-2" placeholder="Confirm new password" name="update-password-new-2">
                            </div>
                            <button id="update-password-button" type="submit" class="btn btn-primary">Submit</button>
                            <div class="loader" id="update-password-loader"></div>
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
    <script src="js/profile.js"></script>
</body>
</html>
