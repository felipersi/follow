<?php
session_start();
$usuario = $_GET["usuario"];
$senha = $_GET["senha"];
include_once('model/classAPI.php');

$requisicaoapi = new api($usuario, $senha);
if($requisicaoapi -> loga()){
	$phpsessid = $requisicaoapi -> getBkoSes();
	$idBko = $requisicaoapi -> num_responsavel($phpsessid);
	var_dump($idBko);
	var_dump($requisicaoapi -> consulta_bko($phpsessid,1,$idBko));
	include_once('tabela.php');
}
else{
	echo "Não logado";
}


/*include_once('model/classDB.php');


$conecta = new db();
$senha= 'migra201125';
$usuario = 'luis.silva';

$requisicaoapi = new api($usuario, $senha);

$tabela = 'followup';
$idchamado = '207329';
$pagina ='interacoes';
$cron = date("Y-m-d");
$numInteracao = $requisicaoapi->consulta_ws($idchamado, $pagina)->count;


var_dump($numInteracao);

$dados_follow = array(
      'idChamado' => '',
      'numInteracao' => $numInteracao,
      'usuario' => $usuario,
      'executaCron' => $cron,
);
$insert = $conecta->inserir($tabela, $dados_follow);
*/