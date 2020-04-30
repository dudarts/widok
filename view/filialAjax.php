<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php 
@session_start();
	require_once("../controller/paginaCtr.php"); 
	require_once("../controller/pessoaCtr.php"); 

	@$_POST["pfSoFilialCadastrada"] == 1 ? $tipoBusca = 'filial' : $tipoBusca = 'tipopessoa';

	if (!isset($p['pfBusca'])) 
		$p['pfBusca'] = "";
	

	if (@$_GET['cod']) {

		$pessoa = new PessoaCtr();
		$vfPessoa = $pessoa->selecionar($_SESSION['codOtica'], $_GET['cod'], 1)->fetch_array(MYSQLI_ASSOC);
		
//$vfPessoa['COD_LENTE'];
//$vfPessoa['COD_MARCA'];
//$vfPessoa['COD_TIPO_LENTE'];
//$vfPessoa['COD_COR'];
//
//$vfPessoa['COD_OTICA'];

		$vfNomeBotao = "Atualizar";
		$vfAtualiza = '<label><p><span>Código:</span></p><input type="text" name="pfCod" disabled size="10" value="' . @$_GET['cod'] . '"></label>';
		$btExcluir = '<input type="submit" class="buttonExcluir" name="btn" id="btnExcluir" value="Excluir" onClick="return validaForm(this.value);" />';
	} else {
		$vfDes = "";
		$vfNomeBotao = "Salvar";
		$vfAtualiza = "";
		$btExcluir = "";
	}
?>

	<form action="../controller/filialCtr.php" method="post" name="formFilial" id="formFilial" class="smart-blue" onSubmit="return validaForm();">
		<input type="hidden" name="pfCodOtica" value="<?php echo $_SESSION['codOtica']; ?>">
		<input type="hidden" name="pfCod" value="<?php echo @$_GET['cod']; ?>">
		<input type="hidden" name="pfBusca" value="<?php echo $p['pfBusca']; ?>">
		<label>
			<input type="checkbox" name="pfSoFilialCadastrada" id="pfSoFilialCadastradas" value="1" onChange="SubmitAjax('post','filialAjaxFiltro.php','formFilial','divFilial')">
			Exibir somentes as filiais cadastradas. </label>

		<div id="divFilial" class="div100" style="margin-bottom:10px;">
			<?php include("FilialAjaxFiltro.php"); ?>
		</div>
		
		<br>
		<br>
		
		<input type="submit" class="button" name="btnSalvar" id="btnSalvar" value="<?php echo $vfNomeBotao; ?>" />
		<?php echo $btExcluir; ?>
	</form>
