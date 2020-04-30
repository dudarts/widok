<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php
	require_once("../controller/tipoLenteCtr.php");
		
	if (!isset($p['pfCodOtica']))
			$p['pfCodOtica'] = $_SESSION['codOtica'];
	
	if (!isset($p['pfBusca'])) 
		$p['pfBusca'] = "";
		
	$listaTipoLente = new TipoLenteCtr();
	$rsTipoLente = $listaTipoLente->selecionar($p['pfCodOtica'], $p['pfBusca'], 2);
?>
	<table class="table">
		<tr>
			<td>CÓD</td>
			<td>DESCRIÇÃO</td>
		</tr>
	<?php
		while ($row = mysqli_fetch_array($rsTipoLente)){
	?>
		
		<tr onDblClick="redirecionar('../view/pagina.php?m=1&op=10&cod=<?php echo $row['COD_TIPO_LENTE']; ?>');">
			<td><?php echo $row['COD_TIPO_LENTE']; ?></td>
			<td style="text-align:left;"><?php echo $row['DES_TIPO_LENTE']; ?></td>
		</tr>
	<?php
		}
	?>
	</table>
