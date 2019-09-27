<?php

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
include_once('model/classAPI.php');

if(isset($usuario)&&isset($senha)){
	$requisicaoapi = new api($usuario, $senha);
	if($requisicaoapi -> loga()){
		$phpsessid = $requisicaoapi -> getBkoSes();
		echo '<script>var phpsessid="'.$phpsessid.'"</script>';
		$idBko = $requisicaoapi -> num_responsavel($phpsessid);
		$result = $requisicaoapi -> consulta_bko($phpsessid,1,$idBko);
		include_once('tabela.php');
	}
	else{
		echo "<script>alert('Dados inválidos');window.history.back();</script>";
	}
}
else{
	echo '
		<form action="index.php" method="post">
 		<p>Usuário: <input type="text" name="usuario" /></p>
 		<p>Senha: <input type="password" name="senha" /></p>
 		<p><input value="Logar" type="submit" /></p>
		</form>
	';
}

/*
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

*/
