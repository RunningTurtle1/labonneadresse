<?php

require 'model/autoload.php'; 
Autoloader::register(); 

require 'vendor/autoload.php';


if (!isset($_SESSION))
{
    session_start();
    $controller = new MainController;
    if (!isset($_SESSION['admin']))
    {
        $_SESSION['admin'] = false;
    }
    if (!isset($_SESSION['token']))
    {
        $controller->generateToken();
    }
}
if (isset($_GET['action']))
{
    switch ($_GET['action']) 
    {
        case 'newpost':
        $publication = new PublicationController;
        $publication->createPost();
        break;

        case 'deletepost':
        $publication = new PublicationController;
        $publication->deletePost();
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

        case 'createaccount':
        $user = new UserController;
        $user->createaccount();
        break;
        
        case 'newaccount':
        $user = new UserController;
        $user->newAccount($_POST['email'], $_POST['username'], $_POST['password']);
        break;

        case 'auth': 
        $user = new UserController;
        $user->signIn();
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