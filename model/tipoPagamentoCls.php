<?php 
require_once("conexaoCls.php");
require_once("tipoPagamentoInt.php");

class TipoPagamentoCls implements TipoPagamentoInt {
	private $codTipoPagamento;
	private $desTipoPagamento;
	
	public function setCodTipoPagamento($pCodTipoPagamento){
		$this->codTipoPagamento = $pCodTipoPagamento;	
	}
	
	public function getCodTipoPagamento(){
		return $this->codTipoPagamento;	
	}
	
	public function setDesTipoPagamento($pDesTipoPagamento){
		$this->desTipoPagamento = $pDesTipoPagamento;	
	}
	
	public function getDesTipoPagamento(){
		return $this->desTipoPagamento;	
	}

	public static function selecionar($pBusca, $pCodTipoBusca) {
		/*
		1 = codigo
		2 = codigo ou nome
		*/
		$stringSQL = "SELECT * FROM tipo_pagamento WHERE FLG_ATIVO = 1";
		if ($pBusca <> "") {
			switch ($pCodTipoBusca){
				case 1:
					$stringSQL = $stringSQL . " AND COD_TIPO_PAGAMENTO = '" . $pBusca . "'";
					break;
				case 2:
					$stringSQL = $stringSQL . " AND COD_TIPO_PAGAMENTO = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " OR DES_TIPO_PAGAMENTO LIKE '" . $pBusca . "%'";
					break;
			}
		} 
		$stringSQL = $stringSQL . " ORDER BY DES_TIPO_PAGAMENTO;";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>