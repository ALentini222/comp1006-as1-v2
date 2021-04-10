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
    <script src="js/scripts.js"></script>
</head>
<body>
<header>
    <?php
    include 'logged-in-nav.php';
    ?>
</header>
<main>
    <p>To take survey click <a href="take-survey.php">here</a></p>
<?php
try{
    //collect variables from user interface
    $user = 'Andreas1141007';
    $database = 'Andreas1141007';
    $password = 'Ye5OchoAsg';
    try {
        $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $password);
    } catch (PDOException $e) {
        echo "Error when connecting to database: " . $e->getMessage();
        die();
    }


    $sql = "SELECT * FROM survey_results";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':itemID', $itemId, PDO::PARAM_INT);
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $item = $cmd->fetchAll();

    echo '<table><thread><th>Firstname</th><th>Lastname</th><th>Email</th><th>Colour</th>';

    if(!empty($_SESSION['username'])){
        echo'<th>Actions</th>';
    }
    echo'</thread>';

    $sqlCount = "SELECT COUNT(*) FROM survey_results";
    $res = $db->query($sqlCount);
    $count = $res->fetchColumn();

    for( $i=0; $i<$count;$i++){
        echo '<tr><td>' . $item[$i]['firstname'] . '</td><td>' . $item[$i]['lastname'] . '</td><td>' . $item[$i]['email'] . '</td><td>' . $item[$i]['color'] .'</td></tr>';
        echo '<td><a href="edit-survey.php?surveyId=' . $item[$i]['surveyId'] . '" class="btn btn-secondary">Edit</a>&nbsp;
                <a href="delete-survey-result.php?surveyId=' . $item[$i]['surveyId'] . '" class="btn btn-danger" title="Delete"
            onclick="return confirmDelete();">Delete</a></td>';
        echo'</tr>';
    }
    echo '</table>';
    $surveyTableId = $item[$i]['surveyId'];
    $_SESSION['surveyItemId'] = $surveyTableId;
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



