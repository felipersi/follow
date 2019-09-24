<?php
include_once('model/classAPI.php');
//include_once('model/classDB.php');

/*$conecta = new db();
$requisicaoapi = new api();

$phpsessid = $requisicaoapi->loga("bruno.minossi","218211415kinghost");

$idBko = $requisicaoapi-> numResponsavel($phpsessid);
var_dump($requisicaoapi-> consultaBko($phpsessid,1,$idBko));

$usuario = 'luis.silva'
$tabela = 'follow'
$idchamado = '207329';
$pagina ='aguardando';
$numInteracao = $requisicaoapi->consulta_ws()->count;



  $dados_follow = array(
      'idChamado' => null,
      'numInteracao' => $numInteracao,
      'usuario' => $usuario,
      'executaCron' => ,

$insert = $conecta->insert($tabela, $dados_follow);


$usuario = 'luis';
$senha = 'l123321l'; 
$url = '102930848';

$requisicaoapi = new api($usuario,$senha, $url);
$testathis = $requisicaoapi->testa_this($url);
echo $testathis;
var_dump($testathis);

*/

$requisicaoapi = new api("bruno.minossi","218211415kinghost",'');
$phpsessid = $requisicaoapi->loga("bruno.minossi","218211415kinghost",'');
