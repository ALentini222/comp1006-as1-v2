<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | COMP 1006</title>

</head>
<!--user interface input the full name, email and favorite colour-->

<body>
<h2>Basic Information Survey</h2>
<form action="database-upload.php" method="post">
    <label for="firstname">First name:</label><br>
    <input type="text" id="firstname" name="firstname"><br>
    <label for="lastname">Last name:</label><br>
    <input type="text" id="lastname" name="lastname"><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="colour">Favorite Colour of the Rainbow:</label><br>
    <select id="colour" name="colour">
        <?php
        $db = new PDO('mysql:host=172.31.22.43;dbname=Andreas1141007', 'Andreas1141007', 'Ye5OchoAsg');
        $sql = "SELECT * FROM dropdown_list";

        $cmd = $db->prepare($sql);
        $cmd->execute();
        $categories = $cmd->fetchAll();

        foreach ($categories as $c) {
            echo '<option value="' . $c['tabledata_color'] . '">' . $c['tabledata_color'] . '</option>';
        }
        ?>
    </select><br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
