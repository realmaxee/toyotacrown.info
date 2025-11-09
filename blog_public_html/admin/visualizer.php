<?php
include('variables.php');
$blogs_list = json_decode(file_get_contents($LINK_TO_RAW_BLOGS), true);


if(isset($_POST['blog-to-view'])) {
    $blogIndex = $_POST['blog-to-view']; 
} else {
    $blogIndex = $_GET['blog'];
}

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goth Girls Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="blog-body">
    <nav>
        <div class="nav-row">
            <h1 style="color:red">PREVIEW</h1>
            <ul>
                <li><a href="bloglist.php">BACK TO BLOGEDITOR</a></li>
            </ul>
        </div>
        
    </nav>
    <article>
        <div class="row">
            <h1>'. $blogs_list[$blogIndex]["title"] .'</h1>
            <h3 class="blog-subtitles">by '. $blogs_list[$blogIndex]["author"] .'</h3>
            <h4 class="blog-subtitles">posted on '. $blogs_list[$blogIndex]["date"] .'</h4><hr>
            <p>'. $blogs_list[$blogIndex]["content"] .'</p>
        </div>
    </article>
    <span id="blogfiller">&nbsp;</span>
    <footer>
        <h4>Copyright &copy; '. Date("Y") .' GothGirls.ca</h4>
    </footer>
</body>
</html>
';
?>
