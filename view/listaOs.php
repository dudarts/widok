<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php
@session_start();
    date_default_timezone_set("America/Bahia");
	require_once("../controller/osCtr.php");
	require_once("../controller/funcoes.php");

if (!isset($p['pfCodOtica'])) {
	$p['pfCodOtica'] = $_SESSION['codOtica'];
}

isset($p['pfBusca']) ? $p['pfBusca'] : $p['pfBusca'] = "";
	$listaOs = new OsCtr();
	$rsOs = $listaOs->selecionar($p['pfCodOtica'], $p['pfBusca'], 3, 0);
?>

<form name="form_ListaOS" id="form_ListaOS" class="smart-blue">
	<table class="table">
		<tr>
			<!--<td><input type="checkbox" class="OS_class" name="ckbTodos_OS" id="ckbTodos_OS" onChange="marcarTodos(this.id, 'form_ListaOS');" value="0"></td>-->
			<td>NÚM</td>
			<td>CLIENTE/RESP</td>
			<td>VENDEDOR</td>
			<td>DATA</td>
			<td>STATUS</td>
			<td>AÇÃO</td>
		</tr>
		<?php
			while ($row = mysqli_fetch_array($rsOs, MYSQLI_ASSOC)){
				switch ($row["ATRASO"]) {
					case -1:
						$avisoAtraso = '<span class="vermelho">(Ontem)</span>' ;
						break;
					case 0:
						$avisoAtraso = '<span class="azul">(Hoje)</span>' ;
						break;
					case 1:
						$avisoAtraso = '<span class="verde">(Amanhã)</span>' ;
						break;
					default:
						$row["ATRASO"] < 1 ? $avisoAtraso = '<span class="vermelho">(' : $avisoAtraso = '<span class="preto">(';
						$avisoAtraso .= $row["ATRASO"] . ' dias)</span>';
						break;
				}
		?>
		<tr onDblClick="redirecionar('../view/pagina.php?m=2&op=20&cod=<?php echo $row['COD_PESSOA']; ?>&os=<?php echo $row['COD_OS']; ?>')">
			<!--<td><input type="checkbox" class="pfCheckBoxOS" name="pfCheckBoxOS" id="pfCheckBoxOS" value="<?php //echo $row['COD_OS']; ?>"></td>-->
			<td><?php echo $row['COD_OS']; ?></td>
			<td id="tdNome">
				<?php
					if ($row['DES_DEPENDENTE']) {
						echo "<b>" . $row['DES_DEPENDENTE'] . "</b><br>Responsável: ";
					}
				echo $row['CLIENTE'] . " (Cód: " . $row['COD_PESSOA'] . ")";
				?>
			</td>
			<td ><?php echo fNomeCurto($row['VENDEDOR']); ?></td>
			<td style="text-align:left; width:20%;" >
				<?php echo "<strong>Pedido:</strong> " . date_format(date_create($row['DAT_PEDIDO']), "d/m/y H:m"); ?>
                <br>
				<?php echo "<strong>Entrega:</strong> " . date_format(date_create($row['DAT_ENTREGA']), "d/m/y") . " " . $avisoAtraso ; ?>
            </td>
			<td ><?php echo $row['STATUS']; ?></td>
			<td style="text-align:center;">
				<?php 
				$tamDiv = 50;
				
				//if ($_SESSION['codUsuario'] == $row['COD_USUARIO']) {
				switch($_SESSION['codPermissao']) {
					case 1:
					case 2:
					case 3:
					$tamDiv = 33; 
				?>
					<div class="div<?php echo $tamDiv; ?>">
						<?php 
						switch ($_SESSION['codPermissao']) {
							case 1:
							case 2:
							case 3:
						?>
                        <img class="imgAcao" src="img/cancel.png" alt="Cancelar" title="Cancelar OS" onClick="alteraStatus(<?php echo $row['COD_OS']; ?>, 4, <?php echo $_SESSION['codPermissao']; ?>)">
						<span class="legenda">Cancelar</span>
					</div>
				<?php 
						}
					break;
				} 
				?>
				<div class="div<?php echo $tamDiv; ?>">
					<a href="printOS.php?os=<?php echo $row['COD_OS']; ?>" title="Imprimir OS" target="_blank" ><img class="imgAcao" src="img/imprimir.png" alt="Imprimir" title="Imprimir"></a>
					<span class="legenda">Imprimir</span>
				</div>
				<div class="div<?php echo $tamDiv; ?>">
					<?php 
					if ($row['COD_STATUS'] <> 2) {
						$f = "alteraStatus(" . $row['COD_OS'] . ", 2, " . $_SESSION['codPermissao'] .");";	
					} else {
						$f = "alertaOSEntregue();";	
					}
					?>
                    <img class="imgAcao" src="img/entrega.png" alt="Entregar" title="Entregar" onClick="<?php echo $f; ?>">
					<span class="legenda">Entregar</span>
				</div>
			</td>
		</tr>
		<?php
			}
		?>
	</table>
<br>
		<!--<input type="button" class="button" value="Gerar Boletos para as OS selecionadas">-->
</form>
