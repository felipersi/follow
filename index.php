<?php
include_once('model/classAPI.php');

$requisicaoapi = new api();
$phpsessid = $requisicaoapi->loga("bruno.minossi","218211415kinghost");

$idBko = $requisicaoapi-> numResponsavel($phpsessid);
var_dump($requisicaoapi-> consultaBko($phpsessid,1,$idBko));



