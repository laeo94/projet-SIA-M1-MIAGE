<?php

$hostname = "localhost";
$dbname = "epa_bdd";
$username = "root";
$password = "";

$dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8";

try
{
	$db = new PDO('mysql:host='.$hostname.';dbname='.$dbname.';charset=utf8',$username,$password);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
