// Imageslide

// odchytim element z html
const slides = document.querySelectorAll(".slide");
//console.log(slides)

// funkcia
slides.forEach(function(oneslide){
    oneslide.addEventListener("click", function(){
        deleteActiveClass()                               // funkciu som vytvoril nizsie
        oneslide.classList.add("active");
    });
});

function deleteActiveClass(){                          // odobere klasu active
    slides.forEach(function(myslide){
        myslide.classList.remove("active");
    });
};


// Password page - just have fun
let password = "sklad"; // because ANYONE CAN SEE THIS IN VIEW SOURCE!


// Repeatedly prompt for user password until success:
(function promptPass() {

  let psw = prompt("Napíš hesielko mojko.");

  while (psw !== password) {
    alert("Nie, to nebude ono.");
    return promptPass();
  }

}());


alert('Fajnovo, Servus.');

// ===== CURRENTLY YEAR =====
let year = new Date().getFullYear();
let date = `Copyright &copy; Patrik Lovás. Všetky práva vyhradené ${year}`;

document.getElementsByClassName('date')[0].innerHTML = date;



