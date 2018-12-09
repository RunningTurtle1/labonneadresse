<?php

class Publication 
{
    private $_id;
    private $_title;
    private $_text;
    private $_date;

    public function __construct ($id, $title, $text, $date)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setText($text);
        $this->setDate($date);
    }

    public function setId ($id)
    {
        $this->_id = $id;
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
}
?>