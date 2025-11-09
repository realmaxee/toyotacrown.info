<?php
include("variables.php");
$blogs_list = json_decode(file_get_contents($LINK_TO_RAW_BLOGS), true);

//create index.html
$html_content = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goth Girls Blog</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="blog-body">
    <nav>
        <div class="nav-row">
            <h1>GothGirls.ca</h1>
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="index.html">Blogs</a></li>
            </ul>
        </div>      
    </nav>
    <main>
        <div class="row">
            <div class="blogs-list-wrapper">
';
for($i = 0; $i < count($blogs_list); $i++) {
    if($blogs_list[$i]["display"]) {
        $html_content .= '
        <a href="./'. $blogs_list[$i]["url"] .'.html" class="blogs-list-preview">
            <h2>'. $blogs_list[$i]["title"] .'</h2>
            <p>
        ';
        if(strlen($blogs_list[$i]["content"]) > 150) {
            $html_content .= substr($blogs_list[$i]["content"],0,150) . "...";
        } else {
            $html_content .= $blogs_list[$i]["content"];
        }
        $html_content .= '
            </p>
        </a>';
    }
}
$html_content .= '
            </div> 
        </div>
    </main>
    <footer>
        <h4>Copyright &copy; '. Date("Y") .' GothGirls.ca</h4>
    </footer>
</body>
</html>
';
file_put_contents($REL_LINK_TO_BLOGS . "index.html", $html_content);

for($i = 0; $i < count($blogs_list); $i++) {
    $html_content = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Goth Girls Blog</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body class="blog-body">
        <nav>
            <div class="nav-row">
                <h1>GothGirls.ca</h1>
                <ul>
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="index.html">Blogs</a></li>
                </ul>
            </div>
        </nav>
        <article>
            <div class="row">
                <h1>'. $blogs_list[$i]["title"] .'</h1>
                <h3 class="blog-subtitles">by '. $blogs_list[$i]["author"] .'</h3>
                <h4 class="blog-subtitles">posted on '. $blogs_list[$i]["date"] .'</h4><hr>
                <p>'. $blogs_list[$i]["content"] .'</p>
            </div>
        </article>
        <span id="blogfiller">&nbsp;</span>
        <footer>
            <h4>Copyright &copy; '. Date("Y") .' GothGirls.ca</h4>
        </footer>
    </body>
    </html>
    ';
    file_put_contents($REL_LINK_TO_BLOGS . $blogs_list[$i]["url"] . ".html", $html_content);
}

echo 'done<a href="bloglist.php"> go back to blog editor</a>';

?>