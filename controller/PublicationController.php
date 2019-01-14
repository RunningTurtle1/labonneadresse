<?php    
class PublicationController extends MainController
{
    public function showPosts ()
    {
        $publicationManager = new PublicationManager();
        $nbPage = $publicationManager->nbPages();
        if(isset($_GET['cPage']) && (($_GET['cPage']) >0) && (($_GET['cPage']) <= $nbPage))
        {
            $posts = $publicationManager->showPosts($_GET['cPage']);
        }
        else
        {
            $posts = $publicationManager->showPosts(1);
        }
        echo $this->getTwig()->render('home.twig', ['posts' => $posts, 'session' => $_SESSION]);
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

    public function showPostTitle ()
    {
        $this->checkAdmin();
        $publication = new PublicationManager();
        $posts = $publication->getPosts();
        echo $this->getTwig()->render('adm.twig', ['posts' => $posts, 'session' => $_SESSION, 'editpost' => false]);
    }

    public function createPost ()
    {
        $this->checkToken();
        $this->checkAdmin();
        //$this->checkForm(array($_POST['title'], $_POST['text']));
        $publication = new PublicationManager();
        $publication->addPub();
        //$this->redirect('index.php');
    }

    public function deletePost ()
    {
        $this->checkToken();
        $this->checkAdmin();
        $publication = new PublicationManager();
        $publication->deletePost($_GET['publicationId']);
        $comments = new CommentManager();
        $comments->deleteComments($_GET['publicationId']);
        $this->redirect('index.php?action=adm');
    }

    public function editPost ()
    {
        $this->checkToken();
        $this->checkAdmin();
        $publication = new PublicationManager();
        $post = $publication->getPost($_GET['publicationId']);
        $posts = $publication->getPosts();
        echo $this->getTwig()->render('adm.twig', ['posts' => $posts, 'session' => $_SESSION, 'post' => $post, 'editpost' => true]);
    }
    
    public function editedPost ()
    {
        $this->checkToken();
        $this->checkAdmin();
        $publication = new PublicationManager();
        $publication->editPost($_GET['publicationId']);
    }

    public function orderReports ()
    {
        $commentManager = new CommentManager();
        $req = $commentManager->orderReports();
        $comments = [];
        while ($data = $req->fetch())
        {        
        $commentId = $data['commentId'];
            $comments[] = ['comment'=>$commentManager->getComment($commentId),'count'=>$data['reports']];
        }
        $req->closeCursor();
        return $comments;
    }
}

?>