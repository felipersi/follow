<?php
include_once('model/classAPI.php');

$idchamado = '207329';

$requisicaoapi = new api($idchamado);
$requisicaoapi->consulta($idchamado);

//header("Location: http://localhost/follow/autenticacao.php");