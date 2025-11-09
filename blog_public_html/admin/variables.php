<?php
//this is to be included at the top of every admin php file. 
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    echo 'you need to be logged in to access this page. <a href="login.php">click here to go to the log in page</a>';
    die();
}
$LINK_TO_RAW_BLOGS = "blogs.json";
$REL_LINK_TO_BLOGS = "../blogs/"




?>