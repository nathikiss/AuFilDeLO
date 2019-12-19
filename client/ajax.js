let tabPatrimoine = function (response) {
    for (let i = 0; i < response.length; i++) {
        console.log(response.resultats[0].commune);
        let node = document.createElement("tr");
        let textTd = document.createTextNode(response.resultats[i].commune);
        node.appendChild(textTd);
        document.getElementById("body").appendChild(node);
    }
};
function clickGet() {
    $(function () {

        let departement = document.getElementById("departement").value;
        let commune = document.getElementById("commune").value;
        let type = document.getElementById("type").value;
        console.log(type);

        if (departement !== "") {
            let url = "http://localhost/SIO22/Mission2/apiRest.php/?departement=" + departement;
            // En cas de succès c'est à dire un retour
            $.get(url, tabPatrimoine).done(function () {

            })
                // En cas d'echec...
                .fail(function (error) {
                    alert("Echec de la requête : " + JSON.stringify(error));
                })
        } else if (commune !== "") {
            let url = "http://localhost/SIO22/Mission2/apiRest.php/?commune=" + commune;
            // En cas de succès c'est à dire un retour
            $.get(url, tabPatrimoine).done(function () {

            })
                // En cas d'echec...
                .fail(function (error) {
                    alert("Echec de la requête : " + JSON.stringify(error));
                })
        } else if (type !== "") {
            let url = "http://localhost/SIO22/Mission2/apiRest.php/?type=" + type;
            // En cas de succès c'est à dire un retour
            $.get(url, tabPatrimoine).done(function () {

            })
                // En cas d'echec...
                .fail(function (error) {
                    alert("Echec de la requête : " + JSON.stringify(error));
                })
        }


    });
}
    /*function testAJAX() {
$(function () {
$.ajax({
// L'URL de la requête
url: "http://localhost/SIO22/Mission2/apiRest.php/",
// La méthode d'envoi
method: "GET",
// Le format attendu en réponse
dataType: "json"
})
// En cas de succès c'est à dire un retour
.done(function (response) {
let data = JSON.stringify(response);
alert(data);
})
// En cas d'echec...
.fail(function (error) {
alert("Echec de la requête : " + JSON.stringify(error));
})
});
}
// Méthode générique retournant un objet XMLHttpRequest
function goXHR() {
let xhr = null;
if (window.XMLHttpRequest) { // Autres navigateurs
xhr = new XMLHttpRequest();
} else {
if (window.ActiveXObject) { // Internet Explorer
try {
xhr = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
} else { // XMLHttpRequest non supporté par le navigateur
alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
xhr = false;
}
}
return xhr;
}
function XMLHTTPRequest() {
var xhr = goXHR();
// Traitement une fois la réponse obtenue
xhr.onreadystatechange = function () {
if (xhr.readyState == 4) {
if (xhr.status == 200) {
// Retour du print du script PHP
reponse = xhr.responseText;
// Information du retour
alert(reponse);
} else {
alert(xhr.status);
}
}
}
// Envoi de la requête par GET avec données
xhr.open("GET", "http://localhost/SIO22/Mission2/apiRest.php/");
xhr.send(null);
}*/