<?php
require_once("conexaoCls.php");
require_once("permissaoInt.php");

class PermissaoCls implements PermissaoInt {
	private $codPermissao;
	private $desPermissao;
	
	public function setCodPermissao($pCodPermissao){
		$this->codPermissao = $pCodPermissao;	
	}
	
	public function getCodPermissao(){
		return $this->codPermissao;	
	}
	
	public function setDesPermissao($pDesPermissao){
		$this->desPermissao = $pDesPermissao;
	}
	
	public function getDesPermissao(){
		return $this->desPermissao;
	}
	
	public function selecionar($pCodPermissao){
	
		$stringSQL = " SELECT * FROM permissao";
		$stringSQL = $stringSQL . " WHERE COD_PERMISSAO <> 1 ";
		if ($pCodPermissao <> "") {
			$stringSQL = $stringSQL . " AND COD_PERMISSAO = " . $pCodPermissao ;
		}
		$stringSQL = $stringSQL . " ;";

//		echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;		
	}
}
?>