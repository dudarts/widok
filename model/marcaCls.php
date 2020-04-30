<?php 
require_once('conexaoCls.php');
require_once('marcaInt.php');

class MarcaCls  {
	private $codMarca;
	private $desMarca;
	private $codOtica;
	
	public function setCodMarca($pCodMarca){
		$this->codMarca = $pCodMarca;
	}
	
	public function getCodMarca(){
		return $this->codMarca;
	}
	
	public function setDesMarca($pDesMarca){
		$this->desMarca = $pDesMarca;
	}
	
	public function getDesMarca(){
		return $this->desMarca;	
	}
	
	public function setCodOtica($pCodOtica){
		$this->codOtica = $pCodOtica;
	}
	
	public function getCodOtica(){
		return $this->codOtica;	
	}
	
	public function selecionar($pCodOtica, $pCodMarca, $pCodTipoBusca){
		/*
		1 - COD_MARCA
		2 - COD_MARCA OU DES_MARCA
		*/
		$stringSQL = "SELECT * FROM marca WHERE COD_OTICA = " . $pCodOtica;
		if ($pCodMarca <> "") {
			switch ($pCodTipoBusca) {
				case 1: 
					$stringSQL = $stringSQL . " AND COD_MARCA = '" . $pCodMarca . "'";
					break;
				case 2:
					$stringSQL = $stringSQL . " AND COD_MARCA = '" . $pCodMarca . "'";
					$stringSQL = $stringSQL . " OR DES_MARCA LIKE '" . $pCodMarca . "%'";
					break;
			}
		} 
		$stringSQL = $stringSQL . " ORDER BY DES_MARCA ;";
		
		$con = Conexao::getInstanciar();
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function inserir($pDesMarca, $pCodOtica){
		$stringSQL = " INSERT INTO marca ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . " DES_MARCA, ";
		$stringSQL = $stringSQL . " COD_OTICA) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . " '" . $pDesMarca . "', ";
		$stringSQL = $stringSQL . " " . $pCodOtica . " ";
		$stringSQL = $stringSQL . " ); ";
		
		$con = Conexao::getInstanciar();
		$recordSet = $con->executar($stringSQL);
		return $recordSet;

	}

	public function atualizar($pCodMarca, $pCodOtica, $pDesMarca){
		$stringSQL = " UPDATE marca ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " DES_MARCA = '" . $pDesMarca . "' ";
		$stringSQL = $stringSQL . " WHERE COD_MARCA = " . $pCodMarca . " ";
		$stringSQL = $stringSQL . " AND COD_OTICA = " . $pCodOtica . "; ";
		
		$con = Conexao::getInstanciar();
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
	}

	public function excluir($pCodMarca){
		$stringSQL = " DELETE FROM marca  WHERE COD_MARCA = " . $pCodMarca;
		
		$con = Conexao::getInstanciar();
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
	}

}
?>