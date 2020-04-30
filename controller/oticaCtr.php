<?php
require_once("../model/oticaCls.php");

class OticaCtr {
	
	public static function getCodOtica($pF){
		$otica = new OticaCls();
		$resultado = $otica->selecionar($pF, 2)->fetch_array(MYSQLI_ASSOC);
		return $resultado['COD_OTICA'];
	}
	
	public function selecionar($pCodOtica, $codTipoBusca){
		$otica = new OticaCls();
		return $otica->selecionar($pCodOtica, $codTipoBusca);
	}

	public function selecionarTodas(){
		$otica = new OticaCls();
		return $otica->selecionarTodas();
	}

}
?>