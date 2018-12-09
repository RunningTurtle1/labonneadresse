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

    //function generateToken
    //function checkToken
}
?>