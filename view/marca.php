<?php 
@session_start();
	require_once("../controller/paginaCtr.php"); 
	require_once("../controller/marcaCtr.php"); 
	
	if (@$_GET['cod']) {
		$rsMarca = new MarcaCtr();
		$vfDesMarca = $rsMarca->selecionar($_SESSION['codOtica'], $_GET['cod'], 1)->fetch_array(MYSQLI_ASSOC);
		$vfDesMarca = $vfDesMarca['DES_MARCA'];
		$vfNomeBotao = "Atualizar";
		$vfAtualiza = '<label><p><span>Código:</span></p><input type="text" name="pfCod" disabled value="' . @$_GET['cod'] . '"></label>';
		$btExcluir = '<input type="submit" class="buttonExcluir" name="btn" id="btnExcluir" value="Excluir" onClick="ConfirmaExcluir();" />';
	} else {
		$vfDesMarca = "";
		$vfNomeBotao = "Salvar";
		$vfAtualiza = "";
		$btExcluir = "";
	}
?>


<form action="../controller/marcaCtr.php" method="post" name="formMarca" id="formMarca" class="smart-blue" onSubmit="return validaForm(this.name);">
	<input type="hidden" name="pfCodOtica" value="<?php echo $_SESSION['codOtica']; ?>">
	<input type="hidden" name="pfCod" value="<?php echo @$_GET['cod']; ?>">
	
	<?php echo $vfAtualiza; ?>
	
	<label>
		<p><span>Descrição: </span></p>
		<input id='pfDesMarca' type='text' name='pfDesMarca' placeholder='Nome da Marca' size='32' maxlength='32' value="<?php echo $vfDesMarca; ?>" />
	</label>
	
		<input type="submit" class="button" name="btn" id="btn" value="<?php echo $vfNomeBotao; ?>" /> 
		<?php echo $btExcluir; ?>		
</form>
