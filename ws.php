<?php
function ws($id,$pagina) {
$ch= curl_init();
curl_setopt($ch,CURLOPT_URL, "http://ws-backoffice.kinghost.net/chamados/$id/$pagina");
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$retorno= curl_exec($ch);
curl_close($ch);
$retorno = json_decode($retorno);
 if($pagina=="interacoes"){
 $ultimaInteracao = array_pop($retorno -> content) -> data;
 echo "<td>".$ultimaInteracao -> nomeLogin."<br>".str_replace(array('<div>&nbsp;</div>','<p>&nbsp;</p>'),"",$ultimaInteracao -> descricao)."</td>";

  if($ultimaInteracao -> observacoes){
   echo "<td>".$ultimaInteracao -> observacoes."</td>";
  }
  else{
   echo "<td> Nenhuma </td>";
  }
 }
 if($pagina=="categorias"){
  echo "<td>".$retorno -> content[0] -> data -> nome."</td>";
 }
}

