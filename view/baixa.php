<script type="text/javascript" language="javascript" src="js/funcoes.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-1.11.2.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.maskMoney.js"></script>
<?php
if (!isset($_GET["os"])) {
    ?>
    <script type="text/javascript" language="javascript">
        redirecionar("pagina.php?m=3&op=15");
    </script>
    <?php
} else {
    require_once("../controller/osCtr.php");

    if (!isset($p['pfCodOtica'])) {
        $p['pfCodOtica'] = $_SESSION['codOtica'];
    }

    $objOS = new OsCtr();
    $rsOS = $objOS->selecionar($_SESSION["codOtica"], $_GET["os"], 1, 1);
    $OS = mysqli_fetch_assoc($rsOS);

    if (mysqli_num_rows($rsOS) <> 1) {
        ?>
        <script type="text/javascript" language="javascript">
            //	redirecionar("pagina.php?m=3&op=15");
        </script>
        <?php
    } else {
        @session_start();
        require_once("../controller/osCtr.php");
        require_once("../controller/lancamentoCtr.php");
        require_once("../controller/funcoes.php");
        ?>

        <div class="divBloco">
            <div class="div20" id="ResumoOS">
                <h1>Resumo da OS<br/>Nº <?php echo $OS["COD_OS"]; ?></h1>
                <strong>Cliente:</strong> <?php echo $OS["CLIENTE"]; ?><br>
                <strong>CPF:</strong> <?php echo $OS["CPF"]; ?><br>
                <br>
                <strong>Aramação:</strong> <?php echo $OS["DES_ARMACAO"]; ?><br>
                <strong>Lente:</strong> <?php echo $OS["DES_LENTE"]; ?><br>
                <br>
                <strong>TOTAL DA COMPRA:</strong>
                R$ <?php echo number_format($OS["VAL_TOTAL"] + $OS["VAL_ENTRADA"], 2, ",", "."); ?><br><br>
                <strong>Obs:</strong><br>
                <?php echo $OS["OBS"]; ?>
            </div>
            <div class="div70">
                <table class="tableLancamento" id="tableLancamento" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <th style="width:40px;">LANC</th>
                        <th style="width:20px;">Nº</th>
                        <th style="width:80px;">VALOR</th>
                        <th style="width:80px">VENCIMENTO</th>
                        <th style="width:20px;">DIAS</th>
                        <th style="200px;"><!--BAIXA--></th>
                        <th></th>
                    </tr>
                    <?php
                    $codOS = $_GET["os"];
                    $objLancamento = new lancamentoCtr();

                    $rsLancamento = $objLancamento->selecionar($_SESSION["codOtica"], $codOS, 4);

                    while ($row2 = mysqli_fetch_array($rsLancamento)) {
                        $numParcela = $row2["NUM_PARCELA"];
                        $valParcela = fDecimalPHP($row2["VAL_PARCELA"]);
                        $diasVencido = $row2["DIAS"];

                        $numParcela == 0 ? $numParcela = "Entrada" : $numParcela;
                        $row2["VAL_PAGO"] == NULL ? $jaFoiPago = false : $jaFoiPago = true;

                        $class = "";
                        $classPago = "";
                        if ($jaFoiPago == false) {
                            $diasVencido < 0 ? $class = "vermelho" : $class = "";
                            $classPago = "negrito";
                        }

                        $pfCampo = "pfValorBaixa_" . $row2["COD_OS"] . "_" . $row2["NUM_PARCELA"];
                        ?>
                        <tr class="<?php echo $classPago; ?>">
                            <td><?php echo str_pad($row2["NUM_LANCAMENTO"], 6, 0, STR_PAD_LEFT); ?></td>
                            <td><?php echo $numParcela; ?></td>
                            <td><?php echo "R$ " . $valParcela; ?></td>
                            <td class="<?php echo $class; ?>"><?php echo $row2["DAT_VENCIMENTO"]; ?></td>
                            <?php
                            if ($jaFoiPago == false) {
                                ?>
                                <td class="<?php echo $class; ?>"><?php echo $row2["DIAS"]; ?></td>
                                <td>
                                    <form name="formOS" action="pagina.php?m=3&op=29" method="post" class="smart-blue">
                                        <input type="hidden" name="pfNumLancamento" id="pfNumLancamento"
                                               value="<?php echo $row2["NUM_LANCAMENTO"]; ?>">
                                        <input type="submit" class="imgSubmit" width="30"
                                               title="Fazer a baixa deste Lançamento" src="img/baixaPreto.png"
                                               value=" Baixar ">
                                    </form>
                                </td>
                                <?php
                            } else {
                                if ($row2["FLG_ESTORNO"] == 1) {
                                    echo "<td colspan='2'><div class='estorno' title='Lançamento Estornado'>S</div>" . " " . $row2["DES_BAIXA_LANCAMENTO"] . " por " . $row2["DES_NOME_ESTORNO"] . "</div>";
                                } else {

                                    switch ($row2["ATRASO"]) {
                                        case -1:
                                            $atraso = "Pagou com 01 dia de atraso.";
                                            $class = "vermelho";
                                            break;
                                        case 0 :
                                            $atraso = "Pagou no dia.";
                                            $class = "";
                                            break;
                                        case 1 :
                                            $atraso = "Pagou com 01 dia de antecedência.";
                                            $class = "";
                                            break;
                                        default :
                                            if ($row2["ATRASO"] < 0) {
                                                $msgAtraso = "atraso.";
                                                $class = "vermelho";
                                            } else {
                                                $msgAtraso = "antecedência.";
                                                $class = "";
                                            }

                                            $atraso = "Pagou com " . str_pad($row2["ATRASO"], 2, 0, STR_PAD_LEFT) . " dias de " . $msgAtraso;
                                            break;
                                    }

                                    ?>
                                    <td colspan="2" class="<?php echo $class; ?>" style="text-align:left;">
                                        <?php echo "R$ " . number_format($row2["VAL_PAGO"], 2, ',', '.') . ' em ' . $row2["DAT_PGTO"] . "." . $atraso; ?>
                                    </td>
                                    <?php
                                }
                            }
                            ?>

                            <td>
                                <?php
                                if ($jaFoiPago && $row2["FLG_ESTORNO"] != 1 && ($_SESSION['codPermissao'] == 1 || $_SESSION['codPermissao'] == 2)) {

                                    ?>
                                    <form name="formOS" action="../controller/estorno.php" method="post"
                                          class="smart-blue" onSubmit="return estorno();">
                                        <input type="hidden" name="pfNumLancamento" id="pfNumLancamento"
                                               value="<?php echo $row2["NUM_LANCAMENTO"]; ?>">
                                        <input type="hidden" name="pfBusca" id="pfBusca"
                                               value="<?php echo $row2["COD_OS"]; ?>">
                                        <input type="submit" class="imgSubmit" width="30" title="Estornar Lançamento"
                                               value=" Estornar "
                                               style="font-weight:bold; padding:3px; margin-top: -10px; color:#FF0004;">
                                    </form>
                                    <br>

                                    <form action="printRecibo.php" method="get" class="smart-blue"">
                                    <input type="hidden" name="lancamento"
                                           value="<?php echo $row2["NUM_LANCAMENTO"]; ?>">
                                    <input type="submit" class="imgSubmit" width="30"
                                           title="2ª Via Recibo deste Lançamento" value=" 2ª Via Recibo "
                                           style="font-weight:bold; padding:3px; margin-top: -10px;">
                                    </form>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <script type="text/javascript" language="javascript">
            //	$(document).ready(function() {
            jQuery(function ($) {
                $("input.inputValorBaixa").maskMoney({symbol: "R$", decimal: ",", thousands: "."});
            });
        </script>
        <?php
    }
}
?>	
