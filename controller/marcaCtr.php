<?php
require_once("../model/conexaoCls.php");
require_once("../model/marcaCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class MarcaCtr {
	private $m;
	
	public function cadastrar($pF){
		if ($pF) {
			$this->m = new MarcaCls();
			if ($this->m->inserir($pF['pfDesMarca'], $pF['pfCodOtica'])) {
				header('location:../view/pagina.php?m=1&op=12&msg=' . md5(3));
			}
		}
	}
	
	public function selecionar($pfCodOtica, $pfBusca, $pfCodTipoBusca){
		$this->m = new MarcaCls();
		return $this->m->selecionar($pfCodOtica, $pfBusca, $pfCodTipoBusca);
	}
	
	public function atualizar($pfCodMarca, $pfCodOtica, $pfDesMarca){
		$this->m = new MarcaCls();
		if ($this->m->atualizar($pfCodMarca, $pfCodOtica, $pfDesMarca)) {
			header('location:../view/pagina.php?m=1&op=12&msg=' . md5(3));
		}
	}
	
	public function excluir($pfCodMarca){
		$this->m = new MarcaCls();
		if ($this->m->excluir($pfCodMarca)) {
			header('location:../view/pagina.php?m=1&op=12&msg=' . md5(4));
		}
	}
}

$p = $_POST;
$obj = new MarcaCtr();

switch (@$_POST['btn']){
	case 'Salvar':
		$obj->cadastrar($p);
		break;
	case 'Atualizar':
		$obj->atualizar(@$p['pfCod'], @$p['pfCodOtica'], @$p['pfDesMarca']);
		break;
	case 'Excluir':
		$obj->excluir($p['pfCod']);
		break;		
}
?>