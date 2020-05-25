<?php
include '../db_config.php';
require("../auth/loader.php");
if ($idm->hasIdentity()) {
    $role = $idm->getRole(); //recupere role 
    $_SESSION = $idm->getId(); //recupere id courrant
}
$title = "Modification des informations personnelles";
require("navbar_abonne.php");
if(empty($_POST['pseudo'])) // Affichage du formulaire s'il est vide
{
	require("modify_form.php");
	require("../footer.php");
	exit();
}
$ancien = $_POST['ancien'];
$pseudo=$_POST['pseudo'];
$requete= $db -> query ("SELECT COUNT(pseudo) AS existing FROM abonne WHERE pseudo='$pseudo' AND pseudo!='$ancien'");
if($row=$requete->fetch()){
	if($row['existing']==1){
	echo "Pseudo deja utilisé";
	require("modify_form.php");
	require("../footer.php");
	exit();
	}
}
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email =$_POST['email'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['mdp2'];
$pays= $_POST['pays_origine'];
$profession =$_POST['profession'];
$adresse =$_POST['adresse'];
$profession =$_POST['profession'];
$centre_interet =$_POST['centre_interet'];
$sexe =$_POST['sexe'];

if($mdp!=$mdp2){
	echo "Les mots de passes sont differents";
	require("modify_form.php");
	require("../footer.php");
	exit();
}

if($mdp=="" && $mdp2==""){ //si pas de modification de mdp
	$db->exec("UPDATE abonne SET nom='$nom',prenom='$prenom',pseudo='$pseudo',email='$email',pays_origine='$pays',adresse='$adresse',centre_interet='$centre_interet',profession='$profession',sexe='$sexe' WHERE id_abonne=$_SESSION");
}else{
	$db->exec("UPDATE abonne SET nom='$nom',prenom='$prenom', mdp='$mdp',pseudo='$pseudo',email='$email',pays_origine='$pays',adresse='$adresse',centre_interet='$centre_interet',profession='$profession',sexe='$sexe' WHERE id_abonne=$_SESSION");
}
header('Location: profileAbonne.php');
