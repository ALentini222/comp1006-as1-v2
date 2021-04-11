<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Take Survey</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<header>
    <?php
    include 'logged-in-nav.php';
    include 'auth.php';
    ?>
</header>
<main>
    <h1>Take Survey</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="firstname">First name:</label><br>
    <input type="text" id="firstname" name="firstname" required><br>
    <label for="lastname">Last name:</label><br>
    <input type="text" id="lastname" name="lastname" required><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="colour">Favorite Colour of the Rainbow:</label><br>
    <select id="colour" name="colour" required>
        <?php
        try{
        $db = new PDO('mysql:host=172.31.22.43;dbname=Andreas1141007', 'Andreas1141007', 'Ye5OchoAsg');
        $sql = "SELECT * FROM dropdown_list";

        $cmd = $db->prepare($sql);
        $cmd->execute();
        $categories = $cmd->fetchAll();

        foreach ($categories as $c) {
            echo '<option value="' . $c['tabledata_color'] . '">' . $c['tabledata_color'] . '</option>';
        }
        }
        catch (exception $e){
            header('location:error.php');
        }
        ?>
    </select><br>
    <label for="photo">Image Upload:</label>
    <input type="file" name="photo" id="photo" accept=".jpg,.png,.jpeg" /><br>
    <input type="submit" name="submit" value="Submit">
</form>
</main>
<?php
include 'footer-nav.php';
?>
</body>
</html>
