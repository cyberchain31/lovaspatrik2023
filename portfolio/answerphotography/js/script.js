// navbar-title
const texts = ['Nature', 'Night', 'Sunshine','Animals', 'Car',];
let count = 0;
let index = 0;
let currentText = '';
let letter = '';

(function type(){

    if(count === texts.length) {
        count = 0;
    }
    currentText = texts[count];
    letter = currentText.slice(0, ++index);
    
    document.querySelector('.typing').textContent = letter;
    if(letter.length === currentText.length) {
        count++;
        index = 0;
    }

    setTimeout(type, 400);     

}());


// screen-title
const text = document.querySelector(".screenTitle");

// vytiahnem cisto text
const stringText = text.textContent;

// vytiahme vsetky pismena
const splitText = stringText.split("");


text.textContent = "";

// vytvorim cyklus
for (let i = 0; i < splitText.length; i++) {
    text.innerHTML += "<span>" + splitText[i] + "</span>";
}

let char = 0;
let timer = setInterval(onTick, 200);

// funkcia
function onTick() {
   const span = text.querySelectorAll('span')[char];
   span.classList.add('fade');
   char++
   if(char === splitText.length) {
       complete();
       return;
   }
}

function complete() {
    clearInterval(timer);
    timer = null;
}

// ===== CURRENTLY YEAR =====
let year = new Date().getFullYear();
let date = `Copyright &copy; Patrik Lovás. Všetky práva vyhradené ${year}`;

document.getElementsByClassName('date')[0].innerHTML = date;