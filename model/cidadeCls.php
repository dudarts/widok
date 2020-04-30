<?php
require_once("conexaoCls.php");
require_once("cidadeInt.php");

class CidadeCls implements CidadeInt {
	private $codCidade;
	private $desCidade;
	private $codEstado;
	
	public function setCodCidade($pCodCidade){
		$this->codCidade;	
	}
	
	public function getCodCidade(){
		return $this->codCidade;	
	}
	
	public function setdesCidade($pdesCidade){
		$this->desCidade;	
	}
	
	public function getdesCidade(){
		return $this->desCidade;	
	}
	
	public function setcodEstado($pcodEstado){
		$this->codEstado;	
	}
	
	public function getcodEstado(){
		return $this->codEstado;	
	}
	
	public static function selecionar($pCodCidade){
		$stringSQL = "SELECT * FROM cidade " ;
		
		if ($pCodCidade <> "") {
			$stringSQL .= " WHERE COD_CIDADE = " . $pCodCidade;
		} 
		$stringSQL .= " ;";

	//echo $stringSQL;
	
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>