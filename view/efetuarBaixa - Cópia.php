<script type="text/javascript" language="javascript" src="js/funcoes.js"></script>
<?php 
@session_start();
require_once("../controller/lancamentoCtr.php");
require_once("../controller/funcoes.php");
require_once("../controller/osCtr.php");

$objBaxia = new lancamentoCtr();
$valorBaixa = fDecimalMySQL($_POST["pfValorBaixa"]);
$valorParcela = $_POST["pfValParcela"];
$num_Parcela = $_POST["pfNumParcela"];

//echo $_POST["pfValorBaixa"] . "<br>";
//echo $_POST["pfNumParcela"] . "<br>";
//echo $_POST["pfCodOS"] . "<br>";
//exit();
$objBaxia->baixa($_POST["pfCodOS"], $_POST["pfNumParcela"], $valorBaixa, $_SESSION["codUsuario"]);

if ($num_Parcela == 0) {
	$saldo = $valorParcela - $valorBaixa;

	if ($saldo > 0){
		$objBaxia->inserir($_SESSION["codOtica"],$_POST["pfCodOS"], 0, $saldo, $_SESSION["codUsuario"]);
	}
}

if ($objBaxia->totalParcelaAbertas($_POST["pfCodOS"]) == 0) {
	$objOS = new OsCtr();
	$objOS->alteraStatus($_POST["pfCodOS"], 3);
}


?>
<script type="text/javascript" language="javascript">
	redirecionar("pagina.php?m=3&op=21&os=<?php echo $_POST["pfCodOS"]; ?>");
</script>
