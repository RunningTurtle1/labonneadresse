<?php
class UserController extends MainController
{
    public function signIn ()
    {
        $twig = $this->getTwig();
        echo $twig->render('auth.twig', ['session' => $_SESSION]);
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
                $_SESSION['userConnected'] = true;
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

    public function checkForm ($email, $password)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new exception ('Veuillez saisir une adresse email valide');
        } 
        try
        {
            $email = $_POST['email'];
        }
        catch (Exception $e)
        {
            echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
        }

        if(strlen($password) < 7)
        {
            throw new exception ('Le mot de passe doit contenir au moins 8 caractères');
        }

    }
    
    public function newAccount ($email, $username, $password)
    {
        $userManager = new Usermanager;
        $this->checkForm($email, $password);
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