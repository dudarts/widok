<?php
require_once("../model/lancamentoCls.php");

class lancamentoCtr {
	public function selecionar($pCodOtica, $pBusca, $pcodTipoBusca){
		$obj = new LancamentoCls();
		return $obj->selecionar($pCodOtica, $pBusca, $pcodTipoBusca);
	}
	
//	public function baixa($pCodOS, $pNumParcela, $pCodValor, $pCodUsuario){
//		$obj = new LancamentoCls();
//		return $obj->baixa($pCodOS, $pNumParcela, $pCodValor, $pCodUsuario);
//	}
	public function baixa($pNumLancamento, $pCodOs, $pNumParcela, $pValMora, $pValJuros, $pValDescontoParcela, $pValPago, $pCodUsuarioBaixa, $pDesBaixaLancamento, $pCodOtica) {
		$obj = new LancamentoCls();
		return $obj->baixa($pNumLancamento, $pCodOs, $pNumParcela, $pValMora, $pValJuros, $pValDescontoParcela, $pValPago, $pCodUsuarioBaixa, $pDesBaixaLancamento, $pCodOtica);
	}
	
	
	
	public function inserir($pCodOtica, $pCodOs, $pNumParcela, $pValParcela, $pCodUsuario){
		$obj = new LancamentoCls();
		return $obj->inserir($pCodOtica, $pCodOs, $pNumParcela, $pValParcela, $pCodUsuario);	
	}
	
	public function totalParcelaAbertas($pCodOS){
		$obj = new LancamentoCls();
		$total = mysqli_fetch_assoc($obj->totalParcelaAbertas($pCodOS));
		return $total["TOTAL"];
	}
	
	public function BuscaLancamento($pCodOtica, $pCodOS, $pNumParcela){
		$obj = new LancamentoCls();
		$total = mysqli_fetch_assoc($obj->BuscaLancamento($pCodOtica, $pCodOS, $pNumParcela));
		return $total["NUM_LANCAMENTO"];
	}

	public function LancamentosAtrasados($pCodOtica){
		$obj = new LancamentoCls();
		return $obj->LancamentosAtrasados($pCodOtica);
	}
	
	public function CaixaDiário($pCodOtica, $pDia){
		$obj = new LancamentoCls();
		return $obj->CaixaDiário($pCodOtica, $pDia);
	}
	
	public function estorno($pNumLancamento){
		$obj = new LancamentoCls();
		return $obj->estorno($pNumLancamento);	
	}

}
?>