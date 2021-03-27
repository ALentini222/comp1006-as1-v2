<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Login</title>
</head>
<body>
<header>
    <?php
    include 'global-nav.php';
    ?>
</header>
<main>
    <h1>Login</h1>
    <?php
    if (!empty($_GET['invalid'])) {
        echo '<div>Invalid Login</div>';
    }
    else {
        echo '<div>Please enter your username and password</div>';
    }
    ?>
    <form method="post" action="validate.php">
        <fieldset>
            <label for="username" class="survey-login">Username:</label>
            <input name="username" id="username" required type="email" placeholder="login@takesurvey.com" />
        </fieldset>
        <fieldset>
            <label for="password" class="survey-login">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>
        <div>
            <button class="btn btn-primary">Login</button>
        </div>
    </form>

</main>
<?php
include 'footer-nav.php';
?>
</body>
</html>

