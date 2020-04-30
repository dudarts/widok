<?php
interface OsInt {
	public function selecionar($pCodOtica, $pCodBusca, $pCodTipoBusca, $pCodStatus);
	public function inserir($pCodUsuario, $pCodOtica, $pCodPessoa, $pCodArmacao, $pCodLente, $pDatPedido, $pDatEntrega, $pNumAm, $pNumPa, $pNumAv, $pNumPel, $pNumCo, $pNumDp, $pNumEsfericoOd, $pNumEsfericoOe, $pNumCilindroOd, $pNumCilindroOe, $pNumEixoOd, $pNumEixoOe, $pNumDpnOd, $pNumDpnOe, $pNumAdicao, $pValArmacao, $pNumAltura, $pValLente, $pValEntrada, $pValDesconto, $pValRestoEntrada, $pValTotal, $pQtdParcelas, $pObs, $pCodStatus, $pCodTipoPagamento, $pCodVendedorExterno, $pCodMedico, $pDiaPagamento, $pDesDependente);
	public function atualizar($pCodOs, $pCodUsuario, $pCodOtica, $pCodPessoa, $pCodArmacao, $pCodLente, $pDatPedido, $pNumAm, $pDatEntrega, $pNumPa, $pNumAv, $pNumPel, $pNumCo, $pNumDp, $pValEntrada, $pValDesconto, $pValRestoEntrada, $pValTotal, $pQtdParcelas, $pNumEsfericoOd, $pNumEsfericoOe, $pNumCilindroOd, $pNumCilindroOe, $pNumEixoOd, $pNumEixoOe, $pNumDpnOd, $pNumDpnOe, $pNumAdicao, $pNumAltura, $pObs, $pCodStatus, $pCodTipoPagamento, $pDesDependente
, $pCodVendedorExterno, $pCodMedico);
}
?>