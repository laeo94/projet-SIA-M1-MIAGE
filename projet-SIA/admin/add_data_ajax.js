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
var nb = 0; //Pour ajout sujet dans theme
var sujet = []; //list des titres a ajouter au nouveau theme
var msg = 0; //si y a un msg pour le nouveau sujet
//Ajoute lien et image une image et un lien pas plus !
var link = 0;
var image = 0;
var pdf = 0;

function addSujetToTheme() {
    nb = nb + 1;
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            leselect = xhr.responseText;
            var div = document.createElement('div');
            div.id = "s" + nb.toString();
            document.getElementById('sujet_form').appendChild(div);
            document.getElementById("s" + nb.toString()).innerHTML += leselect;
            sujet.push("s" + nb.toString()); //ajoute dans la liste le sujet
        }
    }
    xhr.open("POST", "add_sujet_to_new_theme_form.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("nb=" + nb);

}

function removeSujetToTheme(nb) {
    var node = document.getElementById(nb);
    if (node.parentNode) {
        node.parentNode.removeChild(node);
        var pos = sujet.indexOf(nb);
        sujet.splice(pos, 1); //supprime sujet dans la liste
    }
}

function addTheme() {
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            leselect = xhr.responseText;
            document.getElementById('end').innerHTML = leselect;
        }
    }
    var nom = document.getElementById('nom_theme').value;
    var description = document.getElementById('description_theme').value;
    //recupère titre des sujet s'il y en a
    var listSujet = [];
    for (i = 0; i < sujet.length; i++) {
        listSujet.push(document.getElementById("nom" + sujet[i]).value);
    }
    var nomSujet = JSON.stringify(listSujet);
    xhr.open("POST", "add_theme.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("nom=" + nom + "&description=" + description + "&sujet=" + nomSujet);

}

function addMsgToSujet() {
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            leselect = xhr.responseText;
            document.getElementById("msg_form").innerHTML += leselect;
            msg++;
        }
    }
    xhr.open("POST", "add_msg_to_new_sujet_form.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send();

}

function removeMsgToSujet() {
    var node = document.getElementById("new_msg");
    if (node.parentNode) {
        node.parentNode.removeChild(node);
    }
    document.getElementById("add_msg_button").style.visibility = "visible";
    msg--;
}

function addSujet() {
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            leselect = xhr.responseText;
            document.getElementById('end').innerHTML = leselect;
        }
    }
    var nom = document.getElementById('nom').value;
    var theme = document.getElementById('theme').value;
    var msgcontenu = "";
    var linkcontenu = "";
    var imgcontenu = [];
    var pdfcontenu = [];
    if (msg == 1) msgcontenu = document.getElementById('msg').value.replace(/\n/g, "<br>");
    if (link == 1) linkcontenu = document.getElementById('link').value;
    if (image == 1) imgcontenu = document.getElementById("img").files[0];
    if (pdf == 1) pdfcontenu = document.getElementById("pdf").files[0];
    var formData = new FormData();
    formData.append("nom", nom);
    formData.append("theme", theme);
    formData.append("msg", msgcontenu);
    formData.append("link", linkcontenu);
    formData.append("img", imgcontenu);
    formData.append("pdf", pdfcontenu);
    xhr.open("POST", "add_sujet.php");
    xhr.send(formData);

}


//PARTIE ADD MODERATEUR

function validateCheck() {
    var length = document.getElementsByName('idmb').length;
    for (i = 0; i < length; i++) {
        if (document.getElementsByName('idmb')[i].checked) {
            return true;
        }
    }
    alert("Veuillez selectionner au moins un membre du bureau s'il vous plait");
    return false;
}

function addModerateur() {
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            leselect = xhr.responseText;
            document.getElementById('end').innerHTML = leselect;
        }
    }

    //recupère id membre 
    var listmembre = [];
    var length = document.getElementsByName('idmb').length;
    for (i = 0; i < length; i++) {
        if (document.getElementsByName('idmb')[i].checked) {
            listmembre.push(document.getElementsByName('idmb')[i].value);
        }
    }
    var idmb = JSON.stringify(listmembre);
    xhr.open("POST", "add_moderateur.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("idmb=" + idmb);
}

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
        xhr.open("POST", "add_link_or_img_to_new_msg_form.php", true);
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