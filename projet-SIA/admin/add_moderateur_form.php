<div style="background-color: #999900; color:white">
    <h2 class="text-center" style="color: white;">Ajout d'un/plusieur nouveau modérateur </h2>
</div>
<section id="pannel">
    <div class="container">
        <div id="contenu">
            <div id="end">
                <?php
                //recupère liste des membres
                include '../db_config.php';
                $req = $db->query("SELECT id_mb_bureau,nom,prenom,email FROM membrebureau 
             WHERE moderateur ='0' ORDER BY prenom");
                if ($req->rowCount() == 0) {
                ?>
                    Tous les membres sont des modérateurs du forum;
                <?php
                } else {
                ?>
                    <form class="form-horizontal" action="javascript:if(validateCheck()) addModerateur();" enctype="multipart/form-data">
                        <table class="table table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Membres du bureau</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Ajouter</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $req->fetch()) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['nom'] . " " . $row['prenom']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="checkbox" name="idmb" value="<?php echo $row['id_mb_bureau']; ?>">
                                            </div>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="container text-center">
                            <button class="btn btn-warning">Enregistrer</button>
                        </div>
                    </form>
                <?php } ?>
                <div class="container text-right">
                    <button class="btn btn-success" onclick="history.go(-1)">Retour</button>
                </div>
            </div>
        </div>
    </div>
</section>