<!--
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
-->
<div class="container " >
	<div id="contenu">
		<h2>Connexion</h2><br>
		<form class="form-horizontal" method="post">
			<div class="row">
				<div class="col-12">
					<div class="form-group">

						<label class="control-label" for="imputLogin">Email</label>

						<input type="text" name="login" size="20" class="form-control" id="inputLogin" required placeholder="Votre email" required value="<?= $data['login'] ?? "" ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<label class="control-label" for="inputMDP">Mot de passe</label>

						<input maxlength ="12" type="password" class="form-control" name="password" size="20" required id="inputMDP" placeholder="Mot de passe">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<span class="pull-left">Pas encore membre ? <a href="<?= $pathFor['signup'] ?>">S'enregistrer</a></span>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">

						<button type="submit" class="btn btn-warning">Connexion</button>
					</div>
				</div>
		</form>
	</div>
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
		background-image: linear-gradient( to top, #d6f5d6, #ffffb3);
		
	}
	
</style>