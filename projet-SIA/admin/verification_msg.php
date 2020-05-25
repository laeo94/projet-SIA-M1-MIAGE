<?php
if (isset($_POST['idmessage']) && isset($_POST['idsujet']) && isset($_POST['idtheme'])) {
    include '../db_config.php';
    $idmsg=$_POST['idmessage'];
    $idtheme =$_POST['idtheme'];
    $idsujet =$_POST['idsujet'];
    if (isset($_POST['link'])) {
        $idlink = $_POST['link'];
        $db->exec("UPDATE lien SET statut='accepte' WHERE id_lien=$idlink ");
    } else {
        $db->exec("DELETE FROM lien WHERE id_message =$idmsg "); // suppression lien
    }
    if (isset($_POST['img'])) {
        $idimg = $_POST['img'];
        $db->exec("UPDATE document SET statut='accepte' WHERE id_document=$idimg ");
    } else {
        $db->exec("DELETE FROM document WHERE id_message =$idmsg AND type='img'"); // suppression image
        $dir='../images/theme/'.$idtheme.'/'.$idsujet.'/'.$idmsg.'jpg';
        if(file_exists($dir))unlink('../images/theme/'.$idtheme.'/'.$idsujet.'/'.$idmsg.'.jpg');
    }
    if (isset($_POST['pdf'])) {
        $idpdf = $_POST['pdf'];
        $db->exec("UPDATE document SET statut='accepte' WHERE id_document=$idpdf ");
    } else {
        $db->exec("DELETE FROM document WHERE id_message =$idmsg AND type='pdf'"); // suppression pdf
        $dir='../images/theme/'.$idtheme.'/'.$idsujet.'/'.$idmsg.'pdf';
        if(file_exists($dir)) unlink('../images/theme/'.$idtheme.'/'.$idsujet.'/'.$idmsg.'.pdf');
    }
    $db->exec("UPDATE message SET date_maj=NOW() WHERE id_message=$idmsg "); 
    header('Location: GestionAdmin.php');

}
