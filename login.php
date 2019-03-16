<?php

/* ---------------------------------------------------------------------------
* filename    : login.php
* author      : Spencer Huebler-Davis, shuebler@svsu.edu
* description : This program presents a login screen for the user
* ---------------------------------------------------------------------------
*/

session_start();

// include the class that handles database connections
require_once '../database.php';

// create error messages for invalid credentials
if($_GET) $errorMessage = $_GET['errorMessage'];
else $errorMessage = '';

if($_POST) {
    // declare variables
    $success = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // grab data from customer database
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customer WHERE email = '$username' AND passwordhash = '$password' LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    
    // log user in if credentials are correct, display error if incorrect
    if($data) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
    }
    else {
        header("Location: login.php?errorMessage=Invalid Credentials");
        exit();
    }
}
// else just show empty login form
?>
<h1>Log In</h1>

<form class="form-horizontal" action="login.php" method="post">
    
    <input name="username" type="text" placeholder="me@email.com" required>
    <input name="password" type="password" required>
    <button type="submit" class="btn btn-success">Sign In</button>
    
</form>

<form action="create2.php">
    <input type="submit" class="btn btn-success" value="Join"/>
</form>

<a href='logout.php'>Log Out</a>
    
<p style='color: red;'><?php echo $errorMessage; ?></p>