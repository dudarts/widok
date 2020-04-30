<?php 
	interface CorLenteInt {
		public function selecionar($pCodOtica, $pCodCor);
		public function inserir($pDesCor, $pCodOtica);
		public function atualizar($pCodCor, $pDesCor, $pCodOtica);
	}
?>