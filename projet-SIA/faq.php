<?php
require("auth/loader.php");
$role = "invite";
if ($idm->hasIdentity()) {
    $role = $idm->getRole(); //recupere role 
    $_SESSION = $idm->getId(); //recupere id courrant
}
if ($role == "invite") include 'navbar_forum.php';
else if ($role == "moderateur") include 'admin/navbar_admin.php';
else include 'abonne/navbar_abonne.php'; ?>
<!DOCTYPE html>
<html>

<body style="margin-top:8%">
    <div class="container-fluid">
        <h1 style="text-align:center">FAQ</h1>
        <h3 style="text-align:center">
            Foire aux questions<br><img src="images/img1"></h3>
    </div>

    <div class="container">
        <div class="faq">
            <div class="faq-q">
                <span>
                    <b>Que représente EPA?</b>
                </span>
                <p>
                    Agir ensemble pour l'Afrique est notre ambition.
                    Elle est née d’une prise de conscience collective (étudiants de la Cité Internationale Universitaire et habitués de la chapelle des Franciscains sise dans le 14ème arrondissement de Paris) devant la gravité des violences survenues au Rwanda en 1994, puis en Côte d'ivoire en 1999.
                    Pour conjurer le sentiment d'impuissance et de culpabilité ressenti en pareille circonstance, le meilleur moyen était de nous engager dans le projet de développement durable de l'Afrique.
                 </p>
            </div>
            <div class="faq-q">
                <span>
                    <b>Comment participer au forum?</b>
                </span>
                <p>
            Ce forum est accessible à tous internautes mais seuls pourront y participer activement les "abonnés" qui seront préalablement inscrits au sein du forum.
            L'abonné pourra participer au forum. Il pourra transmettre des liens vers d'autres sites et documents (pdf, image). Ceux-ci ne seront publiables qu'après avoir été visés par un modérateur.      
            </p>
            </div>
            <div class="faq-q">
                <span>
                    <b>Comment devient-on modérateur ?</b>
                </span>
                <p>
                Les modérateurs sont soit élus et font partie des membres du bureau  (en cas d'élection) ou bien directement nommés par les administrateurs. Les modérateurs sont choisis en fonction de leur implication et leur sérieux sur les forums. On ne devient clairement pas modérateur en le demandant. </p>
            </div>
            <div class="faq-q">
                <span>
                    <b>Comment se crée un nouveau thème?</b>
                </span>
                <p>
            Sur le forum EPA, seul les modérateurs ou administrateurs peuvent créer un nouveau thème.      
            </p>
            </div>
            <div class="faq-q">
                <span>
                    <b>Comment créer un nouveau sujet?</b>
                </span>
                <p>
            Toute personnes abonné au forum peuvent créer un nouveau sujet relative à un thème présent sur le forum.    
            </p>
            </div>
            <div class="faq-q">
                <span>
                    <b>Comment signaler un abus ou bien un message hors-charte ?</b>
                </span>
                <p>
                Si vous constatez un abus ou bien un message hors charte sur les forums, ou bien sur les commentaires de lien,images ..vous pouvez nous les signaler par email : epa20052001@yahoo.fr
                En principe les liens, images, documents ne sont publiable qu'après validation d'un modérateur ou administrateur.
                </p>
            </div>
            <div class="faq-q">
                <span>
                    <b>Comment rajouter/supprimer des abonnements dans mon profil ?</b>
                </span>
                <p>
                Vous pouvez voir les différents contenus auxquels vous êtes abonnés sur l’onglet “Paramètres” de votre profil. Vous pouvez voir les abonnements en cours et  permet de supprimer n’importe lequel des éléments ou d'en ajouter.
                </p>
            </div>
            <div class="faq-q">
                <span>
                    <b>Quelques liens utiles:</b>
                </span>
                <ul>
                    <li><a href="http://agencedys.com/wp-pass/">Programme d’Appui Au développement des Strategies mutualiste de Santé Informations et Contacts (PASS)</a></li>
                    <li><a href="http://www.uam-afro.org/index.html">Union de la Mutualité Africaine Université et Économie Sociale et Solidaire - 2015 (UMA)</a></li>
                    <li><a href="www.ove-national.education.fr">Observatoire national de la vie Etudiante (OVE)</a></li>
                    <li><a href="http://www.fondationgoree.org/memorial">Message de Gorée Purification de la Mémoire Pour une Humanité nouvelle (07/10/2003) (XIIIème SCEAM) </a></li>
                    <li><a href="http://www.rfi.fr/emission/20150108-togo-conducteurs-taxi-moto-mutuelle-transport-emploi-travail-cooperation-developpement">Mutuelle innovante au Togo pour les motos taxis </a></li>
                    <li><a href=" http://www.ilo.org/secsoc/information-resources/publications-and-tools/Toolsandmodels/WCMS_SECSOC_106/lang--fr/index.htm">Guide de gestion pour les mutuelles de santé en Afrique (publication OITE) </a></li>
                </ul>
            </div>


        </div>
    </div>
</body>

</html>
<?php
include('footer.php');
?>

<style>
    .faq {
        font-family: Helvetica;
        width: 75%;
        margin: 0 0 0 12%;
    }

    .faq-q {
        border-top: 2px dashed;
        border-color: yellow !important;
        margin: 0;
        padding: 30px;
        counter-increment: section;
        position: relative;
    }

    .faq-q span {
        font-size: 22px;
    }

    .faq-q:nth-child(even):before {
        content: counter(section);
        right: 100%;
        margin-right: -20px;
        position: absolute;
        border-radius: 50%;
        padding: 10px;
        height: 50px;
        width: 50px;
        background-color: brown;
        text-align: center;
        color: white;
        font-size: 110%;
    }

    .faq-q:nth-child(odd):before {
        content: counter(section);
        left: 100%;
        margin-left: -20px;
        position: absolute;
        border-radius: 50%;
        padding: 10px;
        height: 50px;
        width: 50px;
        background-color: brown;
        text-align: center;
        color: white;
        font-size: 110%;
    }



    .faq-q:nth-child(even) {
        border-left: 2px dashed;
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
        margin-right: 30px;
        padding-right: 0;
    }

    .faq-q:nth-child(odd) {
        border-right: 2px dashed;
        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;
        margin-left: 30px;
        padding-left: 0;
    }

    .faq-q:first-child {
        border-top: 0;
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }

    .faq-q:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    li a{
        color:green;
    }

</style>