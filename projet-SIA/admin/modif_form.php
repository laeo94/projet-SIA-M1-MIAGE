<?php
include '../db_config.php';
require("../auth/loader.php");
$_SESSION = $idm->getId(); //Recupere id courant de l'admin
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    //Si theme recupère donné de ce theme
    if ($type == "theme") {
        $req = $db->query("SELECT * FROM theme WHERE id_theme=$id");
        $row = $req->fetch();
        $nom = $row['nom'];
        $description = $row['description'];
    }
    //Si sujet recupère donné de ce sujet
    else if ($type == "sujet") {
        $req = $db->query("SELECT * FROM sujet WHERE id_sujet=$id");
        $row = $req->fetch();
        $nom = $row['nom'];
        $idtheme = $row['id_theme'];
        if (!empty($row['id_abonne'])) {
            $idauteur = $row['id_abonne'];
            $req1 = $db->query("SELECT pseudo FROM abonne WHERE id_abonne = $idauteur");
            $row2 = $req1->fetch();
            $auteur = $row2['pseudo'] . ' (Abonné(e))';
        } else {
            $idauteur = $row['id_mb_bureau'];
            $req1 = $db->query("SELECT nom, prenom FROM membrebureau WHERE id_mb_bureau = $idauteur");
            $row2 = $req1->fetch();
            $auteur = $row2['nom'] . ' ' . $row2['prenom'] . ' (Admin)';
        }
    }

    if ($type == "moderateur") {

        if ($id != $_SESSION) {
            echo "Acces inderdit vous n'êtes pas authorisé a modifier ce modérateur";
        } else {
            $req = $db->query("SELECT * FROM membrebureau WHERE id_mb_bureau=$id");
            $row = $req->fetch();
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $email = $row['email'];
        }
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestion Admin Modification</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        <!--SCRIPT POUR modifier la page   -->
        <script src="add_data_ajax.js"> </script>
    </head>
    <!--Insertion du navbar  -->
    <?php include('navbar_admin.php'); ?>

    <body style="margin-top:8% ;">
        <div style="background-color: #999900; color:white">
            <h2 class="text-center" style="color: white;">Modification <?php echo $type; ?> </h2>
        </div>

        <?php if ($type == 'theme') { //PARTIE THEME 
        ?>

            <section id="pannel">
                <div class="container">
                    <div id="contenu">

                        <form id="formfield" class="form-horizontal" method="post" action="modif.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input type="hidden" name="type" value="<?php echo $type; ?>" />
                            <div class="form-group">
                                <label for="nom_theme">Nom du thème :</label>
                                <input type="text" required="required" id="nom_theme" class="form-control" placeholder="Nom du thème " name="nom_theme" value="<?php echo $nom; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description_theme">Descriptif du thème : </label>
                                <textarea type="text" name="description_theme" id="description_theme" class="form-control" placeholder="Description du thème" rows="5" required="required"><?php echo $description; ?></textarea>
                            </div>
                        </form>
                        <div class="container text-right">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Enregistrer la modification</button>
                            <button class="btn btn-success" onclick="history.go(-1)">Retour</button>
                        </div>
                        <br>
                        <div class="container" style="background-color: brown">
                            <h2 class="text-center" style="color: white;">Sujet(s) du thème : <?php echo $nom; ?>
                            </h2>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="table-responsive">
                                    <?php
                                    $req2 = $db->query("SELECT id_sujet,nom FROM sujet  WHERE id_theme =$id");

                                    if ($req2 != false) {
                                    ?>
                                        <table class="table  table-striped table-bordered" style="table-layout: fixed; width:100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Modifier</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                while ($row2 = $req2->fetch()) {
                                                ?>
                                                    <tr>
                                                        <th style="word-wrap: break-word;" scope="row"><?php echo  $row2['nom']; ?></th>
                                                        <td><button type="button" class="btn btn-primary"><a style="color: white;" href="modif_form.php?type=sujet&id=<?php echo $row2['id_sujet']; ?>">Modifier le sujet </button></td>
                                                    </tr>
                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo "Pas de sujet";
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        <?php
        } else if ($type == 'sujet') { ?>

            <section id="pannel">
                <div class="container">
                    <div id="contenu">

                        <form id="formfield" class="form-horizontal" method="post" action="modif.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input type="hidden" name="type" value="<?php echo $type; ?>" />
                            <div class="form-group">
                                <label for="nom_theme">Titre du sujet :</label>
                                <input type="text" required="required" id="nom_sujet" class="form-control" placeholder="Titre du sujet " name="nom_sujet" value="<?php echo $nom; ?>">
                            </div>
                            <label for="nom_theme"> Créateur du sujet : <?php echo $auteur; ?></label>
                            <div id="msg_form"></div>
                            <div id="add_msg_button" class="btn btn-primary" onclick="addMsgToSujet(); this.style.visibility='hidden';">Ajouter un nouveau message au sujet</div>
                            <br>
                            <div class="container" style="background-color: brown">
                                <h2 class="text-center" style="color: white;">Message(s) dans le sujet : <?php echo $nom; ?>
                                </h2>
                            </div>
                            <br>
                            <div class="container">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table table-bordered " style="table-layout: fixed; width:100%;">

                                            <?php
                                            $req2 = $db->query("SELECT * FROM message WHERE id_sujet=$id ORDER BY date_ajout DESC");

                                            if ($req2 != false) {  ?>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Message</th>
                                                        <th style="width:100px;" scope="col">Supprimer</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row2 = $req2->fetch()) {
                                                        $idmessage = $row2['id_message'];
                                                        $dateajout = $row2['date_ajout'];
                                                        $descriptionmsg = $row2['description'];
                                                        //recupere les messages :
                                                        if (!empty($row2['id_abonne'])) {
                                                            $idauteur = $row2['id_abonne'];
                                                            $req3 = $db->query("SELECT pseudo FROM abonne WHERE id_abonne = $idauteur");
                                                            $row3 = $req3->fetch();
                                                            $auteurmsg = $row3['pseudo'];
                                                        } else {
                                                            $idauteur = $row2['id_mb_bureau'];
                                                            $req3 = $db->query("SELECT nom, prenom FROM membrebureau WHERE id_mb_bureau = $idauteur");
                                                            $row3 = $req3->fetch();
                                                            $auteurmsg = $row3['prenom'] . ' (Admin)';
                                                        }

                                                    ?>

                                                        <tr>
                                                            <div class="row">
                                                                <div clas="col">
                                                                    <td style="word-wrap: break-word;">
                                                                        <?php echo 'Auteur :' . $auteurmsg . '  Date ajout : ' . $dateajout . '<br>' ?>
                                                                        <?php

                                                                        //recupere id_message si le message est une réponse à un msg
                                                                        $req4 = $db->query("SELECT id_message FROM reponse WHERE id_reponse = $idmessage");

                                                                        if ($rep = $req4->fetch()) {
                                                                            $idmsgreponse = $rep['id_message'];
                                                                            //recupere le message en question 
                                                                            $req5 = $db->query("SELECT description FROM message WHERE id_message = $idmsgreponse");
                                                                            $rep1 = $req5->fetch();
                                                                            echo '<p style="border :solid">Réponse aux message :<br>' . $rep1['description'] . '<br><br></p>';
                                                                        }

                                                                        ?><?php echo $descriptionmsg . '<br>';
                                                                            //recupere lien, image ou pdf s'il yen a 
                                                                            //recupere image s'il y en a
                                                                            $img = $db->query("SELECT id_document FROM document WHERE type='img' AND id_message =$idmessage");
                                                                            $idimg = $img->fetch();
                                                                            //recupere doc s'il y en a
                                                                            $pdf = $db->query("SELECT id_document FROM document WHERE type='pdf' AND id_message =$idmessage");
                                                                            $idpdf = $pdf->fetch();
                                                                            //recupere lien s'il y en a
                                                                            $link = $db->query("SELECT id_lien, lien FROM lien WHERE id_message =$idmessage");
                                                                            $idlink = $link->fetch();
                                                                            if ($idlink != false) { ?> <a href="<?php echo $idlink['lien']; ?>" target="_blank"><?php echo $idlink['lien']; ?></a> <br><?php }
                                                                                                                                                                                                    if ($idimg != false) { ?> <img style="width:200px; height:200px;" src="../images/theme/<?php echo $idtheme . '/' . $id . '/' . $idmessage . '.jpg'; ?>"> <br> <?php }
                                                                                                                                                                                                                                                                                                                                                                if ($idpdf != false) { ?> <a href="../images/theme/<?php echo $idtheme . '/' . $id . '/' . $idmessage . '.pdf'; ?>" target="_blank">Fichier pdf : Voir <br></a><?php } ?>

                                                                    </td>
                                                                    <td><input type="checkbox" style=" width: 30px;height: 30px; " id="messages[]" name="messages[]" value="<?php echo $row2['id_message']; ?>"></td>
                                                                </div>
                                                            </div>
                                                        </tr>

                                                <?php }
                                                } else {
                                                    echo "Pas de message";
                                                } ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="container text-right">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Enregistrer la modification</button>
                            <button class="btn btn-success" onclick="history.go(-1)">Retour</button>
                        </div>


                    </div>
                </div>

            </section>

        <?php
        } else if ($type == "moderateur" && $id == $_SESSION) { ?>

            <section id="pannel">
                <div class="container">
                    <div id="contenu">
                        <form id="formfield" class="form-horizontal" method="post" action="modif.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input type="hidden" name="type" value="<?php echo $type; ?>" />
                            <p style="text-align: center"> <img style="width:100px; height:100px;" src="../images/moderateur/<?php echo $id; ?>"> <br>
                                <input type="checkbox" style=" width: 20px;height: 20px; " id="removeimg" name="removeimg" value="<?php echo $id ?>"> Supprimer image <br> Modifier/ajouter une image <input type="file" id="img" name="img" accept="image/jpg"></p>
                            <div class="form-group">
                                <label for="nom_theme">Nom :</label>
                                <input type="text" required="required" id="nom_moderateur" class="form-control" placeholder="Votre nom " name="nom_moderateur" value="<?php echo $nom; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nom_theme">Prénom:</label>
                                <input type="text" required="required" id="prenom_moderateur" class="form-control" placeholder="Votre prénom " name="prenom_moderateur" value="<?php echo $prenom; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nom_theme">Email:</label>
                                <input type="text" required="required" id="email_moderateur" class="form-control" placeholder="Votre email " name="email_moderateur" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nom_theme">Changer mot de passe</label>
                                <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Mot de passe"></div>

                            <div class="container" style="background-color: brown">
                                <h4 class="text-center" style="color: white;"> Mes abonnements: </h4>
                            </div>
                            <?php
                            $requete = $db->query("SELECT id_theme, nom FROM theme ");
                            while ($theme = $requete->fetch()) {
                                $idtheme = $theme['id_theme'];
                                $requete2 = $db->query("SELECT * FROM abonnement WHERE id_theme='$idtheme' AND id_mb_bureau='$_SESSION'");
                            ?>

                                <div class="form-group">
                                    <input type="checkbox" name="abonnements[]" <?php if ($requete2->fetch()) { ?>checked<?php } ?> data-toggle="toggle" data-onstyle="success" data-on="Abonné" data-off="Pas abonné" value="<?php echo $theme['id_theme']; ?>">
                                    <?php echo $theme['nom']; ?> </div>
                            <?php } ?>
                        </form>
                        <div class="container text-right">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Enregistrer la modification</button>
                            <button class="btn btn-success" onclick="history.go(-1)">Retour</button>
                        </div>
                        <br>
                        <div class="container" style="background-color: brown">
                            <h2 class="text-center" style="color: white;"> Mes sujet(s):
                            </h2>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="table-responsive">
                                    <?php
                                    $req2 = $db->query("SELECT id_sujet,nom FROM sujet  WHERE id_mb_bureau =$id");

                                    if ($req2 != false) {
                                    ?>
                                        <table class="table  table-striped table-bordered" style="table-layout: fixed; width:100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Modifier</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                while ($row2 = $req2->fetch()) {
                                                ?>
                                                    <tr>
                                                        <th style="word-wrap: break-word;" scope="row"><?php echo  $row2['nom']; ?></th>
                                                        <td><button type="button" class="btn btn-primary"><a style="color: white;" href="modif_form.php?type=sujet&id=<?php echo $row2['id_sujet']; ?>">Modifier le sujet </button></td>
                                                    </tr>
                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo "Pas de sujet";
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        <?php
        }
        ?>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmer la modification ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input class="deletenote btn btn-danger" id="confirme" value="Confirmer" />
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
    <!--Insertion du footer de la page -->
    <?php include('../footer.php'); ?>
<?php
} else {
    echo "Accès interdit";
}
?>


<style>
    label {
        color: green;
        font-weight: bold;
    }

    #pannel {
        padding: 2em;
    }

    #contenu {
        /* definition des onglet 'normaux' */
        padding: 1em 2em;
        border: solid 10px #804000;
        font-weight: bold;
        border-radius: 10px 10px 0 0;
        color: #804000;
    }
</style>

<script>
    //SUPPRESSION
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var modal = $(this)

    })

    $('#confirme').click(function() {
        $('#formfield').submit();
    });
</script>