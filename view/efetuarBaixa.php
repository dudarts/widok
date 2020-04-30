<script type="text/javascript" language="javascript" src="js/funcoes.js"></script>
<?php
@session_start();
require_once("../controller/lancamentoCtr.php");
require_once("../controller/funcoes.php");
require_once("../controller/osCtr.php");
require_once("../controller/paginaCtr.php");
require_once("../controller/oticaCtr.php");
require_once("../controller/pessoaCtr.php");

date_default_timezone_set("America/Bahia");

@$valorTotalAPagar = fDecimalMySQL($_POST["pfValTotalAPagar"]);
@$valorMora = fDecimalMySQL($_POST["pfValMora"]);
@$valorJuros = fDecimalMySQL($_POST["pfValJuros"]);
@$valorDesconto = fDecimalMySQL($_POST["pfValDesconto"]);
@$valorRecebido = fDecimalMySQL($_POST["pfValRecebido"]);
@$valorTroco = fDecimalMySQL($_POST["pfValTroco"]);
@$DesLancamento = $_POST["pfDesLancamento"];
@$valorParcela = fDecimalMySQL($_POST["pfValParcela"]);
@$numParcela = $_POST["pfNumParcela"];
@$flgUsaTroco = $_POST["pfValUsaTroco"];
@$codOs = $_POST["pfCodOS"];
@$numLancamento = $_POST["pfNumLancamento"];
@$ultimaParcela = $_POST["pfUltimaParcela"];
@$valorAux = $valorRecebido;

/*echo 'valorTotalAPagar: ' . $valorTotalAPagar . '<br>';
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
echo '<br>';*/
$objOtica = new OticaCtr();
$objBaxia = new lancamentoCtr();
$objOS = new OsCls();
$objPessoa = new PessoaCtr();

$os = mysqli_fetch_assoc($objOS->selecionar($_SESSION['codOtica'], $codOs, 1, 0));
$otica = mysqli_fetch_assoc($objOtica->selecionar($_SESSION['codOtica'], 1));
$pessoa = mysqli_fetch_assoc($objPessoa->selecionar($_SESSION['codOtica'], $os["COD_PESSOA"], 1, 1));



$endereco = "";

if ($otica["END_PESSOA"]) {
    $endereco .= $otica["END_PESSOA"] . ". ";
}
if ($otica["NUM_ENDERECO"]) {
    $endereco .= "Nº " . $otica["NUM_ENDERECO"] . ". ";
}
if ($otica["DES_BAIRRO"]) {
    $endereco .= "Bairro: " . $otica["DES_BAIRRO"] . ". ";
}
if ($otica["CEP"]) {
    $endereco .= "CEP: " . $otica["CEP"] . ". ";
}
if ($otica["COD_CIDADE"]) {
    $endereco .= $otica["DES_CIDADE"] . " - " . $otica["COD_ESTADO"] . ". ";
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Impressão de Recibos</title>
    <style>
        * {
            font-family: "Courier New";
        }

        div.PrintRecibo {
            text-align: center;
        }

        .PrintRecibo {
            width: 50%;
            margin: auto;

        }

        .PrintRecibo span {
            display: block;
        }

        table.PrintRecibo tr th {
            text-align: left;
        }

        @media print {
            #noprint {
                display: none;
            }

            * {
                font-family: "Courier New";
            }
        }

    </style>
</head>
<body>
<div class="PrintRecibo">
    <img id="printLogo" src="<?php echo PaginaCtr::getLogo($_SESSION['codOtica']); ?>"
         alt="widok - Sistema para Oticas">
    <span><?php echo $otica["NOM_PESSOA"]; ?></span>
    <span><?php echo $endereco; ?></span>

    <p>RECIBO<br><span>Sem valor fical</span></p>
    <div class="divLinha" style="text-align: left;">
        <div>
            <b>Nº OS: </b><?php echo $codOs; ?>
        </div>
        <div>
            <b>Cliente: </b><?php echo $pessoa["COD_PESSOA"] . " - " . $pessoa["NOM_PESSOA"]; ?>
        </div>
    </div>
</div>
<br>
<table class="PrintRecibo" border="0">
    <tr>
        <th>PCL</th>
        <th>Nº</th>
        <th>DESCRIÇÃO</th>
        <th>VALOR</th>
        <th>PAGO</th>
    </tr>
    <?php
    if ($codOs == "") {
        $objBaxia->baixa(NULL, NULL, NULL, NULL, NULL, NULL, $valorRecebido, $_SESSION["codUsuario"], $DesLancamento, $_SESSION['codOtica']);
        ?>
        <tr>
            <td></td>
            <td></td>
            <td><?php echo $DesLancamento; ?></td>
            <td><?php echo number_format($valorParcela, 2, ",", "."); ?></td>
            <td><?php echo number_format($valorRecebido, 2, ",", "."); ?></td>
        </tr>
        <?php
    } else {

        while ($numParcela <= $ultimaParcela) {
            $pago = false;
            $numLancamento = $objBaxia->BuscaLancamento($_SESSION["codOtica"], $codOs, $numParcela);

            if ($numLancamento <> NULL) {
                if ($valorTroco > 0 and $flgUsaTroco == 1) {
                    $lancamento = mysqli_fetch_assoc($objBaxia->selecionar($_SESSION["codOtica"], $numLancamento, 1));

                    $diasEmAtraso = $lancamento["DIAS"];

                    if ($diasEmAtraso < 0) {
                        $valorMora = fCalculaJuros($lancamento["VAL_PARCELA"], $configPorcentagemMora);
                        $valorJuros = fCalculaJuros($lancamento["VAL_PARCELA"], $configPorcentagemJurosDiario);
                        $valorParcela = $lancamento["VAL_PARCELA"] + $valorMora + $valorJuros - $valorDesconto;
                        $DesLancamento = "Baixa Progessiva com Atraso";
                    } else {
                        $valorMora = 0;
                        $valorJuros = 0;
                        $valorParcela = $lancamento["VAL_PARCELA"];
                        $DesLancamento = "Baixa Progressiva Antecipada";
                    }

                    $valorDesconto = 0;

                    $valorAux = $valorRecebido;
                    $valorTotalAPagar = $valorParcela;
                    $valorTroco = $valorAux - $valorTotalAPagar;
                    $valorRecebido = $valorTroco;
                }
            } else {
                $pago = true;
                $DesLancamento = "---- JÁ FOI PAGA ---";
                $valorParcela = 0;
                $valorTotalAPagar = 0;
            }

            if ($valorAux < $valorTotalAPagar) {
                $valorTotalAPagar = $valorAux;
                $DesLancamento = "Baixa Parcial - ";
            }

            echo "<tr>";
            echo "<td>$numParcela/$ultimaParcela</td>";
            echo "<td>" . str_pad($numLancamento, 5, 0, STR_PAD_LEFT) . "</td>";
            echo "<td>$DesLancamento</td>";
            echo "<td>" . number_format($valorParcela, 2, ",", ".") . "</td>";
            echo "<td>" . number_format($valorTotalAPagar, 2, ",", ".") . "</td>";
            echo "</tr>";

            if ($pago == false) {
                $objBaxia->baixa($numLancamento, $codOs, $numParcela, $valorMora, $valorJuros, $valorDesconto, $valorTotalAPagar, $_SESSION["codUsuario"], $DesLancamento, $_SESSION['codOtica']);
            }

            if ($valorTroco < 0 || $flgUsaTroco <> 1) {
                break;
            }

            $numParcela++;
        }
        $StringTroco = "";
        if ($valorTroco >= 0) {
            $StringTroco = "<br>TROCO: R$ " . number_format($valorTroco, 2, ",", ".");
        } else {
            echo "<tr>
				<td>$numParcela/$ultimaParcela</td>
				<td colspan='2'>
				NOVO Lanc. Complementar da Parcela $numParcela </td>
				<td>" . number_format(abs($valorTroco), 2, ",", ".") . "</td>
				<td></td>
			  </tr>";

            //$numParcela == 0 ? $numParcela : $numParcela--;
            $objBaxia->inserir($_SESSION["codOtica"], $codOs, $numParcela, abs($valorTroco), $_SESSION["codUsuario"]);
            //echo "<br>Gera nova Parcela " . $numParcela . " no valor de R$ " . abs($valorTroco);
        }
    }
    $date = date('d/m/Y H:i');
    ?>
    <tr>
        <td colspan="5" style="text-align:right;"><?php echo @$StringTroco; ?></td>
    </tr>
</table>
<h6><?php echo " Impresso em $date;" ?></h6>
<br>
<div id="noprint">
    <input class="button" type="button" id="idBtnFocus" value="Voltar" onClick="redirecionar('pagina.php?m=3&op=29');">
    <input class="button" type="button" id="idBtnFocus" value="Imprimir" onClick="javscript:print();">
</div>
<script type="text/javascript" language="javascript">
    document.getElementById("idBtnFocus").focus();
    //print();
    //redirecionar("pagina.php?m=3&op=29");
</script>
</body>
</html>