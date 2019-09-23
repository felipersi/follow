<?php
class api
{
    function consulta ($idchamado)
    {
		$handle = curl_init();
 
		$url = "http://ws-backoffice.kinghost.net/chamados/" . $idchamado . "/interacoes";
 
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  		curl_setopt($handle, CURLOPT_HTTPHEADER, array( 'Accept: application/json')); 
		$output = curl_exec($handle);
		$output = json_decode($output);
 		echo "<pre>";
 		var_dump($output->count);
 		echo "</pre>";
 		


    }
}
