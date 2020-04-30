<?php 
@session_start();
	require_once("../controller/paginaCtr.php"); 
	require_once("../controller/usuarioCtr.php"); 
	require_once("../controller/pessoaCtr.php"); 
	require_once("../controller/permissaoCtr.php"); 
	
	if (@$_GET['cod']) {
		$rsUsuario = new UsuarioCtr();
		$vfUsuario = $rsUsuario->selecionar($_SESSION['codOtica'], $_GET['cod'], "","","", $_SESSION['codFilial'])->fetch_array(MYSQLI_ASSOC);
		$desabilita = 'readonly';
		$vfNomeBotao = "Atualizar Usuário";
		$vfAtualiza = '';
		$novo = false;
		$novo = false;
		//$btExcluir = '<input type="submit" class="buttonExcluir" name="btn" id="btnExcluir" value="Excluir" onClick="return validaFormUsuario(this.value);" />';
	} else {		
		$vfNomeBotao = "Gravar";
		$desabilita = "";
		$vfAtualiza = "";
		$novo = true;
//		$btExcluir = "";
	}
?>


<form action="../controller/usuario_g.php" method="post" name="formCadastro" id="formCadastro" class="smart-blue" onSubmit="return validaFormUsuario();">
	<input type="hidden" name="pfCodOtica" value="<?php echo $_SESSION['codOtica']; ?>">
	<input type="hidden" name="pfNovoCadastro" value="<?php echo $novo; ?>">
	<!--<input type="hidden" name="pfCod" value="<?php echo @$_GET['cod']; ?>">-->

	<div class="div35">	
	<?php echo $vfAtualiza; ?>
	
	<label>
		<p><span>Nome do Usuário: </span></p>
		<select <?php echo $desabilita; ?> name="pfCodPessoa" id="pfCodPessoa">
			<option value="">Selecione</option>
		<?php
			$objPessoa = new PessoaCtr();
			$rsPessoa = $objPessoa->selecionar($_SESSION['codOtica'],"","",1);
			
			while ($row = mysqli_fetch_array($rsPessoa)) {
				$row["COD_PESSOA"] == @$vfUsuario['COD_PESSOA'] ? $selecionado = "selected" : $selecionado = "";
		?>
			<option <?php echo $selecionado; ?>  value="<?php echo $row["COD_PESSOA"]; ?>"><?php echo $row["NOM_PESSOA"]; ?></option>
		<?php
			}
		?>
		</select>
	</label>

	<label>
		<p><span>Login:</span></p>
		<input <?php echo $desabilita; ?> type="text" name="pfCod" placeholder="nome.sobrenome" value="<?php echo @$vfUsuario['COD_USUARIO'];  ?>">
	</label>

	<label>
		<p><span>Permissão: </span></p>
		<select name="pfCodPermissao" id="pfCodPermissao">
			<option value="">Selecione</option>
		<?php
			$rsPermissao = PermissaoCtr::selecionar("");
			
			while ($row = mysqli_fetch_array($rsPermissao)) {
				$row["COD_PERMISSAO"] == @$vfUsuario['COD_PERMISSAO'] ? $selecionado = "selected" : $selecionado = "";
		?>
			<option <?php echo $selecionado; ?>  value="<?php echo $row["COD_PERMISSAO"]; ?>"><?php echo $row["DES_PERMISSAO"]; ?></option>
		<?php
			}
		?>
		</select>
	</label>
	
	<label>
		<p><span>Senha Antiga: </span></p>
		<?php $novo == true ? $tipo = "hidden" : $tipo = "password"; ?>
		<input id='pfSenhaAntiga' type='<?php echo $tipo; ?>' name='pfSenhaAntiga' placeholder='Digite sua senha antiga' maxlength='32' value="" />
	</label>

	<fieldset>
		<legend>Nova senha</legend>

		<label>
			<p><span>Senha: </span></p>
			<input id='pfSenha' type='password' name='pfSenha' placeholder='Digite sua nova senha' maxlength='32' value="" />
		</label>
	
		<label>
			<p><span>Confirmar Senha: </span></p>
			<input id='pfConfirmaSenha' type='password' name='pfConfirmaSenha' placeholder='Novamente a nova Senha' maxlength='32' value="" />
		</label>
	</fieldset>

	<label>
		<p><span></span></p>
		<?php @$vfUsuario["COD_STATUS"] == 1 ? $ativo = "checked" : $ativo = ""; ?>
		<input id='pfCodStatus' type='checkbox' name='pfCodStatus' <?php echo $ativo; ?> value="1">Ativo
	</label>
	
	 <label>
		<br>
		<br>
		<input type="submit" class="button" name="btn" id="btn" value="<?php echo $vfNomeBotao; ?>" /> 
		<?php //echo $btExcluir; ?>		
	</label> 
	</div>
	
	
	
	
</form>
