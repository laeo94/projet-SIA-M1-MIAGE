<?php
$nb = $_POST['nb'];
?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="<?php echo 's' . $nb; ?>">Nom sujet </label>
                <input type="text" required="required" id="<?php echo 'noms' . $nb; ?>" name="<?php echo 's' . $nb; ?>" class="form-control " placeholder="Nom du sujet ">
            </div>
      
        <div class="col"><br><button class="btn btn-danger" onclick="removeSujetToTheme('<?php echo 's' . $nb; ?>')">Annuler</button></div>
    </div>
</div>