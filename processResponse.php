<?php
session_start();
require 'config.php';
$message = '';
/*
This file needs to send the users interpretation of the response to the database. We get all the data that
has been sent using the Ajax query and store them in PHP variables.
 */

if(isset($_SESSION['user'])){
    $userId = $_SESSION['user'];
}
else{
    $userId = 0;
}

$talk = $_POST['query'];
$botChat = $_POST['botChat'];
$evaluation = $_POST['response'];

// Attempt to insert the feedback execution
try{
    //Prepare an insert statement
    $q1 = "INSERT INTO interactions (interactionID, query, response, responsePerception, date, u_Id) VALUES
    (NULL, '$talk', '$botChat', '$evaluation', CURRENT_TIMESTAMP, $userId)";

    //Prepare and execute the statement
    $result = $conn->prepare($q1);
    strip_tags($result);
    $result->execute();
    $message = 'Thank you for your feedback!';
    echo "Feedback inserted successfully.";

} catch(PDOException $e){
    die("ERROR: Could not prepare/execute query: $q1. " . $e->getMessage());
}

// Close statement
unset($result);

// Close connection
unset($conn);
?>