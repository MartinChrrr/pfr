const home = document.getElementById("home");
const calendrier = document.getElementById("calendrier");
const chat = document.getElementById("chat");
const profil = document.getElementById("profil");
const buttonList = [home, calendrier, chat, profile];
var path = (window.location.href.slice(0, -4)).split("/");
var id = document.getElementById(path[path.length - 1]);




function setInactive(nom) {

    const elem = document.getElementById(nom) ;
    buttonList.forEach((b)=>b.classList.remove("active"));
    buttonList.forEach((b)=>b.classList.add("inactive"));
    elem.classList.remove("inactive") ;
    elem.classList.add("active") ;
    
    
}

function GetPath() {
    buttonList.forEach((b)=>b.classList.remove("active"));
    
    id.classList.add("active") ;

}

GetPath();