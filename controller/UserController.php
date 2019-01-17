<?php
class UserController extends MainController
{
    public function signIn ()
    {
        $twig = $this->getTwig();
        echo $twig->render('auth.twig', ['session' => $_SESSION]);
        $this->deleteMessage();
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
                $this->redirect('index.php?action=adm');
            }
            else if ($passwordVerify == true)
            {
                $_SESSION['userConnected'] = true;
                $_SESSION['username'] = $username;
                $this->redirect('index.php');
            }
            else
            {
                $this->setMessage('Identifiant ou mot de passe incorrect');
                $this->redirect('index.php?action=auth');
            }
        }
        else
        {
            $this->setMessage('Identifiant ou mot de passe incorrect');
            $this->redirect('index.php?action=auth');
        }
    }

    public function checkSubForm ($email, $password, $username)
    {
        $user = new UserManager;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['message'] = 'Veuillez saisir une adresse email valide';
            return false;
        } 
        
        else if(strlen($password) < 7)
        
        {
            $_SESSION['message'] = 'Le mot de passe doit contenir au moins 8 caractères';
            return false;
        }
        else if ($user->connect($username) == !null)
        {
            $_SESSION['message'] = 'Ce nom d\'utilisateur est déjà pris';
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function newAccount ($email, $username, $password)
    {
        $userManager = new Usermanager;
        $formIsValid = $this->checkSubForm($email, $password, $username);
        if ($formIsValid)
        {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userManager->createAccount($email, $username, $hashedPassword);
            $this->redirect('index.php');
        }
        else
        {
            $this->redirect('index.php?action=createaccount');
        }
    }

    public function createAccount ()
    {
        echo $this->getTwig()->render('createaccount.twig', ['session' => $_SESSION]);
        $this->deleteMessage();
    }
    
    public function userSignOut ()
    {
        session_destroy();
        $_SESSION['userConnected'] = false;
        $this->redirect('index.php');
    }
}
?>