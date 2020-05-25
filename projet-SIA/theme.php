<?php
require('db_config.php');
require('auth/loader.php');

if ($idm->hasIdentity()) {
    $role = $idm->getRole();
    $_SESSION = $idm->getId();
} else $role = "invite";

$SQL = "SELECT * FROM theme WHERE id_theme = ?";
$stmt = $db->prepare($SQL);
$res = $stmt->execute([$_GET['tid']]);
$theme = $stmt->fetch();

if ($res && !$theme) {
    $_SESSION['error'] = "L'événement n'existe pas.";
    redirect("Forum_Accueil.php");
    exit();
}

$SQL_nbSubs = "SELECT COUNT(id_theme) AS nbSubs FROM abonnement WHERE id_theme = ?";
$stmt2 = $db->prepare($SQL_nbSubs);
$res2 = $stmt2->execute([$theme['id_theme']]);
$nbSubs = $stmt2->fetch();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $theme['nom'] ?></title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script lanquage="javascript" type="text/javascript" src="js/ShowMenuResponsive.js"></script>
</head>

<?php
if ($role == "invite") require('navbar_forum.php');
else if ($role == "moderateur") require('admin/navbar_admin.php');
else require('abonne/navbar_abonne.php');
?>

<body style="margin-top:5%">
    <div class="container-fluid" style="text-align:center;width:100%;padding:5%;background-repeat:no-repeat;background-size:cover;background-image:url('images/forum1')">
        <br>
        <br>
        <div style="text-align:center">
            <h1 style="color:green;font-weight:bold;letter-spacing:0.35em;text-shadow:rgba(0,0,0,0.4) 0px 4px 5px; font-size:200%">
                Bienvenue sur le forum <br>d'Ensemble Pour l'Afrique</h1>
        </div>
        <br>
        <br>
    </div>
    <br>
    <div class="container">
    <div style="font-size: larger;">
        <a href="Forum_Accueil.php">Accueil</a>><a href="theme.php?tid=<?= $theme['id_theme'] ?>"><?= $theme['nom'] ?></a>
    </div>
        <h3 style="text-align:center;color:white;background-color:brown;font-family: cursive;margin:5%">Thème :<?= $theme['nom'] ?></h3>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <?php if ($role == "abonne") { ?>
                    <button type="button" id="search_box"class="btn btn-outline-success btn-block" onClick="window.location='abonne/add_sujet.php?tid=<?= $theme['id_theme']; ?>'">Ajouter un nouveau sujet</button>
                <?php } ?>
                <table class="table" style="table-layout:fixed;width:100%;">
                    <thead class="table-white">
                        <tr>
                            <th colspan="2"><?= $theme['nom'] ?></th>
                            <th>Nombre d'abonnés: <?= $nbSubs['nbSubs'] ?></th>
                        </tr>
                        <tr>
                            <td colspan="3">Description: <?= $theme['description'] ?></td>
                        </tr>
                    </thead>
                    <tbody >
                        <tr style=" background-color: #FAEBD7">
                            <th style="word-wrap: break-word;">Sujet</th>
                            <th style="word-wrap: break-word;">Nombre de messages</th>
                            <th style="word-wrap: break-word;">Dernier message</th>
                        </tr>
                        <?php
                        $SQL = "SELECT * FROM sujet WHERE id_theme = ? ORDER BY date_maj";
                        $stmt = $db->prepare($SQL);
                        $res = $stmt->execute([$theme['id_theme']]);
                        while ($subject = $stmt->fetch()) {
                            $SQL_nbMess = "SELECT COUNT(id_sujet) AS nbMess FROM message WHERE id_sujet = ?";
                            $stmt2 = $db->prepare($SQL_nbMess);
                            $res2 = $stmt2->execute([$subject['id_sujet']]);
                            $nbMess = $stmt2->fetch();
                        ?>
                            <tr>
                                <td style="text-align:center;word-wrap: break-word"><i class="fab fa-discourse" style="color:green"></i><a href="sujet.php?sid=<?= $subject['id_sujet'] ?>" style="color:#808000"><?= $subject['nom'] ?></a></td>
                                <td style="text-align:center; word-wrap: break-word"><i class="fas fa-comments" style="color: green"></i> <?= $nbMess['nbMess'] ?></td>
                                <td style="word-wrap: break-word"><?= $subject["date_maj"] ?></td>
                            </tr>


                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12"style="text-align:center ">
                <img style="width:300px; height:100px;" src="images/Forum.png">
                <div style=" border-radius: 25px;border: solid grey">
                    <h4 class="section-title"> Nouveaux sujets sur le forum </h4>
                    <?php
                    $req5 = $db->query("SELECT * FROM sujet ORDER BY id_sujet DESC LIMIT 5");
                    while ($row5 = $req5->fetch()) {
                    ?>
                        <p style="overflow-wrap: break-word"><i class="fab fa-discourse" style="color:green"></i><a href="sujet.php?sid=<?php echo $row5['id_sujet']; ?>" style="color:#808000 ;"><?php echo $row5['nom']; ?></a> <br></p>
                    <?php
                    }
                    ?>
                </div>
                <div style="margin:5%">
                    <h4 class="section-title"><a style="color:brown" href="brochure.php"> > Brochures et guides Etudiants</a> </h4>

                </div>
                <div style=" border-radius: 25px;border: solid grey">
                    <h3 class="section-title"> Sujets d'actualité </h3>
                    <ul>
                        <i class="fas fa-newspaper"></i><a href="#" style="text-decoration: none;color: #3D443F;"> Education</a> <br>
                        <i class="fas fa-newspaper"></i> <a href="#" style="text-decoration: none;color: #3D443F;"> Projets </a><br>
                        <i class="fas fa-newspaper"></i> <a href="#" style="text-decoration: none;color: #3D443F;"> Technologie </a><br>
                        <i class="fas fa-newspaper"></i> <a href="#" style="text-decoration: none;color: #3D443F;"> Économie </a><br>
                        <i class="fas fa-newspaper"></i> <a href="#" style="text-decoration: none;color: #3D443F;"> Santé </a><br>
                        <i class="fas fa-newspaper"></i> <a href="#" style="text-decoration: none;color: #3D443F;"> Tourisme </a><br>
                        <i class="fas fa-newspaper"></i> <a href="#" style="text-decoration: none;color: #3D443F;"> Politique </a><br>
                        <i class="fas fa-newspaper"></i><a href="#" style="text-decoration: none;color: #3D443F;"> Bourse </a><br>
                    </ul>
                </div>
                <img style="width:300px; height:300px;" src="images/forumafrica.png">
            </div>
        </div>
    </div>
    <br>
</body>
<style>
    table {
		border-collapse: separate;
		border-spacing: 0 20px;
	}


</style>
</html>
<?php
require("footer.php");
?>
<style>