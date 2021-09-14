/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Creation of mini-calendarr █▄██▄█

// Targets
let formDonnee = document.getElementById('formDonnee');
let activeCalendrier = document.getElementById("activeCalendrier");
let injectionCodeCal = document.getElementById("injectionCodeCal");
let envoi = document.getElementById("envoi");
let dateJour = document.getElementById('dateJour');
let moisSuivant = document.getElementById('moisSuivant');
let moisPrecedent = document.getElementById('moisPrecedent');
let gestionCarroussel = document.getElementById('gestionCarroussel');
let containerImg = document.querySelector('.containerImg');
let cibleJour, jourTemp, valTranslate = -1080;

// On click, the mini-calendar appears
activeCalendrier.addEventListener('click', function () {

    injectionCodeCal.style.display = "flex";
    moisPrecedent.style.display = "flex";
    moisSuivant.style.display = "flex";


    // Au click, gestion du mois suivant
    moisSuivant.addEventListener('click', function () {

        if (valTranslate <= -2160) {
            valTranslate = -2160;
        } else {
            valTranslate -= 540;
        }

        gestionCarroussel.style.transform = "translateX(" + valTranslate + "px)";
    });


    // Au click, gestion du mois précédent
    moisPrecedent.addEventListener('click', function () {

        if (valTranslate < 0) {
            valTranslate += 540;
        } else {
            valTranslate = 0;
        }

        gestionCarroussel.style.transform = "translateX(" + valTranslate + "px)";
    });

});


// Au click sur le jour, on injecte dans l'input caché
injectionCodeCal.addEventListener('click', function (e) {

    if (e.target.className == "jour") {

        if (cibleJour == null) {
            cibleJour = e.target;
            cibleJour.setAttribute('style', 'background-color: var(--coulSurvol)');
            cibleMois = cibleJour.parentNode;
            texteMois = cibleMois.className.substr(5, 20);
            jourTemp = cibleJour.textContent;
            if (jourTemp < 10) {
                jourTemp = '0' + jourTemp;
            }
            texte = jourTemp + '/' + texteMois;
            dateJour.value = texte;
            formDonnee.submit();

        } else {
            cibleJour.setAttribute('style', 'background-color: var(--coulContenu)');
            cibleJour = e.target;
            cibleJour.setAttribute('style', 'background-color: var(--coulSurvol)');
            cibleMois = cibleJour.parentNode;
            texteMois = cibleMois.className.substr(5, 20);
            jourTemp = cibleJour.textContent;
            if (jourTemp < 10) {
                jourTemp = '0' + jourTemp;
            }
            texte = jourTemp + '/' + texteMois;
            dateJour.value = texte;
            formDonnee.submit();
        }
    } else {
        alert('Choisissez un jour valable');
    }

});



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Do appears the "blocTaf" █▄██▄█

// Targets
let blocNote = document.getElementById('blocNote');
let blocTaf = document.getElementById('blocTaf');
let interactionPatient = document.querySelector('.interactionPatient')
// On click on the img#blocNote, appear of the bloc
blocNote.addEventListener('click', function () {
    // Get the width
    let tailleBoite = interactionPatient.clientWidth;
    // Modify the class and the attribute
    blocTaf.setAttribute('style', 'width:' + tailleBoite + 'px');
    blocAbsent.classList.remove('blocAbsentVisible');
    blocTaf.classList.toggle('blocTafVisible');

});



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Do appears the "blocAbsent" █▄██▄█

// Targets
let blocNotif = document.getElementById('blocNotif');
let blocAbsent = document.getElementById('blocAbsent');
// On click on the img#blocNote, appear of the bloc
blocNotif.addEventListener('click', function () {

    // Get the width
    let tailleBoite = interactionPatient.clientWidth;
    // Modify the class and the attribute
    blocAbsent.setAttribute('style', 'width:' + tailleBoite + 'px');
    blocTaf.classList.remove('blocTafVisible');
    blocAbsent.classList.toggle('blocAbsentVisible');

});



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Scroll des creneaux horaires (top) █▄██▄█

// Targets
let semaine = document.querySelector('.semaine');
let blocEntetePlan = document.querySelector('.blocEntetePlan');

// On scroll, the block get down
semaine.addEventListener('scroll', function (e) {

    let transfertBloc = semaine.scrollTop;
    blocEntetePlan.setAttribute('style', 'top:' + transfertBloc + 'px');

});



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Faire apparaître en Ajax la liste de patient █▄██▄█

// Initialisation
let rech; //va contenir le mot recherché
let tab_reponse; //Tableau des résultats
let ajax;
// Targets
const NEWCRENEAU = document.querySelector('input[name=nouvCreneauNom]');
const AUTOCOMPBETA = document.getElementById('autocompBeta');
const CRENEAUNOM = document.getElementById('creneauNom');


// Ajout d'un écouteur sur l'input 
NEWCRENEAU.addEventListener('input', function () {

    AUTOCOMPBETA.style.display = "flex";

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
            AUTOCOMPBETA.innerHTML = ajax.responseText;

            // On cible tous les li
            tab_li = AUTOCOMPBETA.querySelectorAll('li');

            // Parcours du tableau généré
            for (cible of tab_li) {
                cible.addEventListener('click', function () {
                    // Récupération du contenu pour MAJ
                    NEWCRENEAU.value = this.firstChild.textContent;
                    // On vide la zone de l'autocompletion
                    AUTOCOMPBETA.innerHTML = '';
                    // Envoie des données pour MAJ visuel
                    CRENEAUNOM.value = this.lastChild.textContent;
                    AUTOCOMPBETA.style.display = "none";
                });
            }

        }
    }

    // Préparation de la demande
    ajax.open("POST", "include/traitPlanPatListe.php", true);

    // Spécification du type de données échangées
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Envoi de la demande au serveur
    ajax.send('recherche=' + mot);
}



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ New meeting (item slot) █▄██▄█

// Targets
const SECTIONPLANNING = document.querySelector('.planning');
let tab_new_cren_hor = document.querySelectorAll('.identitePatient');
let blocModification = document.getElementById('blocModification');
let blocNouvRdv = document.querySelector('.blocNouvRdv');
let inputCreneauId = document.querySelector('input[name = nouvCreneauId]');
let inputCreneauNom = document.querySelector('input[name = nouvCreneauNom]');
let submitNewMeeting = document.getElementById('submitNewMeeting');
const BACKNEWMEETING = document.getElementById('backNewMeeting');
const CRENEAUINJECTION = document.getElementById('creneauInjection');
const HAUTINDEX = document.querySelector('.hautIndex');

// Position of the bloc
let tempHeight = SECTIONPLANNING.clientHeight;
let tempWidth = SECTIONPLANNING.clientWidth;
blocNouvRdv.style.left = "50% - calc(50%" + tempWidth + "px)";
blocNouvRdv.style.top = "50% - calc(50%" + tempHeight + "px)";

// Au click sur le bouton prendre RDV, apparition du blocModification
for (let elem of tab_new_cren_hor) {

    elem.addEventListener('click', function () {

        let donnee = elem.parentNode.className.substring(9);

        semaine.style.filter = "blur(10px)";
        HAUTINDEX.style.filter = "blur(10px)";
        blocNouvRdv.style.display = "flex";
        inputCreneauId.value = donnee;

        BACKNEWMEETING.addEventListener('click', function (e) {
            // Cut the submit
            semaine.style.filter = "none";
            HAUTINDEX.style.filter = "none";
            blocNouvRdv.style.display = "none";

        });

        submitNewMeeting.addEventListener('click', function (e) {
            // Cut the submit
            e.preventDefault();
            // Condition if name's value is empty 
            if (!regExp.verifTxtStNu(inputCreneauNom)) {
                inputCreneauNom.placeholder = "indiquer un nom";
            } else {
                CRENEAUINJECTION.submit();
            }

        });

    });

}



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ New meeting Ante Post (item slot) =>>>> A RETRAVAILLER █▄██▄█

// Targets
let tab_new_AntePostCrenHor = document.querySelectorAll('.identitePatientBeta');
let blocAntePostRdv = document.querySelector('.blocAntePostRdv');
let submitNewAntePostMeeting = document.getElementById('submitNewAntePostMeeting');
let inputCreneauIdBeta = document.querySelector('input[name = nouvCreneauIdBeta]');
let inputCreneauComment = document.querySelector('input[name = creneauComment]');
const BACKNEWANTEPOSTMEETING = document.getElementById('backNewAntePostMeeting');
const CRENEAUINJECTIONANTEPOST = document.getElementById('creneauInjectionAntePost');
// Position of the bloc
blocAntePostRdv.style.left = "50% - calc(50%" + tempWidth + "px)";
blocAntePostRdv.style.top = "50% - calc(50%" + tempHeight + "px)";

// Au click sur le bouton prendre RDV, apparition du blocModification
for (let elem of tab_new_AntePostCrenHor) {

    elem.addEventListener('click', function () {

        let donnee = elem.parentNode.className.substring(9);

        semaine.style.filter = "blur(10px)";
        HAUTINDEX.style.filter = "blur(10px)";
        blocAntePostRdv.style.display = "flex";
        inputCreneauIdBeta.value = donnee;

        BACKNEWANTEPOSTMEETING.addEventListener('click', function (e) {
            // Cut the submit
            semaine.style.filter = "none";
            HAUTINDEX.style.filter = "none";
            blocAntePostRdv.style.display = "none";

        });

        submitNewAntePostMeeting.addEventListener('click', function (e) {
            // Cut the submit
            e.preventDefault();
            // Condition if name's value is empty 
            if (!regExp.verifTxtStNn(inputCreneauComment)) {
                inputCreneauComment.placeholder = "indiquer un texte";
            } else {
                CRENEAUINJECTIONANTEPOST.submit();
            }

        });

    });

}



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Gestion des absences █▄██▄█

// Targets
let tabInterrupteurPresent = document.querySelectorAll('.interrupteurPresence');
let blocTestPresence = document.getElementById('blocTestPresence');
let inputCorrespondancePresence = document.querySelector('input[name = idTimeSlotPresence]');
let modifPresence = document.getElementById('modifPresence');
let boutonConfirme = document.getElementById('boutonConfirme');
let boutonRetourAbsence = document.getElementById('boutonRetourAbsence');


// Au click sur le bouton de présence, calcul du taux d'absence
for (let elem of tabInterrupteurPresent) {

    elem.addEventListener('click', function () {

        let donneePresence = elem.parentNode.className.substring(9);
        let test = elem.previousSibling.firstChild.textContent;

        SECTIONPLANNING.style.filter = "blur(10px)";

        if (isNaN(test)) {
            blocTestPresence.style.display = "flex";
            inputCorrespondancePresence.value = donneePresence;

            boutonRetourAbsence.addEventListener('click', function () {
                blocTestPresence.style.display = "none";
                SECTIONPLANNING.style.filter = "none";
            });

            boutonConfirme.addEventListener('click', function () {
                modifPresence.submit()
            });
        }

    });

}



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ Cancel items in the toDoList █▄██▄█

// Targets
let tabImgDelete = document.querySelectorAll('.itemDelete');
let formItem = document.getElementById('formItem');
let inputItem = document.querySelector('input[name = newItem]');

// On click on the img, near to the item, the text is injected in the input and the form is submit
// Loop to know the elem targeted
for (let elem of tabImgDelete) {

    elem.addEventListener('click', function () {
        // Targets
        let valueItem = elem.previousSibling.data;
        // If condition to know if it's empty
        if (isNaN(inputItem)) {
            // Set the input value
            inputItem.value = valueItem;
            // Submit the form
            formItem.submit()
        }

    });

}



/* ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩ */
// █▄██▄█ RegExp on the toDoList █▄██▄█

// Targets
let submitNewItem = document.querySelector('input[name = submitNewItem]');

// On click on the submit input, we check the data
submitNewItem.addEventListener('click', function (e) {

    // Cut the submit
    e.preventDefault();
    // If condition with a regExp to know if it's empty
    if (regExp.verifTxtStNn(inputItem)) {
        // Submit the form
        formItem.submit()
    } else {
        inputItem.value = "";
        inputItem.placeholder = "texte court (max 30)";
    }

});