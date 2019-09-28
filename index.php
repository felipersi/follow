<?php
session_start();
include_once('model/classAPI.php');

if(isset($_SESSION["usuario"])){
	header("Location: admin.php");
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