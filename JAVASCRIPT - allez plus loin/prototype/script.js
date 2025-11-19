
let container = document.getElementById("container");
let select = document.querySelector("select");
let selectedContinent = []; 

//loading data for the the first use


fetch("https://countries-api-hsak.onrender.com/api/countries")
.then(Response => Response.json())
.then(data => {
    selectedContinent = data;  
    rendringCart(selectedContinent);
});



//rendring the cards by the data in our array
function rendringCart(data) {

    container.innerHTML = ""; 
    data.forEach(p => {
        let cart = document.createElement("div");
        cart.className = 'cart';
        cart.innerHTML = `
            <img src="${p.flag}" alt="${p.name}">
            <h3 class="name">${p.name}</h3>
            <p class="capitale">${p.capital}</p>
            <p class="language">${p.language}</p>
            <p class="continent">${p.continent}</p>
        `;
        container.appendChild(cart);
    });
}


// showing condition///////////////////////////////////////////////



select.addEventListener("change", function () {
    let Selectvalue = select.value;

    if (Selectvalue === "continent") {
        rendringCart(selectedContinent); 
    } else {
        let filtered = selectedContinent.filter(
            country => country.continent === Selectvalue
        );
        rendringCart(filtered);
    }
});










