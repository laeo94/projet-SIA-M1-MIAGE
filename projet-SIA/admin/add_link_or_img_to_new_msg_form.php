<?php
$type = $_POST['type'];
?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label><?php echo $type; ?> </label>
                <?php if ($type == 'img') { ?>
                    <label>Image (type jpg) : </label>
                    <input type="file" id="img" name="img" accept="image/jpg" class="form-control" required>
                <?php } else if ($type == 'pdf') { ?>
                    <label>Fichier (type pdf) : </label>
                    <input type="file" id="pdf" name="pdf" accept="application/pdf" class="form-control" required>

                <?php } else { ?>
                    <input onkeyup="addModif('link')" type="text" required="required" id="<?php echo $type; ?>" name="<?php echo $type; ?>" class="form-control " placeholder="<?php echo $type; ?> ">
                <?php } ?>
            </div>
        </div>
        <div class="col"><br><button class="btn btn-danger" onclick="docText('<?php echo $type; ?>','no')">Annuler</button></div>
    </div>
</div>