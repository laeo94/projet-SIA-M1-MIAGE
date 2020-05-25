<?php
include 'db_config.php';
require("auth/loader.php");
$role = "invite";
if ($idm->hasIdentity()) {
	$role = $idm->getRole(); //recupere role 
	$_SESSION = $idm->getId(); //recupere id courrant
}
$idsujet = $_GET['sid']; //A CHANGER 
$sujet = $db->query("SELECT * FROM sujet WHERE id_sujet =$idsujet");
$row = $sujet->fetch();
$idtheme = $row['id_theme'];
$nomsujet = $row['nom'];
$dateajout = strtotime($row['date_ajout']);
$datemodif = strtotime($row['date_maj']);
//Recupère titre du theme
$theme = $db->query("SELECT theme.nom FROM theme INNER JOIN sujet ON theme.id_theme = sujet.id_theme WHERE theme.id_theme = $idtheme");
$row1 = $theme->fetch();
$nomtheme = $row1['nom'];

//Nb de message:
$req = $db->query("SELECT COUNT(id_message) AS nb_message FROM message WHERE id_sujet = $idsujet");
$row2 = $req->fetch();
$nb_msg = $row2['nb_message'];
//Auteur

if (!empty($row['id_abonne'])) {
	$idauteur = $row['id_abonne'];
	$req1 = $db->query("SELECT pseudo FROM abonne WHERE id_abonne = $idauteur");
	$row3 = $req1->fetch();
	$auteur = $row3['pseudo'];
} else if (!empty($row['id_mb_bureau'])) {
	$idauteur = $row['id_mb_bureau'];
	$req1 = $db->query("SELECT nom, prenom FROM membrebureau WHERE id_mb_bureau = $idauteur");
	$row3 = $req1->fetch();
	$auteur = $row3['prenom'] . ' (Admin)';
} else {
	$auteur = "ancien membre du forum";
}

//ajout du message
if (isset($_POST['ajout_message'])) {
	$msg = addslashes(str_replace("\n", "<br>", $_POST['msg']));
	if ($role == "moderateur") $statut = "accepte";
	else $statut = "encours";
	if ($role == "moderateur") {
		$db->exec("INSERT INTO message (id_sujet,id_mb_bureau,description, date_ajout, date_maj) VALUES ('$idsujet','$_SESSION','$msg',NOW(),NOW())") or die(print_r($db->errorInfo(), true));
	} else if ($role == "abonne") {
		$db->exec("INSERT INTO message (id_sujet,id_abonne,description, date_ajout, date_maj) VALUES ('$idsujet','$_SESSION','$msg',NOW(),NOW())") or die(print_r($db->errorInfo(), true));
	}
	//recupère id du message inserer
	$rep1 = $db->query("SELECT id_message FROM message WHERE id_message = LAST_INSERT_ID()") or die(print_r($db->errorInfo(), true)); // incorrect
	$id1 = $rep1->fetch();
	$idmsg = $id1['id_message'];
	//Si lien 
	if (isset($_POST['link'])) {
		$link = addslashes($_POST['link']);
		//Ajout du lien
		$db->exec("INSERT INTO lien (id_message,lien, date_ajout,statut) VALUES ('$idmsg','$link',NOW(),'$statut')") or die(print_r($db->errorInfo(), true)); // incorrect
	}
	//si image
	if (!empty($_FILES['img'])) {
		$file_name = $_FILES['img']['name'];
		$file_size = $_FILES['img']['size'];
		$file_tmp = $_FILES['img']['tmp_name'];
		$file_type = $_FILES['img']['type'];
		$var = explode('.', $_FILES['img']['name']);
		$file_ext = strtolower(end($var));
		if (move_uploaded_file($file_tmp, "images/theme/" . $idtheme . "/" . $idsujet . '/' . $idmsg . '.' . $file_ext)) {
			$db->exec("INSERT INTO document (id_message,type,date_ajout,statut) VALUES ('$idmsg','img',NOW(),'$statut')");
		}
	}
	//si pdf
	if (!empty($_FILES['pdf'])) {
		$file_name = $_FILES['pdf']['name'];
		$file_size = $_FILES['pdf']['size'];
		$file_tmp = $_FILES['pdf']['tmp_name'];
		$file_type = $_FILES['pdf']['type'];
		$var = explode('.', $_FILES['pdf']['name']);
		$file_ext = strtolower(end($var));
		if (move_uploaded_file($file_tmp, "images/theme/" . $idtheme . "/" . $idsujet . '/' . $idmsg . '.' . $file_ext)) {
			$db->exec("INSERT INTO document (id_message,type,date_ajout,statut) VALUES ('$idmsg','pdf',NOW(),'$statut')");
		}
	}
	if (isset($_POST['reponse'])) { //message en reponse a un message
		//insere dans reponse
		$idmsgreponse = $_POST['reponse']; //recupere id du message à repondre
		$db->exec("INSERT INTO reponse (id_message,id_reponse) VALUES ('$idmsgreponse','$idmsg')") or die(print_r($db->errorInfo(), true)); // incorrect
	}
}



?>
<?php
if ($role == "invite") include 'navbar_forum.php';
else if ($role == "moderateur") include 'admin/navbar_admin.php';
else include 'abonne/navbar_abonne.php'; ?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<title>Sujet : <?php echo $nomsujet; ?></title>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script lanquage="javascript" type="text/javascript" src="js/ShowMenuResponsive.js"></script>

</head>


<body style="margin-top:5% ">
	<div class="container-fluid" style="text-align: center;width: 100%;padding:5%;background-repeat: no-repeat;background-size: cover;background-image:url('images/forum1')">
		<br>
		<br>
		<div style="text-align:center">
			<h1 style="color:green; font-weight:bold;letter-spacing:0.35em;text-shadow:rgba(0, 0, 0, 0.4) 0px 4px 5px; font-size:200%">
				Bienvenue sur le forum <br>d'Ensemble Pour l'Afrique</h1>
		</div>
	</div>
	<br>
	<div class="container">
	<div style="font-size: larger;">
	<a href="Forum_Accueil.php">Accueil</a>><a href="theme.php?tid=<?php echo $idtheme; ?>"><?php echo $nomtheme; ?></a>><a href="#"><?php echo $nomsujet; ?></a>
	</div>
	<h3 style="text-align:center;color:white;background-color:brown;font-family: cursive;margin:5%;"> Sujet: <?= $nomsujet ?></h3>
		<div class="row">
			<div class="col-lg-9 col-md-9 col-sm-12">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						Créé le <?php echo date("d M Y", $dateajout); ?> | Mis à jour le <?php echo date("d M Y", $dateajout); ?>
					</div>
				</div>
				<div class="container">
					<table class="gfg " style="table-layout: fixed; width:100%;">
						<thead class="table-warning" style="text-align:center  ;">
							<tr>
								<th colspan="2" style="word-wrap: break-word;">Sujet : <?php echo $nomsujet; ?></th>
								<th colspan="2" style="word-wrap: break-word;"><i class="fas fa-user-alt" style="color:green"></i> <?php echo $auteur; ?> | <i class="fas fa-comments" style="color: green"></i> <?php echo $nb_msg; ?>
									<?php if ($role == "invite") { ?><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-type="nouveau">Ecrire un message</button>
									<?php } else { ?><button type="button" class="btn btn-success" id="redirection">Ecrire un message</button>
									<?php } ?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//recupère message
							$req2 = $db->query("SELECT * FROM message WHERE id_sujet=$idsujet ORDER BY date_ajout");
							if ($req2 != false) {
								while ($row4 = $req2->fetch()) {
									$idmessage = $row4['id_message'];
									$dateajoutmsg = $row4['date_ajout'];
									$descriptionmsg = $row4['description'];
									//recupere l'auteur
									if (!empty($row4['id_abonne'])) {
										$idauteur = $row4['id_abonne'];
										$req3 = $db->query("SELECT id_abonne,pseudo FROM abonne WHERE id_abonne = $idauteur");
										$row5 = $req3->fetch();
										$auteurmsg = $row5['pseudo'];
										$idauteurmsg = $row5['id_abonne'];
										$cheminauteurmsg = "images/abonne/$idauteurmsg";
									} else if (!empty($row4['id_mb_bureau'])) {
										$idauteur = $row4['id_mb_bureau'];
										$req3 = $db->query("SELECT id_mb_bureau,nom, prenom FROM membrebureau WHERE id_mb_bureau = $idauteur");
										$row5 = $req3->fetch();
										$idauteurmsg = $row5['id_mb_bureau'];
										$auteurmsg = $row5['prenom'] . ' (Admin)';
										$cheminauteurmsg = "images/moderateur/$idauteurmsg";
									} else {
										$auteurmsg = "ancien membre du forum";
										$cheminauteurmsg = "";
									}
							?>
									<tr style="background-color:#fffbee;border-spacing: 0px 50px;">
										<td style="word-wrap: break-word; text-align:center"><img style="width:100px; height:100px;" src="<?php echo $cheminauteurmsg; ?>"><br> <i class="fas fa-user-alt" style="color:green"></i> <?php echo $auteurmsg; ?></td>
										<td style="word-wrap: break-word;" colspan="3">
											<table class="table " style="table-layout: fixed;">
												<thead>
													<tr>
														<th colspan="2" style="word-wrap: break-word;"> <i class="far fa-comment" style="color:green"></i>Ecrit le <?php echo $dateajoutmsg; ?></th>
														<th style="word-wrap: break-word; text-align:right">
															<?php if ($role == "invite") { ?><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-type="repondre" data-value="<?php echo $idmessage; ?>">Répondre</button>
															<?php } else { ?> <a href="#message"><button type="button" class="btn btn-secondary" onclick="repondremsg(`<?php echo $idmessage; ?>`,`<?php echo $auteurmsg; ?>`,`<?php echo addslashes($descriptionmsg); ?>`);">Répondre</button></a>
															<?php  } ?>
														</th>
													</tr>

												</thead>
												<tbody style="padding:5%">

													<tr>
														<th colspan="3" style="word-wrap: break-word;">
															<?php
															//recupere id_message si le message est une réponse à un msg
															$req4 = $db->query("SELECT id_message FROM reponse WHERE id_reponse = $idmessage");

															if ($rep = $req4->fetch()) {
																$idmsgreponse = $rep['id_message'];
																//recupere le message en question 
																$req5 = $db->query("SELECT description, date_ajout FROM message WHERE id_message = $idmsgreponse");
																$rep1 = $req5->fetch();
																echo '<p style="border :solid">Réponse aux message  du ' . $rep1['date_ajout'] . ': <br>' . $rep1['description'] . '<br> </p>';
															}
															?>
															<br>
															<?php echo $descriptionmsg . '<br>';
															//recupere lien, image ou pdf s'il yen a  et accepter par le modérateur
															//recupere image s'il y en a
															$img = $db->query("SELECT id_document, statut FROM document WHERE type='img' AND id_message =$idmessage");
															$idimg = $img->fetch();
															//recupere doc s'il y en a
															$pdf = $db->query("SELECT id_document,statut FROM document WHERE type='pdf' AND id_message =$idmessage");
															$idpdf = $pdf->fetch();
															//recupere lien s'il y en a
															$link = $db->query("SELECT id_lien, lien,statut FROM lien WHERE id_message =$idmessage ");
															$idlink = $link->fetch();
															if ($idlink != false) {
																if ($idlink['statut'] == "accepte") { ?>
																	Lien :<a href="<?php echo $idlink['lien']; ?>" target="_blank"><?php echo $idlink['lien']; ?></a> <br><?php
																																										} else { ?>
																	<p style="color:brown">[Lien en cours de validation par nos modérateurs]</p>
																<?php
																																										}
																																									}
																																									if ($idimg != false) {
																																										if ($idimg['statut'] == "accepte") { ?>
																	<img style="width:400px; height:200px;" src="images/theme/<?php echo $idtheme . '/' . $idsujet . '/' . $idmessage; ?>"> <br> <?php
																																																} else { ?>
																	<p style="color:brown">[Image en cours de validation par nos modérateurs]</p>
																<?php
																																																}
																																															}
																																															if ($idpdf != false) {
																																																if ($idpdf['statut'] == "accepte") { ?>
																	<a href="images/theme/<?php echo $idtheme . '/' . $idsujet . '/' . $idmessage . '.pdf'; ?>" target="_blank">Fichier pdf : Voir <br></a><?php
																																																		} else {
																																																			?>
																	<p style="color:brown">[Document en cours de validation par nos modérateurs]</p>
															<?php
																																																		}
																																																	}
															?>
														</th>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>

								<?php
								}
							}
							if ($role != "invite") {
								?>
								<tr>

									<!--PARTIE REPONDRE MESSAGE A CHANGER SI CONNECTE-->


									<td style="word-wrap: break-word ; text-align:center ;background-color:	lightyellow">
										<?php
										//Recupere information 
										if ($role == "moderateur") {
											$requete = $db->query("SELECT prenom FROM membrebureau WHERE id_mb_bureau = $_SESSION");
											$info = $requete->fetch(); ?>

											<img style="width:100px; height:100px;" src="images/moderateur/<?php echo $_SESSION; ?>"><br> <i class="fas fa-user-alt" style="color:green"></i> <?php echo $info['prenom'] . '(Admin)'; ?>
										<?php

										} else {
											$requete = $db->query("SELECT pseudo FROM abonne WHERE id_abonne = $_SESSION");
											$info = $requete->fetch(); ?>

											<img style="width:100px; height:100px;" src="images/abonne/<?php echo $_SESSION; ?>"><br> <i class="fas fa-user-alt" style="color:green"></i> <?php echo $info['pseudo']; ?>
										<?php

										}
										?>
									</td>
									<td colspan="3" style="word-wrap: break-word;text-align:center; background-color:lightyellow">
										<form class="form-horizontal" method="POST" enctype="multipart/form-data">
											<div id="reponse"></div>
											<div class="form-group">
												<label id="message" for="msg">Message : </label>

												<button onclick="boldText()" type="button" title="Gras"><i class="fa fa-bold" aria-hidden="true"></i></button>
												<button onclick="italicText()" type="button" title="Italic"> <i class="fa fa-italic" aria-hidden="true"></i></button>
												<button onclick="underlineText()" type="button" title="Souligné"> <i class="fa fa-underline" aria-hidden="true"></i></button>
												<button onclick="strikeText()" type="button" title="Barré"> <i class="fa fa-strikethrough" aria-hidden="true"></i></button>
												<button onclick="docText('link','yes')" id="addlink" type="button" title="Ajouter un lien"> <i class="fa fa-link" aria-hidden="true"></i></button>
												<button onclick="docText('img','yes')" id="addimg" type="button" title="Ajouter une image"> <i class="fa fa-picture-o" aria-hidden="true"></i></button>
												<button onclick="docText('pdf','yes')" id="addpdf" type="button" title="Ajouter une document pdf"> <i class="fa fa-file-pdf" aria-hidden="true"></i></button>
												<textarea style="resize: none; " onkeyup="addModif('msg')" type="text" name="msg" id="msg" class="form-control" placeholder="Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances. En postant sur nos espaces, vous vous engagez à en respecter la charte d'utilisation. Tout message discriminatoire ou incitant à la haine sera supprimé et son auteur sanctionné. Attention : Tous lien , image ou document seront vérifiés par nos membres" rows="10" required="required"></textarea>
											</div>
											<div id="link_form"></div>
											<div id="image_form"></div>
											<div id="pdf_form"></div>
											<button type="submit" class="btn btn-warning btn-lg btn-block" name="ajout_message">Poster le message</button> <br>
											<label for="msg">Aperçu du message : </label>
											<div style="border:solid; background-color:white">

												<div id="msg_apercu"></div>
												<br>
												<div id="link_apercu"></div>
											</div>

										</form>
									</td>
								</tr>
							<?php } else { ?>
								<tr>
									<td colspan="4"><button type="submit" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">Ecrire un message</button> <br>
									</td>
								</tr>
							<?php

							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12" style=" text-align:center;border-radius: 25px;border: solid grey">
				<div class="col"><img style="width:200px; height:100px;" src="images/Forum"></div>
				<h3 class="section-title"> Nos projets aidés:</h3>
				<div class="col"><img style="width:200px; height:200px;" src="images/Forum2">
					<p> L'eau de la vie, l'eau de tous les espoirs" <br>
						- Convention de Partenariat EPA Ensemble Pour l'Afrique / groupe Total (18/12/2006).<br>
						Action humanitaire, projet de développement rural à Yokélé, Fada-Copé
						Zone géographique : Afrique de l'Ouest, Pays : Togo</p>
				</div>
				<div class="col"><img style="width:200px; height:200px;" src="images/Forum3">
					<p> Concert de Jazz et de musique classique 16/06/2007 (prestation offerte) <br>
						Au profit de l'association Ensemble Pour l'Afrique pour le financement d'un projet de développement rural à Yokélé, (Togo)<br>
						Projet de mise en place d'une structure d'accueil pour les étudiants et stagiaires de passage à Paris et sa Région en partenariat avec la Maison des Associations de Paris 14 </p>
				</div>
				<div class="col"><img style="width:200px; height:200px;" src="images/Forum4">
					<p>
						CONTE Pour Toute La Famille (prestation offerte) <br>
						Si tu me crois c'est que j'ai menti 27/11/2011 <br>
						Spectacle donné par Mme Françoise BARRET, au bénéfice de l'association "Ensemble pour l'Afrique
					</p>
				</div>


			</div>
		</div>
	</div>

	<br>
</body>
<!--Message de connexion-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel" style="text-align: center">Pour envoyer un message ou répondre à un message, veuillez vous connecter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="text-align:center">
				<button type="button" class="btn btn-success" onClick="window.location = 'login.php'">Connexion</button> Ou
				<button type="button" class="btn btn-success" onClick="window.location = 'signup.php'">S'incrire</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

</html>

<?php
require("footer.php");
?>
<style>
	.gfg {
		border-collapse: separate;
		border-spacing: 0 40px;

	}

	td {
		border-top: solid brown;
		border-bottom: solid brown;
	}
</style>
<script>
	function getXhr() {
		var xhr = null;
		if (window.XMLHttpRequest)
			xhr = new XMLHttpRequest();
		else if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
			xhr = false;
		}
		return xhr;
	}
	var xhr = getXhr();
	var link = 0;
	var image = 0;
	var pdf = 0;
	//Modif text du message
	function boldText() {
		document.getElementById('msg').value += '<b> </b>';
	}

	function italicText() {
		document.getElementById('msg').value += '<cite> </cite>';
	}

	function underlineText() {
		document.getElementById('msg').value += '<u> </u>';
	}

	function strikeText() {
		document.getElementById('msg').value += '<s> </s>';
	}

	function docText(type, y) {
		if (y == 'yes') {
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					leselect = xhr.responseText;
					if (type == 'link') {
						document.getElementById('addlink').style.visibility = 'hidden';
						document.getElementById("link_form").innerHTML += leselect;
						link = 1;
					} else if (type == 'img') {
						document.getElementById('addimg').style.visibility = 'hidden';
						document.getElementById("image_form").innerHTML += leselect;
						image = 1;
					} else {
						document.getElementById('addpdf').style.visibility = 'hidden';
						document.getElementById("pdf_form").innerHTML += leselect;
						pdf = 1;
					}
				}
			}
			xhr.open("POST", "admin/add_link_or_img_to_new_msg_form.php", true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send("type=" + type);
		} else {
			if (type == 'link') {
				document.getElementById('addlink').style.visibility = 'visible';
				document.getElementById("link_form").innerHTML = "";
				link = 0;
			} else if (type == 'img') {
				document.getElementById('addimg').style.visibility = 'visible';
				document.getElementById("image_form").innerHTML = "";
				image = 0;
			} else {
				document.getElementById('addpdf').style.visibility = 'visible';
				document.getElementById("pdf_form").innerHTML = "";
				pdf = 0;
			}
		}
	}

	//Function pour apercu du message
	function addModif(type) {
		if (type == "msg") document.getElementById('msg_apercu').innerHTML = document.getElementById('msg').value.replace(/\n/g, "<br>");
		else {
			var lien = '<a href="' + document.getElementById('link').value + '">' + document.getElementById('link').value + '</a>';
			document.getElementById('link_apercu').innerHTML = lien;
		}
	}


	//Affichage pop up connexion inscription
	$('#exampleModal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var type = button.data('type')
	})

	$('#redirection').click(function() {
		$('html,body').animate({
			scrollTop: $("#message").offset().top
		}, 'slow');
	})

	function repondremsg(idmessage, auteur, description) {
		document.getElementById("reponse").innerHTML =
			'<input type="hidden" name="reponse" value=" ' + idmessage + ' " "/><p style="border :solid">Réponse aux message  de ' + auteur + ': <br>' + description + '<br> </p> <button class="btn btn-danger" onclick="annuler()">Annuler</button>';

	}

	function annuler() {
		document.getElementById("reponse").innerHTML = "";
	}
</script>