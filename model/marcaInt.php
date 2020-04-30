<?php 
require_once('conexaoCls.php');

interface MarcaInt {
		public function selecionar($pCodOtica, $pCodMarca);
		public function inserir($pDesMarca, $pCodOtica);
		public function atualizar($pCodMarca, $pCodOtica);
}
?>