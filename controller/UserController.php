<?php
class UserController extends MainController
{
    public function signIn ()
    {
        $twig = $this->getTwig();
        echo $twig->render('auth.twig', ['token' => $_SESSION['token']]);
    }
    
    public function userSignIn ($username, $password)
    {
        $userManager = new UserManager;
        $user = $userManager->connect($username);
        if (($password == $user->getPassword()) && ($user->getUsertype() == "Admin"))
        {
            $_SESSION['admin'] = true;
            $_SESSION['username'] = $username;
            header('location:index.php?action=adm');
        }
        else if ($password == $user->getPassword())
        {
            $_SESSION['userConnected'] = true;
            $_SESSION['username'] = $username;
            header('location:index.php');
        }
        else
        {
            header('location:index.php?action=authentification');
        }
    }
    
    public function newAccount ($email, $username, $password)
    {
        $userManager = new Usermanager;
        $userManager->createAccount($email, $username, $password);
    }

    public function createAccount ()
    {
        echo $this->getTwig()->render('createaccount.twig');
    }
    
    public function userSignOut ()
    {
        session_destroy();
        $_SESSION['userConnected'] = false;
    }
}
?>