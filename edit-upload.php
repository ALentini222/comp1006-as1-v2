<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Uploading...</title>

</head>
<body>
<header>
    <?php
    include 'logged-in-nav.php';
    ?>
</header>
<main>
    <?php
            try {
                //collect variables from user interface
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $colour = $_POST['colour'];
                $surveyId = $_POST['surveyId'];
                echo $firstname,$lastname,$email,$colour,$surveyId;
                $user = 'Andreas1141007';
                $database = 'Andreas1141007';
                $password = 'Ye5OchoAsg';
                try {
                    $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $password);
                } catch (PDOException $e) {
                    echo "Error when connecting to database: " . $e->getMessage();
                    die();
                }
                $sql = "UPDATE user_input SET firstname = :firstname, lastname = :lastname, email = :email, colour = :colour WHERE surveyId = :surveyId";

                $cmd = $db->prepare($sql);
                $cmd->bindParam(':firstname', $firstname, PDO::PARAM_STR, 100);
                $cmd->bindParam(':lastname', $lastname, PDO::PARAM_STR, 100);
                $cmd->bindParam(':email', $email, PDO::PARAM_STR, 100);
                $cmd->bindParam(':colour', $colour, PDO::PARAM_STR, 100);
                $cmd->bindParam(':surveyId', $surveyId, PDO::PARAM_STR, 100);

                $cmd->execute();
                $db = null;
            } catch (exception $e) {
                header('location:error.php');
    }
    ?>
    <!-- Insert thank you for taking survey and ass link to see results -->
    <h1>Thank you for taking the survey</h1>
    <p>see the results <a href="show-detailed-survey.php" title="Show Survey">here</a></p>
</main>
<?php
include 'footer-nav.php';
?>
</body>
</html>

