<?php 
require("../auth/loader.php");
$role = $idm->getRole(); //recupere role 
if($role=="moderateur"){
$_SESSION= $idm->getId(); //recupere id courrant
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Forum</title>
    <link rel="icon" type="image/png" href="../images/LogoEPA" />
    <link rel="stylesheet" href="GestionAdmin.css?v=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

</head>

<!--Insertion du navbar  -->
<?php include('navbar_admin.php'); ?>

<body style="margin-top:8% ;" >
    <div style="background-color: #999900; color:white">
        <h2 class="text-center" style="color: white;"> <i class="fas fa-tools"></i> Gestion du Forum</h2>

    </div>
    
    <section id="pannel">
        <!-- Liste des onglets -->
        <nav id="onglets">
            <ul>
                <li class="onglet actif">Nouveau doc/lien<i class="fas fa-inbox"></i></li>
                <li class="onglet">Gestion des thèmes <i class="fas fa-tasks"></i></li>
                <li class="onglet">Gestion des sujets <i class="fas fa-quote-right"></i></li>
                <li class="onglet">Gestion des abonnés <i class="fas fa-users"></i></li>
                <li class="onglet">Gestion des modérateurs <i class="fas fa-users"></i></li>
                <li class="onglet">Messages </li>
            </ul>
        </nav>

        <!-- Les contenus -->
        <div class="contenu actif">
            <br>
            <div id="Cible1">
                <?php
                $type = "msg";
                $all = "all";
                include('barSearch_admin.php');
                ?>
            </div>
        </div>

        <div class="contenu ">
            <div class="container  ">
                <div class="row">
                    <div class="col-4">
                        <button type="button" class="btn btn-success" onclick="search('theme','all')">Afficher tous les thèmes</button>
                        <button class="btn new_button" onclick="add('thème')"><i class="fas fa-plus-circle">Nouveau</i></button>
                    </div>
                    <div class="col">
                        <form class="form-inline" onsubmit="return false">
                            <input class="form-control form-control-sm w-75" type="text" id="search_box" placeholder="Rechercher un thème" aria-label="Search">
                            <button class="search_button" onclick="search('theme','')"> <i class="fas fa-search">Rechercher</i></button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div id="Cible2">
                <?php
                $type = "theme";
                $all = "all";
                include('barSearch_admin.php');
                ?>
            </div>
        </div>

        <div class="contenu">
            <div class="container text-center ">
                <div class="row">
                    <div class="col-4">
                        <button type="button" class="btn btn-success" onclick="search('sujet','all')">Afficher tous les sujets</button>
                        <button class="btn new_button" onclick="add('sujet')"><i class="fas fa-plus-circle">Nouveau</i></button>
                    </div>
                    <div class="col">
                        <form class="form-inline" onsubmit="return false">
                            <input class="form-control form-control-sm w-75" type="text" id="search_box1" placeholder="Rechercher un sujet" aria-label="Search">
                            <button class="search_button" onclick="search('sujet','')"> <i class="fas fa-search">Rechercher</i></button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div id="Cible3">
                <?php
                $type = "sujet";
                $all = "all";
                include('barSearch_admin.php');
                ?>
            </div>
        </div>

        <div class="contenu">
            <div class="container text-center ">
                <div class="row">
                    <div class="col-4">
                        <button type="button" class="btn btn-success" onclick="search('abonne','all')">Afficher tous les abonnés</button>
                    </div>
                    <div class="col">
                        <form class="form-inline" onsubmit="return false">
                            <input class="form-control form-control-sm w-75" type="text" id="search_box2" placeholder="Rechercher un(e) abonné(e) : pseudo, email" aria-label="Search">
                            <button class="search_button" onclick="search('abonne','')"> <i class="fas fa-search">Rechercher</i></button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div id="Cible4">
                <?php
                $type = "abonne";
                $all = "all";
                include('barSearch_admin.php');
                ?>
            </div>
        </div>

        <div class="contenu">
            <div class="container text-center ">
                <div class="row">
                    <div class="col-4">
                        <button type="button" class="btn btn-success" onclick="search('moderateur','all')">Afficher tous les moderateur</button>
                        <button class="btn new_button" onclick="add('modérateur')"><i class="fas fa-plus-circle">Nouveau</i></button>
                    </div>
                    <div class="col">
                        <form class="form-inline" onsubmit="return false">
                            <input class="form-control form-control-sm w-75" type="text" id="search_box3" placeholder="Rechercher : nom , prénom ou email" aria-label="Search">
                            <button class="search_button" onclick="search('moderateur','')"> <i class="fas fa-search">Rechercher</i></button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div id="Cible5">
                <?php
                $type = "moderateur";
                $all = "all";
                include('barSearch_admin.php');
                ?>
            </div>
        </div>
        <div class="contenu">
        <?php include 'mail.php'; ?>
        </div>
    </section>

    <!--Message de suppresion validation-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formfield" method="POST" action="javascript:this.supp();">
                    <div class="form-group">
                            <input disabled="disabled" type="text" class="form-control" id="type">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Id :</label>
                            <input disabled="disabled" type="text" class="form-control" id="id">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Nom :</label>
                            <input disabled="disabled" type="text" class="form-control" id="nom">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <input class="deletenote btn btn-danger" type="submit" value="Confirmer" />
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<!--Insertion du footer de la page -->
<?php 
}else{
    include ('../navbar_forum.php');
    echo "Accès refusé : Veuillez vous connecter";
}
?>
<?php include ('../footer.php');?>

<!--SCRIPT POUR modifier la page   -->
<script src="GestionAdmin_ajax.js"> </script>
<script>
    //SUPPRESSION
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('whatever') // Extract info from data-* attributes
        var nom = button.data('value')
        var type = button.data('type')
        var modal = $(this)
        modal.find('.modal-title').text('Supprimer ' + nom + '?')
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #nom').val(nom)
        modal.find('.modal-body #type').val(type)
    })

    $('#submit').click(function() {
        $('#formfield').submit();
    });
</script>
