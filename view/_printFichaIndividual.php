<?php
//Inicia a sessão
session_start();
//Inclui as páginas externas necessárias
require_once("../controller/funcoes.php");
require_once("../controller/osCtr.php");
require_once("../controller/paginaCtr.php");
require_once("../controller/pessoaCtr.php");
require_once("../controller/cidadeCtr.php");
require_once("../controller/armacaoCtr.php");
require_once("../controller/lenteCtr.php");


if (isset($_GET['os'])) {
	$os = new OsCtr();
	$objOS = $os->selecionar($_SESSION['codOtica'], $_GET['os'], 1, 0)->fetch_array(MYSQLI_ASSOC);
} else {
//	header('location:../view/pagina.php?m=2&op=16');
}
?>
    <table border="0" cellpadding="0" cellspacing="0" id="printTabelaTopo">
      <tr>
        <td><img id="printLogo" src="<?php echo PaginaCtr::getLogo($_SESSION['codOtica']); ?>" alt="widok - Sistema para Oticas"></td>
        <td>
          <h1>Ordem de Serviço</h1>
          <div class="div100" style="text-align:left; font-size:75%; line-height:12px;">
          <small><strong>Data do Pedido: </strong><?php echo date_format(date_create($objOS['DAT_PEDIDO']), "d/m/Y H:m:s"); ?></small><br>
          <small><strong>Filial: </strong><?php echo $objOS['FILIAL']; ?></small><br>
          <small><strong>Vendedor: </strong><?php echo $objOS['VENDEDOR']; ?></small><br>
          </div>

        </td>
        <td>
          <h1>Número</h1>
          <span id="printSpanNumOs"><?php echo str_pad($objOS['COD_OS'], 5, "0",STR_PAD_LEFT); ?></span><br>
        </td>
      </tr>
    </table>
    <?php 
		$p = new PessoaCtr();
		$a = new ArmacaoCtr();
		$l = new LenteCtr();
		$pessoa = $p->selecionar($_SESSION['codOtica'], $objOS['COD_PESSOA'], 1, 1)->fetch_array(MYSQLI_ASSOC);
		$cidade = cidadeCtr::selecionar($pessoa['COD_CIDADE'])->fetch_array(MYSQLI_ASSOC);
		$tipoPessoa = TipoPessoaCtr::selecionar($pessoa['COD_TIPO_PESSOA'])->fetch_array(MYSQLI_ASSOC);
		$armacao = $a->selecionar($_SESSION['codOtica'], $objOS['COD_ARMACAO'], 1)->fetch_array(MYSQLI_ASSOC);;
		$lente = $l->selecionar($_SESSION['codOtica'], $objOS['COD_LENTE'], 1)->fetch_array(MYSQLI_ASSOC);;	
		?>
    <div class="divBloco">
      <div class="divLinha">
        <div class="div5">
          <div class="printLabel">Cód.</div>
          <div class="printDados"><?php echo $objOS['COD_PESSOA']; ?></div>
        </div>
        <div class="div35">
          <div class="printLabel">Nome</div>
          <div class="printDados" style="font-size:110%; font-weight:bolder;"><?php echo $objOS['CLIENTE']; ?></div>
        </div>
        <div class="div15">
          <div class="printLabel">CPF</div>
          <div class="printDados"><?php echo fMask($pessoa['CPF'], '###.###.###-##'); ?></div>
        </div>
        <div class="div15">
          <div class="printLabel">Data de Nascimento</div>
          <div class="printDados"><?php echo date_format(date_create($pessoa['DAT_NASCIMENTO']), 'd/m/Y'); ?></div>
        </div>
        <div class="div5">
          <div class="printLabel">Sexo</div>
          <div class="printDados"><?php echo $pessoa['COD_SEXO']; ?></div>
        </div>
        <div class="div10">
          <div class="printLabel">Tipo</div>
          <div class="printDados"><?php echo $tipoPessoa['DES_TIPO_PESSOA']; ?></div>
        </div>
                <div class="div15">
          <div class="printLabel">CEP</div>
          <div class="printDados"><?php echo fMask($pessoa['CEP'], '##.###-###'); ?></div>
        </div>

      </div>
      <div class="divLinha">
        <div class="div25">
          <div class="printLabel">Endereço</div>
          <div class="printDados"><?php echo $pessoa['END_PESSOA'] . ", " . $pessoa['NUM_ENDERECO']; ?></div>
        </div>
        <div class="div20">
          <div class="printLabel">Cidade</div>
          <div class="printDados"><?php echo $cidade['DES_CIDADE']; ?></div>
        </div>
        <div class="div5">
          <div class="printLabel">UF</div>
          <div class="printDados"><?php echo $cidade['COD_ESTADO']; ?></div>
        </div>
        <div class="div20">
          <div class="printLabel">E-mail</div>
          <div class="printDados"><?php echo $pessoa['DES_EMAIL']; ?></div>
        </div>
        <div class="div15">
          <div class="printLabel">Telefone</div>
          <div class="printDados"><?php echo fMask($pessoa['NUM_TELEFONE'], '(##) ####-####'); ?></div>
        </div>
        <div class="div15">
          <div class="printLabel">Celular</div>
          <div class="printDados"><?php echo fMask($pessoa['NUM_CELULAR'], '(##) ####-####'); ?></div>
        </div>
        
      </div>
    </div>
    <div class="divBloco">
      <div class="divLinha">
        <div class="div55">
          <div class="div100">
            <table border="0" class="tablePrintOS">
              <tr>
                <th>Valor da Armação</th>
                <td><small>(+) R$</small></td>
                <td><?php echo number_format($objOS['VAL_ARMACAO'], 2, ',', '.');  ?></td>
              </tr>
              <tr>
                <th>Valor da Lente</th>
                <td><small>(+) R$</small></td>
                <td><?php echo number_format($objOS['VAL_LENTE'], 2, ',', '.');  ?></td>
              </tr>
              <tr>
                <th>Entrada</th>
                <td><small>(-) R$</small></td>
                <td><?php echo number_format($objOS['VAL_ENTRADA'], 2, ',', '.');  ?></td>
              </tr>
              <tr>
                <th>Desconto</th>
                <td><small>(-) R$</small></td>
                <td><?php echo number_format($objOS['VAL_DESCONTO'], 2, ',', '.');  ?></td>
              </tr>
              <tr>
                <th>Parcelas (x<?php echo str_pad($objOS['QTD_PARCELAS'], 2, "0", STR_PAD_LEFT); ?>)</th>
                <td><small>(+) R$</small></td>
                <td><?php echo number_format($objOS['VAL_TOTAL']/$objOS['QTD_PARCELAS'], 2, ',', '.'); ?></td>
              </tr>
              <tr>
                <th>VALOR TOTAL</th>
                <td><small>(+) R$</small></td>
                <td><?php echo number_format($objOS['VAL_TOTAL'] + $objOS['VAL_ENTRADA'], 2, ',', '.'); ?></td>
              </tr>
            </table>
            </div>
            <div class="div95" style="/*border:#000000 solid 1px;*/ padding:5px;">
            	<strong>Forma de Pgto: </strong><?php echo $objOS['DES_TIPO_PAGAMENTO']; ?><br>
                <strong>Armação: </strong><?php echo $objOS['NUM_REFERENCIA'] . " - " . $objOS['DES_ARMACAO'] . "<small> (" . $objOS['MARCA_LENTE'] . ")</small>";  ?><br>
                <strong>Lentes: </strong><?php echo $objOS['DES_LENTE']  . "<small> (" . $objOS['MARCA_ARMACAO'] . ")</small>";  ?> <br>
                <strong>Cor da Lente: </strong><?php echo $objOS['DES_COR']; ?><br> 
            </div> 
            <div class="div95" style="border:#000000 solid 1px; padding:5px;font-size:10px;min-height:45px;">
            	<strong>Obs: </strong><?php echo $objOS['OBS']; ?>
            	
            </div>          
        </div>
        <div class="div5">&nbsp;</div>
        <div class="div40">
          <div class="divReceitaPrintOS">
            <table cellpadding="0" cellspacing="0">
              <tr>
                <th>OLHO</th>
                <th>ESFÉRICO</th>
                <th>CILÍNDRICO</th>
                <th>EIXO</th>
                <th>DNP</th>
              </tr>
              <tr>
                <th>OD</th>
                <td><?php echo number_format($objOS['NUM_ESFERICO_OD'], 2, ',', '.');  ?></td>
                <td><?php echo number_format($objOS['NUM_CILINDRO_OD'], 2, ',', '.');  ?></td>
                <td><?php echo number_format($objOS['NUM_EIXO_OD'], 2, ',', '.');  ?></td>
                <td><?php echo number_format($objOS['NUM_DPN_OD'], 2, ',', '.');  ?></td>
              </tr>
              <tr>
                <th>OE</th>
                <td><?php echo number_format($objOS['NUM_ESFERICO_OE'], 2, ',', '.');  ?></td>
                <td><?php echo number_format($objOS['NUM_CILINDRO_OE'], 2, ',', '.');  ?></td>
                <td><?php echo number_format($objOS['NUM_EIXO_OE'], 2, ',', '.');  ?></td>
                <td><?php echo number_format($objOS['NUM_DPN_OE'], 2, ',', '.');  ?></td>
              </tr>
              <tr>
                <th>ADICAO</th>
                <td><?php echo number_format($objOS['NUM_ADICAO'], 2, ',', '.');  ?></td>
                <th>ALTURA</th>
                <td colspan="2"><?php echo number_format($objOS['NUM_ALTURA'], 2, ',', '.');  ?></td>
              </tr>
            </table>
          </div>
          <div class="divReceitaPrintOS">
            <table>
              <tr>
                <th>PA</th>
                <td><?php echo number_format($objOS['NUM_PA'], 2, ',', '.');  ?></td>
                <th>PEL</th>
                <td><?php echo number_format($objOS['NUM_PEL'], 2, ',', '.');  ?></td>
              <tr>
                <th>AM</th>
                <td><?php echo number_format($objOS['NUM_AM'], 2, ',', '.');  ?></td>
                <th>CO</th>
                <td><?php echo number_format($objOS['NUM_CO'], 2, ',', '.');  ?></td>
              </tr>
              <tr>
                <th>AV</th>
                <td><?php echo number_format($objOS['NUM_AV'], 2, ',', '.');  ?></td>
                <th>DP</th>
                <td><?php echo number_format($objOS['NUM_DP'], 2, ',', '.');  ?></td>
              </tr>
            </table>
          </div>
          <div style="text-align:center !important; padding:4px; margin:auto; background:#D3D3D3;">
             <small style="font-size:12px;">DATA PREVISTA PARA A ENTREGA: </small>
             <h1 style="margin:0px;"><?php echo date_format(date_create($objOS['DAT_ENTREGA']), "d/m/y"); ?></h1>
          </div>
          
          <div class="div100" id="divAssinaturaPrintOS">
          	<span>Assinatura</span>
          </div>

        </div>
      </div>
    </div>

