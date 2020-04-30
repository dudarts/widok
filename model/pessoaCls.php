<?php
require_once("conexaoCls.php");
require_once("pessoaInt.php");


class PessoaCls implements PessoaInt{
	private $codPessoa;
	private $codOtica;
	private $codTipoPessoa;
	private $codCidade;
	private $endPessoa;
	private $numEndereco;
	private $cep;
	private $cpf;
	private $nomMae;
	private $nomPessoa;
	private $datNascimento;
	private $numTelefone;
	private $numCelular;
	private $desEmail;
	private $codStatus;
	private $codSexo;
	private $codPessoaMatriz;
	private $stringSQL;

	public function setCodPessoa ($pCodPessoa) {
		$this->codPessoa = $pCodPessoa;
	}
	
	public function getCodPessoa ($pCodPessoa) {
		return $this->codPessoa;
	}
	
	public function setCodOtica ($pCodOtica) {
		$this->codOtica = $pCodOtica;
	}
	
	public function getCodOtica ($pCodOtica) {
		return $this->codOtica;
	}
	
	public function setCodTipoPessoa ($pCodTipoPessoa) {
		$this->codTipoPessoa = $pCodTipoPessoa;
	}
	
	public function getCodTipoPessoa ($pCodTipoPessoa) {
		return $this->codTipoPessoa;
	}
	
	public function setCodCidade ($pCodCidade) {
		$this->codCidade = $pCodCidade;
	}
	
	public function getCodCidade ($pCodCidade) {
		return $this->codCidade;
	}
	
	public function setEndPessoa ($pEndPessoa) {
		$this->endPessoa = $pEndPessoa;
	}
	
	public function getEndPessoa ($pEndPessoa) {
		return $this->endPessoa;
	}
	
	public function setNumEndereco ($pNumEndereco) {
		$this->numEndereco = $pNumEndereco;
	}
	
	public function getNumEndereco ($pNumEndereco) {
		return $this->numEndereco;
	}
	
	public function setCep($pCep) {
		$this->cep = $pCep;
	}
	
	public function getCep($pCep) {
		return $this->cep;
	}
	
	public function setCpf($pCpf) {
		$this->cpf = $pCpf;
	}
	
	public function getCpf($pCpf) {
		return $this->cpf;
	}
	
	public function setNomMae ($pNomMae) {
		$this->nomMae = $pNomMae;
	}
	
	public function getNomMae ($pNomMae) {
		return $this->nomMae;
	}
	
	public function setNomPessoa ($pNomPessoa) {
		$this->nomPessoa = $pNomPessoa;
	}
	
	public function getNomPessoa ($pNomPessoa) {
		return $this->nomPessoa;
	}
	
	public function setDatNascimento ($pDatNascimento) {
		$this->datNascimento = $pDatNascimento;
	}
	
	public function getDatNascimento ($pDatNascimento) {
		return $this->datNascimento;
	}
	
	public function setNumTelefone ($pNumTelefone) {
		$this->numTelefone = $pNumTelefone;
	}
	
	public function getNumTelefone ($pNumTelefone) {
		return $this->numTelefone;
	}
	
	public function setNumCelular ($pNumCelular) {
		$this->numCelular = $pNumCelular;
	}
	
	public function getNumCelular ($pNumCelular) {
		return $this->numCelular;
	}
	
	public function setDesEmail ($pDesEmail) {
		$this->desEmail = $pDesEmail;
	}
	
	public function getDesEmail ($pDesEmail) {
		return $this->desEmail;
	}
	
	public function setCodStatus ($pCodStatus) {
		$this->codStatus = $pCodStatus;
	}
	
	public function getCodStatus ($pCodStatus) {
		return $this->codStatus;
	}
	
	public function setCodSexo ($pCodSexo) {
		$this->codSexo = $pCodSexo;
	}
	
	public function getCodSexo ($pCodSexo) {
		return $this->codSexo;
	}
	
	public function setCodPessoaMatriz ($pCodPessoaMatriz) {
		$this->codPessoaMatriz = $pCodPessoaMatriz;
	}
	
	public function getCodPessoaMatriz ($pCodPessoaMatriz) {
		return $this->codPessoaMatriz;
	}

	public function selecionar($pCodOtica, $pCodBusca, $pCodTipoBusca, $pCodStatus) {
		/*
		COD TIPO BUSCA
		1 - BUSCA SÓ PELO COD_PESSOA
		2 - BUSCA PELO COD_PESSOA OR NOM_PESSOA
		3 - BUSCA PELO COD_PESSOA OR NOM_PESSOA OR CPF/CNPJ
		4 - BUSCA SOMENTE PELO CPF
		*/
		
		$stringSQL = " SELECT p.*, c.*, IF (p.COD_STATUS = 0, 'Inativo', 'Ativo') AS DES_STATUS FROM pessoa p INNER JOIN cidade c ON (c.COD_CIDADE = p.COD_CIDADE)  WHERE COD_OTICA = " . $pCodOtica;
		if ($pCodBusca <> "") {
			switch ($pCodTipoBusca) {
				case 1:
					$stringSQL = $stringSQL . " AND COD_PESSOA = " . $pCodBusca;	
					break;
				case 2:
					$stringSQL = $stringSQL . " AND (COD_PESSOA = '" . $pCodBusca . "'";
					$stringSQL = $stringSQL . " OR NOM_PESSOA LIKE '" . $pCodBusca . "%')";
					break;
				case 3: 		
					$stringSQL = $stringSQL . " AND (COD_PESSOA = '" . $pCodBusca . "'";
					$stringSQL = $stringSQL . " OR NOM_PESSOA LIKE '" . $pCodBusca . "%'";	
					$stringSQL = $stringSQL . " OR CPF = '" . $pCodBusca . "')";
					break;
				case 4:
					$stringSQL = $stringSQL . " AND CPF = '" . $pCodBusca . "'";	
					break;
			}
		} 
		
		switch($pCodStatus) {
			case 1:
				$stringSQL = $stringSQL . " AND COD_STATUS = 1" ;
				break;
			case 0: 
				$stringSQL = $stringSQL . " AND COD_STATUS = 0"; 
				break;
			default:
				break;
		}
		
		$stringSQL = $stringSQL . " ORDER BY NOM_PESSOA ;";

		//echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;		
	}
	
	public function inserir($pCodOtica, $pCodTipoPessoa, $pCodCidade, $pEndPessoa, $pNumEndereco, $pCep, $pCpf, $pNomMae, $pNomPessoa, $pDatNascimento, $pNumTelefone, $pNumCelular, $pDesEmail, $pCodStatus, $pCodSexo, $pFlgExterno, $pDesBairro, $pFlgMedico ) {
		$stringSQL = " INSERT INTO pessoa ";
		$stringSQL = $stringSQL . " (COD_OTICA, ";
		$stringSQL = $stringSQL . " COD_TIPO_PESSOA, ";
		$stringSQL = $stringSQL . " COD_CIDADE, ";
		$stringSQL = $stringSQL . " END_PESSOA, ";
		$stringSQL = $stringSQL . " NUM_ENDERECO, ";
		$stringSQL = $stringSQL . " CEP, ";
		$stringSQL = $stringSQL . " CPF, ";
		$stringSQL = $stringSQL . " NOM_MAE, ";
		$stringSQL = $stringSQL . " NOM_PESSOA, ";
		$stringSQL = $stringSQL . " DAT_NASCIMENTO, ";
		$stringSQL = $stringSQL . " NUM_TELEFONE, ";
		$stringSQL = $stringSQL . " NUM_CELULAR, ";
		$stringSQL = $stringSQL . " DES_EMAIL, ";
		$stringSQL = $stringSQL . " FLG_EXTERNO, ";
		$stringSQL = $stringSQL . " COD_STATUS, ";
		$stringSQL = $stringSQL . " COD_SEXO, ";
		$stringSQL = $stringSQL . " DES_BAIRRO, ";
		$stringSQL = $stringSQL . " FLG_MEDICO ";
		$stringSQL = $stringSQL . " ) VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . "'" . $pCodOtica . "', ";
		$stringSQL = $stringSQL . "'" . $pCodTipoPessoa . "', ";
		$stringSQL = $stringSQL . "'" . $pCodCidade . "', ";
		$stringSQL = $stringSQL . "'" . $pEndPessoa . "', ";
		$stringSQL = $stringSQL . "'" . $pNumEndereco . "', ";
		$stringSQL = $stringSQL . "'" . $pCep . "', ";
		$stringSQL = $stringSQL . "'" . $pCpf . "', ";
		$stringSQL = $stringSQL . "'" . $pNomMae . "', ";
		$stringSQL = $stringSQL . "'" . $pNomPessoa . "', ";
		$stringSQL = $stringSQL . "'" . $pDatNascimento . "', ";
		$stringSQL = $stringSQL . "'" . $pNumTelefone . "', ";
		$stringSQL = $stringSQL . "'" . $pNumCelular . "', ";
		$stringSQL = $stringSQL . "'" . $pDesEmail . "', ";
		$stringSQL = $stringSQL . "'" . $pFlgExterno . "', ";
		$stringSQL = $stringSQL . "'" . $pCodStatus . "', ";
		$stringSQL = $stringSQL . "'" . $pCodSexo . "', ";
		$stringSQL = $stringSQL . "'" . $pDesBairro . "', ";
		$stringSQL = $stringSQL . "'" . $pFlgMedico . "' ";
		$stringSQL = $stringSQL . " ); ";
	
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	
	public function atualizar($pCodPessoa, $pCodOtica, $pCodTipoPessoa, $pCodCidade, $pEndPessoa, $pNumEndereco, $pCep, $pCpf, $pNomMae, $pNomPessoa, $pDatNascimento, $pNumTelefone, $pNumCelular, $pDesEmail, $pCodStatus, $pCodSexo, $pFlgExterno, $pDesBairro, $pFlgMedico){
		$stringSQL = " UPDATE pessoa ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " COD_PESSOA = '" . $pCodPessoa . "', ";
		$stringSQL = $stringSQL . " COD_OTICA = '" . $pCodOtica . "', ";
		$stringSQL = $stringSQL . " COD_TIPO_PESSOA = '" . $pCodTipoPessoa . "', ";
		$stringSQL = $stringSQL . " COD_CIDADE = '" . $pCodCidade . "', ";
		$stringSQL = $stringSQL . " END_PESSOA = '" . $pEndPessoa . "', ";
		$stringSQL = $stringSQL . " NUM_ENDERECO = '" . $pNumEndereco . "', ";
		$stringSQL = $stringSQL . " CEP = '" . $pCep . "', ";
		$stringSQL = $stringSQL . " CPF = '" . $pCpf . "', ";
		$stringSQL = $stringSQL . " NOM_MAE = '" . $pNomMae . "', ";
		$stringSQL = $stringSQL . " NOM_PESSOA = '" . $pNomPessoa . "', ";
		$stringSQL = $stringSQL . " DAT_NASCIMENTO = '" . $pDatNascimento . "', ";
		$stringSQL = $stringSQL . " NUM_TELEFONE = '" . $pNumTelefone . "', ";
		$stringSQL = $stringSQL . " NUM_CELULAR = '" . $pNumCelular . "', ";
		$stringSQL = $stringSQL . " DES_EMAIL = '" . $pDesEmail . "', ";
		$stringSQL = $stringSQL . " COD_STATUS = '" . $pCodStatus . "', ";
		$stringSQL = $stringSQL . " COD_SEXO = '" . $pCodSexo . "', ";
		$stringSQL = $stringSQL . " FLG_EXTERNO = '" . $pFlgExterno . "', ";
		$stringSQL = $stringSQL . " DES_BAIRRO = '" . $pDesBairro . "', ";
		$stringSQL = $stringSQL . " FLG_MEDICO = '" . $pFlgMedico . "' ";
		//$stringSQL = $stringSQL . " COD_PESSOA_MATRIZ = '" . $pCodPessoaMatriz . "', ";
		$stringSQL = $stringSQL . " WHERE COD_PESSOA = " . $pCodPessoa . " AND COD_OTICA = " . $pCodOtica . "; ";

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;

	}
	
	public function excluir($pCodPessoa){
		$stringSQL = "DELETE FROM pessoa WHERE COD_PESSOA = " . $pCodPessoa;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;

	}
	
	public function todosPorTipo($pCodOtica, $pCodTipoBusca, $pCodBusca, $pFiltroExtra){
		$pCodTipoBusca == "filial" ?  $inner = "INNER" : $inner = "LEFT";
		
		$stringSQL = " SELECT p.*, c.*, IFNULL(f.COD_OTICA,0) FLG_FILIAL, IFNULL(f.FLG_MATRIZ, 0) MATRIZ  ";
		$stringSQL = $stringSQL . " FROM pessoa p ";	
		$stringSQL = $stringSQL . " INNER JOIN cidade c ON (c.COD_CIDADE = p.COD_CIDADE) ";	
		$stringSQL = $stringSQL . $inner . " JOIN filial f ON (f.COD_PESSOA_FILIAL = p.COD_PESSOA) ";	
		$stringSQL = $stringSQL . "  WHERE p.COD_OTICA = " . $pCodOtica;
		
		
		
		$pCodTipoBusca = strtolower($pCodTipoBusca);
		if ($pCodBusca <> "") {
			switch ($pCodTipoBusca) {
				case "sexo":
					$stringSQL = $stringSQL . " AND SEXO = '" . $pCodBusca . "'";	
					break;
				case "tipopessoa":
					$stringSQL = $stringSQL . " AND COD_TIPO_PESSOA = '" . $pCodBusca . "'";
					break;
				case "status": 		
					$stringSQL = $stringSQL . " AND COD_STATUS = '" . $pCodBusca . "'";
					break;
				case "cidade":
					$stringSQL = $stringSQL . " AND c.DES_CIDADE LIKE '%" . $pCodBusca . "%'";	
					$stringSQL = $stringSQL . " OR p.COD_CIDADE = '" . $pCodBusca . "'";	
					break;
			}
		} 
		if ($pFiltroExtra <> "") {
			$stringSQL = $stringSQL . " AND (p.COD_PESSOA = '" . $pFiltroExtra . "'";
			$stringSQL = $stringSQL . " OR p.NOM_PESSOA LIKE '%" . $pFiltroExtra . "%'";	
			$stringSQL = $stringSQL . " OR p.CPF = '" . $pFiltroExtra . "') ";	
		}
				
		
		$stringSQL = $stringSQL . " ORDER BY MATRIZ DESC, FLG_FILIAL DESC, NOM_PESSOA ;";

		//echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;		
		
	}
	
	public function listarMedicos($pCodOtica){
		$stringSQL = "SELECT COD_PESSOA, NOM_PESSOA FROM pessoa P WHERE P.FLG_MEDICO = 1 AND P.COD_OTICA = " . $pCodOtica . " ORDER BY NOM_PESSOA";
		
		echo $stringSQL;	
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;

	}

}
?>