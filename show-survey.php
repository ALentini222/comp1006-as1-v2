<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Show Survey</title>
    <style>
        table, td {
            border: 1px solid black;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    <?php
    include 'global-nav.php';
    ?>
</header>
<main>
    <p>to take the survey click <a href="login.php">here</a></p>
    <?php
    try{
    $user = 'Andreas1141007';
    $database = 'Andreas1141007';
    $password = 'Ye5OchoAsg';
    try {
        $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $password);
    } catch (PDOException $e) {
        echo "Error when connecting to database: " . $e->getMessage();
        die();
    }
    echo '<table><thread><th>Firstname</th><th>Colour</th></thread>';
    $sql = "SELECT * FROM survey_results";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':itemID', $itemId, PDO::PARAM_INT);
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $item = $cmd->fetchAll();

    $sqlCount = "SELECT COUNT(*) FROM survey_results";
    $res = $db->query($sqlCount);
    $count = $res->fetchColumn();

    for( $i=0; $i<$count;$i++){
        echo '<tr><td>' . $item[$i]['firstname'] . '</td><td>' . $item[$i]['color'] .'</td></tr>';
    }
    echo '</table>';
    $db = null;
    }
    catch (exception $e){
        header('location:error.php');
    }
    ?>
</main>
<?php
include 'footer-nav.php';
?>
</body>
</html>

