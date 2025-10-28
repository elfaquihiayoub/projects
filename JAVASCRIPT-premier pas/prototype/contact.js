import { bibliotheque } from "./script.js";
  //  ----------------adding new book---------------
  let addingNewBook =function(bibliotheque){
    let addingName=document.getElementById("nameOfAddingBook").value;
    let addingAuteur=document.getElementById("auteurOfAddingBook").value;
    let addingPublish=Number(document.getElementById("publishOfAddingBook").value)
    let addingCode= Number(document.getElementById("codeOfAddingBook").value)
    let addingDisponible=Boolean(document.getElementById("disponibleOfAddingBook").value)
    let addingPrix=document.getElementById("prixOfAddingBook").value;
    let founded=false

    for (let i = 0; i < bibliotheque.length; i++) {
        if(addingCode==bibliotheque[i].code){
            founded=true
            break
        }
        }
        if(founded){
            alert('the book is already added')
           
        }
        
        else{
            let addedBook={code:addingCode,   titre:addingName   ,auteur:addingAuteur, anne: addingPublish ,disponible: addingDisponible, prix: addingPrix, cover :"assets/Bread Overhead.webp" }
            bibliotheque.splice(bibliotheque.length,0,addedBook)
            alert('the book added succesfully')
            

        }
        
    }
   

  
  let saveButton=document.getElementById("addNewBookButton")
  if(saveButton){

    saveButton.addEventListener("click",function(event){
        event.preventDefault();
        addingNewBook(bibliotheque)
        console.log(bibliotheque)
    
      })
  }