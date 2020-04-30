<?php 
require_once("conexaoCls.php");
require_once("tipoLenteInt.php");

class TipoLenteCls implements TipoLenteInt {
	private $codTipo;
	private $desTipo;
	private $codOtica;
	
	public function setCodCor($pCodTipo){
		$this->codTipo = $pCodTipo;	
	}
	
	public function getCodCor(){
		return $this->codTipo;	
	}
	
	public function setDesCor($pDesTipo){
		$this->desTipo = $pDesTipo;
	}
	
	public function getDesCor(){
		return $this->desTipo;	
	}
	
	public function setCodOtica($pCodOtica){
		$this->codOtica = $pCodOtica;
	}
	
	public function getCodOtica(){
		return $this->codOtica;	
	}
	
	public function selecionar($pCodOtica, $pBusca, $pcodTipoBusca){
		/* Valor para $pCodTipoBusca
		1 - CÓDIGO
		2 - CÓDIGO OU DESCRIÇÃO
		*/

		$stringSQL = "SELECT * FROM tipo_lente WHERE COD_OTICA = " . $pCodOtica;
		if ($pBusca <> "") {
			switch ($pcodTipoBusca) {
				case 1:
					$stringSQL = $stringSQL . " AND COD_TIPO_LENTE = '" . $pBusca . "'";
					break;
				case 2:
					$stringSQL = $stringSQL . " AND COD_TIPO_LENTE = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " OR DES_TIPO_LENTE LIKE '" . $pBusca . "%'";
					break;
			}
		} 
		$stringSQL = $stringSQL . " ORDER BY DES_TIPO_LENTE;";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
	}

	public function inserir($pDesTipo, $pCodOtica){
		$stringSQL = " INSERT INTO tipo_lente ";
		$stringSQL = $stringSQL . " (DES_TIPO_LENTE,";
		$stringSQL = $stringSQL . " COD_OTICA) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . " '" . $pDesTipo . "',";
		$stringSQL = $stringSQL . " " . $pCodOtica . " ";
		$stringSQL = $stringSQL . " ); ";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function atualizar($pCodTipo, $pDesTipo, $pCodOtica){
		$stringSQL = " UPDATE tipo_lente ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " DES_TIPO_LENTE = '" . $pDesTipo . "' ";
		$stringSQL = $stringSQL . " WHERE COD_TIPO_LENTE = " . $pCodTipo . " AND COD_OTICA =  " . $pCodOtica . "; ";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function excluir($pfCodTipoLente){
		$stringSQL = " DELETE FROM tipo_lente WHERE COD_TIPO_LENTE = " . $pfCodTipoLente . "; ";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>