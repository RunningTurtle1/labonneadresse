<?php
namespace Controller;
use Model\PublicationManager;
use Model\CommentManager;
class PublicationController extends MainController
{
    public function showPosts()
    {
        $publicationManager = new PublicationManager();
        $nbPage = $publicationManager->nbPages();
        if (isset($_GET['cPage']) && (($_GET['cPage']) > 0) && (($_GET['cPage']) <= $nbPage)) {
            $posts = $publicationManager->showPosts($_GET['cPage']);
        } else {
            $posts = $publicationManager->showPosts(1);
        }
        echo $this->getTwig()->render('home.twig', ['posts' => $posts, 'session' => $_SESSION, 'pages' => $nbPage]);
        $this->deleteMessage();
    }

    public function showPost()
    {
        $publication = new PublicationManager();
        $post = $publication->getPost($_GET['publicationId']);
        $comment = new CommentManager();
        $comments = $comment->getComments($_GET['publicationId']);
        echo $this->getTwig()->render('showPost.twig', ['post' => $post, 'comments' => $comments, 'session' => $_SESSION]);
    }

    public function getPost()
    {
        $publication = new PublicationManager();
        $post = $publication->getPost($_GET['publicationId']);
    }

    public function showPostTitle()
    {
        $this->checkAdmin();
        $publication = new PublicationManager();
        $posts = $publication->getPosts();
        echo $this->getTwig()->render('adm.twig', ['posts' => $posts, 'session' => $_SESSION, 'editpost' => false]);
    }

    public function createPost()
    {
        $this->checkToken();
        $this->checkAdmin();
        $this->checkForm(array($_POST['title'], $_POST['text'], $_POST['long'], $_POST['lat'], $_POST['picture']));
        $fileName = $this->upload('picture');
        $publication = new PublicationManager();
        $publication->addPub($_POST['title'], $_POST['text'], $_POST['address'], $_POST['long'], $_POST['lat'], $fileName);
        $this->redirect('index.php');
    }

    public function upload($index)
    {
        //On test que le fichier soit correctement uploadé
        if (!isset($_FILES[$index]) or $_FILES[$index]['error'] > 0) {
            return false;
        }
        //Test de la taille du fichier
        if ($_FILES[$index]['size'] > 1000000) {
            return false;
        }
        //Test de  l'extension du fichier
        $ext = substr(strrchr($_FILES[$index]['name'], '.'), 1);
        $extensions = array('png', 'gif', 'jpg', 'jpeg');
        if ($extensions !== false and !in_array($ext, $extensions)) {
            return false;
        }
        //Déplacement du fichier dans un repertoire
        $fileName = md5($_FILES[$index]['name']) . '.' . $ext;
        $destination = 'public/images/' . $fileName;
        move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
        return $fileName;
    }

    public function deletePost()
    {
        $this->checkToken();
        $this->checkAdmin();
        $publication = new PublicationManager();
        $publication->deletePost($_GET['publicationId']);
        $comments = new CommentManager();
        $comments->deleteComments($_GET['publicationId']);
        $this->redirect('index.php?action=adm');
    }

    public function editPost()
    {
        $this->checkToken();
        $this->checkAdmin();
        $publication = new PublicationManager();
        $post = $publication->getPost($_GET['publicationId']);
        $posts = $publication->getPosts();
        echo $this->getTwig()->render('adm.twig', ['posts' => $posts, 'session' => $_SESSION, 'post' => $post, 'editpost' => true]);
    }

    public function editedPost()
    {
        $this->checkToken();
        $this->checkAdmin();
        $publication = new PublicationManager();
        $publication->editPost($_GET['publicationId']);
    }

    public function orderReports()
    {
        $commentManager = new CommentManager();
        $req = $commentManager->orderReports();
        $comments = [];
        while ($data = $req->fetch()) {
            $commentId = $data['commentId'];
            $comments[] = ['comment' => $commentManager->getComment($commentId), 'count' => $data['reports']];
        }
        $req->closeCursor();
        return $comments;
    }
}
