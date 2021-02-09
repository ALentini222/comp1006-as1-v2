<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | COMP 1006</title>
<!--basic layout-->
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
</head>
<body>
<?php
//collect variables from user interface
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$colour = $_POST['colour'];
$ok = true;

//simple validation
if(empty(trim($firstname))){
    echo"First Name must be filled ";
    $ok = false;
}

if(empty(trim($lastname))){
    echo"Last Name must be filled ";
    $ok = false;
}
if(empty($email)){
    echo"Email must be filled ";
    $ok = false;
}
if(empty($colour)){
    echo"Colour must be filled ";
    $ok = false;
}

//if validation is ok it stores the player data in the user_input table in the database
if($ok){
    $user = 'Andreas1141007';
    $database = 'Andreas1141007';
    $password = 'Ye5OchoAsg';

    try {
        $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $password);
    } catch (PDOException $e) {
        echo "Error when connecting to database: " . $e->getMessage();
        die();
    }
    echo '<table><thread><th>Firstname</th><th>Lastname</th><th>Email</th><th>Colour</th></thread>';
    $sql = "INSERT INTO user_input(firstname, lastname, email, color) VALUES (:firstname, :lastname, :email, :colour)";

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':firstname', $firstname, PDO::PARAM_STR, 100);
    $cmd->bindParam(':lastname', $lastname, PDO::PARAM_STR, 100);
    $cmd->bindParam(':email', $email, PDO::PARAM_STR, 100);
    $cmd->bindParam(':colour', $colour, PDO::PARAM_STR, 100);

    $cmd->execute();
    //once it is stored it gets displayed
    $sql = "SELECT * FROM user_input";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':itemID', $itemId, PDO::PARAM_INT);
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $item = $cmd->fetchAll();

    $sqlCount = "SELECT COUNT(*) FROM user_input";
    $res = $db->query($sqlCount);
    $count = $res->fetchColumn();

    for( $i=0; $i<$count;$i++){
        echo '<tr><td>' . $item[$i]['firstname'] . '</td><td>' . $item[$i]['lastname'] . '</td><td>' . $item[$i]['email'] . '</td><td>' . $item[$i]['color'] .'</td></tr>';

    }
    echo '</table>';
    $db = null;

}
?>
</body>
</html>



