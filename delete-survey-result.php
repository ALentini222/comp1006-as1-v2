<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Delete</title>
</head>
<body>
<header>
    <?php
    include 'logged-in-nav.php';
    include 'auth.php';
    try{


    if(is_numeric($_GET['surveyId'])){
        $surveyId = $_GET['surveyId'];
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
            // set up & run the SQL DELETE command
            $sql = "DELETE FROM survey_results WHERE surveyId = :surveyId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':surveyId', $surveyId, PDO::PARAM_INT);
            $cmd->execute();

            // disconnect
            $db = null;
        }
        catch (exception $e){
            header('location:error.php');
        }
    }
    }
    catch (exception $e){
        header('location:error.php');
    }
    ?>
</header>
<main>

</main>