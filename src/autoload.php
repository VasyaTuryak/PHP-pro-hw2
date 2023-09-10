<?php
spl_autoload_register(function ($class){
    $filePath=(__DIR__."/classes/$class.php");
    if(file_exists($filePath)){
        $FilePathConvert=str_replace('\\', '/', $filePath);
        require_once $FilePathConvert;
    }elseif (!file_exists($filePath)){
        $NewfilePath=(__DIR__."/$class.php");
        $NewFilePathConvert=str_replace('\\', '/', $NewfilePath);
        require_once $NewFilePathConvert;
    }

});