<nav>
    <link rel="stylesheet" href="../style.css">
    <style>
        nav {background-color:lightgrey;}
    </style>
    <h3>Welcome <?php echo $_SESSION['username'] ?>!</h3>
    <form action="./login.php" method="post">
    <a href="bloglist.php">Blog Editor</a>
    <a href="settings.php">User Settings page</a>
    <input type="submit" name="logout" value="log out">
    </form>
</nav>
