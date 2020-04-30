<?php
	require_once("../model/paginaCls.php");
	
	class PaginaCtr {
		public static function getNomeSistema(){
			return PaginaCls::getNomeSistema();
		}

	public static function getTituloPagina($pMenu){
		$rsTitulo = PaginaCls::getTituloPagina($pMenu);
		$resultado = mysqli_fetch_assoc($rsTitulo);
		//$z = mysqli_fetch_assoc($rsTitulo)['DES_SUB_TITULO'];
		$arrayTitulo = array($resultado['DES_TITULO'], $resultado['DES_SUB_TITULO']);
		return $arrayTitulo;
	}
	
	public static function getPagina($pfMenu, $pfSubMenu){
		require_once("menuCtr.php");
		return MenuCtr::incluirPagina($pfMenu, $pfSubMenu);
/*		switch ($pfSubMenu) {
			case 6:
				return "pessoa";
				break;
			case 7:
				return "cidade";
				break;
			case 8:
				return "armacao";
				break;
			case 9:
				return "lente";
				break;
			case 10:
				return "tipoLente";
				break;
			case 11:
				return "cor";
				break;
			case 12:
				return "marca";
				break;
			case 16:
				return "listaOs";
				break;
			case 20:
				return "os";
				break;
			case 24:
				return "filial";
				break;
			case 25:
				return "usuario";
				break;
		}*/
	}
	
	public static function getMensgem($pfCodMsg){
		$rsMsg = PaginaCls::getMensagem($pfCodMsg)->fetch_array(MYSQLI_ASSOC);
		return $rsMsg["DES_MENSAGEM"];
	}

	public static function getERRO($pfCodMsg){
		$rsMsg = PaginaCls::getMensagem($pfCodMsg)->fetch_array(MYSQLI_ASSOC);
		return $rsMsg["FLG_ERRO"];
	}

	public static function getLogo($pCodOtica){
		$rsLogo = PaginaCls::getLogo($pCodOtica)->fetch_array(MYSQLI_ASSOC);
		return $rsLogo["URL_LOGO"];
	}
	
	public static function ocultaBusca($pMenu){
		$rsFlgOcultaBusca = PaginaCls::ocultaBusca($pMenu)->fetch_array(MYSQLI_ASSOC);
		return $rsFlgOcultaBusca["FLG_OCULTA_BUSCA"];
	}


}

?>