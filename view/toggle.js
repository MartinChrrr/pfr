const pswrdField = document.querySelector("form .field input[type='password']");
const showIcon = document.querySelector("form .field .icon-password");



function showPswrd(){
  if(pswrdField.type === "password"){
      pswrdField.type = "text";
      
    }else{
      pswrdField.type = "password";
      
    }
}