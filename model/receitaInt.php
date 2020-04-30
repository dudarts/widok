<?php
	interface ReceitaInt {
		public function selecionar($pCodOtica, $pCodReceita);
		public function inserir($codOlho, $numEsferico, $numCilindro, $numEixo, $numDpn, $numAdicao, $numAltura, $codOtica);
		public function atualizar($codReceita, $codOlho, $numEsferico, $numCilindro, $numEixo, $numDpn, $numAdicao, $numAltura, $codOtica);
	}
?>