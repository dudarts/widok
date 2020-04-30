<?php
require_once("../model/conexaoCls.php");
require_once("../model/lenteCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class LenteCtr {
	public function cadastrar($p){
		if ($p) {
			$obj = new LenteCls();
			if ($obj->inserir($p['pfCodMarca'], $p['pfCodTipoLente'], $p['pfCodCor'], str_replace(",",".",$p['pfValLente']), $p['pfDesLente'], $p['pfCodOtica'])) {
				header('location:../view/pagina.php?m=1&op=9&msg=' . md5(3));
			}
		}
	}
	
	public function selecionar($pfCodOtica, $pfBusca, $pfCodTipoBusca){
		$obj = new LenteCls();
		return $obj->selecionar($pfCodOtica, isset($pfBusca) ? $pfBusca : "", isset($pfCodTipoBusca) ? $pfCodTipoBusca : 0);
	}
	
	public function atualizar($pCodLente, $pCodMarca, $pCodTipoLente, $pCodCor, $pValLente, $pDesLente, $pCodOtica){
		$obj = new LenteCls();
		if ($obj->atualizar($pCodLente, $pCodMarca, $pCodTipoLente, $pCodCor, $pValLente, $pDesLente, $pCodOtica)) {
			header('location:../view/pagina.php?m=1&op=9&msg=' . md5(3));
		}
	}
	
	public function excluir($pfCodLente){
		$obj = new LenteCls();
		if ($obj->excluir($pfCodLente)) {
			header('location:../view/pagina.php?m=1&op=9&msg=' . md5(4));
		}
	}
}

$p = $_POST;
$obj = new LenteCtr();

switch (@$_POST['btn']){
	case 'Salvar':
		$obj->cadastrar($p);
		break;
	case 'Atualizar':
		$obj->atualizar($p['pfCod'], $p['pfCodMarca'], $p['pfCodTipoLente'], $p['pfCodCor'], str_replace(",",".",$p['pfValLente']), $p['pfDesLente'], $p['pfCodOtica']);
		break;
	case 'Excluir':
		$obj->excluir($p['pfCod']);
		break;		
}
?>