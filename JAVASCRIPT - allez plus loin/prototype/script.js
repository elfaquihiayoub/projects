let container= document.getElementById("container");


fetch("https://countries-api-hsak.onrender.com/api/countries")
.then(Response=>Response.json())
.then(data=>{
    data.forEach(p => {
        let cart=document.createElement("div")
        cart.className='cart'
        cart.innerHTML=`
        <img src="${p.flag}" alt="${p.name}">
        <h3 class="name">${p.name}</h3>
        <p class="capitale"> ${p.capital} </p>
        <p class="language"> ${p.language} </p>
        <p class="continent"> ${p.continent} </p>

        `
        container.appendChild(cart)
        
    });

})  

rendringInfos();
let option=document.querySelectorAll("option");

let continent=function(data){
    
    

}







