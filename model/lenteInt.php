<?php
	interface LenteInt {
		public function selecionar($pCodOtica, $pBusca, $pCodTipoBusca);
		public function inserir($pCodMarca, $pDesLente, $pCodTipoLente, $pValor, $pCodCor, $pCodOtica);
		public function atualizar($pCodLente, $pCodMarca, $pDesLente, $pCodTipo, $pValor, $pCodOtica, $pCodCor);
	}
?>