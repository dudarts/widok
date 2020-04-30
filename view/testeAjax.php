<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
<script language="javascript" type="text/javascript" src="js/ajax.js"></script>
</head>

<body>
<form action="" name="formAjax" id="FormAjaxId" method="get">
	Nome:<br>
	<input type="text" name="nome" id="nome"><br><br>
	
	<div id="aqui"></div>
	
	<input type="button" name="btnAjax" onClick="SubmitAjax('post','inputAjax.php','FormAjaxId','aqui');" value="Ajax">
	
	<p><input type="submit" name="submit" value="Enviar"></p>
	
</form>
</body>
</html>