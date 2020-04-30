<?php 
@session_start();
	require_once("../controller/paginaCtr.php"); 
	require_once("../controller/corCtr.php"); 
	
	if (@$_GET['cod']) {
		$rsCor = new CorCtr();
		$vfDesCor = $rsCor->selecionar($_SESSION['codOtica'], $_GET['cod'], 1)->fetch_array(MYSQLI_ASSOC);
		$vfNomeBotao = "Atualizar";
		$vfAtualiza = '<label><p><span>Código:</span></p><input type="text" name="pfCod" disabled value="' . @$_GET['cod'] . '"></label>';
		$btExcluir = '<input type="submit" class="buttonExcluir" name="btn" id="btnExcluir" value="Excluir" onClick="return validaFormCor(this.value);" />';
	} else {
		$vfDesCor = "";
		$vfNomeBotao = "Salvar";
		$vfAtualiza = "";
		$btExcluir = "";
	}
?>

<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>

<form action="../controller/corCtr.php" method="post" name="formCadastro" id="formCadastro" class="smart-blue" onSubmit="return validaFormCor();">
	<input type="hidden" name="pfCodOtica" value="<?php echo $_SESSION['codOtica']; ?>">
	<input type="hidden" name="pfCod" value="<?php echo @$_GET['cod']; ?>">
	
	<?php echo $vfAtualiza; ?>
	
	<label>
		<p><span>Descrição: </span></p>
		<input id='pfDesCor' type='text' name='pfDesCor' placeholder='Nome da Cor' size='32' maxlength='32' value="<?php echo @$vfDesCor['DES_COR']; ?>" />
	</label>
	
	 <label>
		<input type="submit" class="button" name="btn" id="btn" value="<?php echo $vfNomeBotao; ?>" /> 
		<?php echo $btExcluir; ?>		
	</label> 
</form>
