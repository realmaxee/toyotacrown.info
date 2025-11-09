<?php
include('variables.php');
$path_to_pw = '/users';
if(isset($_POST['changepassword'])) {

    $new_password = $_POST['new-password'];
    $old_password = $_POST['old-password'];

    try {
        $user_settings = json_decode(file_get_contents('users/' . $_SESSION['username'] . '.json'), true);
    } catch (Exception $e) {
        $error = "user does not exist.";
    }
    $hashed_password = $user_settings['password'];
    if (password_verify($old_password, $hashed_password)) {
        $user_settings['password'] = password_hash($new_password, PASSWORD_DEFAULT);
        file_put_contents('users/' . $_SESSION['username'] . '.json', json_encode($user_settings));
    } else {
        $error = "wrong password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('navtemplate.php');?>
    <h1>User settings..... will be finished later.......</h1>
    <form action="settings.php" method="post">
    <input id="new-password" name="new-password" type="text" placeholder="new password">
    <input id="old-password" name="old-password" type="text" placeholder="confirm old password">
    <input type="submit" value="Change Password" name="changepassword">
    </form>
    <?php
        if(isset($error)) {
        echo '<h2 style="color:red">' . $error . '</h2>'; 
        }
    ?>

    
</body>
</html>