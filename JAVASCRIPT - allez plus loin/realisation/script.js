
let container = document.getElementById("container");
let select = document.querySelector("select");
let selectedContinent = []; 
let countcountry = [];
let searchCount=document.getElementById("population");
let head=document.getElementById("head");

let africaCount=0
let SouthAmericaCount=0
let EuropeCount=0
let AsiaCount=0
let OceaniaCount=0
let NorthAmericaCount=0



///////////////////                  loading data for the the first use                   /////////////////////////////////////


fetch("https://countries-api-hsak.onrender.com/api/countries")
.then(Response => Response.json())
.then(data => {
    selectedContinent = data;  
    countcountry= data
    rendringCart(selectedContinent);
    countriesCount()
});



//                   rendring the cards by the data in our array                    ////////////////////////
function rendringCart(data) {


let africatemp=0
let SouthAmericatemp=0
let Europetemp=0
let Asiatemp=0
let Oceaniatemp=0
let NorthAmericatemp=0

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
        //-----------switch statment to count number of pays by continent
       switch (p.continent) {
        case "Africa":
            africatemp++
            africaCount=africatemp
            
            break;
        case "Europe":
            Europetemp++
            EuropeCount=Europetemp

            
            break;
        case "Asia":
            Asiatemp++
            AsiaCount=Asiatemp
    
                
            break;
        case "North America":
            NorthAmericatemp++
            NorthAmericaCount=NorthAmericatemp

            
            break;
        case "Oceania":
            Oceaniatemp++
            OceaniaCount=Oceaniatemp

            
            break;
        case "South America":
            SouthAmericatemp++
            SouthAmericaCount=SouthAmericatemp

            
            break;

       
       }
      
        container.appendChild(cart);

        cart.addEventListener("click",function(){
            let number=p.id;

            sessionStorage.setItem("countryID", number);

            window.location.href = "country-details.html";

            
        })
    });
}


//                        showing condition              ///////////////////////////////////////////////



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


////////////              ssearching                   ////////////////////////
let searchbar=document.getElementById("search") ;
let searchingcountries=function(){

 let searchValue=searchbar.value.trim().toLowerCase()
 let allCarts=document.querySelectorAll(".cart")
    for (let i = 0; i < allCarts.length; i++) {
        let cart=allCarts[i];
        let title=cart.querySelector("h3").textContent.toLowerCase();

        if(title.includes(searchValue)){
            cart.style.display = "block";
        }else{
            cart.style.display = "none";
        }
    };
        
    }
   
   
  
 
if(searchbar){
    searchbar.addEventListener("input",function(){
        searchingcountries()
        })
        
}
///// popilation filter/----------------------///////////--------------------------------




searchCount.addEventListener('input', function() {
    const selectedCount = Number(this.value);

    if (!selectedCount) {
        rendringCart(countcountry);
       
    }

    const filteredCountCountries = countcountry.filter(country => 
        country.population >= selectedCount
    );

    rendringCart(filteredCountCountries);
});

function countriesCount(){

    console.log(africaCount,EuropeCount,SouthAmericaCount,NorthAmericaCount,AsiaCount,OceaniaCount,)
    let numberCart = document.createElement("div");
        // numberCart.className = 'cart';
        numberCart.innerHTML = `
                <ul class="numberContries">
                            <li>Africa : ${africaCount} |</li>
                            <li>South America : ${SouthAmericaCount} |</li>
                            <li>Europe : ${EuropeCount} |</li>
                            <li>Asia : ${AsiaCount} |</li>
                            <li>Oceania : ${OceaniaCount} |</li>
                            <li>North America : ${NorthAmericaCount} |</li>
                </ul>
        `;
        head.appendChild(numberCart)
    

}











