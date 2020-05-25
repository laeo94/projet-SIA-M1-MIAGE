<?php

require("loader.php");

if(!$idm->hasIdentity())
{
    $_SESSION[SKEY] = $_SERVER['REQUEST_URI'];
    redirect($pathFor['login']);
    exit();
};
