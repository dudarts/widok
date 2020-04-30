<?php require_once("../controller/funcoes.php"); ?>
<?php
		$ValorTroco = fDecimalMySQL($_POST["pfValRecebido"]) - fDecimalMySQL($_POST["pfValTotalAPagar"]);
?>
<label>
<p><span>Troco:</span></p>
<input readonly type="text" name="pfValTroco" id="pfValTroco" value="<?php echo number_format(@$ValorTroco, 2, ",","."); ?>" onBlur="SubmitAjax('post','CaixaSubmitAjax.php','formCaixa','divSubmitAjax')" >
</label>
