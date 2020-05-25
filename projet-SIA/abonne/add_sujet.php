<?php
include '../db_config.php';
require("../auth/loader.php");
if ($idm->hasIdentity()) {
    $role = $idm->getRole(); //recupere role 
    $_SESSION = $idm->getId(); //recupere id courrant
}
$title = "Ajout d'un sujet";
require("navbar_abonne.php");
$tid= $_GET['tid'];
if(empty($_POST['nom']))
{
	require("add_sujet_form.php");
	require("../footer.php");
	exit();
}
$nom = addslashes($_POST['nom']);
  //Ajout du sujet
  $db->exec("INSERT INTO sujet (id_theme,id_abonne,nom, date_ajout, date_maj) VALUES ('$tid','$_SESSION','$nom',NOW(),NOW())") or die(print_r($db->errorInfo(), true)); // incorrect
  //recupère id du sujet
  $rep = $db->query("SELECT id_sujet FROM sujet WHERE id_sujet = LAST_INSERT_ID()") or die(print_r($db->errorInfo(), true)); // incorrect
  $id = $rep->fetch();
  $idsujet = $id['id_sujet'];
  //creation dossier sujet 
  if (!file_exists('../images/theme/' . $tid . '/' . $idsujet)) {
      mkdir('../images/theme/' . $tid . '/' . $idsujet, 0777, true);
  }
  header('Location: ../sujet.php?sid='.$idsujet);
?>