<?php
include('variables.php');



$blogs_list = json_decode(file_get_contents($LINK_TO_RAW_BLOGS), true);
$current_blog = $_GET['blog'];

if(!isset($blogs_list[$current_blog]['title']) || $blogs_list[$current_blog]['title']=="") {
    $blogs_list[$current_blog]['title'] = "default title";
}

if(!isset($blogs_list[$current_blog]['author']) || $blogs_list[$current_blog]['author']=="") {
    $blogs_list[$current_blog]['author'] = $_SESSION['username'];
}


if(!isset($blogs_list[$current_blog]['date']) || $blogs_list[$current_blog]['date']=="") {
    $blogs_list[$current_blog]['date'] = date("Y-m-d");
}

if(!isset($blogs_list[$current_blog]['url']) || $blogs_list[$current_blog]['url']=="") {
    $blogs_list[$current_blog]['url'] = $blogs_list[$current_blog]['title'];
}

if(isset($_POST['submit'])) {
    $blogs_list[$current_blog]['title'] = $_POST['title'];
    $blogs_list[$current_blog]['author'] = $_POST['author'];
    $blogs_list[$current_blog]['content'] = $_POST['content'];
    $blogs_list[$current_blog]['date'] = $_POST['date'];
    $blogs_list[$current_blog]['url'] = $_POST['url'];
    $blogs_list[$current_blog]['display'] = isset($_POST['display']);

    $myfile = fopen("blogs.json", "w") or die("UwU");
    $txt = json_encode($blogs_list);
    fwrite($myfile, $txt);
    fclose($myfile);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Editor</title>
    <style>
        .blogs-list {
            border: 4px solid #8080ff;
            padding: 16px;
            margin-top:16px;
        }
    </style>
</head>
<body>
    <?php
        include('navtemplate.php');
        if($blogs_list[$current_blog]['display']) {
            $blogs_list[$current_blog]['display'] = "checked";
        }
        echo "
        <h1>blog editor</h1>
        <form action='blogeditor.php?blog=" . $current_blog . "' method='post'>
        <h1>title:<input type='text' id='title' name='title' value='" . $blogs_list[$current_blog]['title']. "'></h1>
        <h2>author:<input type='text' id='author' name='author' value='" . $blogs_list[$current_blog]['author']. "'></h2>
        <h2>date posted:<input type='text' id='date' name='date' value='" . $blogs_list[$current_blog]['date']. "'></h2>
        <h2>url:<input type='text' id='url' name='url' value='" . $blogs_list[$current_blog]['url']. "'></h2>
        <h2>display this blog publicly?:<input type='checkbox' id='display' name='display' " . $blogs_list[$current_blog]['display']. "></h2>
        <p>blog: text:<br><input type='text' id='content' size='100%' name='content' value='" . $blogs_list[$current_blog]['content']. "'></p>
        
        <input type='submit' name='submit' value='Save!'><label>if you dont save your work will be forgotten ):</label>
        </form>
        ";

        if(isset($_POST['submit'])) {
            echo 'submitted';
        }

    ?>
</body>
</html>