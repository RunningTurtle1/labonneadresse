<?php

require 'model/autoload.php'; 
Autoloader::register(); 

require 'vendor/autoload.php';


if (!isset($_SESSION))
{
    session_start();
}
if (isset($_GET['action']))
{
    switch ($_GET['action']) 
    {
        case "createpub":
        require('controller/publicationManager.php');
        createPost();
        break;

        case "showpost":
        require('controller/publicationManager.php');
        $post = showPost();
        require('controller/commentManager.php');
        $comments = getComments();
        echo $twig->render('showPost.twig', ['post' => $post, 'comments' => $comments]);
    }

}
else
{
    $publication = new PublicationController;
    $posts = $publication->showPosts();
}
?>