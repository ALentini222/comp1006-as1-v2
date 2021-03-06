<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Assignment 1 V2 | Login</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <script src="js/scripts.js"></script>
</head>
<body>
<header>
<?php
include 'global-nav.php';
?>
</header>
<main class="container">
    <h1>Login</h1>
    <?php
    if (!empty($_GET['invalid'])) {
        echo '<div class="alert alert-danger">Invalid Login</div>';
    }
    else {
        echo '<div class="alert alert-info">Please enter your credentials</div>';
    }
    ?>
    <form method="post" action="validate.php">
        <fieldset class="form-group">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   onkeyup="return comparePasswords();">
        </fieldset>
        <div class="offset-3">
            <button class="btn btn-primary">Login</button>
        </div>
    </form>
    <p>Don't have an account click <a href="register.php">here</a> to register</p>
</main>

<?php include 'footer-nav.php'; ?>
</body>
</html>

