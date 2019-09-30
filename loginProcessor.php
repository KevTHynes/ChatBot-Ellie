<?php
session_start();
require 'config.php';
$message = '';

try {
    $sql = "SELECT * FROM users WHERE (email = :email && password = :password)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', md5($_POST['pwd']));


    if ($stmt->execute()) {
        // Check if email exists, if yes then verify password
        if ($stmt->rowCount() == 1) {

            if ($results = $stmt->fetch()) {

                //assign DB row with variables
                $id = $results['id'];
                $eml = $results['email'];
                $hashedPwd = $results['password'];


                //check if password entered is equal to DB password

                if( md5($_POST['pwd']) == $hashedPwd){

                    //Assign session variables, we will need them later
                    $_SESSION['user'] = $results['id'];
                    $_SESSION['name'] = $results['name'];

                    //Redirect on success
                    header('Location: index.php');
                }
            }
        }
        else{
            //Redirect back with error message
            Header( 'Location: login.php?failure=1' );
        }
    }
} catch (PDOException $e) {
    die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
}

?>