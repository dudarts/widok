<?php
	require_once("../model/menuCls.php");
	require_once("funcoes.php");
	
	class MenuCtr {
		public static function menu(){
			return MenuCls::menu();
		}

		public static function subMenu($pMenuPai){
			return MenuCls::subMenu($pMenuPai);
		}
		
		public static function menuSair($opSair){
			if ($opSair == 5) {
				session_destroy();
				fPaginaInicial();
			}
		}
	}
?>