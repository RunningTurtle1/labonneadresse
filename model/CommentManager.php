<?php
namespace Model;
class CommentManager extends ConnexionManager
{
    public function getComments ($publicationId)
    {
        //cette fonction permet de récupérer les commentaires liés à l'article consulté par l'utilisateur
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT * FROM comments WHERE publicationId = ?');
        $req->execute(array($_GET['publicationId']));
        $comments = [];
        while ($data = $req->fetch())
        {
            $comment = new Comment($data['commentId'], $data['Username'], $data['textContent'], $data['commentDate']);
            $comments[] = $comment;
        }
        $req->closeCursor();
        return $comments;
    }
    
    public function addComment ($comment, $publicationId, $username)
    //ajoute un commentaire à la base de donnée
    {
        $db = $this->dbconnect();
        $req = $db->prepare('INSERT INTO comments(textContent, commentDate, publicationId, username) VALUES (?, NOW(), ?, ?)');
        $comment = $req->execute(array($comment, $publicationId, $username));
        return $comment;
    }

    public function deleteComments ($publicationId)
    {
        //cette fonction détruit tous les commentaires liés à une publication elle même supprimée
        $db = $this->dbconnect();
        $req = $db->prepare('DELETE FROM comments WHERE publicationId = ?');
        $req->execute(array($publicationId));
    }

    public function deleteComment ($commentId)
    {
        //celle ci détruit un commentaire qui a été signalé 
        $db = $this->dbconnect();
        $req = $db->prepare('DELETE FROM comments WHERE commentId = ?');
        $req->execute(array($commentId));
    }

    public function unreportcomment ($commentId)
    //retire le commentaire de la table des signalements
    {
        $db = $this->dbconnect();
        $req = $db->prepare('DELETE FROM comments_report WHERE commentId = ?');
        $req->execute(array($commentId));
    }

    public function getComment ($commentId)
    //récupère un commentaire en fonction de son id pour l'afficher dans l'interface d'administration
    {
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT textContent, username, commentId
        FROM comments  
        WHERE commentId = ?');
        $req->execute(array($commentId));
        return $req->fetch();
    }
}
?>