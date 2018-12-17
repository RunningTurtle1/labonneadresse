<?php
class MainController
{
    private $twig;
    private $loader;

    public function __construct()
    {
        $this->loader = new Twig_Loader_Filesystem('templates');
        $this->twig = new Twig_Environment($this->loader);

    }

    public function getTwig()
    {
        return $this->twig;
    }

    public function generateToken ()
    {
        $token = rand(1000, 99999);
        $_SESSION['token'] = $token;
    }

    function checkToken ()
    {
        if(!($_SESSION['token'] == $_POST['token']) && !($_SESSION['token'] == $_GET['token']))
        {
            throw new Exception ('Une erreur est survenue, veuillez réessayer');
        }
    }
}
?>