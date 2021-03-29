<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Edit</title>
</head>
<body>
<header>
<?php
include 'logged-in-nav.php';
include 'auth.php';
$surveyId = $_GET['surveyId'];
$item = null;
$item['firstname'] = null;
$item['lastname'] = null;
$item['email'] = null;
$item['colour'] = null;
$item['surveyId'] = $surveyId;
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
            $sql = "SELECT * FROM items WHERE surveyId = :surveyId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':surveyId', $surveyId, PDO::PARAM_INT);
            $cmd->execute();
            $item = $cmd->fetch();

        } catch (exception $e) {
            header('location:error.php');
}

?>
    <form action="edit-upload.php" method="post">
    <label for="firstname">First name:</label><br>
    <input type="text" id="firstname" name="firstname" required value="<?php echo $item['firstname'];?>"><br>
    <label for="lastname">Last name:</label><br>
    <input type="text" id="lastname" name="lastname" required value="<?php echo $item['lastname'];?>"><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required value="<?php echo $item['email'];?>"><br>
        <label for="colour">Favorite Colour of the Rainbow:</label><br>
        <select id="colour" name="colour">';
        <?php
        try{
                $sql = "SELECT * FROM dropdown_list";

                $cmd = $db->prepare($sql);
                $cmd->execute();
                $categories = $cmd->fetchAll();
                foreach ($categories as $c) {
                    echo '<option value="' . $c['tabledata_color'] . '">' . $c['tabledata_color'] . '</option>';
                }
                $db = null;
        } catch (exception $e) {
                header('location:error.php');
        }
            ?>
        </select><br><br>
        <input type="hidden" name="surveyId" id="surveyId" value="<?php echo $item['surveyId'];?>" />
        <input type="submit" value="Submit">
    </form>
</header>
</body>
</html>