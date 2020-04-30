<?php
require_once("../controller/lancamentoCtr.php");
require_once("../controller/osCtr.php");

require_once("../controller/funcoes.php");

if (!isset($p['pfCodOtica'])) {
	$p['pfCodOtica'] = $_SESSION['codOtica'];
}

isset($p['pfBusca']) ? $p['pfBusca'] : $p['pfBusca'] = "";
	$objOS = new OsCtr();
	$rsOS = $objOS->selecionar($p['pfCodOtica'], $p['pfBusca'], 3, 0);
?>

<div id="divBaixa"></div>
<div id="divListaOSBaixaManual">
	<table id="tableOSLancamentos" cellpadding="0" cellspacing="0" border="0">
		<tr class="trThTableOSLancamentos"> 
			<!--<td><input type="checkbox" class="OS_class" name="ckbTodos_OS" id="ckbTodos_OS" onChange="marcarTodos(this.id, 'form_ListaOS');" value="0"></td>-->
			<th>OS</th>
			<th>CLIENTE</th>
			<th>VENDEDOR</th>
			<th>DATA DO PEDIDO</th>
			<th>RESUMO</th>
			<th></th>
		</tr>
		<?php
				while ($row = mysqli_fetch_array($rsOS, MYSQLI_ASSOC)){
					$codOS = $row['COD_OS'];
					$row['TOTAL'] == 0 ? $porcentagem = 0 : $porcentagem = ($row['PAGO']/$row['TOTAL']) * 100;
			?>
		<tr class="trTdTableOSLancamentos">
			<td style="width:60px;"><?php echo str_pad($codOS,5,0,STR_PAD_LEFT) ?></td>
			<td id="tdNome" style="text-align:left;"><?php echo $row['CLIENTE']; ?></td>
			<td ><?php echo fNomeCurto($row['VENDEDOR']); ?></td>
			<td ><?php echo $row['DAT_PEDIDO']; ?></td>
			<td style="text-align:left;width:290px;" valign="middle">
				<?php echo str_pad($row['PAGO'],2,0,STR_PAD_LEFT) . "/" . str_pad($row['TOTAL'],2,0,STR_PAD_LEFT) . " de R$ " . fDecimalPHP($row['VAL_PARCELA']); ?>
				<div style="height:15px; width:150px; background:#FFFFFF; border:#BFBFBF solid 1px; padding:3px; float:right;" >
					<div style="height:100%; width:<?php echo $porcentagem; ?>%; background:#47CB97; text-align:center;">
						<?php echo number_format($porcentagem,2,",","."); ?>%
					</div>
				</div>
			</td>
			<td>
				<div class="div40">
					<a href="pagina.php?m=3&op=21&os=<?php echo $codOS; ?>" title="Visualizar Parcelas">
						<img class="imgAcao" src="img/lista.png" alt="Visualizar Parcelas" >
						<span class="legenda">Parcelas</span>
					</a>
				</div>
				<div class="div60">
					<a href="printCarne.php?os=<?php echo $codOS; ?>" title="Imprimir Carnê" target="_blank">
						<img class="imgAcao" src="img/pgto/5.png" height="25" alt="Imprimir Carnê">
						<span class="legenda">Imprimir Carnê</span>
					</a>
				</div>
			</td>
		</tr>
		<?php
				}
			?>
	</table>
</div>
<!--<input type="button" class="button" value="Gerar Boletos para as OS selecionadas">--> 
<script type="text/javascript" language="javascript" src="js/funcoes.js"></script> 
<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$(".inputValorBaixa").maskMoney({symbol:"R$",decimal:",",thousands:"."});
	});
</script> 
