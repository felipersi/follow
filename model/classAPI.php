<?php
class api
{
	private $usuario;
	private $senha;
	private $bko_phpsessid;

	function __construct($usuario,$senha)
	{
		$this->usuario = $usuario;
		$this->senha = $senha;
		$_SESSION["usuario"] =  $usuario;
		$_SESSION["senha"] =  $senha;
	}
	public function getBkoSes()
	{
		return $this -> bko_phpsessid;
	}
    public function consulta_ws($idchamado,$pagina)
    {
		$handle = curl_init();
		$url = "http://ws-backoffice.kinghost.net/chamados/".$idchamado."/".$pagina;
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
  		curl_setopt($handle, CURLOPT_HTTPHEADER, array('Accept: application/json')); 
		$output= curl_exec($handle);
		$output = json_decode($output);
		if($pagina=="categorias")
			{
				$output = $output -> content[0] -> data;
			}
		if($pagina=="interacoes")
			{
				$ultimaInteracao = array_pop($output -> content) -> data;
		 		$output = "<td>".$ultimaInteracao -> nomeLogin."<br>".str_replace(array('<div>&nbsp;</div>','<p>&nbsp;</p>'),"",$ultimaInteracao -> descricao)."</td>";
		  		if($ultimaInteracao -> observacoes){
		   			$output+= "<td>".$ultimaInteracao -> observacoes."</td>";
		  		}
		  		else{
		   		$output+= "<td> Nenhuma </td>";
		  		}
 			}
 		return $output;	
    }
    public function consulta_bko($phpsessid,$pagina,$idBko)
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
    public function loga(){
    	$resultado = shell_exec("curl -s -v 'http://backoffice.kinghost.net/login' -d 'login=".$this -> usuario."&senha=".$this -> senha."&submit=Entrar' 2>&1 | grep -o '302\|PHPSESSID=[a-z0-9]*'");
		if(strpos($resultado,"302") !==false){
			preg_match("/PHPSESSID=[a-zA-Z0-9]*/", $resultado, $phpsessid);
			$bko_phpsessid=explode('=',$phpsessid[0])[1];
			$this -> bko_phpsessid = $bko_phpsessid;
			return true;

			}else {
			return false;
			 }
	}

	public function num_responsavel($phpsessid)
	{
		$idBko = shell_exec("curl -s -H 'Cookie: PHPSESSID=".$phpsessid."' 'http://www.backoffice.kinghost.net/bug' | egrep -o 'login.*$'");
		$idBko = preg_replace( '/[^0-9]/', '', $idBko);
		return $idBko;
	}
}