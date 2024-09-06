const home = document.getElementById("home");
const calendrier = document.getElementById("calendrier");
const chat = document.getElementById("chat");
const profil = document.getElementById("profil");
const buttonList = [home, calendrier, chat, profil];
var path = "/pfr/profile.php";

function setInactive(nom) {
    //let p = new Promise
    //Change();
    const elem = document.getElementById(nom) ;
    buttonList.forEach((b)=>b.classList.remove("active"));
    buttonList.forEach((b)=>b.classList.add("inactive"));
    elem.classList.remove("inactive") ;
    elem.classList.add("active") ;
    //window.location.href = path;
    
}

function Change() {
    window.location.href = path;
}