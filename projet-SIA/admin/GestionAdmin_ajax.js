//POUR AFFICHAGE ONGLET
$(document).ready(function() {
    //1 - Stockage des éléments 
    var $contenu = $('.contenu');
    var $onglet = $('.onglet');

    // 2- Gestion des évènements 
    $onglet.click(activer);

    //3-  Création des fonctions
    function activer() {
        //Stockage du numéro de l'onglet cliqué
        var num = $(this).index();

        //Déplacement de la classe actif sur l'onglet
        $(this)
            .addClass('actif')
            .siblings()
            .removeClass('actif');

        //Déplacement de la classe actif sur le contenu correspondant
        $contenu.eq(num)
            .addClass('actif')
            .siblings()
            .removeClass('actif');
        localStorage.setItem('activeTab', num);
    }
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $onglet.eq(activeTab)
            .addClass('actif')
            .siblings()
            .removeClass('actif');
        $contenu.eq(activeTab)
            .addClass('actif')
            .siblings()
            .removeClass('actif');
        localStorage.getItem('activeTab', num);
    }
}); //fin de script JQ


function getXhr() {
    var xhr = null;
    if (window.XMLHttpRequest) // Firefox et autres
        xhr = new XMLHttpRequest();
    else if (window.ActiveXObject) { // Internet Explorer 
        try {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
    } else { // XMLHttpRequest non supporté par le navigateur 
        alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
        xhr = false;
    }
    return xhr;
}
var xhr = getXhr();
var mot = "";

function search(type, all) {
    if (type == 'theme') mot = document.getElementById('search_box').value;
    else if (type == 'sujet') mot = document.getElementById('search_box1').value;
    else if (type == 'abonne') mot = document.getElementById('search_box2').value;
    else if (type == 'moderateur') mot = document.getElementById('search_box3').value;
    if (mot == "") return;
    xhr.onreadystatechange = function() {
            // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
            if (xhr.readyState == 4 && xhr.status == 200) {
                leselect = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options a la liste
                if (type == 'theme') document.getElementById('Cible2').innerHTML = leselect;
                else if (type == 'sujet') document.getElementById('Cible3').innerHTML = leselect;
                else if (type == 'abonne') document.getElementById('Cible4').innerHTML = leselect;
                else if (type == 'moderateur') document.getElementById('Cible5').innerHTML = leselect;
            }
        }
        // Ici on va voir comment faire du post
    xhr.open("POST", "barSearch_admin.php", true);
    // ne pas oublier ça pour le post
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // ne pas oublier de poster les arguments
    xhr.send("search=" + mot + "&type=" + type + "&all=" + all);
}

function add(type) {
    window.location.href = "add_data_admin.php?type=" + type;
}

function supp() {
    var id = document.getElementById('id').value;
    var nom = document.getElementById('nom').value;
    var type = document.getElementById('type').value;
    window.location.href = "delete_data_admin.php?type=" + type + "&id=" + id + "&nom=" + nom;
}