<?php
spl_autoload_register('myAutoloader');

function myAutoloader($className): void
{
    $path = "../classes/";
    $ext = ".class.php";
    $fullPath = $path . $className . $ext;

    include_once $fullPath;
}
