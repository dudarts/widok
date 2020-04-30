<?php
	require_once("../model/menuCls.php");
	require_once("funcoes.php");
	
	class MenuCtr {
		public static function menu($pCodPermissao){
			return MenuCls::menu($pCodPermissao);
		}

		public static function subMenu($pMenuPai, $pCodPermissao){
			return MenuCls::subMenu($pMenuPai, $pCodPermissao);
		}
		
		public static function sair(){
			session_destroy();
			fPaginaInicial();
		}
		
		public static function incluirPagina($pMenu, $pMenuPai){
			$pagina = mysqli_fetch_assoc(MenuCls::incluirPagina($pMenu, $pMenuPai));	
			return $pagina['URL_PAGINA'];
		}
		
		public static function listaMenu($op){
			$str = mysqli_fetch_assoc(MenuCls::listaMenu($op));
			return $str["DES_MENU"];
		}
	
		public static function listaSubMenu($op){
			$str = mysqli_fetch_assoc(MenuCls::listaSubMenu($op));
			return $str["DES_MENU"];
		}
	}
?>