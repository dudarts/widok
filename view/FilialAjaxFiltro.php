<?php 
@session_start();
	require_once("../controller/pessoaCtr.php"); 

@$_POST["pfSoFilialCadastrada"] == 1 ? $tipoBusca = 'filial' : $tipoBusca = 'tipopessoa';
@$_POST["pfBusca"] == "" ? $_POST["pfBusca"] = "" : $_POST["pfBusca"];
	
?>
			<div class="div50">
			
			<table class="table">
				<tr>
					<th>Cód</th>
					<th>Nome</th>
					<th>Filial</th>
					<th>Matriz</th>
				</tr>
				<?php
				$pessoaJuridica = new PessoaCtr();
				$rsPessoaJuridica = $pessoaJuridica->todosPorTipo($_SESSION['codOtica'], $tipoBusca, 'J', $p['pfBusca']);
				$filialCadastradas = "";
				
				while ($row = mysqli_fetch_assoc($rsPessoaJuridica)) {
						($row['FLG_FILIAL'] <> 0) ? $selected = 'checked' : $selected = "";		
						
						if ($row["MATRIZ"] == 1 ) { 
							$img = '<img src="img/ok.png" class="imgAcao" alt="Ótica Matriz">';
							$desabilita = 'disabled';
							$nomeCampo = "pfCkbMatriz";
						} else {
							$img = '';
							$desabilita = '';						
							$nomeCampo = "pfCkbFilial[]";
							$filialCadastradas .= $row['COD_PESSOA'] . ",";
						}
						
						
						

				?>
				<tr>
					<td><?php echo $row['COD_PESSOA']; ?></td>
					<td style="text-align:left;"><?php echo $row['NOM_PESSOA']; ?></td>
					<td><input <?php echo $desabilita;  ?>  <?php echo $selected; ?>  type="checkbox" name="<?php echo $nomeCampo; ?>" id="<?php echo $nomeCampo; ?>" value="<?php echo $row['COD_PESSOA']; ?>"></td>
					<td><?php echo $img; ?></td>
				</tr>
				<?php
				}
				$filialCadastradas = substr($filialCadastradas,0,-1);
				?>
			</table>
				<input type="hidden" name="pfFiliaisSelecionadas" id="pfFiliaisSelecionadas" value="<?php echo $filialCadastradas; ?>">
			</div>



<!--<div class="div50">

<table class="table">
	<tr>
		<th>Cód</th>
		<th>Nome</th>
		<th>Filial</th>
		<th>Matriz</th>
	</tr>
	<?php
	$pessoaJuridica = new PessoaCtr();
	$rsPessoaJuridica = $pessoaJuridica->todosPorTipo($_SESSION['codOtica'], $tipoBusca, 'J', $_POST["pfBusca"]);
	
	while ($row = mysqli_fetch_assoc($rsPessoaJuridica)) {
			($row['FLG_FILIAL'] <> 0) ? $selected = 'checked' : $selected = "";
	?>
	<tr>
		<td><?php echo $row['COD_PESSOA']; ?></td>
		<td style="text-align:left;"><?php echo $row['NOM_PESSOA']; ?></td>
		<td><input <?php echo $selected; ?>  type="checkbox" name="" id="" value="<?php echo $row['COD_PESSOA']; ?>"></td>
		<td>
			<?php if ($row["MATRIZ"] == 1 ) { ?>
				<img src="img/ok.png" class="imgAcao" alt="Ótica Matriz">
			<?php } ?>
		</td>
	</tr>
	<?php
	}
	?>
</table>
</div>
-->