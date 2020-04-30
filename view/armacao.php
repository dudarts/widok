<?php 
@session_start();
	require_once("../controller/paginaCtr.php"); 
	require_once("../controller/armacaoCtr.php"); 
	require_once("../controller/marcaCtr.php"); 
	
	if (@$_GET['cod']) {
		$rsArmacao = new ArmacaoCtr();
		$vfArmacao = $rsArmacao->selecionar($_SESSION['codOtica'], $_GET['cod'], 1)->fetch_array(MYSQLI_ASSOC);
		
		$vfArmacao['COD_ARMACAO'];
		$vfArmacao['COD_MARCA'];
		$vfArmacao['DES_ARMACAO'];
		$vfArmacao['NUM_REFERENCIA'];
		$vfArmacao['VAL_ARMACAO'];

		$vfNomeBotao = "Atualizar";
		$vfAtualiza = '<label><p><span>Código:</span></p><input type="text" name="pfCod" disabled size="10" value="' . @$_GET['cod'] . '"></label>';
		$btExcluir = ""; //'<input type="submit" class="buttonExcluir" name="btn" id="btnExcluir" value="Excluir" onClick="return validaFormArmacao(this.value);" />';
	} else {
		$vfDesArmacao = "";
		$vfNomeBotao = "Salvar";
		$vfAtualiza = "";
		$btExcluir = "";
	}
?>

<div class="div50"> 
<form action="../controller/armacaoCtr.php" method="post" name="formCadastro" id="formCadastro" class="smart-blue" onSubmit="return validaFormArmacao();">
	<input type="hidden" name="pfCodOtica" value="<?php echo $_SESSION['codOtica']; ?>">
	<input type="hidden" name="pfCod" value="<?php echo @$_GET['cod']; ?>">
	
	<?php echo $vfAtualiza; ?>
	
	<label>
		<p><span>Marca</span></p>
		<select name="pfCodMarca" id="pfCodMarca">
			<option value="">Selecione</option>
			<?php
			$marca = NULL;
			$rsMarca = NULL;
			$row = NULL;
			
			$marca = new MarcaCtr();
			$rsMarca = $marca->selecionar($_SESSION['codOtica']);
			while ($row = mysqli_fetch_assoc($rsMarca)) {
				($row['COD_MARCA'] == $vfArmacao['COD_MARCA']) ? $selected = 'selected' : $selected = "";
			?>
				<option <?php echo $selected; ?> value="<?php echo $row['COD_MARCA']; ?>"><?php echo $row['DES_MARCA']; ?></option>
			<?php
			}
			?>
		</select>
	</label>
	
	<label>
		<p><span>Modelo</span></p>
		<input id='pfDesArmacao' type='text' name='pfDesArmacao' placeholder='Modelo ou Descrição da Armação' size='32' maxlength='32' value="<?php echo @$vfArmacao['DES_ARMACAO']; ?>" />
	</label>
	
	<label>
		<p><span>Nº de Referência</span></p>
		<input id='pfNumReferencia' type='text' name='pfNumReferencia' placeholder='Referência' size='32' maxlength='32' value="<?php echo @$vfArmacao['NUM_REFERENCIA']; ?>" />
	</label>
	
	<label>
		<p><span>Valor</span></p>
		<input id='pfValArmacao' type='text' name='pfValArmacao' placeholder='Valor' size='10' maxlength='8' value="<?php echo @$vfArmacao['VAL_ARMACAO']; ?>" />
	</label>
	
	<input type="submit" class="button" name="btn" id="btn" value="<?php echo $vfNomeBotao; ?>" /> 
	<?php echo $btExcluir; ?>		
</form>
</div>
<?php
if (@$_GET['cod']) {
	switch($_SESSION['codPermissao']) {
		case 1:
		case 2:
?>
	<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
	<div class="div50">
		<h1>Quantidade de Armações</h1>
		<form action="../controller/armacaoCtr.php" method="post" class="smart-blue" onSubmit="return validadeFormQtdArmacacao();">
			<input type="hidden" name="pfCodArmacao" value="<?php echo @$vfArmacao['COD_ARMACAO']; ?>">
			<input type="hidden" name="pfCodUsuario" value="<?php echo @$_SESSION['codUsuario']; ?>">
			<input type="hidden" name="pfCodOs" value="NULL">
			<input type="hidden" name="pfAdiciona" value="1">
			
			<p><span>Qtd de armações no sistema: <h2><?php echo @$vfArmacao['QTD_ARMACAO']; ?></h2></span></p>
		
			<p><span>Quantas novas armações deste modelo você deseja adicionar ao sistema?</span></p>
			<div class="div10">
			<label>
				<input id='pfQtdArmacao' type='text' name='pfQtdArmacao' size='3' maxlength='3' />
			</label>
			</div>
			<div class="divLinha">
			<input type="submit" class="button" name="btn" id="btn" value="Adicionar" /> 
			</div>
		</form>
	</div>
<?php
	}
}
?>