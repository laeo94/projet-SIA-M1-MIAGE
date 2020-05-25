<?php
include 'db_config.php';
require("auth/loader.php");
$role = "invite";
if ($idm->hasIdentity()) {
    $role = $idm->getRole(); //recupere role 
    $_SESSION = $idm->getId(); //recupere id courrant
}


?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>EPA FORUM</title>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script lanquage="javascript" type="text/javascript" src="js/ShowMenuResponsive.js"></script>

</head>
<?php
if ($role == "invite") include 'navbar_forum.php';
else if ($role == "moderateur") include 'admin/navbar_admin.php';
else include 'abonne/navbar_abonne.php'; ?>

<body style="margin-top:5% ">
    <div class="container-fluid" style="text-align: center;width: 100%;padding:5%;background-repeat: no-repeat;background-size: cover;background-image:url('images/forum1')">
        <br>
        <br>
        <div style="text-align:center">
            <h1 style="color:green; font-weight:bold;letter-spacing:0.35em;text-shadow:rgba(0, 0, 0, 0.4) 0px 4px 5px; font-size:200%">
                Bienvenue sur le forum <br>d'Ensemble Pour l'Afrique</h1>
        </div>
        <br><br>

    </div>
    <br>
    <div class="container">
    <h3 style="text-align:center;color:white;background-color:brown;font-family: cursive;margin-left:5%;margin-right:5%">Accueil Forum</h3>
        <div class="input-group" style="text-align:center ;margin-bottom:1%">
            <div class="container" style="text-align:center;">
                <form class="form-inline" onsubmit="return false">
                    <input class="form-control form-control-md w-75" type="text" id="search_box" placeholder="Rechercher un thème ou un sujet" aria-label="Search">
                    <button class="btn btn-secondary" onclick="search()"> <i class="fas fa-search">Rechercher</i></button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div id="cible"></div>
                <table class="table" style="table-layout: fixed; width:100%;">
                    <thead class="table-white">
                        <?php
                        //recupere nombre de theme
                        $req = $db->query("SELECT COUNT(id_theme) AS nb_theme FROM theme")->fetch();
                        $nb_theme = $req['nb_theme'];
                        //recupere nombre d'abonné
                        $req = $db->query("SELECT  COUNT(DISTINCT id_mb_bureau)+COUNT(DISTINCT id_abonne) AS nb_abonne FROM abonnement")->fetch();
                        $nb_abonne = $req['nb_abonne'];
                        ?>
                        <tr>
                            <th>Theme</th>
                            <th style="word-wrap: break-word;">Nombre de thèmes : <?php echo $nb_theme; ?> </th>
                            <th style="word-wrap: break-word;">Nombre d'abonnés : <?php echo $nb_abonne; ?></th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php

                        $req = $db->query("SELECT * FROM theme ORDER BY nom");
                        while ($row = $req->fetch()) {
                            $idtheme = $row['id_theme'];
                            $nomtheme = $row['nom'];
                            $description = $row['description'];
                            //Nb sujet
                            $req1 = $db->query("SELECT COUNT(id_theme) AS nb_sujet FROM sujet WHERE id_theme = $idtheme");
                            $row1 = $req1->fetch();
                            $nb_sujet = $row1['nb_sujet'];
                            //Nb abonne
                            $req2 = $db->query("SELECT COUNT(id_theme) AS nb_abonne FROM abonnement WHERE id_theme = $idtheme");
                            $row2 = $req2->fetch();
                            $nb_abonne = $row2['nb_abonne'];

                        ?>

                            <tr style="background-color:#FAEBD7">
                                <th style="word-wrap: break-word;" colspan="2"><a style="color:green" href="theme.php?tid=<?= $idtheme ?>"><?php echo $nomtheme; ?></a>
                                </th>
                                <th style="word-wrap: break-word;">Nb sujet : <?php echo $nb_sujet; ?> | Nb abonné : <?php echo $nb_abonne; ?></th>
                            </tr>
                            <tr>
                                <td colspan="3" style="word-wrap: break-word;"> Description : <?php echo $description; ?> <br>
                               <p style="text-align:right"> <a href="theme.php?tid=<?= $idtheme ?>"><button class="btn btn-warning">Voir tous les sujets </button></a></td>
                        </p>
                            </tr>
                          
                            <?php
                            //Recupère les 3 premier sujet
                            $req3 = $db->query("SELECT * FROM sujet WHERE id_theme =$idtheme LIMIT 3");

                            while ($row3 = $req3->fetch()) {

                                $idsujet = $row3['id_sujet'];
                                $nomsujet = $row3['nom'];
                                //Nb de message:
                                $req4 = $db->query("SELECT COUNT(id_message) AS nb_message FROM message WHERE id_sujet = $idsujet");
                                $row4 = $req4->fetch();
                                $nb_msg = $row4['nb_message'];
                                //Auteur

                                if (!empty($row3['id_abonne'])) {
                                    $idauteur = $row3['id_abonne'];
                                    $req5 = $db->query("SELECT pseudo FROM abonne WHERE id_abonne = $idauteur");
                                    $row5 = $req5->fetch();
                                    $auteur = $row5['pseudo'];
                                } else if (!empty($row3['id_mb_bureau'])) {
                                    $idauteur = $row3['id_mb_bureau'];
                                    $req5 = $db->query("SELECT nom, prenom FROM membrebureau WHERE id_mb_bureau = $idauteur");
                                    $row5 = $req5->fetch();
                                    $auteur = $row5['prenom'] . ' (Admin)';
                                } else {
                                    $auteur = "Ancien membre";
                                }
                            ?>

                                <tr>
                                    <th style="word-wrap: break-word;" colspan="2"><i class="fab fa-discourse" style="color:green"></i>Sujet : <a href="sujet.php?sid=<?php echo $idsujet; ?>" style="color:#808000"><?php echo $nomsujet; ?></a></th>
                                    <th style="word-wrap: break-word; "> <i class="fas fa-user-alt" style="color:green"></i> <?php echo $auteur; ?> | <i class="fas fa-comments" style="color: green"></i> <?php echo $nb_msg; ?></th>
                                </tr>


                            <?php
                            }
                            ?>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align:center ">
                <img style="width:300px; height:100px;" src="images/Forum.png">
                <div style=" border-radius: 25px;border: solid grey">
                    <h4 class="section-title"> Nouveaux sujets sur le forum </h4>

                    <?php
                    $req5 = $db->query("SELECT * FROM sujet ORDER BY id_sujet DESC LIMIT 5");
                    while ($row5 = $req5->fetch()) { ?>
                        <p style="overflow-wrap: break-word"><i class="fab fa-discourse" style="color:green"></i><a href="sujet.php?sid=<?php echo $row5['id_sujet']; ?>" style="color:#808000 ;"><?php echo $row5['nom']; ?></a> <br></p>
                    <?php

                    }
                    ?>
                </div>
                <div style="margin:2%">
                    <h4 class="section-title"><a style="color:brown" href="brochure.php"> Brochures et guides Etudiants</a> </h4>

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
                <img style="width:250px; height:350px;margin:5%" src="images/forumafrica.png">
            </div>
        </div>

    </div>
    <br>
</body>

</html>

<?php include("footer.php"); ?>
<style>
    table {
		border-collapse: separate;
		border-spacing: 0 20px;
	}


</style>

<script>
    function getXhr() {
        var xhr = null;
        if (window.XMLHttpRequest) // Firefox et autres
            xhr = new XMLHttpRequest();
        else if (window.ActiveXObject) { // Internet Explorer 
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else { // XMLHttpRequest non supporté par le navigateur 
            alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
            xhr = false;
        }
        return xhr;
    }
    var xhr = getXhr();

    function search() {
        console.log("aaaa");
        mot = document.getElementById('search_box').value;
        xhr.onreadystatechange = function() {
            // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
            if (xhr.readyState == 4 && xhr.status == 200) {
                leselect = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options a la liste
                document.getElementById('cible').innerHTML = leselect;
            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST", "search.php", true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        // ne pas oublier de poster les arguments
        xhr.send("search=" + mot);
    }
    function annuler(){
        document.getElementById('cible').innerHTML = "";
    }
</script>