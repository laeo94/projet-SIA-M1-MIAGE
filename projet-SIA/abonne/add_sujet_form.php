<?php 
$req = $db->query("SELECT * from theme WHERE id_theme=$tid");
$data = $req->fetch();
$nomtheme = $data['nom'];
?>
<div class="container">
<div style="background-color: #999900; color:white">
    <h2 class="text-center" style="color: white;">Ajout d'un nouveau sujet au thème :<?=$nomtheme;?></h2>
</div>

<section id="pannel">
    <div class="container">
        <div id="contenu">
            <div id="end">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom">Nom du sujet :</label>
                        <input type="text" required="required" id="nom" class="form-control" placeholder="Nom du sujet " name="nom">
                    </div>

                    <button class="btn btn-warning">Enregistrer</button>
                    <button class="btn btn-success" onclick="history.go(-1)">Retour</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</section>
</div>