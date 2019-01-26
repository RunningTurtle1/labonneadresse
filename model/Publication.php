<?php
namespace Model;
class Publication 
{
    private $_id;
    private $_title;
    private $_text;
    private $_date;
    private $_picture;

    public function __construct ($id, $title, $text, $date, $picture=NULL)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setText($text);
        $this->setDate($date);
        $this->setPicture($picture);
    }

    public function setId ($id)
    {
        if(!is_numeric($id))
        {
            throw new Exception ('L\'identifiant doit être un nombre entier');
        }
        try
        {
            $this->_id = $id;
        }
        catch (Exception $e)
        {
            echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
        }
    }

    public function setTitle ($title)
    {
        if(isset($title))
        {
            $this->_title = $title;
        }
    }

    public function setText ($text)
    {
        if(isset($text))
        {
            $this->_text = $text;
        }
    }

    public function setDate ($date)
    {
        if(isset($date))
        {
            $this->_date = $date;
        }
    }

    public function setPicture ($picture)
    {
        $this->_picture = $picture;
    }
    public function getId ()
    {
        return $this->_id;
    }

    public function getTitle ()
    {
        return $this->_title;
    }

    public function getText ()
    {
        return $this->_text;
    }

    public function getDate ()
    {
        return $this->_date;
    }

    public function getPicture ()
    {
        return $this->_picture;
    }
}
?>