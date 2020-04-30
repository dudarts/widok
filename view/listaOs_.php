<?php 
@session_start();
$_SESSION['valorTotal'] = 0;
	require_once("../controller/osCtr.php"); 
	
	if (@$_GET['cod']) {
		$rsOs = new OsCtr();
		$pessoa = $rsOs->selecionar($_SESSION['codOtica'], $_GET['cod'], 1, 1)->fetch_array(MYSQLI_ASSOC);
		
		$vfNomeBotao = "Salvar";
		$vfAtualiza = '<label><p><span>Código:</span></p><input type="text" name="pfCod" disabled value="' . @$_GET['cod'] . '"></label>';
		//$btExcluir = '<input type="submit" class="buttonExcluir" name="btn" id="btnExcluir" value="Excluir" onClick="ConfirmaExcluir();" />';
	} else {
		$vfDesMarca = "";
		$vfNomeBotao = "Salvar";
		$vfAtualiza = "";
		$btExcluir = "";
	}

	if (@$rsOs) {
?>

<div>Nome: <span class="dadosOsis"><?php echo $pessoa['NOM_PESSOA']; ?></span></div>
<div>Endereço: <span class="dadosOsis"><?php echo $pessoa['END_PESSOA']; ?>, <?php echo $pessoa['NUM_ENDERECO']; ?> - CEP: <?php echo $pessoa['CEP']; ?>. <?php echo $pessoa['DES_CIDADE']; ?> - <?php echo $pessoa['COD_ESTADO']; ?></span></div>
<div>Data de Nascimento: <span class="dadosOsis"><?php echo date('d/m/Y', strtotime($pessoa['DAT_NASCIMENTO'])); ?></span></div>
<div>CPF: <span class="dadosOsis"><?php echo $pessoa['CPF']; ?></span></div>
<br>
<br>
<form action="../controller/osCtr.php" method="post" name="formOS" id="formOS" class="smart-blue" onSubmit="return validaForm(this.name);">
	<input type="hidden" name="pfCodUsuario" value="<?php echo $_SESSION['codUsuario']; ?>">
	<input type="hidden" name="pfCodOtica" value="<?php echo $_SESSION['codOtica']; ?>">
	<input type="hidden" name="pfCodOs" value="<?php echo @$_GET['cod']; ?>">
	
	<div class="blocoOS">
		<div class="tabelaOS">
			<fieldset>
				<legend>Receita</legend>
				<table class="receita">
					<tr>
						<td class="tdFundoAzul">OLHO</td>
						<td class="tdFundoAzul">ESFÉRICO</td>
						<td class="tdFundoAzul">CILÍNDRICO</td>
						<td class="tdFundoAzul">EIXO</td>
						<td class="tdFundoAzul">DNP</td>
					</tr>
					<tr>
						<td class="tdFundoAzul">OD</td>
						<td><input type='text' name='pfNumEsfericoOD' id='pfNumEsfericoOD' maxlength="7" ></td>
						<td><input type='text' name='pfNumCilindroOD' id='pfNumCilindroOD' maxlength="7" ></td>
						<td><input type='text' name='pfNumEixoOD' id='pfNumEixoOD' maxlength="7" ></td>
						<td><input type='text' name='pfNumDpnOD' id='pfNumDpnOD' maxlength="7" ></td>
					</tr>
					<tr>
						<td class="tdFundoAzul">OE</td>
						<td><input type='text' name='pfNumEsfericoOE' id='pfNumEsfericoOE' maxlength="7" ></td>
						<td><input type='text' name='pfNumCilindroOE' id='pfNumCilindroOE' maxlength="7" ></td>
						<td><input type='text' name='pfNumEixoOE' id='pfNumEixoOE' maxlength="7" ></td>
						<td><input type='text' name='pfNumDpnOE' id='pfNumDpnOE' maxlength="7" ></td>
					</tr>
					<tr>
						<td class="tdFundoAzul">ADICAO</td>
						<td><input type='text' name='pfNumAdicao' id='pfNumAdicao' maxlength="7" ></td>
						<td class="tdFundoAzul">ALTURA</td>
						<td colspan="2"><input type='text' name='pfNumAltura' id='pfNumAltura' maxlength="7" ></td>
					</tr>
				</table>
			</fieldset>
		</div>
		<div class="tabelaOS">
			<fieldset>
				<legend>Medidas</legend>
				<table class="receita">
					<tr>
						<td class="tdFundoAzul">PA</td>
						<td><input type='text' name='pfNumPa' id='pfNumPa' maxlength="7" ></td>
						<td class="tdFundoAzul">PEL</td>
						<td><input type='text' name='pfNumPel' id='pfNumPel' maxlength="7" ></td>
					<tr>
						<td class="tdFundoAzul">AM</td>
						<td><input type='text' name='pfNumAm' id='pfNumAm' maxlength="7" ></td>
						<td class="tdFundoAzul">CO</td>
						<td><input type='text' name='pfNumCo' id='pfNumCo' maxlength="7" ></td>
					</tr>
					<tr>
						<td class="tdFundoAzul">AV</td>
						<td><input type='text' name='pfNumAv' id='pfNumAv' maxlength="7" ></td>
						<td class="tdFundoAzul">DP</td>
						<td><input type='text' name='pfNumDp' id='pfNumDp' maxlength="7" ></td>
					</tr>
						</tr>
					
				</table>
			</fieldset>
		</div>
	</div>
	
	<div class="blocoOS">
		<div class="tabelaOS">
			<fieldset>
				<legend>Lentes e Armação</legend>
				<label>
					<p><span>Lentes:</span></p>
					<select name="pfCodLente" onChange="SubmitAjax('post','OSDadosFinanceirosAjax.php','formOS','OSDadosFinanceiros');">
						<option value="">Selecione uma Lente</option>
						<?php
							$rsLente = new LenteCtr();
							$lente = $rsLente->selecionar($_SESSION['codOtica'], "",0);
							while ($row =  mysqli_fetch_assoc($lente)) {
						?>
						<option value="<?php echo $row['COD_LENTE'] . "!@!" . $row['VAL_LENTE']; ?>"><?php echo $row['DES_LENTE']; ?></option>
						<?php
							}
						?>
					</select>
				</label>
				<label>
					<p><span>Armação:</span></p>
					<select name="pfCodArmacao" onChange="SubmitAjax('post','OSDadosFinanceirosAjax.php','formOS','OSDadosFinanceiros');">
						<option value="">Selecione uma Armação</option>
						<?php
							$rsArmacao = new ArmacaoCtr();
							$armacao = $rsArmacao->selecionar($_SESSION['codOtica'], "",0);
							while ($row =  mysqli_fetch_assoc($armacao)) {
						?>
						<option value="<?php echo $row['COD_ARMACAO'] . "!@!" . $row['VAL_ARMACAO']; ?>"><?php echo $row['DES_ARMACAO']; ?></option>
						<?php
							}
						?>
					</select>
				</label>
			</fieldset>
	
			<fieldset>
				<legend>Entrega:</legend>
				<label>
					<p><span>Data de Entrega:</span></p>
					<input type="date" name="pfDatEntrega" id="pfDatEntrega" >
				</label>
				<label>
					<p><span>Observações:</span></p>
					<textarea name="pfObs" id="pfObs" ></textarea>
				</label>
	
			</fieldset>
	
		</div>
		<div class="tabelaOS">
			<fieldset id="dadosFinanceiro">
				<legend>Financeiro</legend>
				<label>
				<p><span>Valor da Entrada <small>R$ (-)</small>:</span></p>
				<input type="text" name="pfValEntrada" id="pfValEntrada" >
				<input type="hidden" name="pfValRestoEntrada" id="pfValRestoEntrada" value="0">
				</label>
				<label>
				<p><span>Desconto <small>R$ (-)</small>:</span></p>
				<input type="text" name="pfValDesconto" id="pfValDesconto">
				</label>
				<div id="OSDadosFinanceiros">
					<label>
					<p><span>Valor da Lente <small>R$ (+)</small>:</span></p>
					<input type="text" name="valLente" id="valLente" value="" disabled>
					</label>
					<label>
					<p><span>Valor da Armação <small>R$ (+)</small>:</span></p>
					<input type="text" name="valArmacao" id="valArmacao" value="" disabled>
					</label>
					<label>
					<p><span><b>TOTAL <small>R$</small>:</b></span></p>
					<input type="text" name="pfValTotal" id="pfValTotal" value="<?php echo number_format($_SESSION['valorTotal'], 2, ',','.'); ?>" disabled style="font-size:150%; font-weight:bold;">
					</label>
				</div>
				<label>
					<input type="button" class="button" name="btnCalcular" id="btnCalcular" onClick="SubmitAjax('post','OSDadosFinanceirosAjax.php','formOS','OSDadosFinanceiros');" value="Calcular">
				</label>
				<label>
				<p><span>Forma de Pagamento:</span></p>
				<select name="fFormaPgto" onChange="SubmitAjax('post','OSDadosFinanceirosFormPgtoAjax.php','formOS','formaPgto');">
					<option value=""></option>
					<option value="1">À Vista</option>
					<option value="2">Boleto</option>
					<option value="3">Cartão</option>
					<option value="4">Cheque</option>
				</select>
				</label>
				
				<div id="formaPgto"></div>
			</fieldset>
		</div>
	</div>
	<input type="submit" class="button" name="btn" id="btn" value="<?php echo $vfNomeBotao; ?>" />
	<?php //echo $btExcluir; ?>
</form>
<?php
	}
	?>
<script>
	$(function() {
		$('#pfNumAm').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumPa').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumAv').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumPel').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumCo').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumDp').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumEsfericoOD').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumEsfericoOE').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumCilindroOD').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumCilindroOE').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumEixoOD').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumEixoOE').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumDpnOD').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumDpnOE').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumAdicao').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfNumAltura').maskMoney({decimal:',',thousands:'.', allowNegative:true});
		$('#pfValEntrada').maskMoney({symbol:"R$",decimal:",",thousands:"."});
		$('#pfValDesconto').maskMoney({symbol:"R$",decimal:",",thousands:"."});
		$('#pfValRestoEntrada').maskMoney({symbol:"R$",decimal:",",thousands:"."});
	});
</script>