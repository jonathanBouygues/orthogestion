//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Faire apparaître le Bloc Nouveau sur bilan █▄██▄█ 

// Targets
const NEWDATABILAN = document.getElementById('newDataBilan');
const BILANVISUEL = document.getElementById('bilanVisuel');
let captionSelect = document.querySelector('caption');
const CONTAINERNEWBILAN = document.getElementById('containerNewBilan');
const IMGBACKBILAN = document.getElementById('backBilan');

// On click of the image, bloc appears
NEWDATABILAN.addEventListener('click', function () {

    CONTAINERNEWBILAN.style.display = "flex";
    BILANVISUEL.style.filter = "blur(10px)";
    captionSelect.style.filter = "blur(10px)";

    IMGBACKBILAN.addEventListener('click', function () {
        CONTAINERNEWBILAN.style.display = "none";
        BILANVISUEL.style.filter = "none";
        captionSelect.style.filter = "none";
    });

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Asynchrone Finance █▄██▄█

// Targets
const URLFIN = '../php/include/requeteFin.php';
let containerCharges = document.getElementById('containerCharges');
let containerProduits = document.getElementById('containerProduits');
let dateBilan = document.getElementById('dateBilan');
let recupDataTable = document.getElementById('tableBilan');
let resultatBilan = document.getElementById('resultatBilan');
let tabImgDelBilan;

// Function to call the JSON by requeteFin.php
function apppelDbFin() {

    // Re-initialisation of the data
    containerCharges.innerHTML = '';
    containerProduits.innerHTML = '';

    // Asynchrone's request
    fetch(URLFIN).then(function (reponse) {
        return reponse.json();
    }).then(function (data) {
        // Initialisation of the result
        let result = 0;
        // Injection of the datas with the fonction "map" on the JSON
        data.map(function (personne) {

            if (personne.fin_date.substr(0, 7) == dateBilan.value) {
                if (personne.fin_montant < 0) {
                    containerCharges.innerHTML += '<div data-num="' + personne.fin_id + '"><span>' + personne.fin_date + '</span><span>' + personne.fin_nom + '</span><span>' + personne.fin_montant + ' €</span><img class="delItem" src="../images/close.png" alt="delete item"></div>';
                    result += parseInt(personne.fin_montant);
                } else {
                    containerProduits.innerHTML += '<div data-num="' + personne.fin_id + '"><span>' + personne.fin_date + '</span><span>' + personne.fin_nom + '</span><span>' + personne.fin_montant + ' €</span><img class="delItem" src="../images/close.png" alt="delete item"></div>';
                    result += parseInt(personne.fin_montant);
                }
            }

        })

        // Targets
        tabImgDelBilan = document.querySelectorAll('.delItem');
        // Map the tab
        for (cible of tabImgDelBilan) {

            cible.addEventListener('click', function () {

                // Différence entre "cible" et "this" = 
                // "cible" ne va injecter que le dernier élément connu à la fin de la boucle alors que "this" sera dynamique. 
                // Il vaut mieux jouer avec "this".

                // Targets
                let formDelItemBilan = document.getElementById('formDelItemBilan');
                let idInputBilan = document.querySelector('input[name=idInputBilan]');
                // Set the value
                idInputBilan.value = this.parentNode.dataset.num;
                formDelItemBilan.submit();
            });
        }

        // Render the result
        resultatBilan.innerHTML = result;
        resultatBilan.innerHTML += ' €';


    }).catch(function (erreur) {
        console.log(erreur);
    });
}

// Call the function with actuel date
apppelDbFin();

// Call the function at change of input
dateBilan.addEventListener('change', function () {
    apppelDbFin();
});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ RegExp on the new item █▄██▄█ 

// Targets
let nomInputBilan = document.querySelector('input[name=nomInputBilan');
let montantInputBilan = document.querySelector('input[name=montantInputBilan');
let formItemBilan = document.getElementById('newItemBilan');

// Before send the datas, it check by regexp
submitItem.addEventListener('click', function (e) {
    // Initialisation data
    let erreur = 0;
    // Cut the submit
    e.preventDefault();
    // Check by RegExp
    if (!regExp.verifTxtStNn(nomInputBilan)) {
        nomInputBilan.value = "";
        nomInputBilan.placeholder = "erreur sur le format : max caractères 30";
        erreur = 1;
    }
    if (!regExp.verifDec(montantInputBilan)) {
        montantInputBilan.value = "";
        montantInputBilan.placeholder = "2 décimales max.";
        erreur = 1;
    }
    // Send the form
    if (erreur == 0) {
        formItemBilan.submit();
    }

});
