/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Asynchrone etablissement input █▄██▄█

// Targets
const URL = '../php/include/requetePatient.php';
let selectPatient = document.querySelector('select[name = newNomDocument]');

// Asynchrone's request
fetch(URL).then(function (reponse) {
    return reponse.json();
}).then(function (data) {
    // Injection of the datas with the fonction "map" on the JSON
    data.map(function (personne) {
        selectPatient.innerHTML += '<option>' + personne.pat_ident_nom + ' ' + personne.pat_ident_prenom + '</option>';
    })
}).catch(function (erreur) {
    console.log(erreur);
});



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ import of new document █▄██▄█

// Targets
let imgNewDocument = document.getElementById('newDocument');
let sectionNewDocument = document.getElementById('containerNewDocument');
let sectionContainerDocument = document.getElementById('containerDocument');

// On click on the submit input, we check the data
imgNewDocument.addEventListener('click', function (e) {

    sectionNewDocument.style.display = "flex";
    sectionContainerDocument.style.display = "none";

});