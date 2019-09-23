<?php
$idBko = shell_exec("curl -s -H 'Cookie: PHPSESSID=".$phpsessid."' 'http://www.backoffice.kinghost.net/bug' | egrep -o 'login.*$'");
$idBko = preg_replace( '/[^0-9]/', '', $idBko);

