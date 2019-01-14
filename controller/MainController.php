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

    public function redirect($location)
    {
        header('location:' . $location);
    }

    public function checkAdmin () 
    {
        $user = new UserManager;
        if (isset($_SESSION['username']))
        {
            $data = $user->connect($_SESSION['username']);
            if ($data->getUsertype() != 'Admin')
            {
                $this->redirect('index.php?action=auth');
            }
        }
        else
        {
            $this->redirect('index.php?action=auth');
        }
            //on vérifie dans la DB que l'utilisateur a le statut d'admin
    }

    public function generateToken ()
    {
        $token = rand(1000, 99999);
        $_SESSION['token'] = $token;
        //on crée un token qu'on stocke en session
    }

    public function checkToken ()
    {
        if (isset($_POST['token']))
        {
           if (!($_SESSION['token'] == $_POST['token']))
           {
            throw new Exception ('Une erreur est survenue, veuillez réessayer');
           }
        }
        if (isset($_GET['token']))
        {
            if (!($_SESSION['token'] == $_GET['token']))
            {
            throw new Exception ('Une erreur est survenue, veuillez réessayer');
            }
        }
       //cette fonction vérifie que c'est bien le même utilisateur qui a rempli et envoyé le formulaire 
    }

    public function checkForm($inputs)
    {
        foreach($inputs as $input)
        {
            if(empty($input))
            {
                $this->setMessage('Un champ n\'a pas été renseigné');
                $this->redirect('index.php?action=adm');
            }
        }
        
        //fonction qui vérifie que tous les champs d'un formulaire sont remplis
    }


    public function setMessage($message)
    {
        $_SESSION['message'] = $message;
        //défini le message d'erreur à envoyer
    }

    public function deleteMessage()
    {
        unset($_SESSION['message']);
        //supprimer le message après utilisation
    }
}
?>