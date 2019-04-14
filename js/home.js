const writenewpostdiv = document.getElementById('writenewpostdiv');
const homepostdiv = document.getElementById('homepostdiv');

const newpostbtn = document.getElementById('newpostbtn');
const cancelpostbtn = document.getElementById('cancelpostbtn');
const signoutbtn = document.getElementById('signoutbtn');
const profilebtn = document.getElementById('profilebtn');

signoutbtn.addEventListener('click',function(){
  
  let xhr = new  XMLHttpRequest();
  let param = "q=signout";

  xhr.open("POST","home.php",true);
  xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  xhr.send(param);

  xhr.onload = function(){
    if(this.status ==200){
      window.location.replace("index.php");
    }
  }


});

profilebtn.addEventListener('click',function(){

    window.location.replace('profile.php');

});

newpostbtn.addEventListener("click",function(){

  if(writenewpostdiv.style.display=="none"){
    writenewpostdiv.style.display = "block";
    homepostdiv.style.display = "none";
  }

});

cancelpostbtn.addEventListener("click",function(){
    writenewpostdiv.style.display = "none";
    homepostdiv.style.display = "block";
});
