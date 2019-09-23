<?php
include('ws.php');
function aguardando($phpsessid,$idBko,$i){
 $ch= curl_init();
 curl_setopt($ch,CURLOPT_URL, "http://backoffice.kinghost.net/chamado/list/p/".$i);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: PHPSESSID=$phpsessid","Accept: application/json","X-Requested-With: XMLHttpRequest","Content-Type: application/x-www-form-urlencoded;"));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 curl_setopt($ch, CURLOPT_POSTFIELDS, "status=aberto&grupopertence=0&interno=0&login=$idBko&situacao=aguardandocliente");
 $result= curl_exec($ch);
 curl_close($ch);
 $result = json_decode($result);
if(!empty($result -> list)){
echo "<head><script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js'></script>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css' integrity='sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ' crossorigin='anonymous'>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
<style>body{width: 70%; border-width: 0.1px; margin-left: 10%;}div{margin:1%;}p{margin:0px;}</style></head><body>";
 echo "<table class='table table-striped table-hover'>";
 echo "<thead class='thead-dark'> <tr><th scope='col'>Última Interação</th> <th scope='col'>Assunto</th> <th scope='col'>Chamado</th> <th scope='col'>Obs. Interna</th><th scope='col'>Resposta</th><th scope='col'>Ação</th></tr> </thead>";
 foreach($result -> list as $key){
  echo "<tr>";
  echo "<td>".$key -> dataUltimaInteracao."</td>";
  echo "<td>".$key -> assunto."</td>";
  echo "<td><a href='http://www.backoffice.kinghost.net/chamado/index/id/".$key -> id."'>".$key -> id."</a></td>";
  ws(intval($key -> id));
  echo "<td><button type='button' class='btn btn-outline-secondary' data-content='".$key -> id." 24'>24h</button><button type='button' class='btn btn-outline-success' data-content='".$key -> id." 48'>48h</button>";
  echo "</tr>";
 }
 echo "</table>";
 echo "<script src='js/follow.js'></script>";
 echo "<script>
$(document).ready(function(){
$('table').DataTable({'order': [[ 1, 'desc' ]],'paging': false,'language': { 'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json' }})
})
</script>";
}
else{
return false;
}
}
