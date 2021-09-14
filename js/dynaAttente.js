//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Faire apparaître/disparaître le Bloc Nouveau sur liste d'attente █▄██▄█ 

// Targets
let newFileAttente = document.getElementById('newFileAttente');
let attentePartieBasse = document.getElementById('attentePartieBasse');
let attentePartieHaute = document.querySelector('.attentePartieHaute');

// On click on the bloc-note, bloc TAF appears
newFileAttente.addEventListener('click', function () {

    attentePartieBasse.classList.toggle('attentePartieBasseActive');
    let attentePartieHaute = document.querySelector('.attentePartieHaute');
    attentePartieHaute.style.display = 'none';

});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Targets for check the datas █▄██▄█
let ajouterAttente = document.getElementById('ajouterAttente');
let erreurNewAttente = document.querySelector(".erreurNewAttente");
let newDateContact = document.getElementById('newDateContact');
let newPrenomEnfant = document.getElementById('newPrenomEnfant');
let newAgeEnfant = document.getElementById('newAgeEnfant');
let newGenreEnfant = document.getElementById('newGenreEnfant');
let newNomParent = document.getElementById('newNomParent');
let newPrenomParent = document.getElementById('newPrenomParent');
let newNumTel = document.getElementById('newNumTel');
let newMail = document.getElementById('newMail');
let newPlainte = document.getElementById('newPlainte');
let newLimiteHoraire = document.getElementById('newLimiteHoraire');
let newCommentaires = document.getElementById('newCommentaires');
let formAttente = document.getElementById('formAttente');

// Avant envoi des données, contrôle par des RegExp => A FAIRE
ajouterAttente.addEventListener('click', function (e) {
    // Initialisation
    let erreur = "";
    // Cut he submit
    e.preventDefault();
    // Check by RegExp
    if (!regExp.verifTxtStNn(newPrenomEnfant)) {
        erreur += "<span>Format attendu sur le prénom : caractères max 30</span>";
    }
    if (!regExp.verifTxtStNn(newNomParent)) {
        erreur += "<span>Format attendu sur le nom du parent : ccaractères max 30</span>";
    }
    if (!regExp.verifTxtStNn(newPrenomParent)) {
        erreur += "<span>Format attendu sur le prénom du parent : caractères max 30</span>";
    }
    if (!regExp.verifTel(newNumTel)) {
        erreur += "<span>Format attendu sur le numéro de téléphone : 05-65-65-65-65</span>";
    }
    if (!regExp.verifTxtLgNu(newCommentaires)) {
        erreur += "<span>Format attendu sur le commentaire : caractères max 255</span>";
    }
    if (!regExp.verifTxtLgNn(newPlainte)) {
        erreur += "<span>Format attendu sur la plainte : caractères max 255</span>";
    }
    if (!regExp.verifTxtLgNu(newLimiteHoraire)) {
        erreur += "<span>Format attendu sur les contraintes horaires : caractères max 255</span>";
    }

    // Alternate action if error or not
    if (erreur == "") {
        // OK
        formAttente.submit();
    } else {
        // Bloc error appears and blur the other
        erreurNewAttente.innerHTML += "<h4>Erreur</h4>" + erreur + "<button class='closeError'>Fermer</button>";
        erreurNewAttente.style.display = "flex";
        formAttente.style.filter = "blur(10px)";
        // Target the button "close" after the creation
        let errorButton = document.querySelector('.closeError');
        // on click, we change the view
        errorButton.addEventListener('click', function () {
            erreurNewAttente.style.display = "none";
            formAttente.style.filter = "none";
            erreurNewAttente.innerHTML = "";
        });
    }
});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Création des boutons de slide sur la liste d'attente █▄██▄█

// Ciblages
let gestionListe = document.querySelector('.gestionListe');
let listeAttentePrecedent = document.getElementById('listeAttentePrecedent');
let listeAttenteSuivant = document.getElementById('listeAttenteSuivant');
let frontiereVisuel, valTranslateAttente = 0;

// Au click, slide postérieur
listeAttentePrecedent.addEventListener('click', function () {

    frontiereVisuel = gestionListe.clientWidth - attentePartieHaute.clientWidth;

    if (valTranslateAttente <= 0) {
        valTranslateAttente = valTranslateAttente;
    } else {
        valTranslateAttente -= 400;
    }

    gestionListe.style.transform = "translateX(-" + valTranslateAttente + "px)";
});

// Au click, slide antérieur
listeAttenteSuivant.addEventListener('click', function () {

    frontiereVisuel = 100 + gestionListe.clientWidth - attentePartieHaute.clientWidth;

    if (valTranslateAttente >= frontiereVisuel) {
        valTranslateAttente = valTranslateAttente;
    } else {
        valTranslateAttente += 400;
    }

    gestionListe.style.transform = "translateX(-" + valTranslateAttente + "px)";
});



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Gestion des suppressions de la liste d'attente █▄██▄█

// Targets 
let actionSuppression = document.querySelectorAll('.actionSuppression');
let supprValide = document.querySelectorAll('.supprValide');
let supprNonValide = document.querySelectorAll('.supprNonValide');

// Fonction : au click, apparition du bloc action Delete
for (let elem of actionSuppression) {

    elem.addEventListener('click', function () {

        let blocAction = elem.parentNode;
        let formSupprValide = elem.previousElementSibling;
        let blocControleSupp = blocAction.lastChild;
        let tempDel = elem.parentNode.parentNode;

        tempDel.style.border = "none";
        blocControleSupp.classList.toggle('blocControlSuppActive');

        for (let elem of supprValide) {

            elem.addEventListener('click', function () {
                formSupprValide.submit();
            });
        }

        for (let elem of supprNonValide) {

            elem.addEventListener('click', function () {
                blocControleSupp.classList.remove('blocControlSuppActive');
                tempDel.style.border = "solid 2px var(--coulDelta)";
            });

        }

    });
}



//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Gestion des modifications de la liste d'attente █▄██▄█

// Targets 
let actionModify = document.querySelectorAll('.actionModify');
let returnModify = document.querySelectorAll('.returnModify');

// Fonction : au click, apparition du bloc action Modify
for (let elem of actionModify) {

    elem.addEventListener('click', function () {

        let tempMod = elem.parentNode.parentNode;
        let blocAction = elem.parentNode;
        let blocControleModify = blocAction.firstChild;

        console.log(tempMod);

        tempMod.style.border = "none";
        blocControleModify.classList.toggle('blocControlModifyActive');

        for (let element of returnModify) {

            element.addEventListener('click', function () {

                blocControleModify.classList.toggle('blocControlModifyActive');
                tempMod.style.border = "solid 2px var(--coulDelta)";

            });

        }

    });
}