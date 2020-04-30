<?php 
require_once("conexaoCls.php");
require_once("receitaInt.php");

class ReceitaCls implements ReceitaInt {
	private $codReceita;
	private $codOlho;
	private $numEsferico;
	private $numCilindro;	
	private $numEixo;
	private $numDpn;
	private $numAdicao;
	private $numAltura;
	private $codOtica;
	
	public function setCodReceita($pCodReceita){
		$this->codReceita = $pCodReceita;	
	}
	
	public function getCodReceita(){
		return $this->codReceita;	
	}

	public function setCodOlho($pCodOlho){
		$this->codOlho = $pCodOlho;	
	}
	
	public function getCodOlho(){
		return $this->codOlho;	
	}
	
	public function setNumEsferico($pNumEsferico){
		$this->numEsferico = $pNumEsferico;
	}
	
	public function getNumEsferico(){
		return $this->numEsferico;	
	}
	
	public function setNumCilindro($pNumCilindro){
		$this->NumCilindro = $pNumCilindro;
	}
	
	public function getNumCilindro(){
		return $this->numCilindro;	
	}

	public function setNumCilindro($pNumCilindro){
		$this->NumCilindro = $pNumCilindro;
	}
	
	public function getNumCilindro(){
		return $this->numCilindro;	
	}

	public function setNumEixo($pNumEixo){
		$this->NumEixo = $pNumEixo;
	}
	
	public function getNumEixo(){
		return $this->numEixo;	
	}

	public function setNumDpn($pNumDpn){
		$this->numDpn = $pNumDpn;
	}
	
	public function getNumDpn(){
		return $this->numDpn;	
	}

	public function setNumAdicao($pNumAdicao){
		$this->numAdicao = $pNumAdicao;
	}
	
	public function getNumAdicao(){
		return $this->numAdicao;	
	}

	public function setNumAltura($pNumAltura){
		$this->numAltura = $pNumAltura;
	}
	
	public function getNumAltura(){
		return $this->numAltura;	
	}

	public function setCodOtica($pCodOtica){
		$this->CodOtica = $pCodOtica;
	}
	
	public function getCodOtica(){
		return $this->codOtica;	
	}



	public function selecionar($pCodOtica, $pCodReceita) {
		$stringSQL = "SELECT * FROM receita WHERE COD_OTICA = " . $pCodOtica;
		if (func_num_args() > 1) {
			$stringSQL = $stringSQL . " AND COD_RECEITA = " . $pCodReceita;
		} 
		$stringSQL = $stringSQL . " ;";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function inserir($codOlho, $numEsferico, $numCilindro, $numEixo, $numDpn, $numAdicao, $numAltura, $codOtica){
		$stringSQL = " INSERT INTO receita ";
		$stringSQL = $stringSQL . " (COD_OLHO, ";
		$stringSQL = $stringSQL . " NUM_ESFERICO, ";
		$stringSQL = $stringSQL . " NUM_CILINDRO, ";
		$stringSQL = $stringSQL . " NUM_EIXO, ";
		$stringSQL = $stringSQL . " NUM_DPN, ";
		$stringSQL = $stringSQL . " NUM_ADICAO, ";
		$stringSQL = $stringSQL . " NUM_ALTURA, ";
		$stringSQL = $stringSQL . " COD_OTICA) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . " '" . $codOlho . "', ";
		$stringSQL = $stringSQL . " '" . $numEsferico . "', ";
		$stringSQL = $stringSQL . " '" . $numCilindro . "', ";
		$stringSQL = $stringSQL . " '" . $numEixo . "', ";
		$stringSQL = $stringSQL . " '" . $numDpn . "', ";
		$stringSQL = $stringSQL . " '" . $numAdicao . "', ";
		$stringSQL = $stringSQL . " '" . $numAltura . "', ";
		$stringSQL = $stringSQL . " '" . $codOtica . "' ";
		$stringSQL = $stringSQL . " ); ";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodReceita, $pCodOlho, $pNumEsferico, $pNumCilindro, $pNumEixo, $pNumDpn, $pNumAdicao, $pNumAltura, $pCodOtica){
		$stringSQL = " UPDATE receita ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " COD_OLHO = '" . $pCodOlho . "', ";
		$stringSQL = $stringSQL . " NUM_ESFERICO = '" . $pNumEsferico . "', ";
		$stringSQL = $stringSQL . " NUM_CILINDRO = '" . $pNumCilindro . "', ";
		$stringSQL = $stringSQL . " NUM_EIXO = '" . $pNumEixo . "', ";
		$stringSQL = $stringSQL . " NUM_DPN = '" . $pNumDpn . "', ";
		$stringSQL = $stringSQL . " NUM_ADICAO = '" . $pNumAdicao . "', ";
		$stringSQL = $stringSQL . " NUM_ALTURA = '" . $pNumAltura . "', ";
		$stringSQL = $stringSQL . " WHERE COD_RECEITA = '" . $pCodReceita . "' AND COD_OTICA = " . $pCodOtica . "; ";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

}
?>