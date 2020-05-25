<?php
$idabo=$_POST['iduser'];
$dossier = '../images/abonne/' ;
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['avatar']['name'], '.'); 
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
    
     $file_name = $_FILES['avatar']['name'];
     $file_size = $_FILES['avatar']['size'];
     $file_tmp = $_FILES['avatar']['tmp_name'];
     $file_type = $_FILES['avatar']['type'];
     $var = explode('.', $_FILES['avatar']['name']);
     $file_ext = strtolower(end($var));
     $dir = '../images/abonne/' . $_SESSION.'.jpg';
     if(file_exists($dir)) unlink($dir);
     move_uploaded_file($file_tmp, $dossier . $idabo. '.' . $file_ext);
}
else
{
     echo $erreur;
}
header('Location: profileAbonne.php');
?>
