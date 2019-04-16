const writenewpostdiv = document.getElementById('writenewpostdiv');
const homepostdiv = document.getElementById('homepostdiv');

const newpostbtn = document.getElementById('newpostbtn');
const cancelpostbtn = document.getElementById('cancelpostbtn');
const signoutbtn = document.getElementById('signoutbtn');
const profilebtn = document.getElementById('profilebtn');
const submitpostbtn = document.getElementById('submitpostbtn');

let imagefile = document.getElementById('imagefile');

let title = document.getElementById('title');
let body = document.getElementById('body');

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

title.addEventListener('keyup',function(){
  titlespan.textContent = "";
  title.style.borderColor = "grey";
 });

 body.addEventListener('keyup',function(){
  bodyspan.textContent = "";
  body.style.borderColor = "grey";
 });

 
 imagefile.onchange = function(){
  let filespan = document.getElementById('filespan');
  filespan.textContent = "";
 }



submitpostbtn.addEventListener('click',function(event){

  let titlespan = document.getElementById('titlespan');
  let bodyspan = document.getElementById('bodyspan');
  let filespan = document.getElementById('filespan');
  let tmp = "";
  let match = false;

  if(imagefile.value.length>0){

     for(let i = imagefile.value.length-1 ; imagefile.value.charAt(i)!='.'; --i)
      tmp+=imagefile.value.charAt(i);

    let extension="";

    for(let i = tmp.length-1 ; i>=0 ; --i)
      extension+=tmp.charAt(i);

    let allowedlist = ["jpeg","png","jpg","gif"];

    for(let i = 0 ; i<allowedlist.length ; ++i){
       if(allowedlist[i]===extension)
         match = true;
    }
  }


  if(!match && imagefile.value.length>0){
    filespan.textContent = "This file type is not suppported";
    imagefile.focus();
    event.preventDefault();

  }
  

  if(title.value===""){
    titlespan.textContent = "Title cannot be empty!!";
    title.style.borderColor = "red";
    title.focus();
    event.preventDefault();
  }

  if(body.value===""){

    bodyspan.textContent = "Body cannot be empty!!";
    body.style.borderColor = "red";
    body.focus();
    event.preventDefault();
  }

 

});

cancelpostbtn.addEventListener("click",function(){
    writenewpostdiv.style.display = "none";
    homepostdiv.style.display = "block";
});


