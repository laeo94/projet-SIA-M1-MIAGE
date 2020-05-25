<div class="container" >
<h4 style="text-align:center;color:green">Résultats de la recherche:</h4>
<?php
if ($_POST['search'] != '') {
    include 'db_config.php';
    $mot = addslashes($_POST['search']);
    $req = $db->query("SELECT * FROM theme WHERE nom LIKE '%" . $mot . "%' ORDER BY nom");
    if ($req->rowCount() == 0) {
?>
        Pas de thème avec le mot-clé : <?php echo $mot; ?>
    <?php
    } else { ?>
<table class="table table-bordered">
<thead style="text-align: center" class="thead-dark">
<tr>
      <th>Thèmes:</th>
</tr>
</thead>
<tbody>
    <?php
       
        while ($row = $req->fetch()) {
            $link = "theme.php?tid=" . $row['id_theme'];
            echo  "<tr><td><a href='" . $link . "'>" . $row['nom'] . "</a></td></tr>";
        }
    }
    ?>
</tbody>
</table>
    <br>
    <?php
    $req1 = $db->query("SELECT * FROM sujet WHERE nom LIKE '%" . $mot . "%' ORDER BY nom");
    if ($req1->rowCount() == 0) {
?>
        Pas de sujet avec le mot-clé : <?php echo $mot; ?>
    <?php
    } else { ?>
<table class="table table-bordered">
<thead style="text-align: center" class="thead-dark">
<tr>
      <th>Sujets:</th>
</tr>
</thead>
<tbody>
    <?php
        while ($row1 = $req1->fetch()) {
            $link1 = "sujet.php?sid=" . $row1['id_sujet'];
            echo  "<tr><td><a href='" . $link1 . "'>" . $row1['nom'] . "</a></li></tr></td>";
        }
    }
    ?>
</tbody>
</table>
    <br>
<?php } else {
    echo "Aucun résultats <br><br>";
}; ?>
<div style="text-align: right">
<button class="btn btn-danger" onclick="annuler()">Annuler</button>
</div>
<br>
<br>
</div>