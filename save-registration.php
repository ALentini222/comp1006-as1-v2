<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Registering...</title>
</head>
<body>
<?php
include 'global-nav.php';
try{
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

if (empty($username)) {
    echo 'Username required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

if ($ok) {
    $user = 'Andreas1141007';
    $database = 'Andreas1141007';
    $password = 'Ye5OchoAsg';
    try {
        $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $password);
    } catch (PDOException $e) {
        echo "Error when connecting to database: " . $e->getMessage();
        die();
    }
        $sql = "SELECT userId FROM users WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
        $cmd->execute();
        $user = $cmd->fetch();

        if ($user) {
            echo '<p class="alert alert-danger">User already exists</p>';
        }
        else {
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $cmd = $db->prepare($sql);

            $password = password_hash($password, PASSWORD_DEFAULT);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
            $cmd->execute();
            echo '<h1>Registration Saved</h1><p>Click <a href="login.php">Login</a> to enter the site</p>';
        }
        $db = null;
}
}
catch (exception $e){
    header('location:error.php');
}
include 'footer-nav.php';
?>
</body>
</html>
