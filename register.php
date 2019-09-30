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
    <link href="css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

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
            var nName = document.getElementById("name").value;
            var username = document.getElementById("uName").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("pwd").value;
            var cPassword = document.getElementById("cPwd").value;
            var mailEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var passEx = /^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,8}$/;
            /*
            /^[a-z0-9]+$/i

            ^         start of string
            [a-z0-9]  a or b or c or ... z or 0 or 1 or ... 9
            +         one or more times (change to * to allow empty string
            $         end of string

            /i        case-insensitive
            */
            var userEx = /^[a-z0-9]+$/i;
            //alert("the name is : "+nName);

            //validate name
            if (nName == "") {
                document.getElementById("noName").style.display = "inline";
                return false;
            } else {
                document.getElementById("noName").style.display = "none";
            }

            //validate username
            if (!(userEx.test(username))) {
                document.getElementById("badUname").style.display = "inline";
                return false;
            } else {
                document.getElementById("badUname").style.display = "none";
            }

            //validate email address
            if (!(mailEx.test(email))) {
                document.getElementById("badEmail").style.display = "inline";
                return false;
            } else {
                document.getElementById("badEmail").style.display = "none";
            }

            //validate password
            if (!(passEx.test(password))) {
                document.getElementById("badPassword").style.display = "inline";
                return false;
            } else {
                document.getElementById("badPassword").style.display = "none";
            }

            //check if passwords match
            if (cPassword !== password) {
                document.getElementById("pwdNotEqual").style.display = "inline";
                return false;
            } else {
                document.getElementById("pwdNotEqual").style.display = "none";
            }

            document.getElementById("register").submit();
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
                    <a class="nav-link active" href="#">Register</a>
                    <a class="nav-link" href="login.php">Log In</a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading">Welcome to ChatBot Ellie!</h1>
            <p class="lead">Register here...</p>
            <div id = "registerMsg">
            <?php
                if ( isset($_GET['failure']) && $_GET['failure'] == 1 ){
                    echo "<b><span style=\"color:Red\">Oops, something appear went wrong, try again?</span></b>";
                }
            ?>
            </div>
            <script language="JavaScript" type="text/javascript">timedMsg()</script>

            <div id="container" class="container">
                <div class="col-sm-4 offset-sm-3 text-left">
                    <div class="info-form">
                        <form id="register" method="POST" action="registerProcessor.php" class="form-inlin justify-content-center">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <div id="noName" class="invalid-feedback" style="display:none;">
                                    <h4>Please enter your name!</h4>
                                </div>
                                <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <div id="badUname" class="invalid-feedback" style="display:none;">
                                    <h4>Please enter a username</h4>
                                </div>
                                <input type="username" class="form-control" id="uName" placeholder="Enter username" name="username">
                            </div>
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
                                    <h4>Password should have at least 1 number, one letter and between 6 and 8 characters!</h4>
                                </div>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Confirm Password:</label>
                                <div id="pwdNotEqual" class="invalid-feedback" style="display:none;">
                                    <h4>Passwords do not match!</h4>
                                </div>
                                <input type="password" class="form-control" id="cPwd" placeholder="Confirm password" name="cPwd">
                            </div>
                            <button type="submit" id="submit1" name="submit1" class="btn btn-primary " onclick="event.preventDefault();validateForm()" ;>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer class="mastfoot mt-auto">
            <div class="inner" wfd-id="1">
                <p style="color:black;font-family:courier">&#169; Copyright 2019 - EllieBot</p>
            </div>
        </footer>
    </div>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <script src="" async defer></script>
</body>

</html>