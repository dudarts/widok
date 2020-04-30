<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body>
<form method="post" action="">
	Cidade: <input type="text" name="codCidade" >
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once("../controller/cidadeCtr.php");
	$cidade = mysqli_fetch_assoc(CidadeCtr::selecionar($_POST["codCidade"]));
	echo "Nome: " . $cidade["DES_CIDADE"] . "<br>";
}
?>
</body>
</html>