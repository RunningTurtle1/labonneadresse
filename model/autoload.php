<?php

class Autoloader 
{

    /**
     * Enregistre notre autoloader
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload', ));
    }

    static function autoload($class)
    {
        if (file_exists('model/' . $class . '.php'))
        {
            require 'model/' . $class . '.php';

        }
        else if (file_exists('controller/' . $class . '.php'))
        {
            require 'controller/' . $class . '.php';
        }
    }

}
?>