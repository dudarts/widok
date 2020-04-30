<?php require_once("../controller/funcoes.php"); ?>
<?php
	
	if ($_POST["pfValDesconto"] <> "") {
		//echo "aqui";
		$TipoDesconto	= $_POST["pfTipDesconto"];
		$ValorTotal 	= $_POST["pfHiddenValTotal"];
		
		if ($TipoDesconto == 'R')
			$ValorTotal -= fDecimalMySQL($_POST["pfValDesconto"]);
		else
			$ValorTotal -= $ValorTotal*fDecimalMySQL($_POST["pfValDesconto"]) / 100;
	} else {
		if ($_POST["pfValParcela"] <> "")
			$ValorTotal = fDecimalMySQL($_POST["pfValParcela"]);
	}
?>
<label>
<p><span>Total a Pagar:</span></p>
<input type="text" readonly name="pfValTotalAPagar" id="pfValTotalAPagar" value="<?php echo number_format(@$ValorTotal, 2, ",","."); ?>" >
</label>
