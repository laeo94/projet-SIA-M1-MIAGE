<?php
require("auth/EtreAuthentifie.php");

$auth->clear();
$idm->clear();

redirect($pathFor['root']);
