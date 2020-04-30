<?php 
require_once("conexaoCls.php");
require_once("configBoletoInt.php");

class ConfigBoletoCls implements ConfigBoletoInt {
	private $codConfigBoleto;
	private $codOtica;
	private $flgPrincipal;
	private $qtdDiasVencimento;
	private $codBanco;
	private $desCedente;
	private $numAgencia;
	private $desAgencia;
	private $numConta;
	private $desLocalPgto;
	private $codDocEspecie;
	private $codCarteira;
	private $desMensagem;
	private $flgAtivo;
	private $desConfigBoleto;
		
	public function setCodConfigBoleto ($pCodConfigBoleto) {
		$this->codConfigBoleto = $pCodConfigBoleto;
	}
	
	public function getCodConfigBoleto ($pCodConfigBoleto) {
		return $this->codConfigBoleto;
	}
	
	public function setCodOtica ($pCodOtica) {
		$this->codOtica = $pCodOtica;
	}
	
	public function getCodOtica ($pCodOtica) {
		return $this->codOtica;
	}
	
	public function setFlgPrincipal ($pFlgPrincipal) {
		$this->flgPrincipal = $pFlgPrincipal;
	}
	
	public function getFlgPrincipal ($pFlgPrincipal) {
		return $this->flgPrincipal;
	}
	
	public function setQtdDiasVencimento ($pQtdDiasVencimento) {
		$this->qtdDiasVencimento = $pQtdDiasVencimento;
	}
	
	public function getQtdDiasVencimento ($pQtdDiasVencimento) {
		return $this->qtdDiasVencimento;
	}
	
	public function setCodBanco ($pCodBanco) {
		$this->codBanco = $pCodBanco;
	}
	
	public function getCodBanco ($pCodBanco) {
		return $this->codBanco;
	}
	
	public function setDesCedente ($pDesCedente) {
		$this->desCedente = $pDesCedente;
	}
	
	public function getDesCedente ($pDesCedente) {
		return $this->desCedente;
	}
	
	public function setNumAgencia ($pNumAgencia) {
		$this->numAgencia = $pNumAgencia;
	}
	
	public function getNumAgencia ($pNumAgencia) {
		return $this->numAgencia;
	}
	
	public function setDesAgencia ($pDesAgencia) {
		$this->desAgencia = $pDesAgencia;
	}
	
	public function getDesAgencia ($pDesAgencia) {
		return $this->desAgencia;
	}
	
	public function setNumConta ($pNumConta) {
		$this->numConta = $pNumConta;
	}
	
	public function getNumConta ($pNumConta) {
		return $this->numConta;
	}
	
	public function setDesLocalPgto ($pDesLocalPgto) {
		$this->desLocalPgto = $pDesLocalPgto;
	}
	
	public function getDesLocalPgto ($pDesLocalPgto) {
		return $this->desLocalPgto;
	}
	
	public function setCodDocEspecie ($pCodDocEspecie) {
		$this->codDocEspecie = $pCodDocEspecie;
	}
	
	public function getCodDocEspecie ($pCodDocEspecie) {
		return $this->codDocEspecie;
	}
	
	public function setCodCarteira ($pCodCarteira) {
		$this->codCarteira = $pCodCarteira;
	}
	
	public function getCodCarteira ($pCodCarteira) {
		return $this->codCarteira;
	}
	
	public function setDesMensagem ($pDesMensagem) {
		$this->desMensagem = $pDesMensagem;
	}
	
	public function getDesMensagem ($pDesMensagem) {
		return $this->desMensagem;
	}
	
	public function setFlgAtivo ($pFlgAtivo) {
		$this->flgAtivo = $pFlgAtivo;
	}
	
	public function getFlgAtivo ($pFlgAtivo) {
		return $this->flgAtivo;
	}
	
	public function setDesConfigBoleto ($pDesConfigBoleto) {
		$this->desConfigBoleto = $pDesConfigBoleto;
	}
	
	public function getDesConfigBoleto ($pDesConfigBoleto) {
		return $this->desConfigBoleto;
	}

	public function selecionar($pCodOtica, $pCodConfigBoleto) {
		$stringSQL = "SELECT * FROM ConfigBoleto WHERE COD_OTICA = " . $pCodOtica;
		if (func_num_args() > 1) {
			$stringSQL = $stringSQL . " AND COD_CONFIG_BOLETO = " . $pCodConfigBoleto;
		} 
		$stringSQL = $stringSQL . " ;";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function inserir($pCodMarca, $pDesConfigBoleto, $pNumReferencia, $pValor, $pCodOtica){
		$stringSQL = " INSERT INTO config_boleto ";
		$stringSQL = $stringSQL . " (COD_OTICA, ";
		$stringSQL = $stringSQL . " FLG_PRINCIPAL, ";
		$stringSQL = $stringSQL . " QTD_DIAS_VENCIMENTO, ";
		$stringSQL = $stringSQL . " COD_BANCO, ";
		$stringSQL = $stringSQL . " DES_CEDENTE, ";
		$stringSQL = $stringSQL . " NUM_AGENCIA, ";
		$stringSQL = $stringSQL . " DES_AGENCIA, ";
		$stringSQL = $stringSQL . " NUM_CONTA, ";
		$stringSQL = $stringSQL . " DES_LOCAL_PGTO, ";
		$stringSQL = $stringSQL . " COD_DOC_ESPECIE, ";
		$stringSQL = $stringSQL . " COD_CARTEIRA, ";
		$stringSQL = $stringSQL . " DES_MENSAGEM, ";
		$stringSQL = $stringSQL . " FLG_ATIVO, ";
		$stringSQL = $stringSQL . " DES_CONFIG_BOLETO) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . "'" . $pCodOtica . "', ";
		$stringSQL = $stringSQL . "'" . $pFlgPrincipal . "', ";
		$stringSQL = $stringSQL . "'" . $pQtdDiasVencimento . "', ";
		$stringSQL = $stringSQL . "'" . $pCodBanco . "', ";
		$stringSQL = $stringSQL . "'" . $pDesCedente . "', ";
		$stringSQL = $stringSQL . "'" . $pNumAgencia . "', ";
		$stringSQL = $stringSQL . "'" . $pDesAgencia . "', ";
		$stringSQL = $stringSQL . "'" . $pNumConta . "', ";
		$stringSQL = $stringSQL . "'" . $pDesLocalPgto . "', ";
		$stringSQL = $stringSQL . "'" . $pCodDocEspecie . "', ";
		$stringSQL = $stringSQL . "'" . $pCodCarteira . "', ";
		$stringSQL = $stringSQL . "'" . $pDesMensagem . "', ";
		$stringSQL = $stringSQL . "'" . $pFlgAtivo . "', ";
		$stringSQL = $stringSQL . "'" . $pDesConfigBoleto . "' ";
		$stringSQL = $stringSQL . " ); ";
				
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodConfigBoleto, $pCodMarca, $pDesConfigBoleto, $pNumReferencia, $pValor, $pCodOtica){
		$stringSQL = " UPDATE config_boleto ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " FLG_PRINCIPAL = '" . $pFlgPrincipal . "', ";
		$stringSQL = $stringSQL . " QTD_DIAS_VENCIMENTO = '" . $pQtdDiasVencimento . "', ";
		$stringSQL = $stringSQL . " COD_BANCO = '" . $pCodBanco . "', ";
		$stringSQL = $stringSQL . " DES_CEDENTE = '" . $pDesCedente . "', ";
		$stringSQL = $stringSQL . " NUM_AGENCIA = '" . $pNumAgencia . "', ";
		$stringSQL = $stringSQL . " DES_AGENCIA = '" . $pDesAgencia . "', ";
		$stringSQL = $stringSQL . " NUM_CONTA = '" . $pNumConta . "', ";
		$stringSQL = $stringSQL . " DES_LOCAL_PGTO = '" . $pDesLocalPgto . "', ";
		$stringSQL = $stringSQL . " COD_DOC_ESPECIE = '" . $pCodDocEspecie . "', ";
		$stringSQL = $stringSQL . " COD_CARTEIRA = '" . $pCodCarteira . "', ";
		$stringSQL = $stringSQL . " DES_MENSAGEM = '" . $pDesMensagem . "', ";
		$stringSQL = $stringSQL . " FLG_ATIVO = '" . $pFlgAtivo . "', ";
		$stringSQL = $stringSQL . " DES_CONFIG_BOLETO = '" . $pDesConfigBoleto . "', ";
		$stringSQL = $stringSQL . " WHERE COD_CONFIG_BOLETO = '" . $pCodConfigBoleto . "' AND COD_OTICA = '" . $pCodOtica . "'; ";
		 		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

}
?>