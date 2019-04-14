let regiform = document.getElementById('registerform');
let count = 0 ;
const defcolor = "#6C757C";
//button list
const homebtn = document.getElementById('homebtn');
const siginbtn = document.getElementById('signinbtn');
const registerbtn = document.getElementById('registerbtn');
//div variable list
let registerdiv = document.getElementById('registerdiv');
//span variable list


function age_cal(dateinput){

  let today  = new Date();
  let birtdate = new Date(dateinput);
  let age = today.getFullYear() - birtdate.getFullYear();
  let  month = today.getMonth() - birtdate.getMonth();

  if (month < 0 || ( month === 0 && today.getDate() < birtdate.getDate())) {
     age--;
  }

  return age;
}


homebtn.addEventListener("click",function(){
  window.location.replace("index.php");
});

signinbtn.addEventListener("click",function(){
  window.location.replace("signIn.php");
});


function check_email(){

  let emailspan = document.getElementById('emailspan');
  let email = regiform.elements['email'];

  let xhr = new  XMLHttpRequest();
  let param = "q=checkemail&email="+email.value;

  xhr.open("POST","pageserver.php",true);
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send(param);

  xhr.onload = function(){

    if(this.status ==200){ 

      if(xhr.responseText.trim()=="true"){
        emailspan.textContent = "This email is already registered!!";
        email.style.borderColor = "red";
        email.focus;
        event.preventDefault();
      }
      else{
        emailspan.textContent = "";
        email.style.borderColor = "grey";
      }

    }
  }

}


regiform.addEventListener('submit',function(event){

  let password = regiform.elements['password'];
  let repassword = regiform.elements['repassword'];
  let dob = regiform.elements['dob'];


  let passpan  = document.getElementById('passwordspan');
  let repasspan = document.getElementById('repasswordspan');
  let agespan = document.getElementById('agespan');
  

  let password_text = password.value;
  let repassword_text = repassword.value;
  let age = age_cal(dob.value);


  if(password_text.length>=6){
    passpan.textContent = "";
    password.style.borderColor = defcolor;
  }
  

  if(password_text===repassword_text){
    repasspan.textContent = "";
    repassword.style.borderColor = defcolor;
  }


  if(age>=18){
    agespan.textContent = "";
    dob.style.borderColor = defcolor;
  }

  
  if(password_text.length<6){
    passpan.textContent = "Password is too short!!";
    password.style.borderColor = "red";
    password.focus();
    event.preventDefault(); 
  }

  if(password_text!=repassword_text){
    repasspan.textContent = "Passwords doesn't match!!";
    repassword.style.borderColor = "red";
    repassword.focus();
    event.preventDefault(); 
  }

  if(age<18 || age>130){
    agespan.textContent = "Invalid Age!!"
    dob.focus();
    dob.style.borderColor = "red";
    event.preventDefault(); 
  }

  check_email();

 
  //event.preventDefault();

});
