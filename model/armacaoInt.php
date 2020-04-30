<?php
interface ArmacaoInt {
	public function selecionar($pCodOtica, $pBusca, $pCodTipoBusca);
	public function inserir($pCodMarca, $pDesArmacao, $pNumReferencia, $pValor, $pCodOtica); 		
	public function atualizar($pCodArmacao, $pCodMarca, $pDesArmacao, $pNumReferencia, $pValor, $pCodOtica);
}
?>