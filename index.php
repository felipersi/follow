<?php
session_start();
//$usuario = $_GET["usuario"];
//$senha = $_GET["senha"];
include_once('model/classAPI.php');
/*
$requisicaoapi = new api($usuario, $senha);
if($requisicaoapi -> loga()){
	$phpsessid = $requisicaoapi -> getBkoSes();
	$idBko = $requisicaoapi -> num_responsavel($phpsessid);
	$result = $requisicaoapi -> consulta_bko($phpsessid,0,$idBko);
	include_once('tabela.php');
}
else{
	echo "Não logado";
}
*/
include_once('model/classDB.php');


$conecta = new db();
$senha= 'migra201125';
$usuario = 'luis.silva';

$requisicaoapi = new api($usuario, $senha);

$tabela = 'followup';
$idchamado = '207329';
$pagina ='interacoes';
$cron = date("Y-m-d H:i");
$numInteracao = $requisicaoapi->consulta_ws($idchamado, $pagina)->count;

var_dump($numInteracao);

$dados_follow = array(
      'idChamado' => $idchamado,
      'numInteracao' => $numInteracao,
      'usuario' => $usuario,
      'executaCron' => $cron,
);
//inserir no banco de dados
//$insert = $conecta->inserir($tabela, $dados_follow);

//select do para comparar se houve alteração no chamado
/*$select = $conecta->select($idchamado);
$countws = implode("", $select);

if($countws == $numInteracao){
	echo "<br>";
	echo "Os valores são iguais, manter para o follow";

} else if($countws >= $numInteracao){
	$conecta->delete($idchamado);
	echo "removido do banco";

} else {
	echo "<br>";
	echo "Opss... erro inesperado, fale com o dev do sistema";
}
*/

//verificar se já passou 24 horas.
$hora_banco = $conecta->select_hora($idchamado);
$h = implode("", $hora_banco);
echo $h;
echo $cron;
$timediff = strtotime($cron) - strtotime($h);

echo $timediff;

if($timediff > 86400){ 
	echo "<br>";
    echo 'Mais de 24 horas';
} else {
	echo "<br>";
 	echo 'Menos de 24 horas';
}


