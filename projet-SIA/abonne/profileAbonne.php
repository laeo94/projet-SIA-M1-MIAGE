<?php
include '../db_config.php';
require("../auth/loader.php");
if ($idm->hasIdentity()) {
    $role = $idm->getRole(); //recupere role 
    $_SESSION = $idm->getId(); //recupere id courrant
    if ($role == "moderateur") {
        $idabo = $_GET['idabo'];
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Profile</title>

    <link rel="stylesheet" href="/projet-sia/css/profile.css?v=1">
    <link rel="stylesheet" href="/projet-sia/css/Footer.css?v=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script lanquage="javascript" type="text/javascript" src="js/ShowMenuResponsive.js"></script>
    <script lanquage="javascript" type="text/javascript" src="../js/profile.js"></script>
</head>
<?php if ($role == "moderateur") include '../admin/navbar_admin.php';
else include 'navbar_abonne.php'; ?>
<?php
if ($role == "moderateur") {
    $req1 = $db->query("SELECT * FROM abonne WHERE id_abonne= $idabo");
} else {
    $req1 = $db->query("SELECT * FROM abonne WHERE id_abonne= $_SESSION");
}
$infos = $req1->fetch();
?>

<body style="margin-top:8% ">
    <div class="container">
        <!-- profile header -->
        <div class="profile-header">
            <div class="profile-img">
                <img src="../images/abonne/<?php if ($role == "moderateur") echo $idabo;
                                            else echo $_SESSION; ?>" alt="">
            </div>
            <div class="profile-nav-info">

                <h3>
                    <?php echo $infos['pseudo']; ?>
                </h3>
                <h4>
                    <?php echo " {$infos['nom']} {$infos['prenom']} ";

                    //echo $infos['prenom'];         

                    ?> </h4>
                <div class="infos persos">

                    <p class="ancienneté">
                        Membre depuis: <?php echo $infos['date_enreg'] ?>

                    </p>

                    <span class="pays">
                        <i class="fa fa-globe"></i> <?php
                                                    if ($role == "moderateur") {
                                                        $req2 = $db->query("SELECT nom_fr FROM pays INNER JOIN abonne on abonne.pays_origine=pays.id_pays WHERE abonne.id_abonne= $idabo");
                                                    } else {
                                                        $req2 = $db->query("SELECT nom_fr FROM pays INNER JOIN abonne on abonne.pays_origine=pays.id_pays WHERE abonne.id_abonne= $_SESSION");
                                                    }
                                                    $pays = $req2->fetch();
                                                    echo $pays['nom_fr']; ?>
                    </span>
                </div>
            </div>
            <div class="profile-option">
                <div class="notification">
                    <i class="fa fa-bell"></i>
                    <span class="alert-message"> 1 </span>
                </div>
            </div>
        </div>
        <!-- profile body -->
        <div class="main-bd">

            <div class="left-side">
                <div class="profile-side">
                    <p class="user-mail"><i class="fa fa-envelope"></i>
                        <?php echo $infos['email'] ?>
                    </p>
                    <?php if ($role == "abonne") { ?>
                        <div class="profile-btn">

                            <form class="chatbtn" method="POST" action="upload.php" enctype="multipart/form-data">
                                <input type="hidden" name="iduser" value="<?= $_SESSION; ?>" />
                                <!-- On limite le fichier à 100Ko -->
                                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                                <strong> Modifier mon image : </strong>
                                <input id="detail" type="file" name="avatar">
                                <input id="detail" type="submit" name="envoyer" value="Envoyer le fichier">
                            </form>

                        </div>

                        <button class="chatbtn"> <i class="fa fa-pen"></i>
                            <a href="modif_infos_perso.php"> Modifier mon profil </a> </button>
                    <?php } ?>
                </div>
            </div>

            <div class="right-side">
                <div class="nav">
                    <ul>
                        <li onclick="openTab(event, 'firsttab')" class="tablinks"> Messages/Sujets</li>
                        <!-- <li onclick="openTab(event, 'secondtab')" class="tablinks"> Informations</li> -->
                        <li onclick="openTab(event, 'thirdtab')" class="tablinks"> Paramètres</li>
                    </ul>
                </div>

                <div id="firsttab" class="tabcontent">
                    <!-- <h2> Mes messages </h2>
                    <p>Affichage des derniers messages</p>
                    -->
                    <?php
                    if ($role == "moderateur") {
                        $req3 = $db->query("SELECT * FROM message WHERE id_abonne=$idabo");
                    } else {
                        $req3 = $db->query("SELECT * FROM message WHERE id_abonne=$_SESSION");
                    }
                    ?>



                    <body>
                        <h> Statistiques:<br /> </h>
                        <?php
                        if ($role == "moderateur") {
                            $req5 = $db->query("SELECT COUNT(id_message) as nbmessages FROM message WHERE id_abonne=$idabo");
                        } else {
                            $req5 = $db->query("SELECT COUNT(id_message) as nbmessages FROM message WHERE id_abonne=$_SESSION");
                        }
                        $nbmessages = $req5->fetch();
                        if ($role == "moderateur") {
                            $req6 = $db->query("SELECT COUNT(id_sujet) as nbsujets FROM sujet WHERE id_abonne=$idabo");
                        } else {
                            $req6 = $db->query("SELECT COUNT(id_sujet) as nbsujets FROM sujet WHERE id_abonne=$_SESSION");
                        }

                        $nbsujets = $req6->fetch();
                        echo "Nombre de messages: {$nbmessages['nbmessages']}";
                        echo "<br>";
                        echo  "Nombre de sujets: {$nbsujets['nbsujets']}";

                        ?>

                        <div class="container" style="background-color: brown">
                            <h2 class="text-center" style="color: white;">
                                Derniers messages:</h2>
                        </div>
                        <table style="width:100%">
                            <tr>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Nombre de réponses</th>
                                <th>Voir plus</th>
                            </tr>
                            <?php
                            while ($mess = $req3->fetch()) {
                                $des = $mess['description'];
                                $idwritter = $mess['id_abonne'];
                                $date = $mess['date_ajout'];
                                $idmess = $mess['id_message'];
                                $idsujet = $mess['id_sujet'];
                                $req4 = $db->query("SELECT COUNT(id_message) as nbreponses FROM reponse WHERE id_message=$idmess");
                                $nbreponses = $req4->fetch();

                            ?>

                                <tr>
                                    <td><?php echo $des ?></td>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $nbreponses['nbreponses'] ?></td>
                                    <td><u> <a href="../sujet.php?sid=<?= $idsujet; ?>">Voir le message</a> </u> </td>
                                </tr>
                            <?php } ?>


                        </table>

                        <div class="container" style="background-color: brown">
                            <h2 class="text-center" style="color: white;">
                                Derniers sujets:</h2>
                        </div>
                        <table style="width:100%">
                            <tr>
                                <th>Sujet</th>
                                <th>Date</th>
                                <th>Nombre de messages</th>
                                <th>Voir plus</th>
                            </tr>
                            <?php
                            if ($role == "moderateur") {
                                $req7 = $db->query("SELECT * FROM sujet WHERE id_abonne=$idabo");
                            } else {
                                $req7 = $db->query("SELECT * FROM sujet WHERE id_abonne=$_SESSION");
                            }

                            while ($sujets = $req7->fetch()) {
                                $nomsujet = $sujets['nom'];
                                $datesujet = $sujets['date_ajout'];
                                $ids = $sujets['id_sujet'];
                                $req8 = $db->query("SELECT COUNT(id_message) as nbmsg FROM message WHERE id_sujet=$ids");
                                $nbmsg = $req8->fetch();

                            ?>

                                <tr>
                                    <td><?php echo $nomsujet ?></td>
                                    <td><?php echo $datesujet ?></td>
                                    <td><?php echo $nbmsg['nbmsg'] ?></td>
                                    <td><u> <a href="../sujet.php?sid=<?= $ids; ?>">Voir le sujet</a> </u> </td>
                                </tr>
                            <?php } ?>


                        </table>

                    </body>

                </div>

                <div id="thirdtab" class="tabcontent">
                    <div class="container" style="background-color: brown">
                        <?php
                        if ($role == "moderateur") { ?>
                            <h4 class="text-center" style="color: white;"> Ses abonnements: </h4>
                        <?php
                        } else { ?>
                            <h4 class="text-center" style="color: white;"> Mes abonnements: </h4>
                        <?php
                        }
                        ?>


                    </div>
                    <form id="formfield" class="form-horizontal" method="post" action="abonnement_theme.php" enctype="multipart/form-data">

                        <?php
                        $requete = $db->query("SELECT id_theme, nom FROM theme ");
                        while ($theme = $requete->fetch()) {
                            $idtheme = $theme['id_theme'];
                            if ($role == "moderateur") {
                                $requete2 = $db->query("SELECT * FROM abonnement WHERE id_theme='$idtheme' AND id_abonne='$idabo'");
                            } else {
                                $requete2 = $db->query("SELECT * FROM abonnement WHERE id_theme='$idtheme' AND id_abonne='$_SESSION'");
                            }

                        ?>

                            <div class="form-group">
                                <input type="checkbox" name="abonnements[]" <?php if ($requete2->fetch()) { ?>checked<?php if ($role == "moderateur") { ?> disabled <?php }
                                                                                                                                                                } ?> data-toggle="toggle" data-onstyle="success" value="<?php echo $theme['id_theme']; ?>">
                                <?php echo $theme['nom']; ?> </div>
                        <?php } ?>
                    </form>
                    <?php if ($role == "abonne") { ?>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Enregistrer la modification</button>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    </div>
    <br>
</body>
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
<?php include("../footer.php"); ?>

</html>

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