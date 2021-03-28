<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Take Survey</title>
</head>
<body>
<header>
    <?php
    include 'logged-in-nav.php';
    include 'auth.php';

    $surveyItem = null;
    $surveyItem['firstname'] = null;
    $surveyItem['lastname'] = null;
    $surveyItem['email'] = null;
    $surveyItem['colour'] = null;

    ?>
</header>
<main>
<h2>Basic Information Survey</h2>
<form action="upload.php" method="post">
    <label for="firstname">First name:</label><br>
    <input type="text" id="firstname" name="firstname"><br>
    <label for="lastname">Last name:</label><br>
    <input type="text" id="lastname" name="lastname"><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="colour">Favorite Colour of the Rainbow:</label><br>
    <select id="colour" name="colour">
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
    </select><br><br>
    <input type="hidden" name="surveyId" id="surveyId" value="<?php echo $surveyItem['surveyId']; ?>" />
    <input type="submit" value="Submit">
</form>
</main>
<?php
include 'footer-nav.php';
?>
</body>
</html>
