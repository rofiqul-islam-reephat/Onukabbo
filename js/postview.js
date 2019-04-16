let commentbody = document.getElementById('commentbody');
let commentbtn = document.getElementById('commentbtn');
let commetnspan = document.getElementById('commentspan');

let editbtn = document.getElementById('editbtn');
let delbtn = document.getElementById('delbtn');



delbtn.addEventListener("click",function(){

    
    let cofirmation = confirm("Are you Sure?");
    let url_string = window.location.href;
    let url = new URL(url_string);
    let  postid = url.searchParams.get("id");

    if(cofirmation){
        
        let xhr = new XMLHttpRequest();
        let param = "q=delpost&postid="+postid;
      
        xhr.open("POST","pageserver.php",true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xhr.send(param);
        
        xhr.onload = function (){
      
          if(this.status==200){
                
            window.location = "profile.php";
            
          }
      
        }
        

    }

});


commentbody.addEventListener('keyup',function(){

    commetnspan.textContent = "";

});


commentbtn.addEventListener('click',function(event){
    
   if(commentbody.value===""){
        commetnspan.textContent = "Comment body is empty!!";
        event.preventDefault();
   }

});