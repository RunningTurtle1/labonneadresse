<?php

require 'model/autoload.php'; 
Autoloader::register(); 
use Controller\MainController;
use Controller\PublicationController;
use Controller\UserController;
use Controller\CommentController;


require 'vendor/autoload.php';

session_start();
if (!isset($_SESSION['userConnected']))
{
    $_SESSION['userConnected'] = false;
}
if (!isset($_SESSION['token']))
{
    $controller = new MainController;
    $token = $controller->generateToken();
}

if (isset($_GET['action']))
{
    switch ($_GET['action']) 
    {
        case 'newpost':
        $publication = new PublicationController;
        $publication->createPost();
        break;

        case 'editpost':
        $publication = new PublicationController;
        $publication->editPost();
        break;

        case 'postedited':
        $publication = new PublicationController;
        $publication->editedPost();

        case 'newcomment':
        $comment = new CommentController;
        $comment->addComment();
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

        case 'authentification':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new UserController;
        $user->userSignIn($username, $password);
        break;

        case 'signout':
        $user = new UserController;
        $user->userSignOut();
        break;

        case 'api':
        $api = new APIController;
        $api->getLocations();
        break;

        default:
        $publication = new PublicationController;
        $posts = $publication->showPosts();
        break;
    }

}
else
{
    $publication = new Controller\PublicationController;
    $posts = $publication->showPosts();
}
?>