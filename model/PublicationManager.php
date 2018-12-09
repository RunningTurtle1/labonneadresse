<?php
require_once("model/connexionManager.php");
class PublicationManager extends connexionManager
{     
    public function showPosts ($cPage)
    {
        $db = $this->dbconnect();
        
        $req =$db->query('SELECT COUNT(publicationId) as nbArt FROM publication'); 
        $data = $req->fetch();
        $nbArt = $data['nbArt'];
        $perPage = 3;
        $nbPage = ceil($nbArt / $perPage);
        $var = (($cPage - 1) * $perPage);
        //le première partie de la fonction permet de préparer la pagination du des articles
        $req = $db->prepare('SELECT * FROM publication ORDER BY publicationId DESC LIMIT :cPage , :perPage ');
        $req->bindValue(':cPage', $var, PDO::PARAM_INT);
        $req->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        //on récupère les articles correspondant à la page selectionnée
        $req->execute();
        $posts = [];
        while ($data = $req->fetch())
        {
            $posts[] = $data;
        }
        //on met directement les données dans un tableau avant de les envoyer au controller
        $req->closeCursor();
        $controller = new MainController;
        $twig = $controller->getTwig();
        echo $twig->render('home.twig', ['posts' => $posts]);
    }

    public function nbPages ()
    {
        $db = $this->dbconnect();
        //cette fonction permet simplement de calculer le nombre de pages necessaires à l'affichage des articles
        $req =$db->query('SELECT COUNT(publicationId) as nbArt FROM publication'); 
        $data = $req->fetch();
        $nbArt = $data['nbArt'];
        $perPage = 3;
        $nbPage = ceil($nbArt / $perPage);
        return $nbPage;
    }

    public function getPosts ()
    {
        $db = $this->dbconnect();
        //la fonction récupère les articles pour l'interface d'administration
        $req =$db->query('SELECT * FROM publication'); 
        $posts = [];
        while ($data = $req->fetch())
        {
            $posts[] = ['post'=>$data];
        }
        return $posts;
    }
    
    public function getPost ($publicationId)
    //récupère une publication en fonction de son identifiant
    {
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT * FROM publication WHERE publicationId = ?');
        $req->execute(array($publicationId));
        $post = $req->fetch();
        return $post;
    }

    public function deletePost ($publicationId)
    //supprime une publication de la base de donnée 
    {
        $db = $this->dbconnect();
        $req = $db->prepare('DELETE FROM publication WHERE publicationId = :publicationId');
        $req->bindValue(':publicationId', $publicationId, PDO::PARAM_INT);
        $req->execute();
    }
    
    public function editPost ($publicationId)
    //met à jour le titre de la publication et son contenu par l'auteur
    {
        $db = $this->dbconnect();
        $req = $db->prepare('UPDATE publication SET publicationTitle = ?, publicationText = ? WHERE publicationId = ?');
        $req->execute(array($_POST['title'], $_POST['text'], $publicationId));
    }

    public function addPub ()
    //ajoute un article écrit par l'auteur à base de données
    {
        $db = $this->dbconnect();
        $req = $db->prepare('INSERT INTO publication(publicationTitle, publicationText, publicationDate) VALUE (?, ?, NOW())');
        $req->execute(array($_POST['title'], $_POST['text']));
    }

    public function getComments ($publicationId)
    {
        //cette fonction permet de récupérer les commentaires liés à l'article consulté par l'utilisateur
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT * FROM comments WHERE publicationId = ?');
        $comments = $req->execute(array($_GET['publicationId']));
        $comments = [];
        while ($data = $req->fetch())
        {
            $comments[] = ['comment'=>$data];
        }
        $req->closeCursor();
        return $comments;
    }
}
?>