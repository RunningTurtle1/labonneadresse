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
        $array_path = explode("\\", $class);
        if ($array_path[0] !== "Controller" && $array_path[0] !== "Model")
        {
            return;
        }
        $path = strtolower(implode("/", array_slice($array_path, 0, (count($array_path) - 1)))) . '/' . array_pop($array_path) . '.php';
        require($path);
    }

}
?>