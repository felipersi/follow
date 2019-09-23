<?php
if(isset($_POST["finger"])){
 $finger=$_POST["finger"];
 $path=shell_exec("grep -rl $finger");
 $phpsessid =shell_exec("grep -o PHPSESSID.* $path");
 $phpsessid =preg_split('/[\s]+/', $phpsessid)[1];
 if($phpsessid){
 setcookie("finger",$finger);
 setcookie("bko",$phpsessid);
 echo 1;
 }
 else{
  unset($_COOKIE["finger"]);
 }
}
else{
echo '<head><script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/finger.js"></script></head><body>';
echo '<script>$.post("auth.php","finger="+fingerprint).done(function(e){if($(e).text()==1){alert("setado");}else{window.location.href="autenticacao.php"}});</script>';
}
