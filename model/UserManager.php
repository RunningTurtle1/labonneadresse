<?php
require_once('model/connexionManager.php');
class UserManager extends connexionManager
{
    public function connect ($username)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT * FROM users WHERE username = ?');
        $req->execute(array($username));
        $user = $req->fetch();
        return $user;
    }

    public function createAccount ($email, $username, $password)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('INSERT INTO users(emailAddress, username, password, userType) VALUES(?, ?, ?, user) ');
        $req->execute(array($email, $username, $password));
    }
}
?>