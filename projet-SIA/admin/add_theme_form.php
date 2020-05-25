<div style="background-color: #999900; color:white">
    <h2 class="text-center" style="color: white;">Ajout d'un nouveau thème </h2>
</div>
<section id="pannel">
    <div class="container">
        <div id="contenu">
            <div id="end">
                <form class="form-horizontal" action="javascript:this.addTheme();" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom_theme">Nom du thème :</label>
                        <input type="text" required="required" id="nom_theme" class="form-control" placeholder="Nom du thème " name="nom_theme">
                    </div>
                    <div class="form-group">
                        <label for="description_theme">Descriptif du thème </label>
                        <textarea type="text" name="description_theme" id="description_theme" class="form-control" placeholder="Description du thème" rows="5" required="required"></textarea>
                    </div>
                    <div id="sujet_form"></div>
                    <div class="btn btn-primary" onclick="addSujetToTheme();">Ajouter un nouveau sujet à ce thème </div>
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