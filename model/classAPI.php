<?php
class api
{
	private $url;
	private $usuario;
	private $senha;

	function _construct($usuario,$senha){

		$this->url = 'http://backoffice.kinghost.net/login';
		$this->usuario = $usuario;
		$this->senha = $senha;

	}
   public function consulta ($idchamado)
    {
		$handle = curl_init();
 
		$url = "http://ws-backoffice.kinghost.net/chamados/" . $idchamado . "/interacoes";
 
		curl_setopt($handle, CURLOPT_URL, $this->url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  		curl_setopt($handle, CURLOPT_HTTPHEADER, array( 'Accept: application/json')); 
		$output = curl_exec($handle);
		$output = json_decode($output);
 		echo "<pre>";
 		var_dump($output->count);
 		echo "</pre>";	
    }

    public function loga ($usuario,$senha){
	
	$this->usuario;
	$this->senha;
	
	}

	public function numResponsavel(){
		$idBko = shell_exec("curl -s -H 'Cookie: PHPSESSID=".$phpsessid."' 'http://www.backoffice.kinghost.net/bug' | egrep -o 'login.*$'");
		$idBko = preg_replace( '/[^0-9]/', '', $idBko);

	}
}


}
