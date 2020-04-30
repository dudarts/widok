<?php
require_once("lancamentoCtr.php");

if ($_POST["pfNumLancamento"] != ""){
	$lancamento = new lancamentoCtr();

	if ($lancamento->estorno($_POST["pfNumLancamento"]))
		header('location:../view/pagina.php?m=3&op=21&os='.$_POST["pfBusca"].'&msg='.md5(7));
	else
		header('location:../view/pagina.php?m=3&op=21&os='.$_POST["pfBusca"].'&msg='.md5(8));		
} else {
	header('location:../view/pagina.php?m=3&op=21&os='.$_POST["pfBusca"]);	
}

?>