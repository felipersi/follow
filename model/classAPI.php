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
   public function consultaWs ($idchamado,$pagina)
    {
		$handle = curl_init();
		$url = "http://ws-backoffice.kinghost.net/chamados/".$idchamado."/".$pagina;
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
  		curl_setopt($handle, CURLOPT_HTTPHEADER, array('Accept: application/json')); 
		$output= curl_exec($handle);
		$output = json_decode($output);
 		return $output;	
    }
    public function consultaBko ($phpsessid,$pagina,$idBko)
    {
		$handle = curl_init();
		$url = "http://backoffice.kinghost.net/chamado/list/p/".$pagina;
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
  		curl_setopt($handle, CURLOPT_HTTPHEADER, array('Accept: application/json'));
  		curl_setopt($handle, CURLOPT_HTTPHEADER, array("Cookie: PHPSESSID=$phpsessid","Accept: application/json","X-Requested-With: XMLHttpRequest","Content-Type: application/x-www-form-urlencoded;"));
		curl_setopt($handle, CURLOPT_POSTFIELDS, "status=aberto&grupopertence=0&interno=0&login=$idBko&situacao=aguardandocliente");

		$output= curl_exec($handle);
		$output = json_decode($output);
 		return $output;	
    }
    public function loga ($usuario,$senha){
		$resultado=shell_exec("curl -w '%{http_code}' 'http://backoffice.kinghost.net/login' -d 'login=$usuario&senha=$senha&submit=Entrar'");
		if($resultado=="302"){
			$ch = curl_init('http://backoffice.kinghost.net/login');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "login=$usuario&senha=$senha&submit=Entrar");

			$result = curl_exec($ch);
			preg_match("/PHPSESSID=[a-zA-Z0-9]*/", $result, $phpsessid);
			return explode('=',$phpsessid[0])[1];
		}
		else{
			return "Não logado";
		}
	}

	public function numResponsavel($phpsessid){
		$idBko = shell_exec("curl -s -H 'Cookie: PHPSESSID=".$phpsessid."' 'http://www.backoffice.kinghost.net/bug' | egrep -o 'login.*$'");
		$idBko = preg_replace( '/[^0-9]/', '', $idBko);
		return $idBko;
	}
}