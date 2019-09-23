<?php
function loga($nome,$senha,$finger){
$ch= curl_init();
echo $senha;
curl_setopt($ch,CURLOPT_URL, "http://backoffice.kinghost.net/login");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_COOKIEJAR, "./cookies/$nome.txt");
curl_setopt($ch, CURLOPT_POSTFIELDS, "login=$nome&senha=$senha&submit=Entrar");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$interacoes= curl_exec($ch);
curl_close($ch);
if(substr_count($interacoes,"Dados Incorretos") == 0){
        shell_exec("echo 'FINGERPRINTID '$finger >> ./cookies/$nome.txt");
        echo "1";
}
else{
echo "0";
shell_exec("rm -f ./cookies/$nome.txt");
}
}

