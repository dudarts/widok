<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php
@session_start();
	require_once("../controller/usuarioCtr.php");
		
	if (!isset($p['pfCodOtica']))
			$p['pfCodOtica'] = $_SESSION['codOtica'];
	
	if (!isset($p['pfBusca']))
		$p['pfBusca'] = "";
		
		
	$listaUsuario = new UsuarioCtr();
	$rsUsuario = $listaUsuario->selecionar($p['pfCodOtica'], $p['pfBusca'], "", "", 1, $_SESSION['codFilial']);
	
?>
	<table class="table">
		<tr>
			<th>CÓD</th>
			<th>NOME</th>
			<th>COD_USUARIO</th>
			<th>STATUS</th>
		</tr>
	<?php
		while ($row = mysqli_fetch_array($rsUsuario)){
	?>
		
		<tr onDblClick="redirecionar('../view/pagina.php?m=22&op=25&cod=<?php echo $row['COD_USUARIO']; ?>');">
			<td><?php echo $row['COD_PESSOA']; ?></td>
			<td style="text-align:left;"><?php echo $row['NOM_PESSOA']; ?></td>
			<td><?php echo $row['COD_USUARIO']; ?></td>
			<td><?php echo $row['COD_STATUS']; ?></td>
		</tr>
	<?php
		}
	?>
	</table>
