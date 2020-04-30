<?php
require_once("../model/cidadeCls.php");

class cidadeCtr {
	public static function selecionar($pCodCidade){
		return CidadeCls::selecionar($pCodCidade);
	}
}
?>