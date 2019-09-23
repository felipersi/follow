$(document).ready(function(){
 $('button').on('click',function(){
 var b=$(this).closest("tr");
 var datacontent=$(this).attr('data-content').split(' ');
 if(datacontent[1]=="48"){
 var confirmar=confirm("Follow 48h será finalizado\nTem certeza?");
 }
 else{
 var confirmar=true;
 }
 if(confirmar){
 $.post('follow.php',"chamado="+datacontent[0]+"&follow="+datacontent[1]+"&phpsessid="+$.cookie("bko")).done(
  function(e){
   alert('followUp realizado');
   $(b).remove();
   console.log(e);
   console.log(b);
  })
  }
 })
})

