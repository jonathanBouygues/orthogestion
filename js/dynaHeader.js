//╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Deconnection ot the session █▄██▄█
// On click, deconnection of the session and redicrection to the index.php
// Targets
let deconnexion = document.getElementById('deconnexion');
// On click, deconnection of the session and redicrection to the deconnexion.php
deconnexion.addEventListener('click', function () {
    formDeco.submit();
});



// ╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩╔╩
// █▄██▄█ Subrillance of the a █▄██▄█

// Targets
let titleHead = document.querySelector('title');
let tabLienA = document.querySelectorAll('a');

if (titleHead) {

    for (let elem of tabLienA) {

        if (elem.dataset.num == titleHead.dataset.num) {

            elem.style.background = "var(--coulDelta)";
            elem.style.color = "var(--coulBeta)";
        }

    }
}