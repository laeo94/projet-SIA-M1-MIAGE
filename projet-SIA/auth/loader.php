<?php

session_start();

require(__DIR__ ."/../db_config.php");

require("config.php");

spl_autoload_register(function ($class) {
    $path = explode('\\',$class);
    $class = array_pop($path);
     if (file_exists(__DIR__."/$class.php"))
        include(__DIR__."/$class.php");
});

function redirect($url, $code=303){
    header("Location: $url");
    http_response_code($code);
}

$db = new PDO($dsn, $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$idm = new Pw\Auth\Identity\IdentityManager();

$auth = new Pw\Auth\Authenticate(new Pw\Auth\Providers\SqlTableAuthentication($db,$authTableData),$idm);
