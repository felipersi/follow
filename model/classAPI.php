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
		   			$output.= "<td>".$ultimaInteracao -> observacoes."</td>";
		  		}
		  		else{
		   		$output.= "<td> Nenhuma </td>";
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
    public function prepara_follow($chamado,$follow,$phpsessid){
      $ch= curl_init();
	  curl_setopt($ch,CURLOPT_URL, "http://ws-backoffice.kinghost.net/chamados/".$chamado);
	  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	  $info= curl_exec($ch);
	  $info = json_decode($infos);
	  $idCliente=$info->cliente;
	  $idResponsavel=$info->idResponsavel;
	  if($follow == "24")
	  {
	    $texto="Olá, tudo bem?<br>Ainda não identifiquei seu retorno quanto a última interação deste chamado.<br>Por gentileza, peço que verifique as informações solicitadas e me retorne para que possamos continuar a verificação.<br>Caso não responda este chamado o status será alterado para 'resolvido' podendo ser reaberto por até 5 dias. <br>Sigo à sua disposição!<br>Atenciosamente,";
	    $resposta="chamado=$chamado&descricao=$texto&observacoes=&status=5&cliente=$idCliente&responsavel=$idResponsavel&grupo=-1";
	  }
	  elseif($follow == "48")
	  {
	    $texto="Olá, tudo bem?<br>Estou encerrando este chamado, devido a falta de retorno. <br>Caso haja necessidade de tratar novamente esta dificuldade, efetue uma nova interação em até 5 dias para reabrir este chamado. Passando deste período, você deverá abrir um novo em nosso pelo painel de controle.<br>Em caso de qualquer dúvida adicional, seguimos à disposição através de nossos canais de atendimento.<br>Atenciosamente,";
	    $resposta="chamado=".$chamado."&descricao=".$texto."&observacoes=&status=6&cliente=".$idCliente."&responsavel=".$idResponsavel."&grupo=-1";
	  }
	  else
	  {
	    $resposta="Olá";
	  } 
	  return $this->follow_up($resposta,$phpsessid);
	}
    public function follow_up($resposta,$phpsessid){
    	 $ch = curl_init();
		  curl_setopt($ch,CURLOPT_URL, "http://backoffice.kinghost.net/interacao/add");
		  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: PHPSESSID=".$phpsessid,"Accept: application/json","X-Requested-With: XMLHttpRequest","Content-Type: application/x-www-form-urlencoded;"));
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		  curl_setopt($ch, CURLOPT_POSTFIELDS, $resposta);
		  $result= curl_exec($ch);
		  $result = json_decode($result);
		  return true;
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