export let bibliotheque =[
{code:1,titre:"A Voyage to Arcturus"   ,auteur:"David Lindsay", anne: 2010 ,disponible: true , prix: 190 ,cover :"assets/Voyage to ArcturusA.webp"},

{code:2,titre:"A Bundle Of Letters"   ,auteur:"Henry James", anne: 2010 ,disponible: true , prix: 150 ,cover :"assets/Bundle Of Letters.webp"  },

{code:3,titre:"A Voice In The Wilderness"   ,auteur:"E. W. Hornung", anne: 2010 ,disponible: true , prix: 160 ,cover :"assets/Voice In The Wilderness.webp" },

{code:4,titre:"A Thin Ghost and Others"   ,auteur:"Montague Rhodes James ", anne: 2008,disponible: true , prix: 200 ,cover :"assets/Thin Ghost and Others.webp" },

{code:5,titre:"Bread Overhead"   ,auteur:"Fritz Leiber", anne: 2011 ,disponible: true , prix: 150, cover :"assets/Bread Overhead.webp" },

{code:6,titre:"The Beginning After The End"   ,auteur:"	TurtleMe", anne: 2018 ,disponible: true , prix: 500 , cover:"assets/The Beginning After The End.webp" },

{code:7,titre:"Shadow slave"   ,auteur:"Guiltythree", anne: 2022 ,disponible: false , prix: 300 , cover:"assets/Shadow slave.webp" },

{code:8,titre:"Lord of Mysteries"   ,auteur:"	Cuttlefish That Loves Diving", anne: 2018 ,disponible: true , prix: 400 ,cover:"assets/Lord of Mysteries.webp" },

{code:9,titre:"Sword Art Online"   ,auteur:"Reki Kawahara", anne: 2015 ,disponible: true , prix: 250 ,cover:"assets/Sword Art Online.webp" },

{code:10,titre:"Re:Zero - Starting Life in Another World"   ,auteur:"Tappei Nagatsuki", anne: 2020 ,disponible: false , prix: 500,cover:"assets/Re-Zero.webp" },

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



//adding new book


//start of searching a book
let searchbar=document.getElementById("searching") ;
let searchingBook=function(bibliotheque){
 let searchValue=searchbar.value.trim().toLowerCase()
 
 for( let i=0; i < bibliotheque.length; i++){
    let titlebook=bibliotheque[i].titre.trim().toLowerCase()
  
    if (titlebook.includes(searchValue)) {
      
        let changeField=document.getElementById("section"+(i+1))
     
        changeField.classList.add("book-found")
     
        
       
      
        
    }
    
  
   
       
}}

if(searchbar){
    searchbar.addEventListener("change",function(){
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
    AddingBookCover(bibliotheque);
    Addingtitle(bibliotheque);
    AdingNumberOfBooks();
    afficherLesLIvre();
    NumberBook()
   


  };
   // adding the books covers
   let AddingBookCover=function(bibliotheque){
    for (let i = 0; i < bibliotheque.length; i++) {
        let bookCover=document.querySelector(".photo"+[i+1])
        if(bookCover){
        bookCover.innerHTML = `
        <img src="${bibliotheque[i].cover}" alt="${bibliotheque[i].titre}" class="book-cover">
       
      `
    }
        
    }

  }


  // the end of adding books functions
  function DeleteBook(event) {
  let sectionToRemove = event.target.closest(".section-books");
  if (sectionToRemove) {
    sectionToRemove.remove();
  }
}

let Addingtitle = function(bibliotheque) {
  for (let i = 0; i < bibliotheque.length; i++) {
    let booktiter = document.querySelector(".infos" + [i + 1]);
    if (booktiter) {
      booktiter.innerHTML = `
        <h4>${bibliotheque[i].titre}</h4>
        <button class="delete">supprimer</button>
          
      `;
    }
  }

 
  let deleteBtns = document.querySelectorAll(".delete");
  deleteBtns.forEach(function(btn) {
    btn.addEventListener("click", DeleteBook);
  });
};






