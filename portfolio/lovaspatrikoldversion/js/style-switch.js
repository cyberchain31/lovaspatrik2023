/* ===== STYL PREPINACA NA PRAVEJ STRANE ===== */

// vysunutie a zasunutie listy
const styleSwitchToggle = document.querySelector(".style-switch-toggle");

styleSwitchToggle.addEventListener("click", () => {
    document.querySelector(".style-switch").classList.toggle("open");
})

// odchytenie celeho okna stranky
// skrytie listy po skrolnuti - contains, ak obsahuje otvorenie tak...
window.addEventListener("scroll", () => {
    if (document.querySelector(".style-switch").classList.contains("open")) {
        document.querySelector(".style-switch").classList.remove("open");
    }
})

/* ===== PREPINAC - FARBY TEMY ===== */

// odchytenie farby z html link
const alternateStyle = document.querySelectorAll(".alternate-style");

function setActiveStyle(color) {
    alternateStyle.forEach((style) => {
        // vitiahnutie atributu z html link
        if (color === style.getAttribute("title")) {
            //   vymaz atribut deaktivovany
            style.removeAttribute("disabled");
        } else {
            //   nastav atribut aktivovany
            style.setAttribute("disabled", "true");
        }
    })
}

/* ===== PREPINAC - POZADIA TEMY light/dark ===== */

const dayNight = document.querySelector(".day-night");

dayNight.addEventListener("click", () => {
    dayNight.querySelector("i").classList.toggle("bi-brightness-high-fill");
    dayNight.querySelector("i").classList.toggle("bi-moon-fill");
    // v html vytvori class="dark"
    document.body.classList.toggle("dark");
})

// odchytenie celeho okna stranky po nacitani
window.addEventListener("load", () => {
    // document.querySelector(".style-switch").classList.toggle("open");
    // zmena ikony temy
    if (document.body.classList.contains("dark")) {
        dayNight.querySelector("i").classList.add("bi-brightness-high-fill");
    } else {
        dayNight.querySelector("i").classList.add("bi-moon-fill");
    }
})



