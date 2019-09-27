<?php
 if(isset($_POST["chamado"])&&isset($_POST["follow"])&&isset($_POST["phpsessid"]))
 {
  $phpsessid=$_POST["phpsessid"];
  $chamado=$_POST["chamado"]; 
  $ch= curl_init();
  curl_setopt($ch,CURLOPT_URL, "http://ws-backoffice.kinghost.net/chamados/$chamado");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $info= curl_exec($ch);
  $info = json_decode($infos);
  $idCliente=$info->cliente;
  $idResponsavel=$info->idResponsavel;
  if($_POST["follow"] == "24")
  {
    $texto="Olá, tudo bem?<br>Ainda não identifiquei seu retorno quanto a última interação deste chamado.<br>Por gentileza, peço que verifique as informações solicitadas e me retorne para que possamos continuar a verificação.<br>Caso não responda este chamado o status será alterado para 'resolvido' podendo ser reaberto por até 5 dias. <br>Sigo à sua disposição!<br>Atenciosamente,";
    $resposta="chamado=$chamado&descricao=$texto&observacoes=&status=5&cliente=$idCliente&responsavel=$idResponsavel&grupo=-1";
  }
  elseif($_POST["follow"] == "48")
  {
    $texto="Olá, tudo bem?<br>Estou encerrando este chamado, devido a falta de retorno. <br>Caso haja necessidade de tratar novamente esta dificuldade, efetue uma nova interação em até 5 dias para reabrir este chamado. Passando deste período, você deverá abrir um novo em nosso pelo painel de controle.<br>Em caso de qualquer dúvida adicional, seguimos à disposição através de nossos canais de atendimento.<br>Atenciosamente,";
    $resposta="chamado=$chamado&descricao=$texto&observacoes=&status=6&cliente=$idCliente&responsavel=$idResponsavel&grupo=-1";
  }
  else
  {
    $resposta="Olá";
  }
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, "http://backoffice.kinghost.net/interacao/add");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: PHPSESSID=$phpsessid","Accept: application/json","X-Requested-With: XMLHttpRequest","Content-Type: application/x-www-form-urlencoded;"));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $resposta);
  $result= curl_exec($ch);
  $result = json_decode($result);
  echo $result;
 }

