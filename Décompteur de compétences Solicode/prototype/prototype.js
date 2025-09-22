function OccurenceNum() {
    let list=["c1","c2","c1","c3","c4","c4","c1","c3","c1"];

    let nameC=prompt("enter the c :");
    let counter=0;
    for (let i = 0; i < list.length; i++) {
        if (nameC==list[i]) {
            counter++
      
        
    }
    }
    console.log("    the number of     "+nameC+" is "+ counter)
}
OccurenceNum();
