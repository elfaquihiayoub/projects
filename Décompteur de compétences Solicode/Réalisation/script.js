function occuranceTest() {

let competence=["Réaliser une interface utilisateur web statique et adaptable	","Développer la partie back-end d’une application web ou web mobile - niveau 1","	Réaliser une interface utilisateur avec une solution de gestion de contenu ou e-commerce","Créer une base de données - niveau 1",   "Maquetter une application	","Développer les composants d’accès aux données - niveau 1","	Développer une interface utilisateur web dynamique","Framwork FrontEnd (React, vueJs...)"];
let occurence=["c2","c7","c4","c5","c1","c6","c3","c8"];
let trueC=0;
let falseC=0;
for (let i = 0; i < competence.length; i++) {
    let input=prompt("whats the name of this competence? "+competence[i])
    if (input==occurence[i].toLowerCase()) {  
        trueC++;
        console.log("the answer is true  ✅")
        
    }else
    {
        falseC++
        console.log("the answer is false ❌ ")}
        if (falseC==3) {
            console.log("you need to revise your courses again⚠️⚠️⚠️")
            break
            
        }else if (trueC==8) {
            console.log("whats a legend 🤯🤯")
        }
    
    
}
console.log('THE INFOS FOR UR TEST IS '+ trueC+" TRUE EST "+falseC+" FALSE")
    
}
occuranceTest();







