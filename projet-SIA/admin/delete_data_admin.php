<?php
include '../db_config.php';
require("../auth/loader.php");
$_SESSION =$idm->getId(); //recupere id courrant moderateur
function rrmdir($dir)
{
    if (is_dir($dir)) { // si le paramètre est un dossier
        $objects = scandir($dir); // on scan le dossier pour récupérer ses objets
        foreach ($objects as $object) { // pour chaque objet
            if ($object != "." && $object != "..") { // si l'objet n'est pas . ou ..
                if (filetype($dir . "/" . $object) == "dir") rmdir($dir . "/" . $object);
                else unlink($dir . "/" . $object); // on supprime l'objet
            }
        }
        reset($objects); // on remet à 0 les objets
        rmdir($dir); // on supprime le dossier
    }
}

function suppMsg($db, $id)
{
    //Recupère msg lié au sujet
    $req1 = $db->query("SELECT id_message FROM message WHERE id_sujet = $id");
    //supprime les réponses,lien et doc lié au sujet
    while ($row1 = $req1->fetch()) {
        $id_msg = $row1['id_message'];
        $db->exec("DELETE FROM reponse WHERE id_message =$id_msg");
        $db->exec("DELETE FROM lien WHERE id_message = $id_msg"); //suppression lien lié aux sujet
        $db->exec("DELETE FROM document WHERE id_message = $id_msg"); //suppression des doc
    }
    $db->exec("DELETE FROM message WHERE id_sujet =$id"); // suppression msg lié a aux sujet supprimé
}
if (isset($_GET['type']) && isset($_GET['id']) && isset($_GET['nom'])) {
    $type = $_GET['type'];
    $nom = $_GET['nom'];
    $id = $_GET['id'];

    //Suppression theme 
    if ($type == "theme") {
        //Recupère sujets lié a ce theme
        $req = $db->query("SELECT id_sujet FROM sujet WHERE id_theme = $id");
        while ($row = $req->fetch()) {
            $id_sujet = $row['id_sujet'];
            suppMsg($db, $id_sujet);
        }
        $db->exec("DELETE FROM sujet WHERE id_theme =$id "); // suppression sujets lié a ce theme
        $db->exec("DELETE FROM theme WHERE id_theme =$id ") or die(print_r($db->errorInfo(), true)); // suppression theme
        //supprime le dossier image theme
        $dir = '../images/theme/' . $id;
        rrmdir($dir);
    }
    //Suppression d'un sujet
    else if ($type == "sujet") {
        suppMsg($db, $id);
        //Recupere id du theme
        $rep = $db->query("SELECT id_theme FROM sujet WHERE id_sujet = $id") or die(print_r($db->errorInfo(), true)); // incorrect
        $id1 = $rep->fetch();
        $idtheme = $id1['id_theme'];
        //supprime le dossier sujet du theme
        $dir = '../images/theme/' . $idtheme . '/' . $id;
        rrmdir($dir);
        $db->exec("DELETE FROM sujet WHERE id_sujet =$id "); // suppression sujet

    }

    //suppression abonne
    else if ($type == "abonne") {
        //supprime l'abonne
        $db->exec("DELETE FROM abonne WHERE id_abonne =$id ") or die(print_r($db->errorInfo(), true));
        //supprime son image dans le dossier abonne
        $dir = '../images/abonne/' . $id.'.jpg';
        if(file_exists($dir)) unlink($dir);

        //archive ses msg, sujet c'est a dire mettre id_abonne dans les table a null
        $db->exec("UPDATE sujet SET id_abonne=null WHERE id_abonne=$id ");
        $db->exec("UPDATE message SET id_abonne=null WHERE id_abonne=$id ");
    } else if ($type == "moderateur") {
        //supprime le modérateur
        $db->exec("UPDATE membrebureau SET moderateur='0' WHERE id_mb_bureau =$id ") or die(print_r($db->errorInfo(), true));
        //supprime son image dans le dossier abonne
        $dir = '../images/moderateur/' . $id.'.jpg';
        if(file_exists($dir)) unlink($dir);

             //archive ses msg, sujet c'est a dire mettre id_abonne dans les table a null
             $db->exec("UPDATE sujet SET id_mb_bureau=null WHERE id_mb_bureau=$id ");
             $db->exec("UPDATE message SET id_mb_bureau=null WHERE id_mb_bureau=$id ");
    }

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestion Forum</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    </head>
    <!--Insertion du navbar  -->
    <?php include('navbar_admin.php'); ?>

    <body style="margin-top:8% ;">
        <div style="background-color: #999900; color:white">
            <h2 class="text-center" style="color: white;">Suppression effectué !</h2>
        </div>
        <div class="container text-center">
            <h4>
                <?php

                if ($type == "theme") echo "Thème supprimé ainsi que ses sujets et messages :";
                else if ($type == "sujet") echo "Sujet supprimé ainsi que ses messages/docs/lien";
                else if ($type == "abonne") echo "Abonné supprimé ainsi que ses messages et sujet";
                else echo "Modérateur supprimé ";
                echo " " . $nom . "<br><br>";
                ?>
            </h4>
            <div class="container text-center">
                <button class="btn btn-success btn-lg" onclick="javascript:window.location.href='GestionAdmin.php'">Retour</button>
            </div>
        </div>



    </body>

    </html>
<?php

} else {
    echo "Erreur";
}
?>