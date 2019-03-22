<?php

spl_autoload_register(function($file)
{
    $file = strtolower($file);
    $file_name = str_replace("\\", "/", BASEDIR."/$file.php"); //замена обратных слешей на прямые для совместимости с linux
    
    if(file_exists($file_name))
    {
        include_once $file_name;
    }
});