<script type="text/javascript" language="javascript" src="js/funcoes.js"></script>
<?php 
@session_start();
require_once("../controller/osCtr.php");
require_once("../controller/armacaoCtr.php");

if (($_GET["os"] <> "") || ($_GET["s"] <> "")) {
	$objOS = new OsCtr();
	$objOS->alteraStatus($_GET["os"], $_GET["s"]);
	
	if ($_GET["s"] == 4) {
		$os = $objOS->selecionar($_SESSION['codOtica'], $_GET["os"], 1, 0)->fetch_array(MYSQLI_ASSOC);
		$arm = new ArmacaoCtr();
		$arm->atualizarQtd($os["COD_ARMACAO"], 1, $_SESSION['codUsuario'], $os["COD_OS"], 1);
	}
}


?>
<script type="text/javascript" language="javascript">
	redirecionar("pagina.php?m=2&op=16");
</script>
