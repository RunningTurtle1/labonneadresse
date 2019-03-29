<?php
namespace Model;
class ConnexionManager
{
    protected function dbconnect ()
    {
        try
        {
            require('accesscode.php'); 
            $db = new \PDO($host, $login, $password);
            return $db;
        } 
        catch(Exception $e) 
        { 
            die('Erreur : '.$e->getMessage()); 
        }
    }
}
?>