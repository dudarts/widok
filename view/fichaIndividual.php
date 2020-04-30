<script language="javascript" type="text/javascript" src="js/funcoes.js"></script>
<?php
	require_once("../controller/pessoaCtr.php");
	require_once("../controller/tipoPessoaCtr.php");
	
if (!isset($p['pfCodOtica'])) {
	$p['pfCodOtica'] = $_SESSION['codOtica'];
}
$busca = "";
$tipoBusca = "";

isset($_GET['pfCodStatus']) ? $_GET['pfCodStatus']  : $_GET['pfCodStatus'] = "-1";

isset($_GET['pfCodPessoa']) ? $busca .= $_GET['pfCodPessoa']  : "";
$busca .= ",";
isset($_GET['pfNomPessoa']) ? $busca .= $_GET['pfNomPessoa']  : "";
$busca .= ",";
isset($_GET['pfCodTipoPessoa']) ? $busca .= $_GET['pfCodTipoPessoa']  : "";
$busca .= ",";
isset($_GET['pfCodSexo']) ? $busca .= $_GET['pfCodSexo']  : "";


		
	$listaPessoa = new PessoaCtr();
	$rsPessoa = $listaPessoa->selecionar($p['pfCodOtica'], $busca, 0, $_GET['pfCodStatus']);
?>
<form action="pagina.php?m=4&op=17" method="get" name="formPessoa" id="formCadastro" class="smart-blue" onSubmit="return validaForm(this.name);">
	<input type="hidden" name="m" value="<?php echo $_GET['m']; ?>">
    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>">
    <input type="hidden" name="pfCodOtica" value="<?php echo $_SESSION['codOtica']; ?>">

	<div class="div10">
        <label>
            <p><span>Código:</span></p>
            <input id='pfCodPessoa' type='text' name='pfCodPessoa' placeholder='Código' style="width:70%;" />
        </label>
    </div>

	<div class="div25">
        <label>
            <p><span>Nome:</span></p>
            <input id='pfNomPessoa' type='text' name='pfNomPessoa' placeholder='Nome ou CPF' />
        </label>
    </div>
	<div class="div14">
        <label>
            <p><span>Tipo:</span></p>
            <select name="pfCodTipoPessoa">
                <option value=""></option>
				<?php
                    $obj = TipoPessoaCtr::selecionar("");
                    while($row = mysqli_fetch_array($obj)){
                ?>
                    <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                <?php
                    }
                ?>
            </select>
        </label>
    </div>
	<div class="div10">
        <label>
            <p><span>Status:</span></p>
            <select name="pfCodStatus">
                <option value="-1"></option>
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </label>
    </div>
	<div class="div10">
        <label>
            <p><span>Sexo:</span></p>
            <select name="pfCodSexo">
                <option value=""></option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
        </label>
    </div>
	<div class="div14">
    	<p><span>&nbsp;</span></p>
        <input type="submit" class="button" value="Filtrar">
    </div>
	<div class="div14">
    	<p><span>&nbsp;</span></p>
        <input type="reset" class="button" value="Limpar">
    </div>
    
</form>    
    <table class="table">
		<tr>
			<td>CÓD</td>
			<td>NOME</td>
			<td>TIPO</td>
			<td>SEXO</td>
			<td>STATUS</td>
            <td>IMPRIMIR</td>
			
		</tr>
	<?php
		while ($row = mysqli_fetch_array($rsPessoa, MYSQLI_ASSOC)){
	?>
		
		<tr onDblClick="redirecionar('../view/printFichaIndividual.php?cod=<?php echo $row['COD_PESSOA']; ?>')">
			<td><?php echo $row['COD_PESSOA']; ?></td>
			<td id="tdNome" style="text-align:left;"><?php echo $row['NOM_PESSOA']; ?></td>
			<td width="8%"><?php echo $row['COD_TIPO_PESSOA']; ?></td>
			<td width="8%"><?php echo $row['COD_SEXO']; ?></td>
			<td width="8%">
			<?php 
			if ($row['COD_STATUS'] == 1) {
				echo "Ativo";
			} else {
				echo "<span class='obrigatorio'>Inativo</span>";	
			}
				?>
			</td>
            <td><a href="printFichaIndividual.php?cod=<?php echo $row['COD_PESSOA']; ?>" title="Imprimir"><img class="imgAcao" src="img/imprimir.png" alt="Imprimir"></a>
		</tr>
	<?php
		}
	?>
	</table>
