let updatebtn = document.getElementById('updatebtn');
let signoutbtn = document.getElementById('signoutbtn');
let updateinfobtn = document.getElementById('updateinfobtn');
let cancelbtn = document.getElementById('cancelbtn');

let updateprofilediv = document.getElementById('updateprofilediv');
let userpostsdiv =  document.getElementById('userposts');



function load_user_posts(){

    let xhr = new XMLHttpRequest();
    let param = "q=loaduserposts";
    let postdiv = document.getElementById('postdiv');
  
    xhr.open("POST","pageserver.php",true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xhr.send(param);
    
    xhr.onload = function (){
  
      if(this.status==200){
  
        userpostsdiv.innerHTML = this.responseText;
  
      }
  
    }
  
}
  
load_user_posts();

signoutbtn.addEventListener('click',function(){
  
    let xhr = new  XMLHttpRequest();
    let param = "q=signout";
  
    xhr.open("POST","pageserver.php",true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xhr.send(param);
  
    xhr.onload = function(){
      if(this.status ==200){
        window.location.replace("index.php");
      }
    }
  
  });
  

updatebtn.addEventListener('click',function(){

    updateprofilediv.style.display ='block';
    userpostsdiv.style.display = 'none';
    

});

cancelbtn.addEventListener('click',function(){

    updateprofilediv.style.display = 'none';
    userpostsdiv.style.display = 'block';

});

updateinfobtn.addEventListener('click',function(){

    updateprofilediv.style.display = 'none';
    userpostsdiv.style.display = 'block';



});