const signInbtn = document.getElementById('signInbtn');
const registerbtn = document.getElementById('registerbtn');

signInbtn.addEventListener('click',function(){

  window.location.replace("signIn.php");

});

registerbtn.addEventListener("click",function(){
  window.location.replace("register.php");
});

