<?php
	interface ConfigBoletoInt {
		public function selecionar($pCodOtica, $pCodConfigBoleto);
		public function inserir($pCodOtica, $pFlgPrincipal, $pQtdDiasVencimento, $pCodBanco, $pDesCedente, $pNumAgencia, $pDesAgencia, $pNumConta, $pDesLocalPgto, $pCodDocEspecie, $pCodCarteira, $pDesMensagem, $pFlgAtivo, $pDesConfigBoleto); 		
		public function atualizar($pCodConfigBoleto, $pCodOtica, $pFlgPrincipal, $pQtdDiasVencimento, $pCodBanco, $pDesCedente, $pNumAgencia, $pDesAgencia, $pNumConta, $pDesLocalPgto, $pCodDocEspecie, $pCodCarteira, $pDesMensagem, $pFlgAtivo, $pDesConfigBoleto);
	}
?>