<?php
$phpsessid=$_COOKIE['bko'];
function validaSessaoBko($phpsessid){
$resultado=shell_exec("curl -w '%{http_code}' 'http://backoffice.kinghost.net/' -H 'Cookie: PHPSESSID=$phpsessid'");
if($resultado=="302"){
return true;
}
else{
shell_exec("grep -rl $phpsessid | xargs rm -f");
echo "<script src='js/limpaCookie.js'></script>";
return false;
}
}
