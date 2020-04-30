<?php 
require_once("conexaoCls.php");
require_once("lenteInt.php");

class LenteCls implements LenteInt {
	private $codLente;
	private $codMarca;
	private $desLente;
	private $codTipoLente;
	private $codCor;
	private $valor;	
	private $codOtica;
	
	public function setCodLente($pCodLente){
		$this->codLente = $pCodLente;	
	}
	
	public function getCodLente(){
		return $this->codLente;	
	}

	public function setCodMarca($pCodMarca){
		$this->codMarca = $pCodMarca;
	}
	
	public function getCodMarca(){
		return $this->codMarca;	
	}
	
	public function setDesLente($pDesLente){
		$this->desLente = $pDesLente;	
	}
	
	public function getDesLente(){
		return $this->desLente;	
	}
	
	public function setCodTipoLente($pCodTipoLente){
		$this->codTipoLente = $pCodTipoLente;
	}
	
	public function getCodTipoLente(){
		return $this->codTipoLente;	
	}
	
	public function setCodCor($pcodCor){
		$this->codCor = $pcodCor;
	}

	public function getCodCor(){
		return $this->codCor;
	}
	
	public function setValor($pValor){
		$this->valor = $pValor;
	}
	
	public function getValor(){
		return $this->valor;	
	}
	
	public function setCodOtica($pCodOtica){
		$this->codOtica = $pCodOtica;
	}
	
	public function getCodOtica(){
		return $this->codOtica;	
	}

	public function selecionar($pCodOtica, $pBusca, $pCodTipoBusca) {
		/*
		1 = codigo
		2 = codigo ou nome
		*/
		$stringSQL = "SELECT l.*, m.DES_MARCA, tl.DES_TIPO_LENTE FROM lente l LEFT JOIN marca m ON (m.COD_MARCA = l.COD_MARCA) ";
		$stringSQL = $stringSQL . " INNER JOIN tipo_lente tl ON (tl.COD_TIPO_LENTE = l.COD_TIPO_LENTE) ";
		$stringSQL = $stringSQL . " WHERE l.COD_OTICA = " . $pCodOtica;
		if ($pBusca <> "") {
			switch ($pCodTipoBusca){
				case 1:
					$stringSQL = $stringSQL . " AND COD_LENTE = '" . $pBusca . "'";
					break;
				case 2:
					$stringSQL = $stringSQL . " AND COD_LENTE = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " OR DES_LENTE LIKE '" . $pBusca . "%'";
					break;
			}
		} 
		$stringSQL = $stringSQL . " ORDER BY l.DES_LENTE;";
		
		//echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function inserir($pCodMarca, $pCodTipoLente, $pCodCor, $pValLente, $pDesLente, $pCodOtica){
		$stringSQL = " INSERT INTO lente ";
		$stringSQL = $stringSQL . " (COD_MARCA, ";
		$stringSQL = $stringSQL . " COD_TIPO_LENTE, ";
		$stringSQL = $stringSQL . " COD_COR, ";
		$stringSQL = $stringSQL . " VAL_LENTE, ";
		$stringSQL = $stringSQL . " COD_OTICA, ";
		$stringSQL = $stringSQL . " DES_LENTE) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . "'" . $pCodMarca . "', ";
		$stringSQL = $stringSQL . "'" . $pCodTipoLente . "', ";
		$stringSQL = $stringSQL . "'" . $pCodCor . "', ";
		$stringSQL = $stringSQL . "'" . $pValLente . "', ";
		$stringSQL = $stringSQL . "'" . $pCodOtica . "', ";
		$stringSQL = $stringSQL . "'" . $pDesLente . "' ";
		$stringSQL = $stringSQL . " ); ";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodLente, $pCodMarca, $pCodTipo, $pCodCor, $pValor, $pDesLente, $pCodOtica){
		$stringSQL = " UPDATE lente ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " COD_MARCA = '" . $pCodMarca . "', ";
		$stringSQL = $stringSQL . " COD_TIPO_LENTE = '" . $pCodTipo . "', ";
		$stringSQL = $stringSQL . " COD_COR = '" . $pCodCor . "', ";
		$stringSQL = $stringSQL . " VAL_LENTE = '" . $pValor . "', ";
		$stringSQL = $stringSQL . " DES_LENTE = '" . $pDesLente . "' ";
		$stringSQL = $stringSQL . " WHERE COD_LENTE = '" . $pCodLente . "' AND COD_OTICA = '" . $pCodOtica . "'; ";
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function excluir($pfCodLente){
		$stringSQL = " DELETE FROM lente WHERE COD_LENTE = " . $pfCodLente;
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>