<?php 
@session_start();
	require_once("../controller/paginaCtr.php"); 
	require_once("../controller/lenteCtr.php"); 
	require_once("../controller/marcaCtr.php"); 
	require_once("../controller/tipoLenteCtr.php"); 
	require_once("../controller/corCtr.php"); 

	
	if (@$_GET['cod']) {
		$lente = new LenteCtr();
		$vfLente = $lente->selecionar($_SESSION['codOtica'], $_GET['cod'], 1)->fetch_array(MYSQLI_ASSOC);
		
//$vfLente['COD_LENTE'];
//$vfLente['COD_MARCA'];
//$vfLente['COD_TIPO_LENTE'];
//$vfLente['COD_COR'];
//
//$vfLente['COD_OTICA'];

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

<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>

<form action="../controller/lenteCtr.php" method="post" name="formCadastro" id="formCadastro" class="smart-blue" onSubmit="return validaFormLente();">
	<input type="hidden" name="pfCodOtica" value="<?php echo $_SESSION['codOtica']; ?>">
	<input type="hidden" name="pfCod" value="<?php echo @$_GET['cod']; ?>">
	
	<?php echo $vfAtualiza; ?>
	
	<label>
		<p><span>Modelo: </span></p>
		<input id='pfDesLente' type='text' name='pfDesLente' placeholder='Descrição da Lente' size='32' maxlength='32' value="<?php echo @$vfLente['DES_LENTE']; ?>" />
	</label>
	
	<label>
		<p><span>Marca: </span></p>
		<select name="pfCodMarca" id="pfCodMarca">
			<option value="">Selecione</option>
			<?php
			$marca = NULL;
			$rsMarca = NULL;
			$row = NULL;
			
			$marca = new MarcaCtr();
			$rsMarca = $marca->selecionar($_SESSION['codOtica']);
			while ($row = mysqli_fetch_assoc($rsMarca)) {
				($row['COD_MARCA'] == $vfLente['COD_MARCA']) ? $selected = 'selected' : $selected = "";
			?>
				<option <?php echo $selected; ?> value="<?php echo $row['COD_MARCA']; ?>"><?php echo $row['DES_MARCA']; ?></option>
			<?php
			}
			?>
		</select>
	</label>
	
	<label>
		<p><span>Tipo de Lente:</span></p>
		<select name="pfCodTipoLente" id="pfCodTipoLente">
			<option value="">Selecione</option>
			<?php
			$tipoLente = NULL;
			$rsTipoLente = NULL;
			$row = NULL;
			
			$tipoLente = new TipoLenteCtr();
			$rsTipoLente = $tipoLente->selecionar($_SESSION['codOtica']);
			while ($row = mysqli_fetch_assoc($rsTipoLente)) {
				($row['COD_TIPO_LENTE'] == $vfLente['COD_TIPO_LENTE']) ? $selected = 'selected' : $selected = "";
			?>
				<option <?php echo $selected; ?> value="<?php echo $row['COD_TIPO_LENTE']; ?>"><?php echo $row['DES_TIPO_LENTE']; ?></option>
			<?php
			}
			?>
		</select>
	</label>
	
	<label>
		<p><span>Cor: </span></p>
		<select name="pfCodCor" id="pfCodCor">
			<option value="""">Selecione</option>
			<?php
			$cor = NULL;
			$rsCor = NULL;
			$row = NULL;
			
			$cor = new CorCtr();
			$rsCor = $cor->selecionar($_SESSION['codOtica']);
			while ($row = mysqli_fetch_assoc($rsCor)) {
				($row['COD_COR'] == $vfLente['COD_COR']) ? $selected = 'selected' : $selected = "";
			?>
				<option <?php echo $selected; ?> value="<?php echo $row['COD_COR']; ?>"><?php echo $row['DES_COR']; ?></option>
			<?php
			}
			?>
		</select>
	</label>
	
	<label>
		<p><span>Valor: </span></p>
		<input id='pfValLente' type='text' name='pfValLente' placeholder='Valor da Lente' size='32' maxlength='32' value="<?php echo str_replace(".",",",@$vfLente['VAL_LENTE']); ?>" />
	</label>
	
	
	<input type="submit" class="button" name="btn" id="btn" value="<?php echo $vfNomeBotao; ?>" /> 
	<?php echo $btExcluir; ?>		
</form>
