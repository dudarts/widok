<?php
require_once("../model/conexaoCls.php");
require_once("../model/pessoaCls.php");
require_once("../model/tipoPessoaCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class PessoaCtr{
	private $m;
	
	public function cadastrar($pF){
		if ($pF) {
			$this->m = new PessoaCls();
			if ($this->m->inserir($pF['pfCodOtica'], @$pF['pfCodTipoPessoa'], $pF['pfCodCidade'], $pF['pfEndPessoa'], $pF['pfNumEndereco'], $pF['pfCep'], $pF['pfCpf'], $pF['pfNomMae'], $pF['pfNomPessoa'], $pF['pfDatNascimento'], $pF['pfNumTelefone'], $pF['pfNumCelular'], $pF['pfDesEmail'], ($pF['pfCodStatus'] == 1) ? $pF['pfCodStatus'] : 0, $pF['pfCodSexo'], $pF['pfFlgExterno'], $pF['pfDesBairro'], $pF['pfFlgMedico'])) {;
				header('location:../view/pagina.php?m=1&op=6&msg=' . md5(3));
			} else {
				echo "Erro na gravação";	
			}
		}
	}
	
	public function selecionar($pfCodOtica, $pfBusca, $codTipoBusca, $pCodStatus){
		$obj = new PessoaCls();
		return $obj->selecionar($pfCodOtica, $pfBusca, $codTipoBusca, $pCodStatus);
	}

	public function atualizar($pF){
		if ($pF) {
			$this->m = new PessoaCls();
			if ($this->m->atualizar($pF['pfCod'], $pF['pfCodOtica'], $pF['pfCodTipoPessoa'], $pF['pfCodCidade'], $pF['pfEndPessoa'], $pF['pfNumEndereco'], $pF['pfCep'], $pF['pfCpf'], $pF['pfNomMae'], $pF['pfNomPessoa'], $pF['pfDatNascimento'], $pF['pfNumTelefone'], $pF['pfNumCelular'], $pF['pfDesEmail'], $pF['pfCodStatus'] == "" ? 0 : $pF['pfCodStatus'], $pF['pfCodSexo'], $pF['pfFlgExterno'], $pF['pfDesBairro'], $pF['pfFlgMedico'])) {;
				header('location:../view/pagina.php?m=1&op=6&msg=' . md5(5));
			} else {
				echo "Erro na gravação";	
			}
		}
	}
	
	public function excluir($pfCodPessoa){
		$this->m = new PessoaCls();
		$this->m->excluir($pfCodPessoa);	
		header('location:../view/pagina.php?m=1&op=6&msg=' . md5(4));
	}
	
	public function todosPorTipo($pCodOtica, $pCodTipoBusca, $pCodBusca, $pFiltroExtra){
		$obj = new PessoaCls();
		return $obj->todosPorTipo($pCodOtica, $pCodTipoBusca, $pCodBusca, $pFiltroExtra);
	}

	public function selecionarMedicos($pCodOtica){
		$obj = new PessoaCls();
		return $obj->listarMedicos($pCodOtica);
	}

}


$p = $_POST;
$obj = new PessoaCtr();

switch (@$_POST['btn']){
	case 'Salvar':
		$obj->cadastrar($p);
		break;
	case 'Atualizar':
		$obj->atualizar($p);
		break;
	case 'Excluir':
		$obj->excluir($p['pfCod']);
		break;		
}
?>