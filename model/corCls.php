<?php 
require_once("conexaoCls.php");
require_once("corInt.php");

class CorCls implements CorInt {
	private $codCor;
	private $desCor;
	private $codOtica;
	
	public function setCodCor($pCodCor){
		$this->codCor = $pCodCor;	
	}
	
	public function getCodCor(){
		return $this->codCor;	
	}

	public function setDesCor($pDesCor){
		$this->desCor = $pDesCor;	
	}
	
	public function getDesCor(){
		return $this->desCor;	
	}
	
	public function setCodOtica($pCodOtica){
		$this->codOtica = $pCodOtica;
	}
	
	public function getCodOtica(){
		return $this->codOtica;	
	}

	public function selecionar($pCodOtica, $pBusca, $pCodTipoBusca) {
		/* Valor para $pCodTipoBusca
		1 - CÓDIGO
		2 - CÓDIGO OU DESCRIÇÃO
		*/
		$stringSQL = "SELECT * FROM cor WHERE COD_OTICA = " . $pCodOtica;
		if ($pBusca <> "") {
			switch ($pCodTipoBusca) {
				case 1 :
					$stringSQL = $stringSQL . " AND COD_COR = '" . $pBusca . "'";
					break;
				case 2 :
					$stringSQL = $stringSQL . " AND COD_COR = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " OR DES_COR like '" . $pBusca . "%'";
					break;
			}
		} 
		$stringSQL = $stringSQL . " ORDER BY DES_COR;";
		//echo $stringSQL;
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function inserir($pDesCor, $pCodOtica){
		$stringSQL = "INSERT INTO cor (DES_COR, COD_OTICA) VALUES ('" . $pDesCor . "', " . $pCodOtica . ");";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodCor, $pDesCor, $pCodOtica){
		$stringSQL = "UPDATE cor SET DES_COR = '" . $pDesCor . "' WHERE COD_COR = " . $pCodCor . " AND COD_OTICA = " . $pCodOtica . " ;";
		 		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function excluir($pCodCor){
		$stringSQL = "DELETE FROM cor WHERE COD_COR = " . $pCodCor . ";";
		 		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

}
?>