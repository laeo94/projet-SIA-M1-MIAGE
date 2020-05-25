<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to EPA</title>
    <link rel="icon" type="image/png" href="images/LogoEPA" />
    <link rel="stylesheet" href="css/EPA_Accueil.css?v=1">
    <link rel="stylesheet" href="css/Slider.css?v=1">
    <link rel="stylesheet" href="css/Content.css?v=1">
    <link rel="stylesheet" href="css/Footer.css?v=1">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script lanquage="javascript" type="text/javascript" src="js/ShowMenuResponsive.js"></script>
</head>

<!--Insertion du navbar -->
<?php include 'navbar_accueil.php'; ?>

<body style="margin-top:8%">
    <!--Mettre un margin top a chaque body car avec le navbar il cache le début -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="backgroundimg">
                <div class="titre petit_titre">
                    <h3 id="history">Ensemble Pour l'Afrique</h3><br />
                    <p > 
                        Agir ensemble pour l'Afrique est notre ambition. <br>
                        Elle est née d’une prise de conscience collective (étudiants de la Cité Internationale Universitaire et habitués de la chapelle des Franciscains sise dans le 14ème arrondissement de Paris) devant la gravité des violences survenues au Rwanda en 1994, puis en Côte d'ivoire en 1999.
                        <br>
                        Pour conjurer le sentiment d'impuissance et de culpabilité ressenti en pareille circonstance, le meilleur moyen était de nous engager dans le projet de développement durable de l'Afrique.</h4>
                    </p>
                        <button type="button" class="btn btn-danger btn-lg ">Faire un don <i class="fas fa-hand-holding-usd"></i></button>
                </div>
            </div>
            <br />
        </div>
    </div>
    <div class="page-wrapper">
        <!-- Content -->
        <div class="row">
            <div class="content">
                <!-- Main Content -->

                <div class="main-content">
                    <h2 class="recent-post-title" style="color:green"> Articles Récents</h2>

                    <div class="post clearfix" style="background-color:#EEE8AA">
                        <img src="images/covid.jpg" class="post-image">
                        <div class="post-preview">
                            <h3><a href="" style="text-decoration: none; color: #3D443F" class="post-chosen"> Covid-19 en Afrique, un miracle nommé chloroquine</a></h3>
                            <i class="far fa-user"> Duc-Chinh PHAM, </i>
                            <i class="far calendar"> 10 Avril 2020 </i>
                            <p class="preview-text">
                                L’espoir est tel que de nombreux pays africains n’ont pas attendu les résultats des essais cliniques menés sur la molécule. Démunis pour prendre en charge les ...
                            </p>
                            <a href="" class="btn read-more"> Lire la suite</a>
                        </div>
                    </div>

                    <div class="post clearfix" style="background-color:#EEE8AA">
                        <img src="images/africa7.jpg" class="post-image">
                        <div class="post-preview">
                            <h3><a href="" style="text-decoration: none; color: #3D443F" class="post-chosen"> Retour sur l'atelier de formation et d'échange sur la réalisation d'un projet eau </a></h3>
                            <i class="far fa-user"> Léa ONG, </i>
                            <i class="far calendar"> 10 Mars 2020</i>
                            <p class="preview-text">
                                Depuis quelques années, l’EPA accompagne des projets dans le domaine de l’Eau et de l’Assainissement dans plusieurs pays : Burkina Faso, Mali et Togo...
                            </p>
                            <a href="" class="btn read-more"> Lire la suite</a>
                        </div>
                    </div>

                    <div class="post clearfix" style="background-color:#EEE8AA">
                        <img src="images/accueildesetudiants.jpg" class="post-image">
                        <div class="post-preview">
                            <h3><a href="" style="text-decoration: none; color: #3D443F" class="post-chosen"> Accueil des étudiants africains à Paris </a></h3>
                            <i class="far fa-user"> Rowann TALON, </i>
                            <i class="far calendar"> 28 Novembre 2019</i>
                            <p class="preview-text">
                                Pour pouvoir étudier en France, il est nécessaire d'avoir un bon niveau de français, c'est pourquoi les candidats doivent pouvoir prouver leur maîtrise de cette langue par un diplôme de langue...
                            </p>
                            <a href="" class="btn read-more"> Lire la suite</a>
                        </div>
                    </div>
                </div>

                <div class="sidebar">

                    <!-- Search section -->

                    <div class="section search" style="background-color: #f7fa9e">
                        <h3 class="section-title"> Rechercher </h3>
                        <form>
                            <input type="text" name="search-term" class="text-input" placeholder="Rechercher...">
                            <div style="text-align:right;">
                                <button class="btn btn-danger" style="padding: 5px 10%;">
                                    <span>Envoyez</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="section news" style="background-color: #f7fa9e">
                        <h3 class="section-title"> Sujets d'actualité </h3>
                        <ul>
                            <li><a href="#" style="text-decoration: none;color: #3D443F;"> Education</a></li>
                            <li><a href="#" style="text-decoration: none;color: #3D443F;"> Projets </a></li>
                            <li><a href="#" style="text-decoration: none;color: #3D443F;"> Technologie </a></li>
                            <li><a href="#" style="text-decoration: none;color: #3D443F;"> Économie </a></li>
                            <li><a href="#" style="text-decoration: none;color: #3D443F;"> Santé </a></li>
                            <li><a href="#" style="text-decoration: none;color: #3D443F;"> Tourisme </a></li>
                            <li><a href="#" style="text-decoration: none;color: #3D443F;"> Politique </a></li>
                            <li><a href="#" style="text-decoration: none;color: #3D443F;"> Bourse </a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!--Form contact-->
            <div class="content">
                <div class="container-fluid" style="background-size: cover;
background-repeat: no-repeat;background-attachment:fixed;background-image:url('images/africa')">
                    <div class="col-12" style="padding:5%">
                        <h6 style="text-align:center;"><span style="text-shadow:rgba(0, 0, 0, 0.4) 0px 4px 5px;"><span style="font-size:31px;"><span style="font-weight:bold;"><span style="color:#E64310;"><span style="letter-spacing:0.35em;">Contactez nous !</span></h6>
                    </div>
                    <div class="container">

                        <form>
                            <div style="padding:1%;text-align:center;">
                                <input type="text" class="form-control" placeholder="Nom" required>
                            </div>
                            <div style="padding:1%;text-align:center;">

                                <input type="text" class="form-control" placeholder="Email" required>
                            </div>

                            <div style="padding:1%;text-align:center;">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Message" required></textarea>

                            </div>
                            <div style="text-align:center;">
                                <button class="btn btn-danger" style="padding: 5px 10%;">
                                    <span>Envoyez</span>
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
                <br>
            </div>
        </div>
    </div>
</body>
<!--Insertion du footer de la page -->
<?php include 'footer.php'; ?>


</html>

<style>
 .titre{
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 50px 50px 50px 50px;
    }

    #history {

        font-family: "peach cream", Arial, Helvetica, sans-serif;
        font-size: 50px;
        color: green;
    }

    .backgroundimg {
        background-image: url("images/background");
        height: 500px;
        /*background-position: center;*/
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }

    @media only screen and (max-width:900px) {
        .petit_titre{
        /*top: 50%;
        left: 50%;*/
        padding: 10px 30px 100px 30px !important;
      }
      .backgroundimg {
        background-image: url("images/background");
        height: 1000px;
       
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }

    }
</style>