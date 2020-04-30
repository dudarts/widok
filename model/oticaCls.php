<?php 
require_once("conexaoCls.php");
require_once("oticaInt.php");

class OticaCls implements OticaInt {
	private $codOtica;
	private $desOtica;
	private $url;
	private $urlLogo;	
	private $flgAtivo;
	
	public function setCodOtica($pCodOtica){
		$this->codOtica = $pCodOtica;	
	}
	
	public function getCodOtica(){
		return $this->codOtica;	
	}

	public function setDesOtica($pDesOtica){
		$this->desOtica = $pDesOtica;	
	}
	
	public function getDesOtica(){
		return $this->desOtica;	
	}
	
	public function setUrl($pUrl){
		$this->url = $pUrl;
	}
	
	public function getUrl(){
		return $this->url;	
	}
	
	public function setUrlLogo($pUrlLogo){
		$this->urlLogo = $pUrlLogo;
	}
	
	public function getUrlLogo(){
		return $this->urlLogo;	
	}
	
	public function setFlgAtivo($pFlgAtivo){
		$this->flgAtivo = $pFlgAtivo;
	}
	
	public function getFlgAtivo(){
		return $this->flgAtivo;	
	}

	public function selecionar($pCodBusca, $pCodTipoBusca) {
		/*
		COD TIPO BUSCA
		1 - BUSCA PELO COD_OTICA
		2 - BUSCA PELA URL
		*/
		$stringSQL = "SELECT o.*, p.CPF, p.NOM_PESSOA, p.*, c.* FROM otica o INNER JOIN pessoa p on (p.COD_OTICA = o.COD_OTICA) INNER JOIN cidade c on (p.COD_CIDADE = c.COD_CIDADE)";
		if (func_num_args() > 1) {
			switch ($pCodTipoBusca) {
				case 1:
					$stringSQL = $stringSQL . " WHERE o.COD_OTICA = " . $pCodBusca;	
					break;
				case 2:
					$stringSQL = $stringSQL . " WHERE URL = '" . $pCodBusca . "'";	
					break;
			}
		} 
		$stringSQL = $stringSQL . " ;";
		
		//echo $stringSQL;
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	
	public function selecionarTodas() {
		$stringSQL = "SELECT o.*, p.*, c.* ";
		$stringSQL .= " FROM otica o ";
		$stringSQL .= " INNER JOIN filial f ON (f.COD_OTICA = o.COD_OTICA) ";
		$stringSQL .= " INNER JOIN pessoa p on (p.COD_PESSOA = f.COD_PESSOA_FILIAL) ";
		$stringSQL .= " INNER JOIN cidade c ON (c.COD_CIDADE = p.COD_CIDADE) ";
		$stringSQL .= " WHERE o.COD_OTICA <> 1;";

		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
// ESTE MÉTODO TEM QUE IR PARA O CONTROLLER
/*	public function selecionarURL($pURL) {
		$stringSQL = "SELECT * FROM otica WHERE URL = '" . $pURL . "';";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		$this->codOtica = $recordSet["COD_OTICA"];
		$this->desOtica = $recordSet["DES_OTICA"];
		$this->url = $recordSet["URL"];
		$this->urlLogo = $recordSet["URL_LOGO"];
		$this->flgAtivo = $recordSet["FLG_ATIVO"];
		return $recordSet;
	}
*/

	public function inserir($pDesOtica, $url, $urlLogo, $flgAtivo){
		$stringSQL = " INSERT INTO otica ";
		$stringSQL = $stringSQL . " (DES_OTICA, ";
		$stringSQL = $stringSQL . " URL, ";
		$stringSQL = $stringSQL . " URL_LOGO, ";
		$stringSQL = $stringSQL . " FLG_ATIVO) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . " '" . $pDesOtica . "', ";
		$stringSQL = $stringSQL . " '" . $url . "', ";
		$stringSQL = $stringSQL . " '" . $urlLogo . "', ";
		$stringSQL = $stringSQL . " " . $pCodPessoa . " "; 
		$stringSQL = $stringSQL . "'" . $pCodPessoa . "', ";
		$stringSQL = $stringSQL . "'" . $pCodOtica . "', ";
		$stringSQL = $stringSQL . "'" . $pCodTipoPessoa . "', ";
		$stringSQL = $stringSQL . "'" . $pCodCidade . "', ";
		$stringSQL = $stringSQL . "'" . $pEndPessoa . "', ";
		$stringSQL = $stringSQL . "'" . $pNumEndereco . "', ";
		$stringSQL = $stringSQL . " ); ";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodOtica, $pDesOtica, $pUrl, $pUrlLogo, $pFlgAtivo){
		$stringSQL = " UPDATE otica ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " DES_OTICA = '" . $pDesOtica . "', ";
		$stringSQL = $stringSQL . " URL = '" . $pUrl . "', ";
		$stringSQL = $stringSQL . " URL_LOGO = '" . $pUrlLogo . "', ";
		$stringSQL = $stringSQL . " FLG_ATIVO = '" . $pFlgAtivo . "' ";
		$stringSQL = $stringSQL . " WHERE COD_OTICA = " . $pCodOtica . "; ";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>