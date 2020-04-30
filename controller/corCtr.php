<?php
require_once("../model/conexaoCls.php");
require_once("../model/corCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class CorCtr {
	public function cadastrar($pF){
		if ($pF) {
			$obj = new CorCls();
			if ($obj->inserir($pF['pfDesCor'], $pF['pfCodOtica'] )) {
				header('location:../view/pagina.php?m=1&op=11&msg=' . md5(3));
			}
		}
	}
	
	public function selecionar($pfCodOtica, $pfBusca, $pfCodTipoBusca){
		$obj = new CorCls();
		return $obj->selecionar($pfCodOtica, isset($pfBusca) ? $pfBusca : "", isset($pfCodTipoBusca) ? $pfCodTipoBusca : 0);
	}
	
	public function atualizar($pfCodCor, $pfDesCor, $pfCodOtica){
		$obj = new CorCls();
		if ($obj->atualizar($pfCodCor, $pfDesCor, $pfCodOtica)) {
			header('location:../view/pagina.php?m=1&op=11&msg=' . md5(3));
		}
	}
	
	public function excluir($pfCodCor){
		$obj = new CorCls();
		if ($obj->excluir($pfCodCor)) {
			header('location:../view/pagina.php?m=1&op=11&msg=' . md5(4));
		}
	}
}

$p = $_POST;
$obj = new CorCtr();

switch (@$_POST['btn']){
	case 'Salvar':
		$obj->cadastrar($p);
		break;
	case 'Atualizar':
		$obj->atualizar(@$p['pfCod'], $p['pfDesCor'], $p['pfCodOtica']);
		break;
	case 'Excluir':
		$obj->excluir($p['pfCod']);
		break;		
}
?>