<?php
require('model/comments.php');

function checkUserLoggin () 
{
    if ((!isset($_SESSION['userConnected'])) && (!isset($_SESSION['admin'])))
    {
        header('location:index.php?action=authentification');
        //si l'utilisateur n'est pas connecté il est renvoyé à la page d'authentification
    }
}

function showComments ()
{
    $comments = new CommentManager();
    $comments = $publication->getComments($_GET['publicationId']);
    return $comments;
}

function addComment () 
{
    checkUserLoggin();
    $commentManager = new CommentManager();
    $commentManager->addComment($_POST['comment'], $_GET['publicationId'], $_SESSION['username']);
    $location = 'location:index.php?action=readpost&publicationId=' . $_GET['publicationId'];
    header($location);
}

function deletecomment ()
//supprime un commentaire et le retire de la table des commentaires signalés
{
    $commentManager = new CommentManager();
    $commentManager->deleteComment($_GET['commentId']);
    $commentManager->unreportcomment($_GET['commentId']);
    header('location:index.php?action=adm');
}

function unreportcomment()
//retire le commentaire de la table des commentaires signalés
{
    $commentManager = new CommentManager();
    $commentManager->unreportcomment($_GET['commentId']);
    header('location:index.php?action=adm');
}

function reportComment()
//ajoute un commentaire à la table des objets signalés
{
    checkUserLoggin();
    if ($_SESSION['userConnected'] || $_SESSION['admin'])
    {
        $commentManager = new CommentManager();
        $commentManager->reportComment($_GET['commentId'], $_SESSION['username']);
        header('location:index.php');
    }
}


?>