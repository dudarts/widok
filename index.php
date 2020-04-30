<?php
session_start();
session_destroy();
require_once("controller/funcoes.php");

?>
<?php //echo "Sub: ".  fSubdominio($_SERVER['SERVER_NAME'], 0) . "<br>"; ?>
<?php //echo "tudo: " . $_SERVER['SERVER_NAME']; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bem Vindo ao widok</title>
<link rel="shortcut icon" href="view/img/favicon.png" />
<link href="view/css/visual.css" rel="stylesheet" type="text/css">
</head>

<body style="background-image:url(view/img/bkg.jpg);">
	<div id="login">
		<img src="view/img/logo widok.png" alt="widok - Sistema para Ótica" width="120"><br>

		<form action="controller/usuarioCtr.php" method="post" class="smart-blue" onsubmit="return validaFormLogin();">
			<input type="hidden" name="pfCodOtica" value="<?php echo fSubdominio($_SERVER['SERVER_NAME'], 0); ?>">
		
			<label>
				Usuário:<br>
				<input type="text" name="pfUsuario" required placeholder='Usuário'><br><br>
			</label>		

			 <label>
				Senha:<br>
				<input type="password" name="pfSenha" required placeholder='Senha'><br><br>
			</label>		
			 <div id="msgCodUsuario">
				<span><?php echo @$_GET['msg']; ?></span> 
			</div>    
			
			 <label>
				<span>&nbsp;</span> 
				<input type="submit" class="button" id="button" value="Entrar" /> 
			</label>    
		</form>
	</div>
</body>
</html>
