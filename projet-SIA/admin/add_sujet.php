<?php
include '../db_config.php';
if (isset($_POST['nom']) && isset($_POST['theme']) && isset($_POST['msg'])) {
    require("../auth/loader.php");
    $id_moderateur = $idm->getId(); //recupere id courrant moderateur
    $nom = addslashes($_POST['nom']);
    $msg = addslashes($_POST['msg']);
    $theme = addslashes($_POST['theme']);
    $havemsg = 0;
    if ($msg != "") $havemsg = 1;
    //Ajout du sujet
    $db->exec("INSERT INTO sujet (id_theme,id_mb_bureau,nom, date_ajout, date_maj) VALUES ('$theme','$id_moderateur','$nom',NOW(),NOW())") or die(print_r($db->errorInfo(), true)); // incorrect
    //recupère id du sujet
    $rep = $db->query("SELECT id_sujet FROM sujet WHERE id_sujet = LAST_INSERT_ID()") or die(print_r($db->errorInfo(), true)); // incorrect
    $id = $rep->fetch();
    $idsujet = $id['id_sujet'];
    //creation dossier sujet 
    if (!file_exists('../images/theme/' . $theme . '/' . $idsujet)) {
        mkdir('../images/theme/' . $theme . '/' . $idsujet, 0777, true);
    }
    //Ajout du message s'il y en a un
    if ($msg != "") {
        $msg = addslashes($msg);
        $db->exec("INSERT INTO message (id_sujet,id_mb_bureau,description, date_ajout, date_maj) VALUES ('$idsujet','$id_moderateur','$msg',NOW(),NOW())") or die(print_r($db->errorInfo(), true)); // incorrect
        //recupère id du message
        $rep1 = $db->query("SELECT id_message FROM message WHERE id_message = LAST_INSERT_ID()") or die(print_r($db->errorInfo(), true)); // incorrect
        $id1 = $rep1->fetch();
        $idmsg = $id1['id_message'];

        //Si lien 
        $link = $_POST['link'];
        if ($link != "") {
            //Ajout du lien
            $db->exec("INSERT INTO lien (id_message,lien, date_ajout,statut) VALUES ('$idmsg','$link',NOW(),'accepte')") or die(print_r($db->errorInfo(), true)); // incorrect

        }
        //si image
        if (!empty($_FILES['img'])) {
            $file_name = $_FILES['img']['name'];
            $file_size = $_FILES['img']['size'];
            $file_tmp = $_FILES['img']['tmp_name'];
            $file_type = $_FILES['img']['type'];
            $var = explode('.', $_FILES['img']['name']);
            $file_ext = strtolower(end($var));
            if (move_uploaded_file($file_tmp, "../images/theme/" . $theme . "/" . $idsujet . '/' . $idmsg . '.' . $file_ext)) {
                $db->exec("INSERT INTO document (id_message,type,date_ajout,statut) VALUES ('$idmsg','img',NOW(),'accepte')");
            }
        }
        //si pdf
        if (!empty($_FILES['pdf'])) {
            $file_name = $_FILES['pdf']['name'];
            $file_size = $_FILES['pdf']['size'];
            $file_tmp = $_FILES['pdf']['tmp_name'];
            $file_type = $_FILES['pdf']['type'];
            $var = explode('.', $_FILES['pdf']['name']);
            $file_ext = strtolower(end($var));
            if (move_uploaded_file($file_tmp, "../images/theme/" . $theme . "/" . $idsujet . '/' . $idmsg . '.' . $file_ext)) {
                $db->exec("INSERT INTO document (id_message,type,date_ajout,statut) VALUES ('$idmsg','pdf',NOW(),'accepte')");
            }
        }
    }
?>
    <h2 style=" border-bottom: 5px solid red;color: green;">Ajout du " <?php echo $nom; ?> "a bien été ajouté</h2>
    <h4>Titre : <?php echo $nom; ?></h4>
    <h4>Thème du sujet: <?php

                        //recupère titre du theme
                        $rep = $db->query("SELECT nom FROM theme WHERE id_theme = $theme") or die(print_r($db->errorInfo(), true)); // incorrect
                        $id = $rep->fetch();
                        $titre = $id['nom'];

                        echo $titre; ?></h4>
    <?php

    if ($msg != "") {
    ?>
        <h4> Message : <?php echo $msg; ?> </h4>
    <?php
    }
    ?>
    <div class="container text-center">
        <button class="btn btn-success btn-lg" onclick="javascript:window.location.href='GestionAdmin.php'">Retour</button>
    </div>

<?php

} else {
    echo "Accès interdit";
}
?>