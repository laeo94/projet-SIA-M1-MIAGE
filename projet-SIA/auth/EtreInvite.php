<?php

require("loader.php");

if($idm->hasIdentity())
{
    http_response_code(403);
    echo "Error: User already authenticated.";
    exit();
};
