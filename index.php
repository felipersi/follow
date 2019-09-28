<?php
session_start();
include_once('model/classAPI.php');

if(isset($_SESSION["usuario"])){
	header("Location: admin.php");
}
else{
	echo '
	<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>BackOffice KingHost</title><!-- bootstrap -->
	<link href="./css/bootstrap.css" rel="stylesheet">
	<link href="./css/bootstrap-responsive.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<style type="text/css" title="currentStyle">

		@import "./css/jquery-ui-1.8.10.custom.css";
	    @import "./css/bo-admin.css";
	    @import "./css/jquery.fancybox-1.3.4.css";
	    @import "./css/tipTip.css";
	</style>

	</head>
	<body>
			<div id="telaLogin">
    <span class="login-title">Login</span>
    <h3 class="login-local">Backoffice</h3>
    <form action="index.php" method="post">
	    <div class="control-group">
	    <div class="controls">
	    <div class="input-icon left">
	    <input type="text" required="required" class="m-wrap placeholder-no-fix valid" placeholder="Login" name="usuario" id="nome" />
	    </div>
	    </div>
	    </div>

	    <div class="control-group">
	    <div class="controls">
	    <div class="input-icon left">
	    <input type="password" required="required" class="m-wrap placeholder-no-fix" placeholder="Senha" name="senha" id="senha" />
	    </div>
	    </div>
	    </div>
	    <div class="form-actions">
	    <input name="submit" type="submit" class="btn btn-primary" value="Entrar" />        
	    </div>

	    <div class="message-box">
	    </div>
    </form>
	</div>
		';
}
if(isset($_POST["usuario"])&&isset($_POST["senha"])){
	$usuario = $_POST["usuario"];
	$senha = $_POST["senha"];

	$requisicaoapi = new api($usuario, $senha);
	if($requisicaoapi -> loga()){
		$_SESSION["usuario"]=$usuario;
		$_SESSION["senha"]=$senha;
		echo "Conectado! Logando ...";
		header("Location: admin.php");
	}
	else{
	echo "Dados inválidos";
	unset($_SESSION["usuario"]);
	unset($_SESSION["senha"]);
	unset($_SESSION["phpsessid"]);
	}
}