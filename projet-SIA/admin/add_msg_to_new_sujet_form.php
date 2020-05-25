<div class="container" id="new_msg">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="msg">Message : </label>

                <button onclick="boldText()" type="button" title="Gras"><i class="fa fa-bold" aria-hidden="true"></i></button>
                <button onclick="italicText()" type="button" title="Italic"> <i class="fa fa-italic" aria-hidden="true"></i></button>
                <button onclick="underlineText()" type="button" title="Souligné"> <i class="fa fa-underline" aria-hidden="true"></i></button>
                <button onclick="strikeText()" type="button" title="Barré"> <i class="fa fa-strikethrough" aria-hidden="true"></i></button>
                <button onclick="docText('link','yes')" id="addlink" type="button" title="Ajouter un lien"> <i class="fa fa-link" aria-hidden="true"></i></button>
                <button onclick="docText('img','yes')" id="addimg" type="button" title="Ajouter une image"> <i class="fa fa-picture-o" aria-hidden="true"></i></button>
                <button onclick="docText('pdf','yes')" id="addpdf" type="button" title="Ajouter une document pdf"> <i class="fa fa-file-pdf" aria-hidden="true"></i></button>
                <textarea style="resize: none; " onkeyup="addModif('msg')" type="text" name="msg" id="msg" class="form-control" placeholder="Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances. En postant sur nos espaces, vous vous engagez à en respecter la charte d'utilisation. Tout message discriminatoire ou incitant à la haine sera supprimé et son auteur sanctionné." rows="10" required="required"></textarea>
            </div>
            <div id="link_form"></div>
            <div id="image_form"></div>
            <div id="pdf_form"></div>
            <label for="msg">Apercu du message : </label>
            <div style="border:solid;">

                <div id="msg_apercu"></div>
                <br>
                <div id="link_apercu"></div>
            </div>
        </div>
        <div class="col"><br><button class="btn btn-danger" onclick="removeMsgToSujet()">Annuler</button></div>
    </div>
</div>