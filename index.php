<?php
include_once('model/classAPI.php');
include_once('model/classDB.php');


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
