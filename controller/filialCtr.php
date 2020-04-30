<?php
require_once("../model/conexaoCls.php");
require_once("../model/filialCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class FilialCtr {
	public function atualizar($p){
		$obj = new FilialCls();

		if (isset($p['pfCodOtica'])) {
			if (isset($p["pfBusca"])) {
				$filialFora = explode(",",$p["pfFiliaisSelecionadas"]);	
				
				for ($k = 0; $k < count($filialFora); $k++)
					$obj->deletar($p['pfCodOtica'], $filialFora[$k]);
								
				if (isset($p["pfCkbFilial"])) {
					for ($l = 0; $l < count($p["pfCkbFilial"]); $l++)
						$obj->inserir($p['pfCodOtica'], $p["pfCkbFilial"][$l], 0);
				}
			} else {	
				if (isset($p["pfCkbFilial"])) {
					$obj->deletar($p['pfCodOtica'], "");
					
					for ($i = 0; $i < count($p["pfCkbFilial"]); $i++)
						$obj->inserir($p['pfCodOtica'], $p["pfCkbFilial"][$i], 0);
	
				} else {
					$filialFora = explode(",",$p["pfFiliaisSelecionadas"]);
					
					for ($j = 0; $j < count($filialFora); $j++)
						$obj->deletar($p['pfCodOtica'], $filialFora[$j]);
				}
			}

			header('location:../view/pagina.php?m=22&op=24&msg=' . md5(3));
		}
	}
	
	public function selecionar($p){
		
	}
}

$p = $_POST;
$obj = new FilialCtr();

switch (@$_POST['btnSalvar']){
	case 'Salvar':
		$obj->atualizar($p);
		break;
}
?>