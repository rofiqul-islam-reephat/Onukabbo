let commentbody = document.getElementById('commentbody');
let commentbtn = document.getElementById('commentbtn');
let commetnspan = document.getElementById('commentspan');


commentbody.addEventListener('keyup',function(){

    commetnspan.textContent = "";

});


commentbtn.addEventListener('click',function(event){
    
   if(commentbody.value===""){
        commetnspan.textContent = "Comment body is empty!!";
        event.preventDefault();
   }

});