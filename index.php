<?php
include_once('model/classAPI.php');

//$idchamado = '2516475';
$requisicaoapi = new api();
$phpsessid = $requisicaoapi->loga("bruno.minossi","218211415kinghost");
//var_dump($phpsessid);

$idBko = $requisicaoapi-> numResponsavel($phpsessid);
var_dump($requisicaoapi-> consultaBko($phpsessid,1,$idBko));



