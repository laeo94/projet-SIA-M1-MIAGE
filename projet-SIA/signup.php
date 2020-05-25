<?php
require("auth/EtreInvite.php");

$title = "Inscription";
require("navbar_forum.php");

if(empty($_POST['pseudo'])) // Affichage du formulaire s'il est vide
{
	require("signup_form.php");
	require("footer.php");
	exit();
}

$error = "";

foreach(['pseudo','mdp','mdp2','email','pays_origine'] as $user) // Traitement des données saisies dans le formulaire
{
	if(empty($_POST[$user])) $error .= "Le champ '$user' ne doit pas être vide. ";
	else $data[$user] = $_POST[$user];
}

foreach(['profession','adresse','centre_interet','nom','prenom', 'sexe'] as $other)
{
	if(!empty($_POST[$other])) $data[$other] = $_POST[$other];
	else $data[$other] = NULL;
}

if(empty($error))
{
	// Vérification de l'existence du login
	if($auth->existIdentity($data['pseudo'])) $error .= "Le nom d'utilisateur est déjà utilisé. ";
}

if($data['mdp'] != $data['mdp2']) // Comparaison des 2 mots de passe
{
	$error .= "Les mots de passes ne correspondent pas. ";
}

if(!empty($error)) // Affichage des erreurs
{
	require("signup_form.php");
	require("footer.php");
	exit();
}

unset($data['mdp2']);
$data['date_enreg'] = date('Y-m-d H:i:s');
/*
$passwordFunction =
	function($s)
	{
		return password_hash($s, PASSWORD_DEFAULT);
	};

$clearData['mdp'] = $passwordFunction($data['mdp']); // Hashage du mot de passe
*/
try // Inscription de l'utilisateur
{
	$SQL = "INSERT INTO abonne(pseudo,mdp,email,pays_origine,date_enreg,nom,prenom,sexe,profession,adresse,centre_interet) VALUES (:pseudo,:mdp,:email,:pays_origine,:date_enreg,:nom,:prenom,:sexe,:profession,:adresse,:centre_interet)";
	$stmt = $db->prepare($SQL);
	$res = $stmt->execute($data);
	if($stmt->rowCount() == 0)
	{
		$error .= "Erreur lors de l'inscription. ";
		require("signup_form.php");
		require("footer.php");
		exit();
	}
	else
	{	
		$id = $db->lastInsertId();
		$auth->authenticate($data['login'], $data['mdp']);
		$_SESSION['success'] = "Inscription réussie. Bienvenue <strong>" . $idm->getIdentity() . "</strong> ! ";
		$idm->setId($id);
		$idm->setIdentity($data['email']);
		$idm->setrole('abonne');
		redirect($pathFor['root']);
	}
}
catch(PDOException $e)
{
	http_response_code(500);
	echo "<div class=\"container\"><p>Erreur de serveur: " . $e->getMessage() . "</p></div>";
}
require("footer.php");
