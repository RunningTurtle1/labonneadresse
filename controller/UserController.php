<?php
class UserController extends MainController
{
    public function signIn ()
    {
        $twig = $this->getTwig();
        echo $twig->render('auth.twig');
    }
    
    public function userSignIn ()
    {
        $userManager = new UserManager;
        $user = $userManager->connect($_POST['user']);
        if ((($_POST['password']) == $user['password']) && ($user['userType'] == "Admin"))
        {
            $_SESSION['admin'] = true;
            header('location:index.php?action=adm');
            $_SESSION['username'] = $_POST['user'];
        }
        else if (($_POST['password']) == $user['password'])
        {
            $_SESSION['userConnected'] = true;
            $_SESSION['username'] = $_POST['user'];
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
    }
}
?>