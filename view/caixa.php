<?php
	require_once("../controller/lancamentoCtr.php");
	require_once("../controller/osCtr.php");
	require_once("../controller/funcoes.php");
//	$configPorcentagemMora = 2;
//	$configPorcentagemJurosDiario = 0.033;
	$aviso = "";
	$numRowsTodosLancs = 0;

	if ($_POST) {
		$numLacamento = $_POST["pfNumLancamento"];
		$objLancamento = new lancamentoCtr();
		
		$rsLancamento = $objLancamento->selecionar($_SESSION["codOtica"], $numLacamento, 1);
		
		if (mysqli_num_rows($rsLancamento) == 1) {
				$lancamento = mysqli_fetch_assoc($rsLancamento);
				$valorLancamento 	= $lancamento["VAL_PARCELA"];
				$codOS				= $lancamento["COD_OS"];
				$num_ParcelaAtual	= $lancamento["NUM_PARCELA"];
				$datVencimento		= $lancamento["DAT_VENCIMENTO"];
				$diasEmAtraso		= $lancamento["DIAS"];
				$valorDesconto		= $lancamento["VAL_DESCONTO_PARCELA"];
				
				$objOS = new OsCtr();
				$rsOS = $objOS->selecionar($_SESSION["codOtica"], $codOS, 1, 1);
				$OS = mysqli_fetch_assoc($rsOS);
				
				$objTodosLancs = new lancamentoCtr();
				$rsTodosLancs = $objTodosLancs->selecionar($_SESSION["codOtica"], $codOS, 4);	
				$numRowsTodosLancs = mysqli_num_rows($rsTodosLancs);
			
			if ($lancamento["DAT_PGTO"] <> NULL) {
				$aviso = '<div class="azul">Esta parcela foi paga em ' . $lancamento["DAT_PGTO"] . '</div>';
			} else {
				$aviso = "";
				
				if ($diasEmAtraso < 0) {
					$mora 	= fCalculaJuros($valorLancamento, $configPorcentagemMora);
					$juros 	= fCalculaJuros($valorLancamento, $configPorcentagemJurosDiario);
					$ValorTotal = $valorLancamento + $mora + $juros - $valorDesconto;
				} else {
					$ValorTotal = $valorLancamento;	
				}
			}
		} else {
			$aviso = '<div class="vermelho">Lançamento não encontrado!</div>';
			$valorLancamento 	= "";
			$codOS				= "";
			$num_ParcelaAtual	= "";
			$datVencimento		= "";
			$valorDesconto		= "";
		}
		
		
	}
?>
<script language="javascript" type="text/javascript" src="js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-1.11.2.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.maskMoney.js"></script>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){ 
		/* ao pressionar uma tecla em um campo que seja de class="pula" */ 
		$('.pula').keypress(function(e){ 
		/* * verifica se o evento é Keycode (para IE e outros browsers) * se não for pega o evento Which (Firefox) */ 
			var tecla = (e.keyCode?e.keyCode:e.which); 
			/* verifica se a tecla pressionada foi o ENTER */ 
			if(tecla == 13){ 
			/* guarda o seletor do campo que foi pressionado Enter */ 
				campo = $('.pula'); 
				/* pega o indice do elemento*/ 
				indice = campo.index(this); 
				/*soma mais um ao indice e verifica se não é null *se não for é porque existe outro elemento */ 
				if(campo[indice+1] != null){ 
				/* adiciona mais 1 no valor do indice */ 
					proximo = campo[indice + 1]; 
					/* passa o foco para o proximo elemento */ 
					proximo.focus(); 
					return false;
				} //else {
				//	return true;	
				//}
			//} else if (((tecla >= 48) && (tecla <= 57)) || (tecla == 44)) {
			//	return true;	
			} //else  {
				/* impede o sumbit caso esteja dentro de um form */ 
				//alert(this.id);
				//if (this.id == "btnSalvar") {
				//	e.preventDefault(e); 
				//	return false; 
				//} else {
				//	return true;	
				//}
			//}
		}) 
	})
	
	function ValidaFormCaixa(){
		if (document.getElementById("pfValParcela").value == "" || document.getElementById("pfValParcela").value == "0,00") {
			alert("O Valor da Parcela é Obrigatório");
			document.getElementById("pfValParcela").focus();
			return false;
		}

		if (document.getElementById("pfValRecebido").value == "" || document.getElementById("pfValRecebido").value == "0,00") {
			alert("O Valor Recebido é Obrigatório");
			document.getElementById("pfValRecebido").focus();
			return false;
		}

		if (document.getElementById("pfDesLancamento").value == "") {
			alert("A Descrição do Lançamento é Obrigatório");
			document.getElementById("pfDesLancamento").focus();
			return false;
		}

		if (document.getElementById("pfValTroco").value == "") {
			alert("O valor do troco ainda não foi calculado");
			document.getElementById("pfValTroco").focus();
			return false;
		}
		
		if (confirm("Confirma o Lançamento?")) {
			return true;	
		} else {
			return false;	
		}
	}
	
	function ValorRecebidoFocus(){
		document.getElementById("pfValRecebido").focus();
	}
</script>
<div class="div35" id="divFormCaixa" style="margin-right:15px;" >
	<div class="divLinha">
		<form name="formCaixa" action="" method="post" class="smart-blue">
			<fieldset>
				<legend>Buscar Lançamento</legend>
				<div class="divLinha">
					<div class="div45">
						<label>
						<p><span>Nº Lancamento:</span></p>
						<input type="text" name="pfNumLancamento" id="pfNumLancamento">
						</label>
					</div>
					<div class="div35">
						<label>
						<p><span>&nbsp;</span></p>
						<input type="submit" class="button" name="btn" id="btn" value="Pesquisar" />
						</label>
					</div>
				</div>
				<?php echo $aviso; ?>
			</fieldset>
		</form>
	</div>
	
	
	<!-- LANCAMENTOS DE TODAS AS PARCELAS. QUADRO ABAIXO DA BUSCA DO LANCAMENTO -->
	<?php
	if (@$codOS <> "") {
	?>
	<div class="divLinha">
		<fieldset>
			<legend>Todas as Parcelas desta OS <?php echo @$codOS; ?></legend>
				<strong>Cliente:</strong> <?php echo $OS["CLIENTE"]; ?><br>
				<strong>CPF:</strong> <?php echo $OS["CPF"]; ?><br>
				<strong>Aramação:</strong> <?php echo $OS["DES_ARMACAO"]; ?><br>
				<strong>Lente:</strong> <?php echo $OS["DES_LENTE"]; ?><br>
				<strong>TOTAL DA COMPRA:</strong> R$ <?php echo number_format($OS["VAL_TOTAL"] + $OS["VAL_ENTRADA"],2,",","."); ?><br>
				<strong>Obs: </strong><?php echo $OS["OBS"]; ?>
			<br><br>
			<?php
					if ($numRowsTodosLancs > 0) {
				?>
			<table class="tableLancamento" id="tableLancamento" cellpadding="0" cellspacing="0" border="0">
				<tr>
                    <th>PARCELA</th>
					<th>VENC</th>
					<th>VALOR</th>
					<th>PAGO</th>
				</tr>
				<?php 
			while ($row2 = mysqli_fetch_array($rsTodosLancs)){
				$numLacamento == $row2["NUM_LANCAMENTO"] ? $bkg = "#FFF500" : $bkg = "";
				
				$numParcela = $row2["NUM_PARCELA"];
				$diasVencido = $row2["DIAS"];
				
				$numParcela == 0 ? $numParcela = "E" : $numParcela;
				$row2["VAL_PAGO"] == NULL ? $jaFoiPago = false : $jaFoiPago = true;
				
				$class = "";
				$classPago = "";
				if ($jaFoiPago == false) {
					$diasVencido < 0 ? $class = "vermelho" : $class = "";
					$classPago = "negrito";
				}
				
				$pfCampo = "pfValorBaixa_" . $row2["COD_OS"] . "_" . $row2["NUM_PARCELA"];
			?>

                <tr class="<?php echo $classPago; ?>" style="background:<?php echo $bkg; ?>" <?php if ($jaFoiPago <> false) { ?> ondblclick="redirecionar('printRecibo.php?lancamento=<?php echo $row2["NUM_LANCAMENTO"]; ?>')" <?php } ?> >
                    <td nowrap><?php echo $numParcela; ?> - <?php echo str_pad($row2["NUM_LANCAMENTO"],5,0,STR_PAD_LEFT); ?></td>
					<td><span class="<?php echo $class; ?>"><?php echo $row2["DAT_VENCIMENTO"]; ?></span></td>
					<td><?php echo fDecimalPHP($row2["VAL_PARCELA"]); ?></td>
					<td nowrap>
						<?php 
						if ($row2["FLG_ESTORNO"] == 1) {
							echo "<div class='estorno' title='Lançamento Estornado'>S</div>" . " " . $row2["DES_BAIXA_LANCAMENTO"];
						} else {
							echo $jaFoiPago ? "R$ " . number_format($row2["VAL_PAGO"],2,',','.') . ' em ' . $row2["DAT_PGTO"] . "." : "";
						}
						
						?>
                    </td>
				</tr>
				<?php
				$ultimaParcela = $numParcela;
			}
			?>
			</table>
			<?php
		}
		?>
		</fieldset>
	</div>
	<?php
	}
	?>
</div>


<!-- Formulário do Caixa -->
<div class="div60">
	<form name="formCaixa"  id="formCaixa" action="efetuarBaixa.php" method="post" class="smart-blue" onSubmit="return ValidaFormCaixa();">
		<input type="hidden" name="pfHiddenValTotal" value="<?php echo @$ValorTotal; ?>">
		<input type="hidden" name="pfNumParcela" value="<?php echo @$num_ParcelaAtual; ?>">
		<input type="hidden" name="pfCodOS" value="<?php echo @$codOS; ?>">
		<input type="hidden" name="pfUltimaParcela" value="<?php echo @$ultimaParcela; ?>">
		<input type="hidden" name="pfNumLancamento" value="<?php echo @$numLacamento; ?>">
		<fieldset>
			<legend>Caixa</legend>
			<div class="divLinha">
				<div class="div20" style="margin-right:10px;">
					<label>
					<p><span>Valor:</span></p>
					<input type="text" name="pfValParcela" id="pfValParcela" class="pula" value="<?php echo number_format(@$valorLancamento, 2, ",","."); ?>" <?php echo @$valorLancamento <> "" ? "readonly" : ""; ?> onBlur="SubmitAjax('post','CaixaTotalAPagarAjax.php','formCaixa','divTotalAPagar')">
					</label>
				</div>
				<div class="div17" style="margin-right:10px;">
					<label>
					<p><span>Mora (+):</span></p>
					<input type="text" readonly name="pfValMora" id="pfValMora"  value="<?php echo number_format(@$mora, 2, ",","."); ?>">
					</label>
				</div>
				<div class="div17">
					<label>
					<p><span>Juros (+):</span></p>
					<input type="text" readonly name="pfValJuros" id="pfValJuros" value="<?php echo number_format(@$juros, 2, ",","."); ?>">
					</label>
				</div>
				<div class="div40">
					<label>
					<p><span>Descontos (-):</span></p>
					
					<div class="div25">
						<input checked type="radio" name="pfTipDesconto" id="pfTipDesconto" value="R"> R$
						<input type="radio" name="pfTipDesconto" id="pfTipDesconto" value="%"> %
					</div>
					<div class="div70">
					<input type="text" name="pfValDesconto" id="pfValDesconto" value="<?php echo number_format(@$valorDesconto, 2, ",",".");; ?>" onBlur="SubmitAjax('post','CaixaTotalAPagarAjax.php','formCaixa','divTotalAPagar')" <?php echo @$valorLancamento <> "" ? 'class="pula"' : "readonly"; ?>>
					</div>
					</label>
				</div>
			</div>
			<div class="divLinha">
				<div class="div35" id="divTotalAPagar">
					<label>
					<p><span>Total a Pagar:</span></p>
					<input type="text" readonly name="pfValTotalAPagar" id="pfValTotalAPagar" value="<?php echo number_format(@$ValorTotal, 2, ",","."); ?>">
					</label>
				</div>
				<div class="div35">
					<label>
					<p><span>Recebido (-):</span></p>
					<input type="text" name="pfValRecebido" id="pfValRecebido" class="pula" value="<?php echo ""; ?>" onBlur="SubmitAjax('post','CaixaTrocoAjax.php','formCaixa','divTroco'); SubmitAjax('post','CaixaSubmitAjax.php','formCaixa','divSubmitAjax')">
					</label>
				</div>
                <script>
					ValorRecebidoFocus();
				</script>
				<div class="div30" id="divTroco">
					<label>
					<p><span>Troco:</span></p>
					<input readonly type="text" name="pfValTroco" id="pfValTroco" onBlur="SubmitAjax('post','CaixaSubmitAjax.php','formCaixa','divSubmitAjax')" >
					</label>
				</div>
			</div>
			<div class="divLinha">
				<label>
				<p><span>Descrição do Lancamento:</span></p>
				<input type="text" name="pfDesLancamento" id="pfDesLancamento" maxlength="45" <?php echo @$valorLancamento <> "" ? 'value="Baixa do Lançamento ' .  str_pad($numLacamento,5,0,STR_PAD_LEFT) . '" readonly' : 'class="pula"'
				; ?> >
				</label>				
			</div>
			<div class="divLinha">
				<label>
					<input type="checkbox" name="pfValUsaTroco" id="pfValUsaTroco" class="pula" value="1">
					Utilizar o troco para saldo das próximas parcelas </label>
			</div>
			<div id="divSubmitAjax"></div>
		</fieldset>
	</form>
</div>
<script>
	$(function() {
		$('#pfValParcela').maskMoney({symbol:"R$",decimal:",",thousands:".", allowNegative: true});
		$('#pfValRecebido').maskMoney({symbol:"R$",decimal:",",thousands:".", allowNegative: true});
		$('#pfValDesconto').maskMoney({symbol:"R$",decimal:",",thousands:".", allowNegative: true});
	});
</script>