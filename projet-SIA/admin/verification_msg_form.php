<?php

 require("../auth/loader.php");
 $_SESSION= $idm->getId(); //recupere id courrant
 
    //recuperation information du message
    if (isset($_GET['id'])) {
        include '../db_config.php';
        $idmsg = $_GET['id'];
        $req = $db->query("SELECT * FROM message WHERE id_message=$idmsg");
        $row = $req->fetch();
        $idabo = $row['id_abonne'];
        $idsujet = $row['id_sujet'];
        $msg = addslashes($row['description']);
        $date_ajout = $row['date_ajout'];
        //recuperation auteur abonne car moderateur message deja validé automatiquement
        $req1 = $db->query("SELECT pseudo, email FROM abonne WHERE id_abonne=$idabo");
        $row1 = $req1->fetch();
        $pseudo = $row1['pseudo'];
        $mailabo = $row1['email'];

        //Recuperation nom du theme et sujet
        //recupere nom sujet et theme 
        $req2 = $db->query("SELECT theme.nom AS themenom , theme.id_theme,sujet.nom AS sujetnom FROM sujet INNER JOIN theme ON theme.id_theme = sujet.id_theme WHERE sujet.id_sujet = $idsujet ");
        $info = $req2->fetch();
        $nomsujet = $info['sujetnom'];
        $nomtheme = $info['themenom'];
        $idtheme = $info['id_theme'];
        //recupere image s'il y en a
        $img = $db->query("SELECT id_document FROM document WHERE type='img' AND id_message =$idmsg");
        $idimg = $img->fetch();
        //recupere doc s'il y en a
        $pdf = $db->query("SELECT id_document FROM document WHERE type='pdf' AND id_message =$idmsg");
        $idpdf = $pdf->fetch();
        //recupere lien s'il y en a
        $link = $db->query("SELECT id_lien, lien FROM lien WHERE id_message =$idmsg");
        $idlink = $link->fetch();

    ?>


     <!--Insertion du navbar  -->
     <?php include('navbar_admin.php'); ?>
     <!DOCTYPE html>
     <html>

     <head>
         <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
         <title>Gestion Admin Verification</title>
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
         <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
         <style>
             #pannel {
                 padding: 2em;
             }

             #contenu {
                 padding: 1em 2em;
                 border: solid 10px #804000;
                 font-weight: bold;
                 border-radius: 10px 10px 0 0;
                 color: #804000;

             }
         </style>
     </head>


     <body style="margin-top:8% ;">
         <div style="background-color: #999900; color:white">
             <h2 class="text-center" style="color: white;">Vérification du message </h2>
         </div>
         <section id="pannel">
             <div class="container">
                 <div id="contenu">
                     <h4 class="text-center" style="color: green;">
                         <?php
                            echo ' Thème : ' . $nomtheme . '<br>';
                            echo ' Sujet : ' . $nomsujet . '<br>';
                            echo ' Message de : ' . $pseudo . ' | email :' . $mailabo . '<br>';
                            ?>
                     </h4>
                     <div id="end">
                         <form id="formfield" class="form-horizontal" method="post" action="verification_msg.php" enctype="multipart/form-data">
                             <input type="hidden" name="idmessage" value="<?php echo $idmsg; ?>" />
                             <input type="hidden" name="idtheme" value="<?php echo $idtheme; ?>" />
                             <input type="hidden" name="idsujet" value="<?php echo $idsujet; ?>" />
                             <table class="table table table-bordered" style="table-layout: fixed; width:100%;">
                                 <tbody>
                                     <tr>
                                         <div class="row">
                                             <div clas="col-lg-8 col-sm-12">
                                                 <td style="word-wrap: break-word;"><?php echo 'Message :' .stripslashes($msg); ?></td>
                                                 <td style=" width:100px;text-align:center">Valider</td>
                                             </div>
                                         </div>
                                     </tr>
                                     <?php if ($idimg != false) { ?>
                                         <tr>
                                             <td>
                                                 <?php
                                                    echo 'Image :'; ?> <img style="width:300px; height:300px;" src="../images/theme/<?php echo $idtheme . '/' . $idsujet . '/' . $idmsg; ?>"> </td>
                                             <td><input type="checkbox" style="width: 30px;height: 30px; " id="img" name="img" value="<?php echo $idimg['id_document']; ?>"></td> <?php } ?>
                                         <?php if ($idlink != false) { ?>
                                         <tr>
                                             <td style="word-wrap: break-word; ">Lien : <a href="<?php echo $idlink['lien']; ?>" target="_blank"><?php echo $idlink['lien']; ?></a> </td>
                                             <td><input type="checkbox" style=" width: 30px;height: 30px; " id="link" name="link" value="<?php echo $idlink['id_lien']; ?>"></td>
                                         </tr>
                                     <?php
                                            }
                                            if ($idpdf != false) { ?>
                                         <tr>
                                             <td style="word-wrap: break-word; "> <a href="../images/theme/<?php echo $idtheme . '/' . $idsujet . '/' . $idmsg . '.pdf'; ?>" target="_blank">Voir en entier <br></a>
                                                 <embed src="../images/theme/<?php echo $idtheme . '/' . $idsujet . '/' . $idmsg . '.pdf'; ?>" width=700 height=500 type='application/pdf' /> </td>
                                             <td><input type="checkbox" style=" width: 30px;height: 30px; " id="pdf" name="pdf" value="<?php echo $idpdf['id_document']; ?>"></td>
                                         </tr> <?php } ?>
                                 </tbody>
                             </table>
                         </form>
                         <div class="container text-right">
                             <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Enregistrer</button>
                             <button class="btn btn-success" onclick="history.go(-1)">Retour</button>
                         </div>
                         <br>

                     </div>
                 </div>
             </div>
         </section>
     </body>
     <!--Message de suppresion validation-->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Confirmer la vérification ?</h5>
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

     </html>
<!--Insertion du footer de la page -->
<?php include ('../footer.php');?>
 <?php
    } else {
        echo "Accès interdit";
    }
    ?>

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

