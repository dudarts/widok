<?php
require_once("../model/conexaoCls.php");
require_once("../model/armacaoCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class ArmacaoCtr {
	public function cadastrar($pF){
		if ($pF) {
			$obj = new ArmacaoCls();
			if ($obj->inserir($pF['pfCodMarca'], $pF['pfDesArmacao'], $pF['pfNumReferencia'], str_replace(",",".",$pF['pfValArmacao']), $pF['pfCodOtica'] )) {
				header('location:../view/pagina.php?m=1&op=8&msg=' . md5(3));
			}
		}
	}
	
	public function selecionar($pfCodOtica, $pfBusca, $pfCodTipoBusca){
		$obj = new ArmacaoCls();
		return $obj->selecionar($pfCodOtica, isset($pfBusca) ? $pfBusca : "", isset($pfCodTipoBusca) ? $pfCodTipoBusca : 0);
	}
	
	public function atualizar($pfCodArmacao, $pfCodMarca, $pfDesArmacao, $pfNumReferencia, $pfValor, $pfCodOtica){
		$obj = new ArmacaoCls();
		if ($obj->atualizar($pfCodArmacao, $pfCodMarca, $pfDesArmacao, $pfNumReferencia, $pfValor, $pfCodOtica)) {
			header('location:../view/pagina.php?m=1&op=8&msg=' . md5(3));
		}
	}
	
	public function excluir($pfCodArmacao){
		$obj = new ArmacaoCls();
		if ($obj->excluir($pfCodArmacao)) {
			header('location:../view/pagina.php?m=1&op=8&msg=' . md5(4));
		}
	}

	public function atualizarQtd($pCodArmacao, $pQtdArmacao, $pCodUsuario, $pCodOs, $pAdiciona){
		$obj = new ArmacaoCls();
		
		if ($pAdiciona == 1)
			$qtd = $pQtdArmacao;
		else
			$qtd = -$pQtdArmacao;
			
		if ($obj->atualizarQtd($pCodArmacao, $qtd, $pCodUsuario, $pCodOs)) {
			header('location:../view/pagina.php?m=1&op=8&msg=' . md5(3));
		}
	}

}

$p = $_POST;
$obj = new ArmacaoCtr();

switch (@$_POST['btn']){
	case 'Salvar':
		$obj->cadastrar($p);
		break;
	case 'Atualizar':
		$obj->atualizar(@$p['pfCod'], $p['pfCodMarca'], $p['pfDesArmacao'], $p['pfNumReferencia'], str_replace(",",".",$p['pfValArmacao']), $p['pfCodOtica']);
		break;
	case 'Excluir':
		$obj->excluir($p['pfCod']);
		break;		
	case 'Adicionar':
		$obj->atualizarQtd($p['pfCodArmacao'], $p['pfQtdArmacao'], $p['pfCodUsuario'], $p['pfCodOs'], $p['pfAdiciona']);
		break;		

}
?>