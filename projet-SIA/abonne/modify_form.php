<?php

if (!empty($error)) // Affichage des messages d'erreur
{
?>
	<div class="alert alert-danger alert-dismissible fade in" style="margin-top: -30px; margin-bottom: 30px">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Attention !</strong> <?= $error ?? "" ?>
	</div>
<?php
}
?>

<?php
include '../db_config.php';
$req = $db->query("SELECT * from abonne WHERE id_abonne=$_SESSION");
$data = $req->fetch();
$idpays = $data['pays_origine'];
$req2 = $db->query("SELECT nom_fr FROM pays WHERE id_pays=$idpays");
$pays = $req2->fetch();


?>


<div class="container">
	<div id="contenu">
		<h2>Modification des informations personnelles </h2>
		* champ obligatoire
		<br><br>
		<form class="form-horizontal" method="post">
		<input type="hidden" name="ancien" value="<?php echo $data['pseudo']; ?>" />
			<div class="row">
				<div class="col-12">
					<div class="form-group">

						<label for="inputLogin" class="control-label">Pseudo utilisateur*</label>

						<input required type="text" name="pseudo" class="form-control" id="inputLogin" placeholder="pseudo" value="<?= $data['pseudo'] ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputMDP" class="control-label"> Nouveau Mot de passe*</label>

						<input type="password" name="mdp" class="form-control" id="inputMDP" placeholder="Nouveau Mot de passe" value="">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputMDP2" class="control-label" style="text-align: left; margin-top: -9px">Répéter mot de passe*</label>

						<input type="password" name="mdp2" class="form-control" id="inputMDP2" placeholder="Répéter le mot de passe" value="">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputEmail" class="control-label">Adresse mail*</label>

						<input  required type="email" name="email" class="form-control" id="inputEmail" placeholder="email" value="<?= $data['email'] ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="selectOrigin" class="control-label">Pays d'origine:*</label>
						<select id="selectOrigin" name="pays_origine">
							<option value="<?php echo $idpays; ?>" selected><?php echo $pays['nom_fr'] ?></option>
							<?php
							$SQL = "SELECT id_pays, nom_fr FROM pays WHERE id_pays != $idpays";
							$stmt = $db->prepare($SQL);
							$req = $stmt->execute();
							while ($row = $stmt->fetch()) {
							?>
								<option value="<?= $row['id_pays'] ?>"><?= $row['nom_fr'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputFirstname" class="control-label">Prénom</label>

						<input type="text" name="prenom" class="form-control" id="inputFirstname" placeholder="<?php echo $data['prenom'] ?>" value="<?= $data['prenom'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputLastname" class="control-label">Nom</label>

						<input type="text" name="nom" class="form-control" id="inputLastname" placeholder="<?php echo $data['nom'] ?>" value="<?= $data['nom'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="selectGender" class="control-label">Vous êtes:</label>
						<select id="selectGender" name="sexe">
							<option value="M">Homme</option>
							<option value="F">Femme</option>
						</select>
					</div>
				</div> <!-- form-group -->

				<div class="col-12">
					<div class="form-group">

						<label for="inputProfession" class="control-label">Profession</label>

						<input type="text" name="profession" class="form-control" id="inputProfession" placeholder="<?php echo $data['profession'] ?>" value="<?= $data['profession'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputAddress" class="control-label">Adresse postale</label>

						<input type="text" name="adresse" class="form-control" id="inputAddress" placeholder="<?php echo $data['adresse'] ?>" value="<?= $data['adresse'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputInterests" class="control-label">Centres d'intérêt</label>

						<input type="text" name="centre_interet" class="form-control" id="inputInterests" placeholder="<?php echo $data['centre_interet'] ?>" value="<?= $data['centre_interet'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">


					</div> <!-- col-sm-offset-2 col-sm-10 -->
				</div> <!-- form-group -->
				<div class="col-12">
					<div class="form-group">

						<button type="submit" class="btn btn-warning">Enregistrer</button>
					</div> <!-- col-sm-offset-2 col-sm-10 -->
				</div> <!-- form-group -->



		</form>
		<button> <a href="supprimer_profil.php"> Supprimer mon profil </a> </button>
		<button class="btn btn-success" onclick="location.href='profilAbonne.php'">Retour</button>
	</div> <!-- container -->
</div>
</div>
<br>
<style>
	#contenu {
		/* definition des onglet 'normaux' */
		padding: 1em 2em;
		border: solid 10px #804000;
		font-weight: bold;
		border-radius: 20px 20px 20px 20px;
		color: #804000;
		text-align: center;
		background-image: linear-gradient(to top, #d6f5d6, #ffffb3);
	}

	@media screen and (min-device-width: 0px) and (max-device-width: 800px) {
		#container {
			padding: 0;
			width: 100%
		}

	}
</style>