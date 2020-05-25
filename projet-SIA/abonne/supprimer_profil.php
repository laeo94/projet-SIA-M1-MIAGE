<?php
include '../db_config.php';
require("../auth/loader.php");
if ($idm->hasIdentity()) {
    $role = $idm->getRole(); //recupere role 
    $_SESSION = $idm->getId(); //recupere id courrant
}

        //supprime l'abonne
        $db->exec("DELETE FROM abonne WHERE id_abonne =$_SESSION ") or die(print_r($db->errorInfo(), true));
        //supprime son image dans le dossier abonne
        $dir = '../images/abonne/' . $_SESSION;
        if(file_exists($dir)) unlink($dir);
        //archive ses msg, sujet c'est a dire mettre id_abonne dans les table a null
        $db->exec("UPDATE sujet SET id_abonne=null WHERE id_abonne=$_SESSION ");
        $db->exec("UPDATE message SET id_abonne=null WHERE id_abonne=$_SESSION ");
     header('Location:../logout.php');
?>