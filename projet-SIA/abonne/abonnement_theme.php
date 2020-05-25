<?php
include '../db_config.php';
require("../auth/loader.php");
if ($idm->hasIdentity()) {
    $role = $idm->getRole(); //recupere role 
    $_SESSION = $idm->getId(); //recupere id courrant
 
    //Modification abonnements
    $db->exec("DELETE FROM abonnement WHERE id_abonne=$_SESSION");
    foreach($_POST['abonnements'] as $theme)
    {
       $db->exec("INSERT INTO abonnement (id_theme,id_abonne) VALUE ('$theme', '$_SESSION')");
    }
    
}
header('Location: profileAbonne.php');
?> 
