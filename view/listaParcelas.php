
<?php
require_once("../controller/lancamentoCtr.php");
require_once("../controller/funcoes.php");

if (!isset($p['pfCodOtica'])) {
	$p['pfCodOtica'] = $_SESSION['codOtica'];
}

isset($p['pfBusca']) ? $p['pfBusca'] : $p['pfBusca'] = "";
	$objLancamento = new lancamentoCtr();
	$rsLancamento = $objLancamento->selecionar($p['pfCodOtica'], $p['pfBusca'], 3, 1);
?>
<div id="divBaixa"></div>

	<table class="table">
		<tr>
			<!--<td><input type="checkbox" class="OS_class" name="ckbTodos_OS" id="ckbTodos_OS" onChange="marcarTodos(this.id, 'form_ListaOS');" value="0"></td>-->
			<td>OS</td>
			<td>CLIENTE</td>
			<td>VENDEDOR</td>
			<td>DATA DO PEDIDO</td>
			<td>PARCELA</td>
			<td>VENCIMENTO</td>
			<td>VALOR</td>
			<td>AÇÃO</td>
		</tr>
		<?php
			while ($row = mysqli_fetch_array($rsLancamento, MYSQLI_ASSOC)){
		?>
		<tr>
			<!--<td><input type="checkbox" class="pfCheckBoxOS" name="pfCheckBoxOS" id="pfCheckBoxOS" value="<?php echo $row['COD_OS']; ?>"></td>-->
			<td><?php echo $row['COD_OS']; ?></td>
			<td id="tdNome"><?php echO $row['NOM_PESSOA']; ?></td>
			<td ><?php echo fNomeCurto($row['COD_USUARIO']); ?></td>
			<td ><?php echo $row['DAT_PEDIDO']; ?></td>
			<td ><?php echo $row['NUM_PARCELA'] == 0 ? "Entrada" : $row['NUM_PARCELA']; ?></td>
			<td ><?php echo $row['DAT_VENCIMENTO']; ?></td>
			<td ><?php echo "R$ " . fDecimalPHP($row['VAL_PARCELA']); ?></td>
			<td class="tdValorBaixa">
			<?php
				if ($row["VAL_PAGO"] == NULL) {
			?>
			<!--onSubmit="efetuaBaixa(this.name);"-->
			<form onSubmit="return efetuaBaixa();" name="form_ListaOS<?php echo $row['COD_OS']; ?>" id="form_ListaOS<?php echo $row['COD_OS']; ?>" class="smart-blue" method="post" action="baixaAjax.php" >
				<input type="hidden" name="pfNumParcela" id="pfNumParcela" value="<?php echo $row['NUM_PARCELA']; ?>" >
				<input type="hidden" name="pfCodOS" id="pfCodOS" value="<?php echo $row['COD_OS']; ?>" >
				<input type="text" class="inputValorBaixa" maxlength="7" name="pfValorBaixa" id="pfValorBaixa">
				<input type="submit" class="button" value="Baixa" >
			</form>
			<?php 
				} else {
			?>
				Pago R$ <?php echo fDecimalPHP($row["VAL_PAGO"]); ?><br>em <?php echo fDecimalPHP($row["DAT_PGTO"]); ?>
			<?php 
				}
			?>

			</td>
		</tr>
		<?php
			}
		?>
	</table>
		<!--<input type="button" class="button" value="Gerar Boletos para as OS selecionadas">-->
<script>
	$(function() {
		$('.inputValorBaixa').maskMoney({symbol:"R$",decimal:",",thousands:"."});
	});
</script>
<script type="text/javascript" language="javascript" src="js/funcoes.js"></script>