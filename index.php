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
        case 'newpost':
        $publication = new PublicationController;
        $publication->createPost();
        break;

        case 'addComment':
        $comment = new CommentController;
        $comment->addComment();
        break;
        
        case 'showpost':
        $publication = new PublicationController;
        $publication->showPost();
        break;

        case 'adm':
        $publication = new PublicationController;
        $publication->showPostTitle();
        break;
         
        default:
        $publication = new PublicationController;
        $posts = $publication->showPosts();
        break;
    }

}
else
{
    $publication = new PublicationController;
    $posts = $publication->showPosts();
}
?>