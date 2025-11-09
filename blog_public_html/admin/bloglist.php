<?php
include('variables.php');
$blogs_list = json_decode(file_get_contents($LINK_TO_RAW_BLOGS), true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php include('navtemplate.php'); ?>
    <h1>admin page</h1>
    <h2>List of blogs</h2>
    <a href="renderhtml.php">Render the HTML (this should only be done when a change is made to any of the blogs, please dont use this too much)</a>
    
    <?php
        for($i = 0; $i < count($blogs_list); $i++) {
            echo "<div class='blogs-list'>
                <h2>" . $blogs_list[$i]["title"] . " by " . $blogs_list[$i]["author"] . "</h2>
                <p>" . substr($blogs_list[$i]["content"],0,150) . "...</p>
                <div class='bloglist-button-wrapper'>
                    <a class='bloglist-buttons' href='blogeditor.php?blog=" . $i . "'>edit</a>
                    <form class='bloglist-buttons' action='./bloglist.php' method='post'>
                        <input type='number' name='blog-to-delete' value='" . $i . "' style='display:none'>
                        <input type='submit' name='delete-blog-submit' value='Delete this blog'>you cannot undelete this
                    </form>
                    <form class='bloglist-buttons' action='./visualizer.php' method='post'>
                        <input type='number' name='blog-to-view' value='" . $i . "' style='display:none'>
                        <input type='submit' name='delete-blog-submit' value='visualize this blog'>
                    </form>
                </div>
            </div>";
        }
        echo "<a href='blogeditor.php?blog=" . count($blogs_list) . "'>make a new blog</a>";
        /*foreach($blogs_list as $blog_info) {
            echo "<div class='blogs-list'>
            <h2>" . $blog_info["title"] . " by " . $blog_info["author"] . "</h2>
            <p>" . $blog_info["content"] . "</p>
            <a href='blogeditor.php?blog=" . $blog_info["id"] . "'>edit</a>
            </div>";
        }*/

    ?>
</body>
</html>