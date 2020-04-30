<?php 
require_once("conexaoCls.php");
require_once("corLenteInt.php");

class CorLenteCls {
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
	
	public function selecionar($pCodOtica, $pCodCor){
		$stringSQL = "SELECT * FROM cor_lente WHERE COD_OTICA = " . $pCodOtica;
		if (func_num_args() > 1) {
			$stringSQL = $stringSQL . " AND COD_COR = " . $pCodCor ;
		} 
		$stringSQL = $stringSQL . " ;";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
	}

	public function inserir($pDesCor, $pCodOtica){
		$stringSQL = " INSERT INTO cor_lente ";
		$stringSQL = $stringSQL . " (DES_COR, ";
		$stringSQL = $stringSQL . " COD_OTICA) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . " " . $pDesCor . "
";
		$stringSQL = $stringSQL . " " . $pCodOtica . " ";
		$stringSQL = $stringSQL . " ); ";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function atualizar($pCodCor, $pDesCor, $pCodOtica){
		$stringSQL = " UPDATE cor_lente ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " DES_COR = " . $pDesCor . " ";
		$stringSQL = $stringSQL . " WHERE COD_COR = " . $pCodCor . " AND COD_OTICA =  " . $pCodOtica . "; ";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

}
?>