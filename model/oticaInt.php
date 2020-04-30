<?php
	interface OticaInt {
		public function selecionar($pCodBusca, $pCodTipoBusca);
		public function inserir($pDesOtica, $url, $urlLogo, $flgAtivo);
		public function atualizar($pCodOtica, $pDesOtica, $pUrl, $pUrlLogo, $pFlgAtivo);
	}
?>