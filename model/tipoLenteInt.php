<?php 
	interface TipoLenteInt {
		public function selecionar($pCodOtica, $pBusca, $pcodTipoBusca);
		public function inserir($pDesTipo, $pCodOtica);
		public function atualizar($pCodTipo, $pDesTipo, $pCodOtica);
	}
?>