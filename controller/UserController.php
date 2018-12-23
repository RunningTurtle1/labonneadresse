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
        if (isset($user))
        {
            $passwordVerify = password_verify($password, $user->getPassword());
            if (($passwordVerify == true) && ($user->getUsertype() == "Admin"))
            {
                $_SESSION['admin'] = true;
                $_SESSION['username'] = $username;
                header('location:index.php?action=adm');
            }
            else if ($passwordVerify == true)
            {
                $_SESSION['userConnected'] = true;
                $_SESSION['username'] = $username;
                header('location:index.php');
            }
        }
        else
        {
            header('location:index.php?action=auth');
        }
    }
    
    public function newAccount ($email, $username, $password)
    {
        $userManager = new Usermanager;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userManager->createAccount($email, $username, $hashedPassword);

    }

    public function createAccount ()
    {
        echo $this->getTwig()->render('createaccount.twig');
    }
    
    public function userSignOut ()
    {
        session_destroy();
        $_SESSION['userConnected'] = false;
        header('location:index.php');
    }
}
?>