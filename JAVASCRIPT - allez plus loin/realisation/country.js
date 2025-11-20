let countryID=sessionStorage.getItem("countryID");
let container = document.getElementById("container");

fetch("https://countries-api-hsak.onrender.com/api/countries/"+countryID)
.then(Response=>Response.json())
.then(data=>{
    let cart = document.createElement("div");
    cart.className = 'cart';
    cart.innerHTML = `
       
        <h3 class="name">${data.name}</h3>
        <img src="${data.flag}" alt="${data.name}">
        <p class="capitale">${data.capital}</p>
        <p class="language">${data.language}</p>
        <p class="continent">${data.continent}</p>
        <p class="population">Population :${data.population}</p>
        <p class="area">Area   :${data.area} m<sup>2</sup></p>
        <p class="currency">${data.currency}</p>
        <p class="timezone">${data.timezone}</p>


    `;
    container.appendChild(cart);


})

