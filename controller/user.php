<?php
function userSignIn ()
{
    require('model/user.php');
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

function createAccount ($email, $username, $password)
{
    require('model/user.php');
    $userManager = new Usermanager;
    $userManager->createAccount($email, $username, $password);
}

function userSignOut ()
{
    session_destroy();
}


?>