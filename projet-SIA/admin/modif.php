<?php
include '../db_config.php';
require("../auth/loader.php");
$id_moderateur = $idm->getId();
if (isset($_POST['type']) && isset($_POST['id'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
    //Modification du theme
    if ($type == 'theme') {
        $nom = addslashes($_POST['nom_theme']);
        $description = addslashes($_POST['description_theme']);
        $db->exec("UPDATE theme SET nom='$nom' , description='$description', date_maj = NOW() WHERE id_theme=$id ") or die(print_r($db->errorInfo(), true));
    } else if ($type == 'sujet') {
        $nom = addslashes($_POST['nom_sujet']);
        $db->exec("UPDATE sujet SET nom='$nom', date_maj = NOW() WHERE id_sujet=$id ") or die(print_r($db->errorInfo(), true));
       $rep = $db->query("SELECT id_theme FROM sujet WHERE id_sujet=$id") or die(print_r($db->errorInfo(), true)); // incorrect
        $idt = $rep->fetch();
        $idtheme = $idt['id_theme'];
        //si nouveau message 
        if (isset($_POST['msg'])) {
            $msg = $_POST['msg'];
              $db->exec("INSERT INTO message (id_sujet,id_mb_bureau,description, date_ajout, date_maj) VALUES ('$id','$id_moderateur','$msg',NOW(),NOW())") or die(print_r($db->errorInfo(), true)); // incorrect
            //recupère id du message
            $rep1 = $db->query("SELECT id_message FROM message WHERE id_message = LAST_INSERT_ID()") or die(print_r($db->errorInfo(), true)); // incorrect
            $id1 = $rep1->fetch();
            $idmsg = $id1['id_message'];
            //Si lien 
            if (isset($_POST['link'])) {
                $link = $_POST['link'];
                $db->exec("INSERT INTO lien (id_message,lien, date_ajout,statut) VALUES ('$idmsg','$link',NOW(),'accepte')") or die(print_r($db->errorInfo(), true)); // incorrect
            }

            //si image 
            if (isset($_FILES['img'])) {
                $file_name = $_FILES['img']['name'];
                $file_size = $_FILES['img']['size'];
                $file_tmp = $_FILES['img']['tmp_name'];
                $file_type = $_FILES['img']['type'];
                $var = explode('.', $_FILES['img']['name']);
                $file_ext = strtolower(end($var));
                if (move_uploaded_file($file_tmp, "../images/theme/" . $idtheme . "/" . $id . '/' . $idmsg . '.' . $file_ext)) {
                    $db->exec("INSERT INTO document (id_message,type,date_ajout,statut) VALUES ('$idmsg','img',NOW(),'accepte')");
                }
            }

            //Si pdf
            if (isset($_FILES['pdf'])) {
                $file_name = $_FILES['pdf']['name'];
                $file_size = $_FILES['pdf']['size'];
                $file_tmp = $_FILES['pdf']['tmp_name'];
                $file_type = $_FILES['pdf']['type'];
                $var = explode('.', $_FILES['pdf']['name']);
                $file_ext = strtolower(end($var));
                if (move_uploaded_file($file_tmp, "../images/theme/" . $idtheme . "/" . $id . '/' . $idmsg . '.' . $file_ext)) {
                    $db->exec("INSERT INTO document (id_message,type,date_ajout,statut) VALUES ('$idmsg','pdf',NOW(),'accepte')");
                }
            }
        }

        //SI suppression message
        if(isset($_POST['messages'])){
            if (is_array($_POST['messages'])) {
                foreach($_POST['messages'] as $value){
                 //Suppression lien , images et pdf
                 $db->exec("DELETE FROM lien WHERE id_message =$value ");
                 if($db->exec("DELETE FROM document WHERE id_message =$value AND type='img'")){
                    $dir = '../images/theme/' . $idtheme.'/'.$id.'jpg';
                    if(file_exists($dir)) unlink($dir);
                 }
                 if($db->exec("DELETE FROM document WHERE id_message =$value AND type='pdf'")){
                    $dir = '../images/theme/' . $idtheme.'/'.$id.'pdf';
                    if(file_exists($dir)) unlink($dir);
                 }
                 //Supprime enfin le message
                 $db->exec("DELETE FROM message WHERE id_message=$value");
                }
              }
        }
    }else if($type=="moderateur"){
        if (isset($_POST['removeimg'])) { //suppression image
            $dir = '../images/moderateur/' . $id_moderateur.'.jpg';
            if(file_exists($dir)) unlink($dir);
        }
        //modification image 
        if (isset($_FILES['img'])) {
            $file_name = $_FILES['img']['name'];
            $file_size = $_FILES['img']['size'];
            $file_tmp = $_FILES['img']['tmp_name'];
            $file_type = $_FILES['img']['type'];
            $var = explode('.', $_FILES['img']['name']);
            $file_ext = strtolower(end($var));
            move_uploaded_file($file_tmp, "../images/moderateur/" . $id_moderateur. '.' . $file_ext);
        }
        //Modification information
        $nom = addslashes($_POST['nom_moderateur']);
        $prenom = addslashes($_POST['prenom_moderateur']);
        $email = $_POST['email_moderateur'];
        if(isset($_POST['mdp']) && $_POST['mdp']!=""){
            $mdp = $_POST['mdp'];
            $db->exec("UPDATE  membrebureau SET nom='$nom',prenom='$prenom', email='$email', mdp='$mdp' WHERE id_mb_bureau =$id_moderateur");
        
        }else{
            $db->exec("UPDATE membrebureau SET nom='$nom',prenom='$prenom', email='$email' WHERE id_mb_bureau =$id_moderateur");
        
        }
        //Modification abonnements
        $db->exec("DELETE FROM abonnement WHERE id_mb_bureau=$id_moderateur");
        foreach($_POST['abonnements'] as $theme)
        {
           $db->exec("INSERT INTO abonnement (id_theme,id_mb_bureau) VALUE ('$theme', '$id_moderateur')");
        }
    }
  header('Location: GestionAdmin.php');
} else {
    echo "Acces interdit";
}
