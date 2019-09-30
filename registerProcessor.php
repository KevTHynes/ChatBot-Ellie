<?php
require 'config.php';
$message = '';

try {
    //preparing the query for inserting the submitted data into the database
    $sql = "INSERT INTO users (name, username, email, password) VALUES(:name, :username, :email, :password)";
    $stmt = $conn->prepare($sql);

    //Bind parameters to statement
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', md5($_POST['pwd']));

    if ($stmt->execute()) {
        header('Location: login.php?success=2');
    } else {
        header('Location: register.php?failure=1');
    }

} catch (PDOException $e) {
    die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
}
// Close statement
unset($stmt);

// Close connection
unset($conn);

?>