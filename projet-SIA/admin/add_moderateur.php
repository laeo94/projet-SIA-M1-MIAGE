<?php
include '../db_config.php';
if (isset($_POST['idmb'])) {
    $idmb = json_decode($_POST['idmb']); //$idmb est maintenant une liste car arrive en tant que str
    $nb_mb = sizeof($idmb);
    //Ajout des nouveau moderateur
    for ($i = 0; $i < $nb_mb; $i++) {
        $id_mb_bureau = $idmb[$i];
        $db->exec("UPDATE membrebureau  SET moderateur = '1' WHERE id_mb_bureau = $id_mb_bureau") or die(print_r($db->errorInfo(), true)); // incorrect
    }

?>
    <h2 style=" border-bottom: 5px solid red;color: green;">Ajout de(s) modérateur(s) avec succès</h2>
    
    <?php 
        for ($i = 0; $i < $nb_mb; $i++) {
            $id_mb_bureau = $idmb[$i];
            $req = $db->query("SELECT * FROM membrebureau WHERE id_mb_bureau = $id_mb_bureau AND moderateur='1'");
            $row= $req->fetch();
            echo "<h4> - ".$row['nom'] . " " . $row['prenom']." | email :".$row['email'].'<h4>';
        }
    ?>

    <div class="container text-center">
        <button class="btn btn-success btn-lg" onclick="javascript:window.location.href='GestionAdmin.php'">Retour</button>
    </div>

<?php

} else {
    echo "Accès interdit";
}
?>