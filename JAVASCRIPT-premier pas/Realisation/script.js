export let bibliotheque =[
{code:1,titre:"A Voyage to Arcturus"   ,auteur:"David Lindsay", anne: 2010 ,disponible: true , prix: 190 ,cover :"assets/Voyage to ArcturusA.webp"},

{code:2,titre:"A Bundle Of Letters"   ,auteur:"Henry James", anne: 2010 ,disponible: true , prix: 150 ,cover :"assets/Bundle Of Letters.webp"  },

{code:3,titre:"A Voice In The Wilderness"   ,auteur:"E. W. Hornung", anne: 2010 ,disponible: true , prix: 160 ,cover :"assets/Voice In The Wilderness.webp" },

{code:4,titre:"A Thin Ghost and Others"   ,auteur:"Montague Rhodes James ", anne: 2008,disponible: true , prix: 200 ,cover :"assets/Thin Ghost and Others.webp" },

{code:5,titre:"Bread Overhead"   ,auteur:"Fritz Leiber", anne: 2011 ,disponible: true , prix: 150, cover :"assets/Bread Overhead.webp" },

{code:6,titre:"The Beginning After The End"   ,auteur:"	TurtleMe", anne: 2018 ,disponible: true , prix: 500 , cover:"assets/The Beginning After The End.webp" },

{code:7,titre:"Shadow slave"   ,auteur:"Guiltythree", anne: 2022 ,disponible: false , prix: 600 , cover:"assets/Shadow slave.webp" },

{code:8,titre:"Lord of Mysteries"   ,auteur:"	Cuttlefish That Loves Diving", anne: 2018 ,disponible: true , prix: 300 ,cover:"assets/Lord of Mysteries.webp" },

{code:9,titre:"Sword Art Online"   ,auteur:"Reki Kawahara", anne: 2015 ,disponible: true , prix: 250 ,cover:"assets/Sword Art Online.webp" },

{code:10,titre:"Re:Zero "   ,auteur:"Tappei Nagatsuki", anne: 2020 ,disponible: false , prix: 400,cover:"assets/Re-Zero.webp" },

];

// display function(afficher les livres)
let afficherLesLIvre=function(){
console.log( "les livres disponibles sont :");
bibliotheque.forEach(function(livre){
  
    if (livre.disponible==true) {
        console.log( livre.titre);
    }
       
})}

// end of display function  


// afficher un livre avec ce code
let inputeCodeAffich=document.getElementById("codeAfficheNUmber")
let afficherUnLivre=function(inputeCodeAffich){
    let indexToAfficher=-1;
    for (let i = 0; i < bibliotheque.length; i++) {
       
        if (bibliotheque[i].code==inputeCodeAffich) {
            indexToAfficher=i;
            break;
            
        }

     


    }

    if(indexToAfficher!=-1) {
        return bibliotheque[indexToAfficher];

       }
       else{
        return "ce code nest pas existe !!"
       }


}



// ending of AFFICHER UN LIVRE function



//adding books dynamicly

function renderBooks() {
    const container = document.getElementById("bookContainer");
  
  
    bibliotheque.forEach((book) => {
        const section = document.createElement("section");
        section.classList.add("section-books");
  
        section.innerHTML = `
            <div class="photo"><img src="${book.cover}" alt="${book.titre}" class="book-cover"></div>
            <div class="infos">
                <h4>${book.titre}</h4>
              
                ${book.disponible ? `<button class="toReserver">Reserver!</button>` : `<div class="reserved">reserved</div>`}
                <button class="delete">supprimer</button>
            </div>
        `;
  
        // Delete functionality
        section.querySelector(".delete").addEventListener("click", () => {
            section.remove();
            bibliotheque.splice(book,1)
        });
  
        container.appendChild(section);
    });
  }
////-------------------------reserved book-------------------------------------

function reservedBook() {
  let buttonReserver = document.querySelectorAll(".toReserver");

  for (let i = 0; i < buttonReserver.length; i++) {

    buttonReserver[i].addEventListener("click", function () {

      if (bibliotheque[i].disponible === true) {
///change the status from true to false - change text btn and - 
        bibliotheque[i].disponible = false;
        buttonReserver[i].textContent = "reserved";
        buttonReserver[i].style.backgroundColor = "gray";
/// create the reserved card and added it to 
        let card = this.closest(".section-books");
        let photo = card.querySelector(".photo");
        let label = document.createElement("div");
        label.classList.add("reserved");
        label.textContent = "Reserved";
        photo.appendChild(label);
      }
     
    });
  }
}
  

//start of searching a book
let searchbar=document.getElementById("searching") ;
let searchingBook=function(bibliotheque){
 let searchValue=searchbar.value.trim().toLowerCase()
 let changeField=document.querySelectorAll(".section-books")
 changeField.forEach((card,i) => {
    let titlebook=bibliotheque[i].titre.trim().toLowerCase()
   
    if(titlebook.includes(searchValue)){
        card.style.display = "block";
    }else{
        card.style.display = "none";
    }
})};
 
if(searchbar){
    searchbar.addEventListener("inout",function(){
        searchingBook(bibliotheque)
        })
        
}



 
 // start of full number of book
 let NumberBook=function(){
    let counter=0
    for (let i of bibliotheque) {
        counter++
        
    }
    return counter
 }
     // ---------it just left the recall at html file-----------


 // end of numberBook function

// start of numberdisponible des book
let numberBookDisponible=function(){
    let counterDispo=0
    for (let i of bibliotheque) {
        if (i.disponible==true) {
            counterDispo++
            
        }
        
    }
    return counterDispo
}



  //--------------it just left the recall at html file-----------

  let AdingNumberOfBooks=function(){
    let addingNUmberSection=document.getElementById("numberOfBooks")
    if(addingNUmberSection){
        addingNUmberSection.innerHTML=`${numberBookDisponible()}   /  ${NumberBook(bibliotheque)}`
  
    }
    
 
  }


 




  window.onload = function() {
  
  
    AdingNumberOfBooks();
    afficherLesLIvre();

    expensiveBook(bibliotheque);
    renderBooks();
    reservedBook();
    localStorage.clear()
    localStorage.setItem("bibliotheque",JSON.stringify(bibliotheque))
     let newBIB=JSON.parse(localStorage.getItem("bibliotheque"))
     bibliotheque=newBIB
     console.log(bibliotheque)
     

  
   
    
   


  };



///------------ realisation functions------------////////////


///--------------1 afficher le book le plus chaire----------------


let expensiveBook=function(bibliotheque){
  let expensiveBookcart=document.querySelector(".container2")
  let max=0;
  let index=0
  for (let i = 0; i < bibliotheque.length; i++) {
    if(bibliotheque[i].prix>max){
      max=bibliotheque[i].prix
      index=i
    }   
  
  }
  if(expensiveBookcart){
    expensiveBookcart.innerHTML = `

    <h3>${bibliotheque[index].titre}<span>
    ${bibliotheque[index].auteur}</span>
    <span class="span-prix">
    PRIX: ${bibliotheque[index].prix}</span>
    </h3>
   
    <img src="${bibliotheque[index].cover}" alt="${bibliotheque[index].titre}" class="book-cover-cart">
    
      
  `;
  }

 

}

///////----- 2 -- reserverBook function---------------=/////////////













