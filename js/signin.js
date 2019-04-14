const registerbtn = document.getElementById('registerbtn');
const homebtn = document.getElementById('homebtn');
const signinbtn = document.getElementById('signinbtn');


registerbtn.addEventListener("click",function(){
  window.location.replace("register.php");
});

homebtn.addEventListener("click",function(){
  window.location.replace("index.php");
});

signinbtn.addEventListener('click',function(event){

  let email = document.getElementById('email');
  let password = document.getElementById('password');
  let span = document.getElementById('warningspan');

  let xhr = new  XMLHttpRequest();
  let param = "q=signin&email="+email.value+"&password="+password.value;

  
  xhr.open("POST","pageserver.php",true);
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send(param);

  xhr.onload = function(){

    if(this.status ==200){
      
      response = this.responseText;

      if(response.trim()==="invalid"){
        span.textContent = "Invalid email or password!";
        email.style.borderColor = "red";
        password.style.borderColor = "red";
        email.focus();
      }
      else if(response.trim()==="valid"){
        window.location.replace("home.php");
      }
      
    }
  }

  event.preventDefault();
  
});
