<?php
include '../db_config.php';
if (isset($_POST['search'])) {
    $all = $_POST['all'];
    $type = $_POST['type'];
    $mot =  addslashes($_POST['search']);
}
if ($type == 'theme') {  //Affichage de la recherche par theme
    if ($all == "all")  $req = $db->query("SELECT * FROM theme ORDER BY nom");
    else  $req = $db->query("SELECT * FROM theme WHERE nom LIKE '%" . $mot . "%' ORDER BY nom");
    if ($req->rowCount() == 0) {
?>
        Pas de thème avec le mot-clé : <?php echo $mot; ?>
    <?php
    } else {
    ?>
        <table class="table table table-striped table-bordered">
            <thead>
                <tr  style="text-align: center">
                    <th scope="col">Titre</th>
                    <th scope="col">Date d'ajout</th>
                    <th scope="col">Date mise à jour</th>
                    <th scope="col">Nb Sujet</th>
                    <th scope="col">Nb abonnés</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $req->fetch()) {
                    $id = $row['id_theme'];
                ?>
                    <tr  style="text-align: center">
                        <th><a href="../theme.php?tid="><?php echo $row['nom']; ?></a></th>
                        <td><?php echo $row['date_ajout']; ?></td>
                        <td><?php echo $row['date_maj']; ?></td>
                        <?php $req1 = $db->query("SELECT COUNT(id_theme) AS nb_sujet FROM sujet WHERE id_theme = $id");
                        $nb_sujet = $req1->fetch();
                        $req2 = $db->query("SELECT COUNT(id_theme) AS nb_abonne FROM abonnement WHERE id_theme = $id");
                        $nb_abonne = $req2->fetch();
                        ?>
                        <td><?php echo $nb_sujet['nb_sujet']; ?></td>
                        <td><?php echo $nb_abonne['nb_abonne']; ?></td>
                        <td><button type="button" class="btn btn-warning" onClick="window.location ='modif_form.php?type=<?php echo $type;?>&id=<?php echo $id;?>'">Modifier</button>
                            <button type="button" class="btn btn-danger" data-type="theme" data-toggle="modal" data-target="#exampleModal" data-value="<?php echo $row['nom']; ?>" data-whatever="<?php echo $row['id_theme']; ?>">Supprimer</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
} else if ($type == 'sujet') {  //Affichage de la recherche de sujet
    if ($all == "all") $req = $db->query("SELECT id_sujet,nom, date_ajout FROM sujet ORDER BY nom");
    else  $req = $db->query("SELECT id_sujet,nom, date_ajout FROM sujet WHERE nom LIKE '%" . $mot . "%' ORDER BY nom");
    if ($req->rowCount() == 0) {
    ?>
        Pas de sujet avec le mot-clé : <?php echo $mot; ?>
    <?php
    } else {
    ?>
        <table class="table table table-striped table-bordered">
            <thead>
                <tr  style="text-align: center">
                    <th scope="col">Titre</th>
                    <th scope="col">Date ajout</th>
                    <th scope="col">Nb msg</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $req->fetch()) {
                    $id = $row['id_sujet'];
                ?>
                    <tr  style="text-align: center">
                        <th><a href="../sujet.php?sid=<?php echo $id;?>" ><?php echo $row['nom']; ?></a></th>
                        <td><?php echo $row['date_ajout']; ?></td>
                        <?php $req1 = $db->query("SELECT COUNT(id_sujet) AS nb_msg FROM message WHERE id_sujet = $id");
                        $nb_msg = $req1->fetch();
                        ?>
                        <td><?php echo $nb_msg['nb_msg']; ?></td>
                        <td><button type="button" class="btn btn-warning" onClick="window.location ='modif_form.php?type=<?php echo $type;?>&id=<?php echo $id;?>'">Modifier</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-type="sujet" data-value="<?php echo $row['nom']; ?>" data-whatever="<?php echo $row['id_sujet']; ?>">Supprimer</button>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
} else if ($type == 'abonne') {  //Affichage de la recherche de abonne
    if ($all == "all") $req = $db->query("SELECT id_abonne,pseudo, email, pays_origine FROM abonne ORDER BY pseudo");
    else  $req = $db->query("SELECT  id_abonne,pseudo, email, pays_origine FROM abonne WHERE pseudo LIKE '%" . $mot . "%' 
    OR email LIKE '%" . $_POST['search'] . "%' 
    ORDER BY pseudo");
    if ($req->rowCount() == 0) {
    ?>
        Pas d'abonné avec le mot-clé : <?php echo $mot; ?>
    <?php
    } else {
    ?>
        <table class="table table table-striped table-bordered">
            <thead>
                <tr  style="text-align: center">
                    <th scope="col">Pseudo</th>
                    <th scope="col">Email</th>
                    <th scope="col">pays_origine</th>
                    <th scope="col">Nb msg</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $req->fetch()) {
                    $id = $row['id_abonne'];
                ?>
                    <tr  style="text-align: center">
                        <th><a href="../abonne/profileAbonne.php?idabo=<?= $id;?>"><img style="width:50px; height:50px;" src="../images/abonne/<?php echo $row['id_abonne']; ?>"> <?php echo $row['pseudo']; ?></a></th>
                        <td><?php echo $row['email']; ?></td>
                        <?php 
                        $req1 = $db->query("SELECT nom_fr FROM pays INNER JOIN abonne ON abonne.pays_origine = pays.id_pays WHERE abonne.id_abonne = $id");
                        $pays = $req1->fetch();
                        ?>
                        <td><?php echo $pays['nom_fr']; ?></td>
                        <?php $req1 = $db->query("SELECT COUNT(id_abonne) AS nb_msg FROM message WHERE id_abonne = $id");
                        $nb_msg = $req1->fetch();
                        ?>
                        <td><?php echo $nb_msg['nb_msg']; ?></td>

                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-type="abonne" data-value="<?php echo "pseudo : " . $row['pseudo'] . " | email : " . $row['email']; ?>" data-whatever="<?php echo $row['id_abonne']; ?>">Supprimer</button>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
} else if ($type == 'moderateur') {  //Affichage de la recherche de moderateur
    if ($all == "all") $req = $db->query("SELECT * FROM membrebureau  WHERE moderateur = '1' ORDER BY prenom");
    else  $req = $db->query("SELECT * FROM membrebureau WHERE moderateur ='1' AND nom LIKE '%" . $mot . "%' 
    OR prenom LIKE '%" . $_POST['search'] . "%'  OR email LIKE '%" . $_POST['search'] . "%'
    ORDER BY prenom");
    if ($req->rowCount() == 0) {
    ?>
        Pas de moderateur avec le mot-clé : <?php echo $mot; ?>
    <?php
    } else {
    ?>
        <table class="table table table-striped table-bordered">
            <thead>
                <tr  style="text-align: center">
                    <th scope="col">Moderateur</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nb msg</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $req->fetch()) {
                    $id = $row['id_mb_bureau'];
                ?>
                    <tr  style="text-align: center">
                        <th><img style="width:50px; height:50px;" src="../images/moderateur/<?php echo $row['id_mb_bureau']; ?>"> <?php echo $row['nom'] . " " . $row['prenom']; ?></th>
                        <td><?php echo $row['email']; ?></td>
                        <?php $req1 = $db->query("SELECT COUNT(id_mb_bureau) AS nb_msg FROM message WHERE id_mb_bureau = $id");
                        $nb_msg = $req1->fetch();
                        ?>
                        <td><?php echo $nb_msg['nb_msg']; ?></td>
                        <?php
                        if ($_SESSION == $row['id_mb_bureau']) { ?>
                            <td><button type="button" class="btn btn-warning" onClick="window.location ='modif_form.php?type=<?php echo $type;?>&id=<?php echo $id;?>'">Modifier</button></td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-type="moderateur" data-value="<?php echo $row['nom'] . " " . $row['prenom']; ?>" data-whatever="<?php echo $row['id_mb_bureau']; ?>">Supprimer</button>
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
} else { //Affichage des nouveaux document et lien d'un nouveau msg à valider
    if ($all == "all") {
        $req = $db->query("SELECT DISTINCT message.id_message, message.id_sujet, message.date_ajout FROM message LEFT JOIN lien ON lien.id_message = message.id_message LEFT JOIN document ON document.id_message =message.id_message WHERE lien.statut ='encours' OR document.statut='encours' ORDER BY message.date_ajout");
    }
    ?>
    <table class="table table table-striped table-bordered">
        <thead >
            <tr  style="text-align: center">
                <th scope="col">Theme/Sujet/Msg</th>
                <th scope="col"><i class="fa fa-image fa-2x" aria-hidden="true"></th>
                <th scope="col"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></th>
                <th scope="col"><i class="fa fa-link fa-2x" aria-hidden="true"></i></th>
                <th scope="col">Date ajout</th>
                <th scope="col">Vérification des lien/Docs</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $req->fetch()) {
                $id = $row['id_message'];
                $idsujet = $row['id_sujet'];
                //recupere nom sujet et theme 
                $req1 = $db->query("SELECT theme.nom AS themenom, theme.id_theme ,sujet.nom AS sujetnom FROM sujet INNER JOIN theme ON theme.id_theme = sujet.id_theme WHERE sujet.id_sujet = $idsujet ");
                $info = $req1->fetch();

            ?>
                <tr  style="text-align: center">
                    <th><a href="../theme.php?tid="><?php echo  $info['themenom'] ?></a>/<a href="../sujet.php?sid=<?php echo $idsujet;?>"><?php echo $info['sujetnom']; ?></a>/<?php echo $id;?></th>
                    <?php
                    //recupere image s'il y en a
                    $img = $db->query("SELECT id_document FROM document WHERE type='img' AND id_message =$id");
                    $idimg = $img->fetch();
                    //recupere doc s'il y en a
                    $pdf = $db->query("SELECT id_document FROM document WHERE type='pdf' AND id_message =$id");
                    $idpdf = $pdf->fetch();
                    //recupere lien s'il y en a
                    $link = $db->query("SELECT lien FROM lien WHERE id_message =$id");
                    $idlink = $link->fetch();
                    ?>
                    <td>
                        <?php if ($idimg != false) { ?>
                            <img style="width:150px; height:150px;" src="../images/theme/<?php echo $info['id_theme'] . '/' . $idsujet . '/' . $id; ?>">
                        <?php } else { ?>
                            <i class="fas fa-ban fa-2x"></i>
                        <?php
                        } ?>
                    </td>
                    <td>
                        <?php if ($idpdf != false) { ?>
                            <i class="far fa-check-circle fa-2x"></i>
                        <?php } else { ?>
                            <i class="fas fa-ban fa-2x"></i>
                        <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($idlink != false) {echo substr($idlink['lien'],0,25);}else { ?>  <i class="fas fa-ban fa-2x"></i> <?php }?> 
                    </td>
                    <td><?php echo $row['date_ajout']; ?></td>
                    <td><button type="button" class="btn btn-warning" onClick="window.location = 'verification_msg_form.php?id=<?php echo $id;?>'">Vérifier</button></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php

}
?>