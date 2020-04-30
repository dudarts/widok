<?php
require_once("../model/conexaoCls.php");
require_once("../model/tipoLenteCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class TipoLenteCtr {
	private $m;
	
	public function cadastrar($pF){
		if ($pF) {
			$this->m = new TipoLenteCls();
			if ($this->m->inserir($pF['pfDesTipoLente'], $pF['pfCodOtica'])) {
				header('location:../view/pagina.php?m=1&op=10&msg=' . md5(3));
			}
		}
	}
	
	public function selecionar($pfCodOtica, $pfBusca, $pfCodTipoBusca){
		$this->m = new TipoLenteCls();
		return $this->m->selecionar($pfCodOtica, $pfBusca, $pfCodTipoBusca);
	}
	
	public function atualizar($pfCodTipoLente, $pfCodOtica, $pfDesTipoLente){
		$this->m = new TipoLenteCls();
		if ($this->m->atualizar($pfCodTipoLente, $pfCodOtica, $pfDesTipoLente)) {
			header('location:../view/pagina.php?m=1&op=10&msg=' . md5(3));
		}
	}
	
	public function excluir($pfCodTipoLente){
		$this->m = new TipoLenteCls();
		if ($this->m->excluir($pfCodTipoLente)) {
			header('location:../view/pagina.php?m=1&op=10&msg=' . md5(4));
		}
	}
}

$p = $_POST;
$obj = new TipoLenteCtr();

switch (@$_POST['btn']){
	case 'Salvar':
		$obj->cadastrar($p);
		break;
	case 'Atualizar':
		$obj->atualizar(@$p['pfCod'], @$p['pfDesTipoLente'], @$p['pfCodOtica'] );
		break;
	case 'Excluir':
		$obj->excluir($p['pfCod']);
		break;		
}
?>