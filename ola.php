<?php
require('check.php');
if(isset($_COOKIE['finger']) && validaSessaoBko($phpsessid)){
 $finger=$_COOKIE['finger'];
 $phpsessid=$_COOKIE['bko'];
 $nome = explode('/', $path)[1];
 $nome = trim(str_replace('.txt', '', $nome));
 include("idBko.php");
 include("reqBko.php");
 $output=true;
 $i=1;
   do{
    $output=aguardando($phpsessid,$idBko,$i);
    $i=$i+1;
    }while($output!=false);
  }
else{
echo "Não autorizado";
echo "<script>alert('Sessão inválida\nFaça login');window.location.href='/monitor'</script>";
}
