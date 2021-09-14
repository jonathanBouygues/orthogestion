//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Chargement de la page █▄██▄█
document.addEventListener('DOMContentLoaded', function () {



    //╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
    // █▄██▄█ Taille des triangles en dynamique █▄██▄█

    // Ciblages
    let containerLogin = document.getElementById('containerLogin');
    let triangleHaut = document.getElementById('triangleHaut');
    let containerForm = document.getElementById('containerForm');
    let triangleForm = document.getElementById('triangleForm');
    let hauteurMain, largeurMain, hauteurForm, largeurForm;

    // Au départ, au chargement de la page
    hauteurMain = containerLogin.clientHeight;
    largeurMain = containerLogin.clientWidth;
    triangleHaut.setAttribute('style', 'border-top:' + hauteurMain + 'px solid var(--coulBeta); border-right:' + largeurMain + 'px solid transparent');

    hauteurForm = containerForm.clientHeight;
    largeurForm = containerForm.clientWidth;
    triangleForm.setAttribute('style', 'border-top:' + hauteurForm + 'px solid  var(--coulAlpha); border-right:' + largeurForm + 'px solid var(--coulBeta');

    // A chaque redimensionnement de la page
    window.addEventListener('resize', function () {

        hauteurMain = containerLogin.clientHeight;
        largeurMain = containerLogin.clientWidth;
        triangleHaut.setAttribute('style', 'border-top:' + hauteurMain + 'px solid var(--coulBeta); border-right:' + largeurMain + 'px solid transparent');

        hauteurForm = containerForm.clientHeight;
        largeurForm = containerForm.clientWidth;
        triangleForm.setAttribute('style', 'border-top:' + hauteurForm + 'px solid  var(--coulAlpha); border-right:' + largeurForm + 'px solid var(--coulBeta');
    });



    //╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
    // █▄██▄█ Gestion du bouton action formulaire █▄██▄█
    // Targets
    let formLogin = document.getElementById('verifLogin');
    let idLogin = document.getElementById('idLogin');
    let mdpLogin = document.getElementById('mdpLogin');
    let boutonLogin = document.getElementById('boutonLogin');
    // 
    boutonLogin.addEventListener('click', function (e) {

        // Cut the submit
        e.preventDefault();

        // Test
        if (regExp.verifMail(idLogin)) {
            // Submit the form
            formLogin.submit();
        } else {
            // Non ok
            idLogin.value = "";
            idLogin.placeholder = "Erreur sur le format du mail";
        }

    })



    //╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
    // █▄██▄█ Alternate the form if creation's ask █▄██▄█
    let demandeCompte = document.getElementById('demandeCompte');
    let containerDemande = document.querySelector('.containerDemande');
    let demandeButton = document.getElementById('demandeButton');
    let demandeSubmit = document.getElementById('demandeSubmit');
    const IMGBACKLOGIN = document.getElementById('backLogin');

    demandeButton.addEventListener('click', function () {

        demandeCompte.style.display = "flex";
        formLogin.style.display = "none";
        containerDemande.style.display = "none";

        IMGBACKLOGIN.addEventListener('click', function () {

            demandeCompte.style.display = "none";
            formLogin.style.display = "flex";
            containerDemande.style.display = "flex";

        });

        demandeSubmit.addEventListener('click', function (e) {

            // Targets
            let inputAskTel = document.querySelector('input[name =demandeTel]');
            let inputAskMail = document.querySelector('input[name =demandeMail]');
            let inputAskMessage = document.querySelector('textarea[name =demandeMessage]');
            let inputAskNom = document.querySelector('input[name =demandeNom]');
            let erreur = 0;

            // Cut the submit
            e.preventDefault();
            // Check the datas
            if (!regExp.verifMail(inputAskMail) && (inputAskMail.value != "")) {
                // Mail's format KO
                inputAskMail.value = "";
                inputAskMail.placeholder = "Erreur sur le format du mail";
                erreur = 1;
            }
            if (!regExp.verifTel(inputAskTel) && (inputAskTel.value != "")) {
                // Tel's format' KO
                inputAskTel.value = "";
                inputAskTel.placeholder = "Format : 05-65-65-65-65";
                erreur = 1;
            }
            if ((inputAskTel.value == "") && (inputAskMail.value == "")) {
                inputAskTel.placeholder = "mail ou tél.obligatoire";
                inputAskMail.placeholder = "mail ou tél.obligatoire";
                erreur = 1;
            }
            if (!regExp.verifTxtStNn(inputAskNom)) {
                // Name's format KO
                inputAskNom.value = "";
                inputAskNom.placeholder = "Caractères autorisés (2-30)";
                erreur = 1;
            }
            if (!regExp.verifTxtLgNn(inputAskMessage)) {
                // Message's format KO
                inputAskMessage.value = "";
                inputAskMessage.placeholder = "255 caractères maximum et pas de caractère spécial";
                erreur = 1;
            }

            // No error, we can submit
            if (erreur == 0) {
                // Submit the form
                demandeCompte.submit();
            }

        });

    })

});