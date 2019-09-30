<?php
session_start();
$message = '';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" content="chrome">
    <title>ChatBot Practical</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="generator" content="Jekyll v3.8.5">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <script type="text/javascript">
        // Form validation code will come here.
        function validateForm() {
            //alert("the validate function has been clicked");
            /*
             *   TODO
             * - JavaScript needs to be added for checking if user exists in DB
             */
            var email = document.getElementById("email").value;
            var password = document.getElementById("pwd").value;

            //validate email address
            if (email == "") {
                document.getElementById("badEmail").style.display = "inline";
                return false;
            } else {
                document.getElementById("badEmail").style.display = "none";
            }

            //validate password
            if (password == "") {
                document.getElementById("badPassword").style.display = "inline";
                return false;
            } else {
                document.getElementById("badPassword").style.display = "none";
            }

            //if all success, pass the job to php code
            document.getElementById("login").submit();
            return true;
        }

        function timedMsg()
        {
            var t=setTimeout("document.getElementById('registerMsg').style.display='none';",4000);
        }
    </script>
</head>

<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" wfd-id="0">
        <header class="masthead mb-auto">
            <div class="inner" wfd-id="2">
                <h3 class="masthead-brand"><img src="images\EllieBotThumb.png" alt="EllieBot" class="img-thumbnail">ChatBot Ellie</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="register.php">Register</a>
                    <a class="nav-link active" href="#">Log In</a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading">Welcome to ChatBot Ellie!</h1>

            <p class="lead">Login here...</p>
            <div id = "registerMsg">
            <?php
                if ( isset($_GET['failure']) && $_GET['failure'] == 1 ){
                    echo "<b><span style=\"color:Red\">Oops, your credentials appear to be wrong, try again?</span></b>";
                }
                else if ( isset($_GET['success']) && $_GET['success'] == 2 ){
                    echo "<b><span style=\"color:Red\">Registration successfull!</span></b>";
                }
            ?>
            </div>
            <script language="JavaScript" type="text/javascript">timedMsg()</script>

            <div id="container" class="container">
                <div class="col-sm-4 offset-sm-3 text-left">
                    <div class="info-form">

                        <form action="loginProcessor.php" method="POST" id="login" class="form-inlin justify-content-center">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <div id="badEmail" class="invalid-feedback" style="display:none;">
                                    <h4>Please enter a valid email address</h4>
                                </div>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <div id="badPassword" class="invalid-feedback" style="display:none;">
                                    <h4>Please enter you password!</h4>
                                </div>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember me</label>
                            </div>
                            <button type="submit" name="submit1" id="submit1" class="btn btn-primary " onclick="event.preventDefault();validateForm()" ;>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer class="mastfoot mt-auto ">
        <div class="inner " wfd-id="1 ">
            <p style="color:black;font-family:courier">&#169; Copyright 2019 - EllieBot</p>
        </div>
    </footer>
    </div>
    <!--[if lt IE 7]>
            <p class="browsehappy ">You are using an <strong>outdated</strong> browser. Please <a href="# ">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <script src=" " async defer></script>
</body>

</html>