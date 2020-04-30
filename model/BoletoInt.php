<?php
	interface BoletoInt {
		public function selecionar($pCodOtica, $pCodBoleto);
		public function inserir($pCodConfigBoleto, $pCodOs, $pNumParcela, $pValBoleto, $pDatVencimento, $pDatBoleto, $pValMulta, $pValJuros, $pValPgto, $pDatPgto, $pFlgEstornado, $pCodUserBaixa, $pDatBaixa, $pDatArquivoRetorno); 		
		public function atualizar($pCodBoleto, $pCodConfigBoleto, $pCodOs, $pNumParcela, $pValBoleto, $pDatVencimento, $pDatBoleto, $pValMulta, $pValJuros, $pValPgto, $pDatPgto, $pFlgEstornado, $pCodUserBaixa, $pDatBaixa, $pDatArquivoRetorno);
	}
?>