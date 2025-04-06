// ===== CURRENTLY YEAR =====
let year = new Date().getFullYear();
let date = `Copyright &copy; Patrik Lovás. Všetky práva vyhradené ${year}`;

document.getElementsByClassName('date')[0].innerHTML = date;