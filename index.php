<?php
session_start();
require 'config.php';
$message = '';

$user = $_SESSION['name'];
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ChatBot Practical</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <meta name="generator" content="Jekyll v3.8.5">
        <link href="css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link href="css/response.css" rel="stylesheet">
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
        <script>

        var emptyCount = 0;
        var botChat;

        function rate(){
            var rate_value;
            if(document.getElementById('great').checked){
                rate_value = "great";
            }
            else if(document.getElementById('undecided').checked){
                rate_value = "undecided";
            }
            else if(document.getElementById('terrible').checked){
                rate_value = "terrible";
            }
            else{
                rate_value = "Not";
            }

            var query = document.getElementById('talk').value;
            alert("The query was : " + query);
            alert("Ellie's response was : " + botChat);
            alert("The rating was : " + rate_value);

            $.ajax({
                url: 'processResponse.php',
                type: 'post',
                data: {query: query, botChat: botChat, response: rate_value},
                async: false,
                success: function(data)
                {
                    botChat = data;
                    if(data){
                        document.getElementById("evaluate").style.display = "none";
                        document.getElementById('ellie').innerHTML = "<h2><b>Ellie: </b>Thankyou for your response, it helps me learn!</h2>";
                    }
                    else{
                        document.getElementById('ellie').innerHTML = "<h2><b>Ellie: </b>Im sorry, I could not process that repsonse!</h2>";
                    }
                },
                cache: false
            });
        }
            /*
            if (document.createElement("input").webkitSpeech === undefined) {
	            alert("Speech input to talk to Ellie is not supported in your browser. Type to talk to Ellie instead!");
            } else{
                alert("Speak to Ellie!");
            }
            */
        function callEllie(){
            var text = document.getElementById('talk').value;
            if(!text){
                if(emptyCount == 0){
                    document.getElementById('ellie').innerHTML =  "<h2>You need to say something first</h2><br />";
                }
                else if(emptyCount ==1){
                    document.getElementById('ellie').innerHTML = "<h2>Whats wrong with you?</h2><br />";
                }
                else if(emptyCount == 2){
                    document.getElementById('ellie').innerHTML = "<h2>If you send another blank message I will deactive the chat button.</h2><br />";
                } else{
                    document.getElementById('ellie').innerHTML = "<h2>Thats your fault. Goodbye!</h2><br />";
                    document.getElementById('chat').style.display ="none";
                }
                emptyCount ++;
            }
            else{
                $.ajax({
                    url: 'queryBot.php',
                    type:'post',
                    data: {text: text},
                    async: false,
                    success: function(data)
                    {
                        if(data !="problems"){
                            botChat = data;
                            document.getElementById('ellie').innerHTML = "<h2><b>Ellie:</b> "+data+"</h2><br />";
                            document.getElementById("evaluate").style.display = "inline";
                            document.getElementById('talk').value = '';
                        }
                        else{
                            botchat = data;
                            document.getElementById('ellie').innerHTML = "<h2><b>Ellie:</b> Im sorry, I dont quite understand what you're trying to say? </h2><br />";
                            document.getElementById("evaluate").style.display = "none";
                            document.getElementById('talk').value = '';
                        }
                    },
                    cache: false
                });
            }
        }
        </script>
    </head>
    <body class="text-center">
    <div id="container" class="container">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" wfd-id="0">
        <header class="masthead mb-auto">
        <div class="inner" wfd-id="2">
        <h3 class="masthead-brand"><img src="images\EllieBotThumb.png" alt="EllieBot" class="img-thumbnail">ChatBot Ellie</h3>

        <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="#">Home</a>

            <?php if(isset($_SESSION['name'])): ?>
            <a class="nav-link" href="logout.php">Logout</a>

            <?php else: ?>

            <a class="nav-link" href="register.php">Register</a>
            <a class="nav-link" href="login.php">Log In</a>

            <?php endif; ?>

        </nav>
        </div>
        </header>

        <main role="main" class="inner cover">
        <br/>
        <br/>
        <div id="evaluate" class="rateResponse" style="display:none">
            <h2>Please rate my response</h2>
            <label class="radio-inline"><input type="radio" id="great" name="optradio">Greate Response</label>
            <label class="radio-inline"><input type="radio" id="undecided" name="optradio">Im not sure</label>
            <label class="radio-inline"><input type="radio" id="terrible" name="optradio">Terrible Response</label>
            <input id="chat" type="submit" class="btn btn-success" onclick="rate()" value="Rate">
            <hr>
            <p style="color:black;font-family:courier" >&#169; Copyright 2019 - EllieBot</p>
        </div>
        <br/>
        <br/>
        <div id="ellie">
            <?php if(isset($_SESSION['name'])):
                echo "<h2><b>Ellie:</b>  What do you want " . $user . "?</h2>";
            ?>
            <?php else: ?>
                <h2><b>Ellie:</b>  What do you want?</h2>
            <?php endif; ?>
        </div>
        <br/>
        <input id="talk" type="textarea" class="tb5" name="searchterm"  placeholder="Type to talk to me">
        <input id="chat" type="submit" class="btn btn-secondary" onclick="callEllie()" value="Chat">
        <br/>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner" wfd-id="1">
                <br/>
                <p style="color:black;font-family:courier" >&#169; Copyright 2019 - EllieBot</p>
            </div>
        </footer>
        </div>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <script src="" async defer></script>
    </body>
</html>