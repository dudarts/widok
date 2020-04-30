<?php 
require_once("conexaoCls.php");
require_once("BoletoInt.php");

class BoletoCls implements BoletoInt {
	private $codBoleto;
	private $codConfigBoleto;
	private $codOs;
	private $numParcela;
	private $valBoleto;
	private $datVencimento;
	private $datBoleto;
	private $valMulta;
	private $valJuros;
	private $valPgto;
	private $datPgto;
	private $flgEstornado;
	private $codUserBaixa;
	private $datBaixa;
	private $datArquivoRetorno;

	public function setCodBoleto ($pCodBoleto) {
		$this->codBoleto =  $pCodBoleto;
	}
	
	public function getCodBoleto ($pCodBoleto) {
		return $this->codBoleto;;
	}
	
	public function setCodConfigBoleto ($pCodConfigBoleto) {
		$this->codConfigBoleto =  $pCodConfigBoleto;
	}
	
	public function getCodConfigBoleto ($pCodConfigBoleto) {
		return $this->codConfigBoleto;;
	}
	
	public function setCodOs ($pCodOs) {
		$this->codOs =  $pCodOs;
	}
	
	public function getCodOs ($pCodOs) {
		return $this->codOs;;
	}
	
	public function setNumParcela ($pNumParcela) {
		$this->numParcela =  $pNumParcela;
	}
	
	public function getNumParcela ($pNumParcela) {
		return $this->numParcela;;
	}
	
	public function setValBoleto ($pValBoleto) {
		$this->valBoleto =  $pValBoleto;
	}
	
	public function getValBoleto ($pValBoleto) {
		return $this->valBoleto;;
	}
	
	public function setDatVencimento ($pDatVencimento) {
		$this->datVencimento =  $pDatVencimento;
	}
	
	public function getDatVencimento ($pDatVencimento) {
		return $this->datVencimento;;
	}
	
	public function setDatBoleto ($pDatBoleto) {
		$this->datBoleto =  $pDatBoleto;
	}
	
	public function getDatBoleto ($pDatBoleto) {
		return $this->datBoleto;;
	}
	
	public function setValMulta ($pValMulta) {
		$this->valMulta =  $pValMulta;
	}
	
	public function getValMulta ($pValMulta) {
		return $this->valMulta;;
	}
	
	public function setValJuros ($pValJuros) {
		$this->valJuros =  $pValJuros;
	}
	
	public function getValJuros ($pValJuros) {
		return $this->valJuros;;
	}
	
	public function setValPgto ($pValPgto) {
		$this->valPgto =  $pValPgto;
	}
	
	public function getValPgto ($pValPgto) {
		return $this->valPgto;;
	}
	
	public function setDatPgto ($pDatPgto) {
		$this->datPgto =  $pDatPgto;
	}
	
	public function getDatPgto ($pDatPgto) {
		return $this->datPgto;;
	}
	
	public function setFlgEstornado ($pFlgEstornado) {
		$this->flgEstornado =  $pFlgEstornado;
	}
	
	public function getFlgEstornado ($pFlgEstornado) {
		return $this->flgEstornado;;
	}
	
	public function setCodUserBaixa ($pCodUserBaixa) {
		$this->codUserBaixa =  $pCodUserBaixa;
	}
	
	public function getCodUserBaixa ($pCodUserBaixa) {
		return $this->codUserBaixa;;
	}
	
	public function setDatBaixa ($pDatBaixa) {
		$this->datBaixa =  $pDatBaixa;
	}
	
	public function getDatBaixa ($pDatBaixa) {
		return $this->datBaixa;;
	}
	
	public function setDatArquivoRetorno ($pDatArquivoRetorno) {
		$this->datArquivoRetorno =  $pDatArquivoRetorno;
	}
	
	public function getDatArquivoRetorno ($pDatArquivoRetorno) {
		return $this->datArquivoRetorno;;
	}


	public function selecionar($pCodOtica, $pCodBoleto){
		$stringSQL = "SELECT * FROM boleto WHERE COD_OTICA = " . $pCodOtica;
		if (func_num_args() > 1) {
			$stringSQL = $stringSQL . " AND COD_BOLETO = " . $pCodBoleto;
		} 
		$stringSQL = $stringSQL . " ;";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}


	public function inserir($pCodConfigBoleto, $pCodOs, $pNumParcela, $pValBoleto, $pDatVencimento, $pDatBoleto, $pValMulta, $pValJuros, $pValPgto, $pDatPgto, $pFlgEstornado, $pCodUserBaixa, $pDatBaixa, $pDatArquivoRetorno){	
		$stringSQL = " INSERT INTO boleto ";
		$stringSQL = $stringSQL . " (COD_BOLETO, ";
		$stringSQL = $stringSQL . " COD_CONFIG_BOLETO, ";
		$stringSQL = $stringSQL . " COD_OS, ";
		$stringSQL = $stringSQL . " NUM_PARCELA, ";
		$stringSQL = $stringSQL . " VAL_BOLETO, ";
		$stringSQL = $stringSQL . " DAT_VENCIMENTO, ";
		$stringSQL = $stringSQL . " DAT_BOLETO, ";
		$stringSQL = $stringSQL . " VAL_MULTA, ";
		$stringSQL = $stringSQL . " VAL_JUROS, ";
		$stringSQL = $stringSQL . " VAL_PGTO, ";
		$stringSQL = $stringSQL . " DAT_PGTO, ";
		$stringSQL = $stringSQL . " FLG_ESTORNADO, ";
		$stringSQL = $stringSQL . " COD_USER_BAIXA, ";
		$stringSQL = $stringSQL . " DAT_BAIXA, ";
		$stringSQL = $stringSQL . " DAT_ARQUIVO_RETORNO) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . "'" . $pCodBoleto . "', ";
		$stringSQL = $stringSQL . "'" . $pCodConfigBoleto . "', ";
		$stringSQL = $stringSQL . "'" . $pCodOs . "', ";
		$stringSQL = $stringSQL . "'" . $pNumParcela . "', ";
		$stringSQL = $stringSQL . "'" . $pValBoleto . "', ";
		$stringSQL = $stringSQL . "'" . $pDatVencimento . "', ";
		$stringSQL = $stringSQL . "'" . $pDatBoleto . "', ";
		$stringSQL = $stringSQL . "'" . $pValMulta . "', ";
		$stringSQL = $stringSQL . "'" . $pValJuros . "', ";
		$stringSQL = $stringSQL . "'" . $pValPgto . "', ";
		$stringSQL = $stringSQL . "'" . $pDatPgto . "', ";
		$stringSQL = $stringSQL . "'" . $pFlgEstornado . "', ";
		$stringSQL = $stringSQL . "'" . $pCodUserBaixa . "', ";
		$stringSQL = $stringSQL . "'" . $pDatBaixa . "', ";
		$stringSQL = $stringSQL . "'" . $pDatArquivoRetorno . "', ";
		$stringSQL = $stringSQL . " ); ";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodBoleto, $pCodConfigBoleto, $pCodOs, $pNumParcela, $pValBoleto, $pDatVencimento, $pDatBoleto, $pValMulta, $pValJuros, $pValPgto, $pDatPgto, $pFlgEstornado, $pCodUserBaixa, $pDatBaixa, $pDatArquivoRetorno){
			$stringSQL = " UPDATE boleto ";
			$stringSQL = $stringSQL . " SET ";
			$stringSQL = $stringSQL . " COD_CONFIG_BOLETO = '" . $pCodConfigBoleto . "', ";
			$stringSQL = $stringSQL . " COD_OS = '" . $pCodOs . "', ";
			$stringSQL = $stringSQL . " NUM_PARCELA = '" . $pNumParcela . "', ";
			$stringSQL = $stringSQL . " VAL_BOLETO = '" . $pValBoleto . "', ";
			$stringSQL = $stringSQL . " DAT_VENCIMENTO = '" . $pDatVencimento . "', ";
			$stringSQL = $stringSQL . " DAT_BOLETO = '" . $pDatBoleto . "', ";
			$stringSQL = $stringSQL . " VAL_MULTA = '" . $pValMulta . "', ";
			$stringSQL = $stringSQL . " VAL_JUROS = '" . $pValJuros . "', ";
			$stringSQL = $stringSQL . " VAL_PGTO = '" . $pValPgto . "', ";
			$stringSQL = $stringSQL . " DAT_PGTO = '" . $pDatPgto . "', ";
			$stringSQL = $stringSQL . " FLG_ESTORNADO = '" . $pFlgEstornado . "', ";
			$stringSQL = $stringSQL . " COD_USER_BAIXA = '" . $pCodUserBaixa . "', ";
			$stringSQL = $stringSQL . " DAT_BAIXA = '" . $pDatBaixa . "', ";
			$stringSQL = $stringSQL . " DAT_ARQUIVO_RETORNO = '" . $pDatArquivoRetorno . "', ";
			$stringSQL = $stringSQL . " WHERE COD_BOLETO = '" . $pCodBoleto . "'; ";
		 		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>