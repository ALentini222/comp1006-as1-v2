<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Uploading...</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<header>
    <?php
    include 'logged-in-nav.php';
    ?>
</header>
<main>
    <?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $colour = $_POST['colour'];
    $photo = null;
    $ok = true;
    if(empty(trim($firstname))){
        echo 'Name is required.<br />';
        $ok = false;
    }
    if(empty(trim($lastname))){
        echo 'Last name is required<br />';
        $ok = false;
    }
    if(empty($email)){
        echo 'Email is required<br />';
        $ok = false;
    }
    if(isset($_FILES['photo'])){
        $photo = $_FILES['photo'];

        $photoName = $photo['name'];
        $photoTempName = $photo['tmp_name'];
        $photoSize = $photo['size'];

        $photoExtension = explode('.', $photoName);
        $photoExtension = strtolower(end($photoExtension));

        $photoHasError = $photo['error'];

        $allowedFiles = array('jpg','png','jpeg');
        if(in_array($photoExtension, $allowedFiles)){
            if($photoHasError === 0){
                if($photoSize <= 2097152){
                    $photoUniqueName = uniqid('', true) . '.' . $photoExtension;
                    $photoDestination = 'img/' . $photoUniqueName;
                    if(move_uploaded_file($photoTempName, $photoDestination)){
                        echo "file successfully uploaded";
                    }
                    else{
                        echo"file failed to upload";
                    }
                }
            }
        }
    }
    if($ok) {
        try {
            $user = 'Andreas1141007';
            $database = 'Andreas1141007';
            $password = 'Ye5OchoAsg';
            try {
                $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $password);
            } catch (PDOException $e) {
                echo "Error when connecting to database: " . $e->getMessage();
                die();
            }
            $sql = "INSERT INTO survey_results(firstname, lastname, email, color, photo) VALUES 
                    (:firstname, :lastname, :email, :colour, :photo)";

            $cmd = $db->prepare($sql);
            $cmd->bindParam(':firstname', $firstname, PDO::PARAM_STR, 100);
            $cmd->bindParam(':lastname', $lastname, PDO::PARAM_STR, 100);
            $cmd->bindParam(':email', $email, PDO::PARAM_STR, 100);
            $cmd->bindParam(':colour', $colour, PDO::PARAM_STR, 100);
            $cmd->bindParam(':photo', $photoUniqueName, PDO::PARAM_STR, 100);
            $cmd->execute();
            $db = null;
        } catch (exception $e) {
            header('location:error.php');
        }
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

