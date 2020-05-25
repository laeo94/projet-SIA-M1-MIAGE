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

<div class="container">
	<div id="contenu">
		<h2>S'inscrire sur le forum </h2>
		* champ obligatoire
		<br><br>
		<form class="form-horizontal" method="post">
			<div class="row">
				<div class="col-12">
					<div class="form-group">

						<label for="inputLogin" class="control-label">Pseudo utilisateur*</label>

						<input type="text" name="pseudo" class="form-control" id="inputLogin" placeholder="Pseudo d'utilisateur" required value="<?= $data['pseudo'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputMDP" class="control-label">Mot de passe*</label>

						<input  maxlength ="12" type="password" name="mdp" class="form-control" id="inputMDP" placeholder="Mot de passe" required value="">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputMDP2" class="control-label" style="text-align: left; margin-top: -9px">Répéter mot de passe*</label>

						<input maxlength ="12" type="password" name="mdp2" class="form-control" id="inputMDP2" placeholder="Répéter le mot de passe" required value="">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputEmail" class="control-label">Adresse mail*</label>

						<input type="email" name="email" class="form-control" id="inputEmail" placeholder="jean.dupont@epa.fr" required value="<?= $data['email'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="selectOrigin" class="control-label">Pays d'origine:*</label>
						<select id="selectOrigin" name="pays_origine" required>
						<option value="" selected disabled>Choisir un pays</option>
							<?php
							$SQL = "SELECT id_pays, nom_fr FROM pays";
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

						<input type="text" name="prenom" class="form-control" id="inputFirstname" placeholder="Jean" value="<?= $data['prenom'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputLastname" class="control-label">Nom</label>

						<input type="text" name="nom" class="form-control" id="inputLastname" placeholder="Dupont"  value="<?= $data['nom'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="selectGender" class="control-label">Vous êtes:</label>
						<select id="selectGender" name="sexe">
							<option value="M">Homme</option>
							<option value="F">Femme</option>
							<option value="">Ne se prononce pas</option>
						</select>
					</div>
				</div> <!-- form-group -->
			
				<div class="col-12">
					<div class="form-group">

						<label for="inputProfession" class="control-label">Profession</label>

						<input type="text" name="profession" class="form-control" id="inputProfession" placeholder="Profession" value="<?= $data['profession'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputAddress" class="control-label">Adresse postale</label>

						<input type="text" name="adresse" class="form-control" id="inputAddress" placeholder="Adresse postale" value="<?= $data['adresse'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label for="inputInterests" class="control-label">Centres d'intérêt</label>

						<input type="text" name="centre_interet" class="form-control" id="inputInterests" placeholder="Centres d'intérêt" value="<?= $data['centre_interet'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<span class="pull-left">Déjà inscrit(e) ? <a href="login.php">Se connecter</a></span>
					</div> <!-- col-sm-offset-2 col-sm-10 -->
				</div> <!-- form-group -->
				<div class="col-12">
					<div class="form-group">

						<button type="submit" class="btn btn-warning">Inscription</button>
					</div> <!-- col-sm-offset-2 col-sm-10 -->
				</div> <!-- form-group -->

		</form>
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
		text-align:center;
		background-image: linear-gradient( to top, #d6f5d6, #ffffb3);
	}
	@media screen and (min-device-width: 0px) and (max-device-width: 800px) {
            #container {
				padding: 0;
				width: 100%
			}
			
        }
</style>