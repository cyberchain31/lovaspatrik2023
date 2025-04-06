// ===== ROLOVANIE NAVBARU =====

// vysunutie a zasunutie listy
const navToggle = document.querySelector(".nav-toggle");

navToggle.addEventListener("click", () => {
    document.querySelector(".aside-container").classList.toggle("open");
    document.querySelector(".nav-toggle").classList.toggle("none");
})

// odchytenie celeho okna stranky
// skrytie navbaru po skrolnuti - contains, ak obsahuje otvorenie tak...
window.addEventListener("scroll", () => {
    if (document.querySelector(".aside-container").classList.contains("open")) {
        document.querySelector(".aside-container").classList.remove("open");
        // document.querySelector(".nav-toggle").classList.remove("none");
        document.querySelector(".nav-toggle").classList.toggle("discover");
        
    }
})

