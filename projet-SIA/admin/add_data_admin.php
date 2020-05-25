<?php
 require("../auth/loader.php");
 $_SESSION= $idm->getId(); //recupere id courrant
if (isset($_GET['type'])) {
    $type = $_GET['type'];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestion Admin Ajout</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <!--SCRIPT POUR modifier la page   -->
        <script src="add_data_ajax.js"> </script>
    </head>
    <!--Insertion du navbar  -->
    <?php include('navbar_admin.php'); ?>

    <body style="margin-top:8% ;">
        <?php
        if ($type == 'thème') {
            include('add_theme_form.php');
        } else if ($type == 'sujet') {
            include('add_sujet_form.php');
        } else if ($type == "modérateur") {
            include('add_moderateur_form.php');
        }
        ?>

    </body>

    </html>
    <!--Insertion du footer de la page -->
<?php include ('../footer.php');?>
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