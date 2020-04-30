<?php
require_once("conexaoCls.php");

class MenuCls {
	public static function menu($pCodPermissao){
		$stringSQL = "SELECT M.* ";
		$stringSQL .= " FROM menu M ";
		$stringSQL .= " INNER JOIN menu_permissao MP ON (MP.COD_MENU = M.COD_MENU) ";
		$stringSQL .= " WHERE IFNULL(COD_MENU_PAI,0) = 0 ";
		$stringSQL .= " AND COD_PERMISSAO = " . $pCodPermissao ;
		
		$con = Conexao::getInstanciar();
		$recordSet = NULL;
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public static function subMenu($pMenuPai, $pCodPermissao){
//		$stringSQL = "SELECT * FROM menu WHERE COD_MENU_PAI = " . $pMenuPai . ";";

		$stringSQL = "SELECT M.* ";
		$stringSQL .= " FROM menu M ";
		$stringSQL .= " INNER JOIN menu_permissao MP ON (MP.COD_MENU = M.COD_MENU) ";
		$stringSQL .= " WHERE COD_MENU_PAI = " . $pMenuPai;
		$stringSQL .= " AND COD_PERMISSAO = " . $pCodPermissao ;


		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public static function incluirPagina($pMenu, $pMenuPai){
		$stringSQL = "SELECT URL_PAGINA FROM menu WHERE COD_MENU = " . $pMenu . " AND COD_MENU_PAI = " . $pMenuPai . ";";
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public static function listaMenu($op){
				$stringSQL = " SELECT F.COD_MENU, F.DES_MENU ";
				$stringSQL = $stringSQL . " FROM menu F ";
				$stringSQL = $stringSQL . " WHERE F.COD_MENU = " . $op;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public static function listaSubMenu($op){

		$stringSQL = " SELECT F.COD_MENU, F.DES_MENU ";
		$stringSQL = $stringSQL . " FROM menu F ";
		$stringSQL = $stringSQL . " INNER JOIN menu P on (P.COD_MENU = F.COD_MENU_PAI) ";
		$stringSQL = $stringSQL . " WHERE F.COD_MENU = " . $op;

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>