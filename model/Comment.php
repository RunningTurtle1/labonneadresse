<?php

class Comment 
{
    private $_id;
    private $_username;
    private $_text;
    private $_date;

    public function __construct ($id, $username, $text, $date)
    {
        $this->setId($id);
        $this->setTitle($username);
        $this->setText($text);
        $this->setDate($date);
    }

    public function setId ($id)
    {
        $this->_id = $id;
    }

    public function setTitle ($username)
    {
        if(isset($username))
        {
            $this->_username = $username;
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

    public function getId ()
    {
        return $this->_id;
    }

    public function getUsername ()
    {
        return $this->_username;
    }

    public function getText ()
    {
        return $this->_text;
    }

    public function getDate ()
    {
        return $this->_date;
    }
}
?>