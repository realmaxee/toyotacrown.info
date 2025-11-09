<?php
session_start();
$path_to_pw = '/users';
if(isset($_POST['submit'])) {

    $given_username = $_POST['username'];
    $given_password = $_POST['password'];

    try {
        $user_settings = json_decode(file_get_contents('users/' . $given_username . '.json'), true);
    } catch (Exception $e) {
        $error = "user does not exist.";
    }
    $hashed_password = $user_settings['password'];
    if (password_verify($given_password, $hashed_password)) {
        $_SESSION['username'] = $given_username;
    } else {
        $error = "wrong password.";
    }
}
if(isset($_POST['logout'])) {

    unset($_SESSION['username']);

}

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
</head>
<body>

    <?php
        if(isset($_SESSION['username'])){ 
            include('navtemplate.php');
        } else { ?>
            <form class="login-form" action="./login.php" method="post">
                <h2>Administrator Log In</h2>
                Username: <input type="text" name="username">
                Password: <input type="text" name="password">
            <input type="submit" name="submit" value="Submit">
            </form>       
        <?php } 
            if(isset($error)) {
            echo '<h2 style="color:red">' . $error . '</h2>'; 
            }
        ?>
</body>
</html>