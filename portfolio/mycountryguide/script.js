// let searchBtn = document.getElementById("search-btn");
// let countryInp = document.getElementById("country-inp");

// searchBtn.addEventListener("click", () => {
//   let countryName = countryInp.value;
//   let finalURL = `https://restcountries.com/v3.1/name/${countryName}?fullText=true`;
//   countryInp.value = "";
//   console.log(finalURL);

//   fetch(finalURL)
//     .then((response) => response.json())
//     .then((data) => {
//       // console.log(data[0]);
//       // console.log(data[0].capital[0]);
//       // console.log(data[0].region);
//       // console.log(data[0].population);
//       // console.log(data[0].flags.svg);
//       // console.log(data[0].name.common);
//       // console.log(data[0].borders);
//       // console.log(data[0].subregion);
//       // console.log(Object.keys(data[0].currencies)[0]);
//       // console.log(data[0].currencies[Object.keys(data[0].currencies)].name);
//       // console.log(data[0].currencies[Object.keys(data[0].currencies)].symbol);
//       // console.log(Object.values(data[0].languages).join(","));
//       result.innerHTML = `<img src="${
//         data[0].flags.svg
//       }" class="flag-img"><h2>${data[0].name.common}</h2>
//       <div class="wrapper">
//         <div class="data-wrapper">
//           <h4>Capital:</h4>
//           <span>${data[0].capital[0]}</span>
//         </div>
//       </div>
//       <div class="wrapper">
//         <div class="data-wrapper">
//           <h4>Region:</h4>
//           <span>${data[0].region}</span>
//         </div>
//       </div>
//       <div class="wrapper">
//         <div class="data-wrapper">
//           <h4>Population:</h4>
//           <span>${data[0].population.toLocaleString({
//             minimumFractionDigits: 3,
//             maximumFractionDigits: 3,
//             useGrouping: false, // Zakáže oddelenie tisícov
//           })}</span>
//         </div>
//       </div>
//       <div class="wrapper">
//         <div class="data-wrapper">
//           <h4>Currency:</h4>
//           <span>${data[0].currencies[Object.keys(data[0].currencies)].name} - ${
//         Object.keys(data[0].currencies)[0]
//       } - ${data[0].currencies[Object.keys(data[0].currencies)].symbol}</span>
//         </div>
//       </div>
//       <div class="wrapper">
//         <div class="data-wrapper">
//           <h4>Languages:</h4>
//           <span>${Object.values(data[0].languages).join(", ")}</span>
//         </div>
//       </div>
//       `;
//     })
//     .catch(() => {
//       if (countryName.length == 0) {
//         result.innerHTML = `<h1>The input field cannot be empty..</h1>`;
//       } else {
//         result.innerHTML = `<h1>Please enter a valid country..</h1>`;
//       }
//     });
// });

let searchBtn = document.getElementById("search-btn");
let countryInp = document.getElementById("country-inp");

function searchCountry() {
  let countryName = countryInp.value;
  let finalURL = `https://restcountries.com/v3.1/name/${countryName}?fullText=true`;
  countryInp.value = ""; // Vymazanie poľa po stlačení Enter alebo kliknutí
  console.log(finalURL);

  fetch(finalURL)
    .then((response) => response.json())
    .then((data) => {
      console.log(data[0]);
      result.innerHTML = `<img src="${
        data[0].flags.svg
      }" class="flag-img"><h2>${data[0].name.common}</h2>
      <div class="wrapper">
        <div class="data-wrapper">
          <h4>Capital:</h4>
          <span>${data[0].capital[0]}</span>
        </div>
      </div>
      <div class="wrapper">
        <div class="data-wrapper">
          <h4>Region:</h4>
          <span>${data[0].region}</span>
        </div>
      </div>
      <div class="wrapper">
        <div class="data-wrapper">
          <h4>Population:</h4>
          <span>${data[0].population.toLocaleString()}</span>
        </div>
      </div>
      <div class="wrapper">
        <div class="data-wrapper">
          <h4>Currency:</h4>
          <span>${data[0].currencies[Object.keys(data[0].currencies)].name} - ${
        Object.keys(data[0].currencies)[0]
      } - ${data[0].currencies[Object.keys(data[0].currencies)].symbol}</span>
        </div>
      </div>
      <div class="wrapper">
        <div class="data-wrapper">
          <h4>Languages:</h4>
          <span>${Object.values(data[0].languages).join(", ")}</span>
        </div>
      </div>
      <div class="wrapper">
        <div class="data-wrapper">
          <h4>Borders:</h4>
          <span>${data[0].borders.join(", ")}</span>
        </div>
      </div>
      `;
    })
    .catch(() => {
      if (countryName.length == 0) {
        result.innerHTML = `<h1>The input field cannot be empty..</h1>`;
      } else {
        result.innerHTML = `<h1>Please enter a valid country..</h1>`;
      }
    });
}

// Event listener pre kliknutie na tlačidlo
searchBtn.addEventListener("click", searchCountry);

// Event listener pre stlačenie Enter v input poli
countryInp.addEventListener("keydown", (event) => {
  if (event.key === "Enter") {
    searchCountry();
  }
});
