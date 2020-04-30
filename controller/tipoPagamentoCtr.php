<?php
require_once("../model/conexaoCls.php");
require_once("../model/tipoPagamentoCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class TipoPagamentoCtr {
	public static function selecionar($pfBusca, $pfCodTipoBusca){
		return TipoPagamentoCls::selecionar(isset($pfBusca) ? $pfBusca : "", isset($pfCodTipoBusca) ? $pfCodTipoBusca : 0);
	}
}
?>