const signInbtn = document.getElementById('signInbtn');
const registerbtn = document.getElementById('registerbtn');

signInbtn.addEventListener('click',function(){

  window.location.replace("signIn.php");

});

registerbtn.addEventListener("click",function(){
  window.location.replace("register.php");
});


function load_posts(){

  let xhr = new XMLHttpRequest();
  let param = "q=loadposts";
  let postdiv = document.getElementById('postdiv');

  xhr.open("POST","pageserver.php",true);
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send(param);
  
  xhr.onload = function (){

    if(this.status==200){

      postdiv.innerHTML = this.responseText;

    }

  }

}

load_posts();
