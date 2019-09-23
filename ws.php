<?php
function ws($id) {
$ch= curl_init();
curl_setopt($ch,CURLOPT_URL, "http://ws-backoffice.kinghost.net/chamados/$id/interacoes");
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$interacoes= curl_exec($ch);
$interacoes = json_decode($interacoes);
$ultimaInteracao = array_pop($interacoes -> content) -> data;
echo "<td>".str_replace(array('<div>&nbsp;</div>','<p>&nbsp;</p>'),"",$ultimaInteracao -> descricao)."</td>";

if($ultimaInteracao -> observacoes){
echo "<td>".$ultimaInteracao -> observacoes."</td>";
}
else{
echo "<td> Nenhuma </td>";
}

}

