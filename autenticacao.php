<?php
if(isset($_COOKIE['finger'])){
header("Location: ola.php");
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>BackOffice KingHost</title><!-- bootstrap -->
<link href="./css/bootstrap.css" rel="stylesheet">
<link href="./css/bootstrap-responsive.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/finger.js"></script>
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
    <form id="login">
        <div class="control-group">
            <div class="controls">
                <div class="input-icon left">
                    <input type="text" required="required" class="m-wrap placeholder-no-fix valid" placeholder="Login" name="login" id="nome" />
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
            <input name="submit" id="submit" class="btn btn-primary" value="Entrar" />        
        </div>

        <div class="message-box">
                    </div>
    </form>
</div>
<script>
function autentica(){
var nome=$("#nome").val();
var pass=$("#senha").val();
if(nome.length && pass.length > 0){
$(".message-box").text("Logando...");
$.post("loginbko.php","login="+nome+"&senha="+escape(pass)+"&finger="+fingerprint).done(function(e){
if(e == 0){
$(".message-box").text("Login incorreto");
}
else{
$.post("auth.php").done(function(a){
document.write(a);
});
}
})
}
}
$("#submit").on("click",function(){
autentica();
});
$("#telaLogin").on("keypress",function(event){
if (event.which == 13) {
autentica();
}
});
</script>
