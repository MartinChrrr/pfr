const pswrdField = document.querySelector("form .field input[type='password']");
const showIcon = document.querySelector("form .field .icon-password");

const showOnID = document.getElementById("chevronOnHoraire");
const showOffID = document.getElementById("chevronOffHoraire");
const listHoraire =  document.getElementById("liste_horaire");


function showOffHoraire() {
  showOnID.style.display = "none";
  listHoraire.style.display = "none";
  showOffID.style.display = "";
}

function showOnHoraire() {
  showOnID.style.display = "";
  listHoraire.style.display = "";
  showOffID.style.display = "none";
}



function showPswrd(){
  if(pswrdField.type === "password"){
      pswrdField.type = "text";
      
    }else{
      pswrdField.type = "password";
      
    }
}

showOnHoraire();