<?php
include '../db_config.php';
if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['sujet'])) {
    require("../auth/loader.php");
    $id_moderateur =$idm->getId(); //recupere id courrant moderateur
    $nom = addslashes($_POST['nom']);
    $description = addslashes($_POST['description']);
    $sujet = json_decode($_POST['sujet']); //$sujet est maintenant une liste car arrive en tant que str
    $nb_sujet = sizeof($sujet);
    //Ajout du theme
    $db->exec("INSERT INTO theme (nom , description, date_ajout, date_maj) VALUES ('$nom','$description',NOW(),NOW())")
        or die(print_r($db->errorInfo(), true)); // incorrect

    //Ajout des nouveau sujet s'il y en a 
    //Recupere id du theme
    $rep = $db->query("SELECT id_theme FROM theme WHERE id_theme = LAST_INSERT_ID()") or die(print_r($db->errorInfo(), true)); // incorrect
    $id = $rep->fetch();
    $idtheme = $id['id_theme'];
     //Creation du dossier ou les image de ce theme sera inserer
     if (!file_exists('../images/theme/' . $idtheme)) {
        mkdir('../images/theme/' . $idtheme, 0777, true);
    }
    for ($i = 0; $i < $nb_sujet; $i++) { //si ajout sujet au thème
        $nomSujet = addslashes($sujet[$i]);
        $db->exec("INSERT INTO sujet (id_theme,id_mb_bureau,nom, date_ajout, date_maj) VALUES ('$idtheme','$id_moderateur','$nomSujet',NOW(),NOW())") or die(print_r($db->errorInfo(), true)); // incorrect
        //Recupere id du theme
        $rep1 = $db->query("SELECT id_sujet FROM sujet WHERE id_sujet= LAST_INSERT_ID()") or die(print_r($db->errorInfo(), true)); // incorrect
        $id1 = $rep1->fetch();
        $idsujet = $id1['id_sujet'];
        //Creation du dossier ou les image du sujet sera inserer
        if (!file_exists('../images/theme/' . $idtheme.'/'.$idsujet)) {
            mkdir('../images/theme/' . $idtheme.'/'.$idsujet, 0777, true);
        }
    }



?>
    <h2 style=" border-bottom: 5px solid red;color: green;">Ajout du thème " <?php echo $nom; ?> "a bien été ajouté</h2>
    <h4>Titre : <?php echo $nom; ?></h4>
    <h4>Description: <?php echo $description; ?></h4>
    <?php

    for ($i = 0; $i < $nb_sujet; $i++) {
    ?>
        <h4> Sujet : <?php echo $sujet[$i]; ?> </h4>
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