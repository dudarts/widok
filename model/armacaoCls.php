<?php 
require_once("conexaoCls.php");
require_once("armacaoInt.php");

class ArmacaoCls implements ArmacaoInt {
	private $codArmacao;
	private $codMarca;
	private $desArmacao;
	private $numReferencia;
	private $valor;	
	private $codOtica;
	
	public function setCodArmacao($pCodArmacao){
		$this->codArmacao = $pCodArmacao;	
	}
	
	public function getCodArmacao(){
		return $this->codArmacao;	
	}

	public function setCodMarca($pCodMarca){
		$this->codMarca = $pCodMarca;
	}
	
	public function getCodMarca(){
		return $this->codMarca;	
	}
	
	public function setDesArmacao($pDesArmacao){
		$this->desArmacao = $pDesArmacao;	
	}
	
	public function getDesArmacao(){
		return $this->desArmacao;	
	}
	
	public function setNumReferencia($pNumRef){
		$this->numReferencia = $pNumRef;
	}
	
	public function getNumReferencia(){
		return $this->numReferencia;	
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
		/* Valor para $pCodTipoBusca
		1 - CÓDIGO
		2 - CÓDIGO OU DESCRIÇÃO
		*/
		$stringSQL = "SELECT a.COD_ARMACAO, a.COD_MARCA, a.DES_ARMACAO, a.NUM_REFERENCIA, a.VAL_ARMACAO, a.COD_OTICA, ifnull(a.QTD_ARMACAO,0) as QTD_ARMACAO, m.DES_MARCA FROM armacao a INNER JOIN marca m ON (m.COD_MARCA = a.COD_MARCA) WHERE a.COD_OTICA = " . $pCodOtica;
		if ($pBusca <> "") {
			switch ($pCodTipoBusca) {
				case 1 :
					$stringSQL = $stringSQL . " AND COD_ARMACAO = '" . $pBusca . "'";
					break;
				case 2 :
					$stringSQL = $stringSQL . " AND COD_ARMACAO = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " OR DES_ARMACAO like '" . $pBusca . "%'";
					break;
			}
		} 
		$stringSQL = $stringSQL . " ORDER BY DES_ARMACAO;";
		//echo $stringSQL;
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function inserir($pCodMarca, $pDesArmacao, $pNumReferencia, $pValor, $pCodOtica){
		$stringSQL = "INSERT INTO armacao (COD_MARCA, DES_ARMACAO, NUM_REFERENCIA, VAL_ARMACAO, COD_OTICA) VALUES (" . $pCodMarca . ", '" . $pDesArmacao . "', '" . $pNumReferencia . "', " . $pValor . ", " . $pCodOtica . ");";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodArmacao, $pCodMarca, $pDesArmacao, $pNumReferencia, $pValor, $pCodOtica){
		$stringSQL = "UPDATE armacao SET COD_MARCA = " . $pCodMarca . ", DES_ARMACAO = '" . $pDesArmacao . "', NUM_REFERENCIA = '" . $pNumReferencia . "', VAL_ARMACAO = " . $pValor . " WHERE COD_ARMACAO = " . $pCodArmacao . " AND COD_OTICA = " . $pCodOtica . " ;";
		 		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function excluir($pCodArmacao){
		$stringSQL = "DELETE FROM armacao WHERE COD_ARMACAO = " . $pCodArmacao . ";";
		 		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function getQtdArmacao($pCodArmacao){
		$stringSQL = " SELECT QTD_ARMACAO FROM armacao WHERE COD_ARMACAO = " . $pCodArmacao;
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL)->fetch_array(MYSQLI_ASSOC);
		return $recordSet["QTD_ARMACAO"];
	}
	
	public function atualizarQtd($pCodArmacao, $pQtdArmacao, $pCodUsuario, $pCodOs){
		$stringSQL = " INSERT INTO armacao_qtd ";
		$stringSQL .= " (COD_ARMACAO, ";
		$stringSQL .= " QTD_ARMACAO, ";
		$stringSQL .= " DAT_GRAVACAO, ";
		$stringSQL .= " COD_USUARIO, ";
		$stringSQL .= " COD_OS ";
		$stringSQL .= " ) VALUES ( ";
		$stringSQL .= $pCodArmacao . ", ";
		$stringSQL .= $pQtdArmacao . ", ";
		$stringSQL .= " NOW(), ";
		$stringSQL .= "'" . $pCodUsuario . "', ";
		$stringSQL .= $pCodOs . "); ";
//		echo $stringSQL;

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		
		$qtd = $this->getQtdArmacao($pCodArmacao) + ($pQtdArmacao);
		
		$stringSQL = "UPDATE armacao SET";
		$stringSQL .= " QTD_ARMACAO = " . $qtd;
		$stringSQL .= " WHERE COD_ARMACAO = " . $pCodArmacao . ";" ;

//		echo $stringSQL;
//		exit();		 		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

}
?>