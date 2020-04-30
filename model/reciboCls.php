<?php

/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 24/04/16
 * Time: 19:00
 */
class Recibo
{
    public function selecionar($pCodOtica, $pCodBusca = null, $pTipoBusca = 0)
    {
        $stringSQL = " SELECT * FROM recibo ";
        $stringSQL .= " WHERE COD_OTICA = " . $pCodOtica;

        switch ($pTipoBusca) {
            case 1 :
                $stringSQL .= " AND COD_RECIBO = " . $pCodBusca;
                break;
            case 2 :
                $stringSQL .= " AND COD_RECIBO = ( ";
                $stringSQL .= " SELECT COD_RECIBO FROM recibo where cod_otica = " . $pCodOtica;
                $stringSQL .= " and NUM_LANCAMENTO = " . $pCodBusca . " limit 1 ); ";
                break;
        }


        //echo $stringSQL;
        $con = Conexao::getInstanciar();
        $recordSet = $con->executar($stringSQL);
        return $recordSet;
    }

    public function inserir($pCodOtica, $pCodRecibo, $pCodSequencia, $pNumParcela, $pNumLancamento, $pDesRecibo, $pValLancamento, $pValPago)
    {
        $stringSQL = "INSERT INTO recibo ";
        $stringSQL .= " (COD_RECIBO, ";
        $stringSQL .= " COD_SEQUENCIA, ";
        $stringSQL .= " NUM_PARCELA, ";
        $stringSQL .= " NUM_LANCAMENTO, ";
        $stringSQL .= " DES_RECIBO, ";
        $stringSQL .= " VAL_LANCAMENTO, ";
        $stringSQL .= " VAL_PAGO, ";
        $stringSQL .= " COD_OTICA, ";
        $stringSQL .= " DAT_RECIBO) ";
        $stringSQL .= " VALUES ";
        $stringSQL .= " ('$pCodRecibo', ";
        $stringSQL .= " '$pCodSequencia', ";
        $stringSQL .= " '$pNumParcela', ";
        $stringSQL .= " '$pNumLancamento', ";
        $stringSQL .= " '$pDesRecibo', ";
        $stringSQL .= " '$pValLancamento', ";
        $stringSQL .= " '$pValPago', ";
        $stringSQL .= " '$pCodOtica', ";
        $stringSQL .= " NOW()); ";

        $con = Conexao::getInstanciar();
        $recordSet = $con->executar($stringSQL);
        return $recordSet;

    }

    public function ultimoRecibo()
    {
        $stringSQL = "SELECT IFNULL(MAX(COD_RECIBO), 0) COD_RECIBO FROM recibo";

        $con = Conexao::getInstanciar();
        $recordSet = $con->executar($stringSQL)->fetch_array();
        return $recordSet["COD_RECIBO"];

    }
}