<?php
namespace Model;
class ConnexionManager
{
    protected function dbconnect ()
    {
        try
        {
            require('accesscode.php'); 
            //$db = new \PDO('mysql:host=db770338133.hosting-data.io;dbname=db770338133;charset=utf8', $login, $password);
            $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
            return $db;
        } 
        catch(Exception $e) 
        { 
            die('Erreur : '.$e->getMessage()); 
        }
    }
}
?>