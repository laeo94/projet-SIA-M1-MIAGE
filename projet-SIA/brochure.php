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

<body style="margin-top:6%">
<div style="text-align: center;width: 100%;padding:9%;background-repeat: no-repeat;background-size: cover;background-image:url(images/brochure)">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div id="titre1">
                Brochures et guides
            </div>
        </div>
    </div>
    <br>
    <div class="container" >
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div id="titre2">
                Chaque année, la mairie de Paris édite des brochures, plans et guides pour vous aider à planifier votre séjour et organiser votre événement dans la capitale. Découvrez ci-dessous les éditions que nous mettons à votre disposition. Tous sont consultables en ligne :
            </div>
        </div>
    </div>
</div>
    <br>
    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:6%; margin-bottom:5%">
        <div class="container-fluid" id="BigContainer">
        <br>
            <div class="row">

                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="opacity1">
                        <div>
                            <div id="border">
                                <a onclick="popup ('pdf/seloger.pdf', 'PDF')">
                                    <div style="margin:0; padding:0; background: url('pdf/seloger') no-repeat center;  background-size: 100% 100%;width:105%; height:200px;"></div>
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="opacity1">
                        <div>
                            <div id="border">
                                <a onclick="popup ('pdf/ouapprendrelefrancais.pdf', 'PDF')">
                                    <div style="margin:0; padding:0; background: url('pdf/apprendrefrancais.png') no-repeat center;  background-size: 100% 100%;width:105%; height:200px;"></div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="opacity1">
                        <div>
                            <div id="border">
                                <a onclick="popup ('pdf/guide_solidarite.pdf', 'PDF')"><img src="pdf/guide_solidarite.png" width="105%;" height="200px;"></a>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="opacity1">
                        <div>
                            <div id="border">
                                <a onclick="popup ('pdf/etudiant.pdf', 'PDF')"><img src="pdf/etudiant.png" style="width:105%; height:200px;"></a>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="opacity1">
                        <div>
                            <div id="border">
                                <a onclick="popup ('pdf/Plaquette_presentation_EPA.pdf', 'PDF')"><img src="pdf/Plaquette_presentation_EPA.png" width="100%;" height="200px;"></a>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="opacity1">
                        <div>
                            <div id="border">

                                <a onclick="popup ('pdf/sante.pdf', 'PDF')">
                                    <div style="margin:0; padding:0; background: url('pdf/sante.png') no-repeat center;  background-size: 100% 100%;width:105%; height:200px;"></div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
<br><br>
        </div>
    </div>

    </div>
    <br>
</body>
<?php
include('footer.php');
?>

</html>

<style type="text/css">
    #titre1 {

        text-align: center;
        color: brown;
        font-size: 75px;
        letter-spacing: 7px;
        font-family: cursive;
    }

    #titre2 {
        text-align: center;
        font-size: 20px;
        color:white;
    }


    #BigContainer {
        border: solid;
        border-color: green;
        width: 90%;
        text-align: center;
    }

    #img {
        width: 90%;
        height: 190px;
    }

    #border {
        margin-top: 5%;
        padding-right: 5%;

        border: solid;
        border-color: green;
    }

    #body {

        width: 100%;
        text-align: center;
        margin: auto;
        display: inline-block;

    }

    #container-img {
        text-align: center;
    }

    /*EFFET IMAGE */
    /* Opacité */
    .opacity1 div img {
        opacity: 1;
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
    }

    .opacity1 div:hover img {
        opacity: .5;
    }

    @media screen and (min-device-width: 0px) and (max-device-width: 600px) {
        #titre1 {


            color: #091AB3;
            font-size: 30px;
            letter-spacing: 7px;
        }


        #titre2 {

            color: #F73939;
            font-size: 20px;
        }
    }
</style>

<script>
    function popup(adresse, nom) {

        width = 1000;

        height = 800;

        window.open(adresse, nom, "width=" + width + ",height=" + height + ",left=100,top=100,scrollbars=yes,resizable=yes,directories=no,location=no,menubar=no,status=no,toolbar=no,dependent=yes");

    }
</script>