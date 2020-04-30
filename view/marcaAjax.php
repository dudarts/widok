<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php
@session_start();

	require_once("../controller/marcaCtr.php");
		
	if (!isset($p['pfOtica']))
			$p['pfOtica'] = $_SESSION['codOtica'];
	
	if (!isset($p['pfBusca'])) 
		$p['pfBusca'] = "";
		
	$listaMarca = new MarcaCtr();
	$rsMarca = $listaMarca->selecionar($p['pfOtica'], $p['pfBusca'], 2);
?>
	<table class="table">
		<tr>
			<td>CÓD</td>
			<td>DESCRIÇÃO</td>
		</tr>
	<?php
		while ($row = mysqli_fetch_array($rsMarca)){
	?>
		
		<tr onDblClick="redirecionar('../view/pagina.php?m=1&op=12&cod=<?php echo $row['COD_MARCA']; ?>');">
			<td><?php echo $row['COD_MARCA']; ?></td>
			<td style="text-align:left;"><?php echo $row['DES_MARCA']; ?></td>
		</tr>
	<?php
		}
	?>
	</table>
