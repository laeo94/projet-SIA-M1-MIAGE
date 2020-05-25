<?php
include '../db_config.php';
?>

<div style="background-color: #999900; color:white">
    <h2 class="text-center" style="color: white;">Ajout d'un nouveau sujet </h2>
</div>

<section id="pannel">
    <div class="container">
        <div id="contenu">
            <div id="end">
                <form class="form-horizontal" action="javascript:this.addSujet();" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom">Nom du sujet :</label>
                        <input type="text" required="required" id="nom" class="form-control" placeholder="Nom du sujet " name="nom">
                    </div>
                    <div class="form-group">
                        <label for="nom">Choix du thème: </label>
                        <select name="theme" id="theme" required>
                            <option value="" selected disabled>Choisir un theme</option>
                            <?php
                            // Appel des thèmes
                            $req = $db->query("SELECT id_theme,nom FROM theme ORDER BY nom");
                            while ($row = $req->fetch()) {
                                echo "<option value=" . $row['id_theme'] . ">" . $row['nom'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div id="msg_form"></div>
                    <div id="add_msg_button" class="btn btn-primary" onclick="addMsgToSujet(); this.style.visibility='hidden';">Ajouter un nouveau message au sujet</div>
                    <div class="container text-right">
                        <button class="btn btn-warning">Enregistrer</button>
                        <button class="btn btn-success" onclick="history.go(-1)">Retour</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</section>