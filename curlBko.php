<?php
include_once('model/classAPI.php');

$idchamado = '207329';
$nome='luis.silva';
$senha='migra201125';
$finger='';
$requisicaoapi = new api($nome, $senha, $finger);
$requisicaoapi->loga($idchamado);
