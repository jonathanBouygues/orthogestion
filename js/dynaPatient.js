//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Faire apparaître/disparaître la liste d'attente █▄██▄█

// Initialisation
let rech; //va contenir le mot recherché
let tab_reponse; //Tableau des résultats
let ajax;
// Targets
const PATIENT = document.querySelector('input[name=patientNom]');
const AUTOCOMP = document.getElementById('autocomp');
const PATIENTID = document.getElementById('patientID');
let FORMLISTE = document.getElementById('formListe');

// Ajout d'un écouteur sur l'input 
PATIENT.addEventListener('input', function () {

    AUTOCOMP.style.display = "block";

    // Récupération de la valeur
    rech = this.value; // on aurait pu mettre PATIENT.value aussi !

    // Debug
    recherche(rech);

});

// Fonction Asynchrone
function recherche(mot) {

    // Instanciation
    ajax = new XMLHttpRequest();

    // Surveillance de la réponse du serveur
    ajax.onreadystatechange = function () {

        if (ajax.readyState == 4 && ajax.status == 200) {

            // On affiche la liste
            AUTOCOMP.innerHTML = ajax.responseText;

            // On cible tous les li
            tab_li = AUTOCOMP.querySelectorAll('li');

            // Parcours du tableau généré
            for (cible of tab_li) {
                cible.addEventListener('click', function () {
                    // Récupération du contenu pour MAJ
                    PATIENT.value = this.firstChild.textContent;
                    // On vide la zone de l'autocompletion
                    AUTOCOMP.innerHTML = '';
                    // Envoie des données pour MAJ visuel
                    PATIENTID.value = this.lastChild.textContent;
                    FORMLISTE.submit();
                });
            }

        }
    }

    // Préparation de la demande
    ajax.open("POST", "include/traitPatListe.php", true);

    // Spécification du type de données échangées
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Envoi de la demande au serveur
    ajax.send('recherche=' + mot);
}



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Gestion des blocs de description de la fiche client █▄██▄█

// Ciblages (click sur nav et activation des blocs)
let patientCorpsFichier = document.querySelector('.patientCorpsFichier');
let tab_li_action = patientCorpsFichier.querySelectorAll('li');
let blocSuivi = document.querySelector('.blocSuivi');
let blocIdentite = document.querySelector('.blocIdentite');
let blocAssure = document.querySelector('.blocAssure');
let blocPrescription = document.querySelector('.blocPrescription');
let elemPrecedent = 0;
let actionSuivi = document.querySelector('.actionSuivi');

// Loop for the li test
for (let elem of tab_li_action) {

    elem.addEventListener('click', function () {

        // Récupération de la valeur selectionnée
        blocCible = elem.textContent;

        // Réinitialisation des styles
        blocSuivi.style.display = "none";
        blocIdentite.style.display = "none";
        blocAssure.style.display = "none";
        blocPrescription.style.display = "none";

        // Gestion du li en subrillance
        if (elemPrecedent != 0) {
            elemPrecedent.classList.toggle('actif');
        } else {
            actionSuivi.classList.remove('actif');
        }
        elem.classList.toggle('actif');

        // Condition selon blocCible
        if (blocCible != "Suivi") {
            if (blocCible == "Identité") {
                blocIdentite.style.display = "flex";
            } else if (blocCible == "Assuré") {
                blocAssure.style.display = "flex";
            } else {
                blocPrescription.style.display = "flex";
            }
        } else {
            blocSuivi.style.display = "flex";
        }

        // Bouton interrupteur 
        elemPrecedent = elem;

    });
}



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Gestion des nouveaux patients █▄██▄█

// Targets
let mainPatient = document.getElementById('containerPatient')
let newPatient = mainPatient.querySelector('.newPatient');
let blocNewPatient = mainPatient.querySelector('.blocNewPatient');
let submitNewPatient = document.getElementById('submitNewPatient');
let formNewPatient = document.getElementById('formNewPatient');
let erreurNewPatient = document.querySelector('.erreurNewPatient');

// On click, the bloc appears
newPatient.addEventListener('click', function () {

    // Change the view
    mainPatient.style.border = "none";
    blocNewPatient.style.display = "flex";

    // On click, we xheck the RegExp. There is not an error, we submit the form
    submitNewPatient.addEventListener('click', function (e) {
        // Cut the submit
        e.preventDefault();
        // Targets
        let erreur = "";
        let identNom = blocNewPatient.querySelector('input[name = identNom]');
        let identPrenom = blocNewPatient.querySelector('input[name = identPrenom]');
        let assureNom = blocNewPatient.querySelector('input[name = assureNom]');
        let assurePrenom = blocNewPatient.querySelector('input[name = assurePrenom]');
        let assureTel = blocNewPatient.querySelector('input[name = assureTel]');
        let assureNumSS = blocNewPatient.querySelector('input[name = assureNumSS]');
        let suiviNbreSeance = blocNewPatient.querySelector('input[name = suiviNbreSeance]');
        let suiviDureeSeance = blocNewPatient.querySelector('input[name = suiviDureeSeance]');
        let suiviFreqSeance = blocNewPatient.querySelector('input[name = suiviFreqSeance]');

        // Check the RexExp
        if (!regExp.verifTxtStNn(identNom)) {
            erreur += "<span>Format attendu sur le nom : max. 30 caractères</span>";
        }
        if (!regExp.verifTxtStNn(identPrenom)) {
            erreur += "<span>Format attendu sur le prénom : max. 30 caractères</span>";
        }
        if (!regExp.verifTxtStNn(assureNom)) {
            erreur += "<span>Format attendu sur le prénom : max. 30 caractères</span>";
        }
        if (!regExp.verifTxtStNn(assurePrenom)) {
            erreur += "<span>Format attendu sur le prénom : max. 30 caractères</span>";
        }
        if (!regExp.verifTel(assureTel)) {
            erreur += "<span>Format attendu sur le tél : 05-65-65-65-65</span>";
        }
        if (!regExp.verifNumSS(assureNumSS)) {
            erreur += "<span>Format attendu sur le num SS : 2 02 02 02 123 123 33</span>";
        }
        if (!regExp.verifAge(suiviNbreSeance)) {
            erreur += "<span>Format attendu sur le nombre :  nombre compris 0 et 100</span>";
        }
        if (!regExp.verifAge(suiviDureeSeance)) {
            erreur += "<span>Format attendu sur la durée :  nombre compris 0 et 100</span>";
        }
        if (!regExp.verifAge(suiviFreqSeance)) {
            erreur += "<span>Format attendu sur la fréquence :  nombre compris 0 et 100</span>";
        }


        // Alternate action if error or not
        if (erreur == "") {
            // OK
            formNewPatient.submit();
        } else {
            // Bloc error appears and blur the other
            erreurNewPatient.innerHTML += "<h4>Erreur</h4>" + erreur + "<button class='closeError'>Fermer</button>";
            erreurNewPatient.style.display = "flex";
            formNewPatient.style.filter = "blur(10px)";

            // Target the button "close" after the creation
            let errorButton = document.querySelector('.closeError');
            // on click, we change the view
            errorButton.addEventListener('click', function () {
                erreurNewPatient.style.display = "none";
                formNewPatient.style.filter = "none";
                erreurNewPatient.innerHTML = "";
            });
        }

    });

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Modify patient █▄██▄█

// Targets
let imgModify = document.getElementById('modifyPatient');
let blocModPatient = document.querySelector('.blocModPatient');
let partieBasse = mainPatient.querySelector('.patientPartieBasse');
let buttonModReturn = document.querySelector('.buttonModReturn');
let nomModPatient = document.getElementById('nomModPatient');

// On click, the bloc appears
imgModify.addEventListener('click', function () {

    let temp = imgModify.parentNode.firstChild.attributes.name;
    nomModPatient.value = temp.value;
    partieBasse.style.border = "none";
    partieBasse.style.padding = "0";
    blocModPatient.style.display = "flex";

    buttonModReturn.addEventListener('click', function () {
        blocModPatient.style.display = "none";
        partieBasse.style.border = "solid 3px var(--coulDelta)";
        partieBasse.style.padding = "10px";

    });

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Delete patient █▄██▄█

// Targets
let imgDelete = document.getElementById('deletePatient');
let blocDelPatient = document.querySelector('.blocDelPatient');
let buttonConfirm = document.querySelector('.buttonConfirm');
let buttonDelReturn = document.querySelector('.buttonDelReturn');
let nomDelPatient = document.getElementById('nomDeletePatient');
let formDelPatient = document.getElementById('formDelPatient');

// On click, the bloc appears
imgDelete.addEventListener('click', function () {

    partieBasse.style.border = "none";
    partieBasse.style.padding = "0";
    blocDelPatient.style.display = "flex";

    buttonConfirm.addEventListener('click', function () {
        let temp = imgModify.parentNode.firstChild.attributes.name;
        nomDelPatient.value = temp.value;
        formDelPatient.submit();
    });

    buttonDelReturn.addEventListener('click', function () {
        blocDelPatient.style.display = "none";
        partieBasse.style.border = "solid 3px var(--coulDelta)";
        partieBasse.style.padding = "10px";

    });

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Bloc med appears █▄██▄█

// Targets
let imgMedPresc = document.getElementById('infoMedecin');
let blocMedPresc = document.querySelector('.blocMedPresc');

// On click, the bloc appears
imgMedPresc.addEventListener('click', function () {

    blocMedPresc.classList.toggle('actif');

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Bloc med trait appears █▄██▄█

// Targets
let imgMedTrait = document.getElementById('infoMedecinTrait');
let blocMedTrait = document.querySelector('.blocMedTrait');

// On click, the bloc appears
imgMedTrait.addEventListener('click', function () {

    blocMedTrait.classList.toggle('actif');

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Bloc etablissement appears █▄██▄█

// Targets
let imgEtab = document.getElementById('infoEtablissement');
let blocIdentEtab = document.querySelector('.blocIdentEtab');
let selectChamps = document.getElementById('selectChamps');

// On click, the bloc appears
imgEtab.addEventListener('click', function () {

    blocIdentEtab.classList.toggle('actif');

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Asynchrone etablissement input █▄██▄█

// Targets
const URL = '../php/include/requeteEtab.php';
let inputEtab = document.querySelector('.inputEtab');
let itemModPatientEtab = document.querySelector('.itemModPatientEtab');

// Asynchrone's request
fetch(URL).then(function (reponse) {
    return reponse.json();
}).then(function (data) {
    // Injection of the datas with the fonction "map" on the JSON
    data.map(function (personne) {
        inputEtab.innerHTML += '<option value="' + personne.etab_id + '">' + personne.etab_nom + '</option>';
    })
    data.map(function (personne) {
        itemModPatientEtab.innerHTML += '<option value="' + personne.etab_id + '">' + personne.etab_nom + '</option>';
    })
}).catch(function (erreur) {
    console.log(erreur);
});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Asynchrone medecin input █▄██▄█

// Targets
const URLMED = '../php/include/requeteMed.php';
let inputMedPresc = document.querySelector('.inputMedPresc');
let inputMedTrait = document.querySelector('.inputMedTrait');
let itemModPatientMed = document.querySelector('.itemModPatientMed');

// Asynchrone's request
fetch(URLMED).then(function (reponse) {
    return reponse.json();
}).then(function (data) {
    // Injection of the datas with the fonction "map" on the JSON
    data.map(function (personne) {
        inputMedPresc.innerHTML += '<option value="' + personne.med_id + '">' + personne.med_nom + '</option>';
    })
    // Injection of the datas with the fonction "map" on the JSON
    data.map(function (personne) {
        inputMedTrait.innerHTML += '<option value="' + personne.med_id + '">' + personne.med_nom + '</option>';
    })
    // Injection of the datas with the fonction "map" on the JSON
    data.map(function (personne) {
        itemModPatientMed.innerHTML += '<option value="' + personne.med_id + '">' + personne.med_nom + '</option>';
    })
}).catch(function (erreur) {
    console.log(erreur);

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Asynchrone Type Bilan █▄██▄█

// Targets
const URLBIL = '../php/include/requeteNomenBilan.php';
let typeBilan = document.querySelector('.typeBilan');
let modTypeBilan = document.querySelector('.itemModPatientBilan');

// Asynchrone's request
fetch(URLBIL).then(function (reponse) {
    return reponse.json();
}).then(function (data) {
    // Injection of the datas with the fonction "map" on the JSON
    data.map(function (personne) {
        typeBilan.innerHTML += '<option value="' + personne.nomen_bilan_id + '">' + personne.nomen_bilan_desActe + '</option>';
        modTypeBilan.innerHTML += '<option value="' + personne.nomen_bilan_id + '">' + personne.nomen_bilan_desActe + '</option>';
    })
}).catch(function (erreur) {
    console.log(erreur);
});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Asynchrone Type Acte █▄██▄█

// Targets
const URLACT = '../php/include/requeteNomenActe.php';
let typeActe = document.querySelector('.typeActe');
let modTypeActe = document.querySelector('.itemModPatientActe');

// Asynchrone's request
fetch(URLACT).then(function (reponse) {
    return reponse.json();
}).then(function (data) {
    // Injection of the datas with the fonction "map" on the JSON
    data.map(function (personne) {
        typeActe.innerHTML += '<option value="' + personne.nomen_acte_id + '">' + personne.nomen_acte_desActe + '</option>';
        modTypeActe.innerHTML += '<option value="' + personne.nomen_acte_id + '">' + personne.nomen_acte_desActe + '</option>';
    })
}).catch(function (erreur) {
    console.log(erreur);
});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Switch with Asynchrone if it's "Medecin" or "Etab" █▄██▄█

// Targets
let itemModPatient = document.getElementById('itemModPatient')

// On click, the bloc appears
selectChamps.addEventListener('change', function () {

    let temp = selectChamps.value;

    if ((temp == "pat_presc_nomMedPresc") || (temp == "pat_presc_nomMedTrait")) {

        itemModPatientMed.style.display = "flex";
        itemModPatient.style.display = "none";
        itemModPatientEtab.style.display = "none";
        modTypeBilan.style.display = "none";
        modTypeActe.style.display = "none";

    } else if (temp == "pat_ident_etab") {

        itemModPatientEtab.style.display = "flex";
        itemModPatient.style.display = "none";
        itemModPatientMed.style.display = "none";
        modTypeBilan.style.display = "none";
        modTypeActe.style.display = "none";

    } else if (temp == "pat_presc_AMOBilan") {

        itemModPatientEtab.style.display = "none";
        itemModPatient.style.display = "none";
        itemModPatientMed.style.display = "none";
        modTypeBilan.style.display = "flex";
        modTypeActe.style.display = "none";

    } else if (temp == "pat_presc_AMOActe") {

        itemModPatientEtab.style.display = "none";
        itemModPatient.style.display = "none";
        itemModPatientMed.style.display = "none";
        modTypeBilan.style.display = "none";
        modTypeActe.style.display = "flex";

    }

});