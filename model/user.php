<?php
class User 
{

    private $_username;
    private $_password;
    private $_usertype;
    private $_email;

    public function __construct ($username, $password, $usertype, $email)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setUsertype($usertype);
        $this->setEmail($email);
    }

    public function setUsername ($username)
    {
        $this->_username = $username;
    }

    public function setPassword ($password)
    {
        $this->_password = $password;
    }

    public function setUsertype ($usertype)
    {
        $this->_usertype = $usertype;
    }

    public function setEmail ($email)
    {
        $this->_email = $email;
    }


    public function getUsername()
    {
        return $this->_username;
    }

    public function getPassword ()
    {
        return $this->_password;
    }

    public function getUsertype ()
    {
        return $this->_usertype;
    }
    public function getEmail ()
    {
        return $this->_email;
    }
}

?>