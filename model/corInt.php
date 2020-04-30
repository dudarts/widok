<?php
interface CorInt {
	public function selecionar($pCodOtica, $pBusca, $pCodTipoBusca);
	public function inserir($pDesCor, $pCodOtica);
	public function atualizar($pCodCor, $pDesCor, $pCodOtica);
	public function excluir($pCodCor);
}
?>