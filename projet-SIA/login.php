<?php
require("auth/EtreInvite.php");

$title = "Connexion";
require("navbar_forum.php");

if (empty($_POST['login']) && empty($_POST['password'])) // Affichage du formulaire s'il est vide
{
	require("login_form.php");
	require("footer.php");
	exit();
}

$error = "";
$role = "invite";
foreach (['login', 'password'] as $name) // Traitement des données saisies dans le formulaire
{
	if (empty($_POST[$name])) $error .= "Erreur lors de l'authentification. ";
}

if (empty($error)) {
	$data['login'] = $_POST['login'];
	$data['password'] = $_POST['password'];
	// Vérification de l'existence du login
	if (strpos($data['login'], '@') !== false) {

		$SQL = "SELECT * FROM membrebureau WHERE email=?";
		$stmt = $db->prepare($SQL);
		$stmt->execute([$data['login']]);
		$row = $stmt->fetch();
		if (!$row) { //pas membre donc verifie abo

			$SQL = "SELECT * FROM abonne WHERE email=?";
			$stmt = $db->prepare($SQL);
			$stmt->execute([$data['login']]);
			$row = $stmt->fetch();
			if (!$row) $error .= "L'utilisateur n'est pas abonne ni moderateur. ";
			else $role = "abonne";
		} else {
			if ($row['moderateur'] != 1) $error .= "L'utilisateur n'est pas modérateur. ";
			else $role = "moderateur";
		}
	} else {
		if (!$auth->existIdentity($data['login'])) $error .= "L'utilisateur n'existe pas. ";
	}
}

if (empty($error)) {
	if (strpos($data['login'], '@') !== false) {
		$password = $row['mdp'];
		if (strcmp($password, $data['password']) != 0) $error .= "Mot de passe incorrect. ";
		if (isset($row['id_mb_bureau'])) $res['id_mb_bureau'] = $row['id_mb_bureau'];
	} else {
		$user = $auth->authenticate($data['login'], $data['password']); // Connexion
		if (!$user) $error .= "Erreur lors de l'authentification. ";
	}
}

if (!empty($error)) {
	require("login_form.php");
	require("footer.php");
	exit();
}

if (isset($_SESSION[SKEY])) // Session
{
	$uri = $_SESSION[SKEY];
	unset($_SESSION[SKEY]);
	redirect($uri);
	exit();
}

// $_SESSION['success'] = "Connexion réussie. Bienvenue <strong>" . $idm->getIdentity() . "</strong> ! ";
if (strpos($data['login'], '@') !== false) {
	if ($role == "moderateur") $idm->setId($row['id_mb_bureau']);
	else $idm->setId($row['id_abonne']);
	$idm->setIdentity($row['email']);
	$idm->setrole($role);
	if ($idm->getrole()=="moderateur") redirect("admin/GestionAdmin.php");
	else redirect("Forum_Accueil.php");
} else {
	redirect("Forum_Accueil.php");
}
