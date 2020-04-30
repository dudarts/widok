<script type="text/javascript" language="javascript" src="js/funcoes.js"></script>
<?php 
@session_start();
require_once("../controller/lancamentoCtr.php");
require_once("../controller/funcoes.php");
require_once("../controller/osCtr.php");

@$valorTotalAPagar	= fDecimalMySQL($_POST["pfValTotalAPagar"]);
@$valorMora			= fDecimalMySQL($_POST["pfValMora"]);
@$valorJuros		= fDecimalMySQL($_POST["pfValJuros"]);
@$valorDesconto		= fDecimalMySQL($_POST["pfValDesconto"]);
@$valorRecebido		= fDecimalMySQL($_POST["pfValRecebido"]);
@$valorTroco		= fDecimalMySQL($_POST["pfValTroco"]);
@$DesLancamento 	= $_POST["pfDesLancamento"];
@$valorParcela 		= fDecimalMySQL($_POST["pfValParcela"]);
@$numParcela 		= $_POST["pfNumParcela"];
@$flgUsaTroco 		= $_POST["pfValUsaTroco"];
@$codOs 			= $_POST["pfCodOS"];
@$numLancamento		= $_POST["pfNumLancamento"];
@$ultimaParcela		= $_POST["pfUltimaParcela"];
@$valorAux			= $valorRecebido;
if (($numParcela == 0) and ($valorRecebido < $valorTotalAPagar))
	$entrada = 1;
else
	$entrada = 0;


echo 'valorTotalAPagar: ' . $valorTotalAPagar . '<br>';
echo 'valorMora: ' . $valorMora . '<br>';
echo 'valorJuros: ' . $valorJuros . '<br>';
echo 'valorDesconto: ' . $valorDesconto . '<br>';
echo 'valorRecebido: ' . $valorRecebido . '<br>';
echo 'valorTroco: ' . $valorTroco . '<br>';
echo 'DesLancamento : ' . $DesLancamento  . '<br>';
echo 'valorParcela : ' . $valorParcela  . '<br>';
echo 'numParcela : ' . $numParcela  . '<br>';
echo 'flgUsaTroco : ' . $flgUsaTroco  . '<br>';
echo 'CodOS : ' . $codOs  . '<br>';
echo 'Qtd Parcelas: ' . $ultimaParcela . "<br>";
echo 'Lanc: ' . $numLancamento;
echo '<br>';
echo '<br>';

$objBaxia = new lancamentoCtr();
?>
<!--<table style="width:190px;">
	<tr>
		<td>PCL</td>
		<td>Nº LANCAMENTO</td>
		<td>DESCRIÇÃO</td>
		<td>VALOR</td>
		<td>PAGO</td>
	</tr>-->
<?php
while ($numParcela <= $ultimaParcela) {
	$pago = false;
	$numLancamento = $objBaxia->BuscaLancamento($_SESSION["codOtica"], $codOs, $numParcela);
	

	if ($numLancamento <> NULL) {
//		$objBaxia->baixa($numLancamento, $codOs, $numParcela, $valorMora, $valorJuros, $valorDesconto, $valorTotalAPagar, $_SESSION["codUsuario"], $DesLancamento);
	//echo "	<tr><td>$numParcela/$ultimaParcela</td><td>$numLancamento</td>";
	//echo "	Baixa $numParcela/$ultimaParcela<br>";

		if ($valorTroco > 0 and $flgUsaTroco == 1) {
			$lancamento = mysqli_fetch_assoc($objBaxia->selecionar($_SESSION["codOtica"], $numLancamento, 1));

			$diasEmAtraso		= $lancamento["DIAS"];
			
			if ($diasEmAtraso < 0) {
				$valorMora 		= fCalculaJuros($lancamento["VAL_PARCELA"], $configPorcentagemMora);
				$valorJuros 	= fCalculaJuros($lancamento["VAL_PARCELA"], $configPorcentagemJurosDiario);
				$valorParcela 	= $lancamento["VAL_PARCELA"] + $valorMora + $valorJuros - $valorDesconto;
				$DesLancamento	= "Baixa Progessiva com Atraso - " .  str_pad($numLancamento,5,0,STR_PAD_LEFT);
			} else {
				$valorMora 		= 0;
				$valorJuros 	= 0;
				$valorParcela 	= $lancamento["VAL_PARCELA"];
				$DesLancamento	= "Baixa Progressiva - " .  str_pad($numLancamento,5,0,STR_PAD_LEFT);
			}
			
			$valorDesconto 		= 0;
			$valorAux 			= number_format($valorRecebido, 2);
			$valorTotalAPagar 	= number_format($valorParcela, 2);
			$valorTroco 		= number_format($valorAux - $valorTotalAPagar, 2);
			$valorRecebido 		= number_format($valorTroco, 2);
			
			echo "Parcela: $numParcela ($diasEmAtraso)<br>";
			echo "Recebido: R$ $valorAux<br>";
			echo "Valor Parcela: R$ $valorTotalAPagar<br>";
			echo "Troco: $valorTroco<br>";
			echo "Des: $DesLancamento<br>";
			
			
			//if ($valorTroco < 0 ) {
				//$objBaxia->inserir($_SESSION["codOtica"], $codOs, $numParcela, abs($valorTroco), $_SESSION["codUsuario"]);
				//echo "-Gera nova Parcela " . $numParcela . " no valor de R$ " . abs($valorTroco);
				//$DesLancamento	= "Baixa Parcial - " .  str_pad($numLancamento,5,0,STR_PAD_LEFT);
				//$valorTroco = 0;
			//	break;	
			//}
			
			
			//echo "<td>$DesLancamento</td><td>$valorTotalAPagar</td><td>$valorRecebido</td></tr>";
		//} else {
		//	echo "parou";
		//	break;	
		}
		//$objBaxia->baixa($numLancamento, $codOs, $numParcela, $valorMora, $valorJuros, $valorDesconto, $valorTotalAPagar, $_SESSION["codUsuario"], $DesLancamento);

	} else {
		$pago = true;
		echo "Pacela $numParcela ---- PAGA ---<br>"	;
	}

	if ($valorAux < $valorTotalAPagar) {
		$valorTotalAPagar = $valorAux;
		$DesLancamento	= "Baixa Parcial - " .  str_pad($numLancamento,5,0,STR_PAD_LEFT);
	}
	
	if ($pago == false) {
	echo "	Baixa $numParcela/$ultimaParcela<br>";
	//$objBaxia->baixa($numLancamento, $codOs, $numParcela, $valorMora, $valorJuros, $valorDesconto, $valorTotalAPagar, $_SESSION["codUsuario"], $DesLancamento);
	}
	
	if ($valorTroco < 0 || $flgUsaTroco <> 1 ) {
		break;	
	}
	
	$numParcela++;
	echo "<br>";
}

	if ($valorTroco >= 0) {
		echo "<br>Troco: R$ $valorTroco";	
	} else {
		//$numParcela == 0 ? $numParcela : $numParcela--;
		//$objBaxia->inserir($_SESSION["codOtica"], $codOs, $numParcela, abs($valorTroco), $_SESSION["codUsuario"]);
		echo "<br>Gera nova Parcela " . $numParcela . " no valor de R$ " . abs($valorTroco);	
	}

exit();



//$objBaxia = new lancamentoCtr();
//while ($numParcela <= $ultimaParcela) {
//	$numLancamento = $objBaxia->BuscaLancamento($_SESSION["codOtica"], $codOs, $numParcela);
//	echo "$numParcela - Lanc: " . $numLancamento . "<br>";
//	$numParcela++;
//	if ($numLancamento <> NULL) { 
//		//echo $objBaxia->baixa($numLancamento, $codOs, $numParcela, $valorMora, $valorJuros, $valorDesconto, $valorRecebido, $_SESSION["codUsuario"], $DesLancamento);
//		echo "<br>Faz a Baixa da parcela ".($numParcela - 1) . " - Lanc $numLancamento <br>";
//	
//		if ($numParcela <= $ultimaParcela) {
//			if ($valorTroco > 0 and $flgUsaTroco == 1){
//				$lancamento = mysqli_fetch_assoc($objBaxia->selecionar($_SESSION["codOtica"], $numLancamento, 1));
//				
//				$diasEmAtraso		= $lancamento["DIAS"];
//				$valorDesconto 		= 0;
//				
//				if ($diasEmAtraso < 0) {
//					$valorMora 		= fCalculaJuros($lancamento["VAL_PARCELA"], $configPorcentagemMora);
//					$valorJuros 	= fCalculaJuros($lancamento["VAL_PARCELA"], $configPorcentagemJurosDiario);
//					$valorParcela 	= $lancamento["VAL_PARCELA"] + $valorMora + $valorJuros - $valorDesconto;
//				} else {
//					$valorMora 		= 0;
//					$valorJuros 	= 0;
//					$valorParcela 	= $lancamento["VAL_PARCELA"];
//				}
//				$valorTotalAux = $valorParcela;
//				$valorTroco < $valorParcela ? $valorRecebido = $valorTroco : $valorRecebido = $valorParcela;
//				
//				$DesLancamento  	= 'Baixa antecipada do Lanc. ' .  str_pad($numLancamento,5,0,STR_PAD_LEFT); 
//	
//				echo "-------------- Usa o troco R$ $valorTroco na parcela ".($numParcela)."<br>";
//				$valorTroco -= $valorTotalAux;
//				echo "Troco:::: $valorTroco<br>";
//				echo "Valor Parcela: $valorTotalAux<br>";
//			} else {
//				break;	
//			}
//		} else {
//			break;	
//		}
//	}
//	//$numParcela++;
//}
//
//	echo "$numParcela<br>";
//	//$numLancamento = $objBaxia->BuscaLancamento($_SESSION["codOtica"], $codOs, $numParcela);
//	
//	$valorTroco = $valorTroco*(-1);
//	//$numParcela--;
//	
//	if (($valorTroco > 0) and ($flgUsaTroco == 1) or ($entrada == 1)) {
//		$entrada == 1 ? $numParcela = 0 : $numParcela;
//		echo "--- Gera uma nova parcela $numParcela no valor de R$ $valorTroco <br>";
//		//echo $objBaxia->inserir($_SESSION["codOtica"], $codOs, $numParcela, $valorTroco, $_SESSION["codUsuario"]);
//	} else {
//		echo "Troco: $valorTroco<br>";
//	}
//	
//	if ($numParcela == $ultimaParcela) {
//		$objOS = new OsCtr();
//		//$objOS->alteraStatus($_POST["pfCodOS"], 3);
//		echo "OS Encerrada<br>";
//	}
?>
<script type="text/javascript" language="javascript">
	//print();
	
	//alert("oi");
	//redirecionar("pagina.php?m=3&op=29");
</script> 
<input class="button" type="button" value="Voltar" onClick="redirecionar('pagina.php?m=3&op=29');">