<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $date = date('Y-m-d H:i:s');
    $blogEntry = "$date|$title|$content\n";
    file_put_contents('blogs.txt', $blogEntry, FILE_APPEND);
    header('Location: manage.html');
    exit();
}
?>