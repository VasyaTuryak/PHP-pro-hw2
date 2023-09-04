<?php
spl_autoload_register(function ($class){
    $filePath=(__DIR__."/ClassesAndInterFace/$class.php");
    $FilePathConvert=str_replace('\\', '/', $filePath);
    require_once $FilePathConvert;
});