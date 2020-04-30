<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php
	require_once("../controller/corCtr.php");
		
	if (!isset($p['pfCodOtica']))
			$p['pfCodOtica'] = $_SESSION['codOtica'];
	
	if (!isset($p['pfBusca'])) 
		$p['pfBusca'] = "";
		
	$listaCor = new CorCtr();
	$rsCor = $listaCor->selecionar($p['pfCodOtica'], $p['pfBusca'], 2);
?>
	<table class="table">
		<tr>
			<td>CÓD</td>
			<td>DESCRIÇÃO</td>
		</tr>
	<?php
		while ($row = mysqli_fetch_array($rsCor)){
	?>
		
		<tr onDblClick="redirecionar('../view/pagina.php?m=1&op=11&cod=<?php echo $row['COD_COR']; ?>');">
			<td><?php echo $row['COD_COR']; ?></td>
			<td style="text-align:left;"><?php echo $row['DES_COR']; ?></td>
		</tr>
	<?php
		}
	?>
	</table>
