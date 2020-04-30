<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php
	require_once("../controller/lenteCtr.php");
		
	isset($p['pfCodOtica']) ? $p['pfCodOtica'] : $p['pfCodOtica'] = $_SESSION['codOtica'];
	isset($p['pfBusca']) ? $p['pfBusca'] : $p['pfBusca'] = "";
		
	$listaLente = new LenteCtr();
	$rsLente = $listaLente->selecionar($p['pfCodOtica'], $p['pfBusca'], 2);
?>
	<table class="table">
		<tr>
			<td>CÓD</td>
			<td>MODELO</td>
			<td>MARCA</td>
			<td>TIPO</td>

		</tr>
	<?php
		while ($row = mysqli_fetch_array($rsLente)){
	?>
		
		<tr onDblClick="redirecionar('../view/pagina.php?m=1&op=9&cod=<?php echo $row['COD_LENTE']; ?>');">
			<td><?php echo $row['COD_LENTE']; ?></td>
			<td style="text-align:left;"><?php echo $row['DES_LENTE']; ?></td>
			<td><?php echo $row['DES_MARCA']; ?></td>
			<td><?php echo $row['DES_TIPO_LENTE']; ?></td>

		</tr>
	<?php
		}
	?>
	</table>