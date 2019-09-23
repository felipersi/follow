<?php
if(isset($_POST["login"])&&isset($_POST["senha"])){
$login=$_POST["login"];
$senha=rawurlencode($_POST["senha"]);
echo "teste1:".$senha;
$finger=$_POST["finger"];
require("curlBko.php");
$resp= loga($login,$senha,$finger);
echo $resp;
}
