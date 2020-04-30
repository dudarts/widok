<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php
	require_once("../controller/armacaoCtr.php");
		
	isset($p['pfCodOtica']) ? $p['pfCodOtica'] : $p['pfCodOtica'] = $_SESSION['codOtica'];
	isset($p['pfBusca']) ? $p['pfBusca'] : $p['pfBusca'] = "";
		
	$listaArmacao = new ArmacaoCtr();
	$rsArmacao = $listaArmacao->selecionar($p['pfCodOtica'], $p['pfBusca'], 2);
?>
	<table class="table">
		<tr>
			<td>CÓD</td>
			<td>MODELO</td>
			<td>MARCA</td>
			<td>REFERENCIA</td>
			<td>QTD</td>

		</tr>
	<?php
		while ($row = mysqli_fetch_array($rsArmacao)){
	?>
		
		<tr onDblClick="redirecionar('../view/pagina.php?m=1&op=8&cod=<?php echo $row['COD_ARMACAO']; ?>');">
			<td><?php echo $row['COD_ARMACAO']; ?></td>
			<td style="text-align:left;"><?php echo $row['DES_ARMACAO']; ?></td>
			<td><?php echo $row['DES_MARCA']; ?></td>
			<td><?php echo $row['NUM_REFERENCIA']; ?></td>
			<td><?php echo $row['QTD_ARMACAO']; ?></td>

		</tr>
	<?php
		}
	?>
	</table>
