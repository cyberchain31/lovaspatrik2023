
// ===== AUTOMATICKE PISANIE TEXTU =====

var typed = new Typed(".typing", {
    strings: ["Pozri si moje Portfólio...", "Pozri si moju 3D Tlač...", "Pozri si moje Modelovanie..."],
    typeSpeed: 100,
    backSpeed: 60,
    loop: true
})


// ===== KONTAKTNY FORMULAR =====

// vybranie elementu inputu z html
const names = document.querySelector("#name");
const email = document.querySelector("#email");
const object = document.querySelector("#object");
const message = document.querySelector("#message");
const success = document.querySelector("#success");
// const denied = document.querySelector("#denied");
const error = document.querySelectorAll(".error");

// overenie dat - dlzka textu
function validateForm() {

    // zavolanie funkcie - vymazanie predchadzajuci error text a ramik, po zadani spravnych udajov
    clearMessages();
    // potvrdenie odoslanie formulara
    let trueFalse = false;

    // NAMES = ak je dlzka mensia ako []index,pismeno tak...
    if (names.value.length < 1) {
        // vypis do erroru, od 0teho indexu - vloz tento text
        error[0].innerText = "Príliš krátke meno";
        // do name pridaj triedu error-border - ramik
        names.classList.add("error-border");

        trueFalse = true;
    }

    // EMAIL = ak je dlzka mensia ako []index,pismeno tak...
    if (!emailIsValid(email.value)) {
        error[1].innerText = "Nesprávna mailová adresa";
        email.classList.add("error-border");

        trueFalse = true;
    }

    // OBJECT = ak je dlzka mensia ako []index,pismeno tak...
    if (object.value.length < 1) {
        error[2].innerText = "Príliš krátky predmet";
        object.classList.add("error-border");

        trueFalse = true;
    }

    // MESSAGE = ak je dlzka mensia ako []index,pismeno tak...
    if (message.value.length < 1) {
        error[3].innerText = "Prosím vložte správu";
        message.classList.add("error-border");

        trueFalse = true;
    }

    // TRUE / FALSE - odoslanie formulara
    if (!trueFalse) {
        success.innerText = "Úspeśné odoslanie!";
    }
}

// vymazanie predchadzajuci error text a ramik, po zadani spravnych udajov
function clearMessages() {
    for (let i = 0; i < error.length; i++) {
        error[i].innerText = "";
    }

    // denied.innerText = "Denied!";
    names.classList.remove("error-border");
    email.classList.remove("error-border");
    object.classList.remove("error-border");
    message.classList.remove("error-border");
    // denied.classList.remove("denied");
}

// kontrola ci je email v spravnom tvare
function emailIsValid(email) {
    // validacia emailu, aby obsahovala tieto znaky
    let testing = /\S+@\S+\.\S+/;
    return testing.test(email);
}


// ===== NAVBAR ACTIVE / AKTUALNA SEKCIA =====

window.onload = function () {
    var anchors = document.querySelectorAll('li a');

    for (var i = 0; i < anchors.length; i++) {
        anchors[i].addEventListener('click', function () {
            for (var j = 0; j < anchors.length; j++) {
                anchors[j].classList.remove('active');
            }
            this.classList.add('active');
        })
    }
}

// ===== TOGGLE ACTIVE =====

let menuToggle = document.querySelector(".nav-toggle");
menuToggle.onclick = function () {
    menuToggle.classList.toggle("active");
}

// ===== KED CHCEM ZABLOKOVAT ODOSLANIE FORMULARA =====

let submit = document.querySelector(".formSubmit");

submit.addEventListener('click', function (event) {
    event.preventDefault();
});

// ===== CURRENTLY YEAR =====
let year = new Date().getFullYear();
let date = `Copyright &copy; Patrik Lovás. Všetky práva vyhradené ${year}`;

document.getElementsByClassName('date')[0].innerHTML = date;
