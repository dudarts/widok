<?php
require_once("../model/conexaoCls.php");

class PaginaCls {
	public static function getNomeSistema(){
		return "widok - Sistema de Os para Óticas";
	}
	
	public static function getTituloPagina($pMenu){
		$stringSQL = "SELECT DES_TITULO, DES_SUB_TITULO FROM menu WHERE COD_MENU = " . $pMenu . ";";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
	}
	
	public static function getMensagem($codMsg){
		$stringSQL = "SELECT DES_MENSAGEM, FLG_ERRO FROM mensagem WHERE md5(COD_MENSAGEM) = '" . $codMsg . "';";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
			
	}

	public static function getLogo($pCodOtica){
		$stringSQL = "SELECT URL_LOGO FROM otica WHERE COD_OTICA = '" . $pCodOtica . "';";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
			
	}

	public static function ocultaBusca($pMenu){
		$stringSQL = "SELECT FLG_OCULTA_BUSCA FROM menu WHERE COD_MENU = " . $pMenu . ";";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
	}
	
}
?>