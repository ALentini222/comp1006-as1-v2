<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Validate</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<?php
try{
$username = $_POST['username'];
$password = $_POST['password'];

$user = 'Andreas1141007';
$database = 'Andreas1141007';
$password = 'Ye5OchoAsg';
try {
    $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $password);
} catch (PDOException $e) {
    echo "Error when connecting to database: " . $e->getMessage();
    die();
}

$sql = "SELECT * FROM users WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
$cmd->execute();
$user = $cmd->fetch();

    if (!$user) {
        $db = null;
        header('location:login.php?invalid=true');
    }
    else {
        if (password_verify($password, $user['password'])) {
            session_start();

            $_SESSION['username'] = $username;

            $db = null;
            header('location:logged-in-home.php');
        }
        else {
            $db = null;

            header('location:login.php?invalid=true');
        }
    }
}
catch (exception $e){
    header('location:error.php');
}
?>