<?php
echo "<head><script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css' integrity='sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ' crossorigin='anonymous'>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
<script src='js/follow.js'></script><table class='table table-striped table-hover'><thead class='thead-dark'> <tr><th scope='col'>Última Interação</th><th scope='col'>Categoria</th> <th scope='col'>Assunto</th> <th scope='col'>Chamado</th> <th scope='col'>Resposta</th><th scope='col'>Obs. Interna</th><th scope='col'>Ação</th></tr> </thead>";
 foreach($result -> list as $key){
  echo "<tr>";
  echo "<td>".$key -> dataUltimaInteracao."</td>";
  echo "<td>".$requisicaoapi -> consulta_ws($key -> id,"categorias") -> nome."</td>";
  echo "<td>".$key -> assunto."</td>";
  echo "<td><a href='http://www.backoffice.kinghost.net/chamado/index/id/".$key -> id."'>".$key -> id."</a></td>";
  echo $requisicaoapi -> consulta_ws($key -> id,"interacoes");
  echo "<td><button type='button' class='btn btn-outline-secondary' data-content='".$key -> id." 24'>24h</button><button type='button' class='btn btn-outline-success' data-content='".$key -> id." 48'>48h</button>";
  echo "</tr>";
 }
 echo "</table>";