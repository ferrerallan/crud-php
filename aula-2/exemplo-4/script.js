function changeTitle() {
  document.getElementById("titulo").innerHTML = 
    new Date().toLocaleTimeString();
}

setInterval(()=>{
  changeTitle()
},1000 )