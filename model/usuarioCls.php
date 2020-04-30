<?php ob_start(); ?>
<?php
require_once("conexaoCls.php");
require_once("usuarioInt.php");

class UsuarioCls implements UsuarioInt {
	private $codUsuario;
	private $codOtica;
	private $codPessoa;
	private $senha;
	private $codPermissao;
	private $codStatus;
		
	public function setCodUsuario ($pCodUsuario) {
		$this->codUsuario = $pCodUsuario;
	}
	
	public function getCodUsuario () {
		return $this->codUsuario;
	}
	
	public function setCodOtica ($pCodOtica) {
		$this->codOtica = $pCodOtica;
	}
	
	public function getCodOtica () {
			return $this->codOtica;
	}
	
	public function setCodPessoa ($pCodPessoa) {
		$this->codPessoa = $pCodPessoa;
	}
	
	public function getCodPessoa () {
		return $this->codPessoa;
	}
	
	public function setSenha ($pSenha) {
		$this->senha = $pSenha;
	}
	
	public function getSenha () {
		return $this->senha;
	}
	
	public function setCodPermissao ($pCodPermissao) {
		$this->codPermissao = $pCodPermissao;
	}
	
	public function getCodPermissao () {
		return $this->codPermissao;
	}
	
	public function setCodStatus ($pCodStatus) {
		$this->codStatus = $pCodStatus;
	}
	
	public function getCodStatus () {
		return $this->codStatus;
	}

	public static function selecionar($pCodOtica, $pCodUsuario, $pSenha, $pCodStatus, $pTipoBusca, $pCodFilial) {
//	public static function selecionar() {
				//func_get_arg (1)
		$stringSQL = " SELECT  u.COD_USUARIO,  ";
		$stringSQL = $stringSQL . "         u.COD_PESSOA, ";
		$stringSQL = $stringSQL . "         pu.NOM_PESSOA, ";
		$stringSQL = $stringSQL . "         u.COD_OTICA, ";
		$stringSQL = $stringSQL . "         o.DES_OTICA, ";
		$stringSQL = $stringSQL . "         u.COD_PERMISSAO, ";
		$stringSQL = $stringSQL . "         p.DES_PERMISSAO, ";
		$stringSQL = $stringSQL . "         u.COD_FILIAL, ";
		$stringSQL = $stringSQL . "         pf.NOM_PESSOA FILIAL, ";
		$stringSQL = $stringSQL . "         cf.DES_CIDADE, ";
		$stringSQL = $stringSQL . "         cf.COD_ESTADO, ";
		$stringSQL = $stringSQL . "         u.COD_STATUS ";
		$stringSQL = $stringSQL . " FROM usuario u ";
		$stringSQL = $stringSQL . "     INNER JOIN pessoa pu ON (pu.COD_PESSOA = u.COD_PESSOA) ";
		$stringSQL = $stringSQL . "     INNER JOIN otica o ON (o.COD_OTICA = u.COD_OTICA) ";
		$stringSQL = $stringSQL . "     INNER JOIN permissao p ON (p.COD_PERMISSAO = u.COD_PERMISSAO) ";
		$stringSQL = $stringSQL . "     INNER JOIN filial f ON (f.COD_PESSOA_FILIAL = u.COD_FILIAL AND f.COD_OTICA = u.COD_OTICA) ";
		$stringSQL = $stringSQL . "     INNER JOIN pessoa pf ON (pf.COD_PESSOA = f.COD_PESSOA_FILIAL) ";
		$stringSQL = $stringSQL . "     INNER JOIN cidade cf ON (cf.COD_CIDADE = pf.COD_CIDADE) ";
		$stringSQL = $stringSQL . " WHERE u.COD_OTICA = " . $pCodOtica;
		
		switch ($pTipoBusca) {
			case 1 : 
				$stringSQL = $stringSQL . " AND (u.COD_USUARIO LIKE '%" . $pCodUsuario . "%' ";	
				$stringSQL = $stringSQL . " OR pu.NOM_PESSOA LIKE '%" . $pCodUsuario . "%' ";	
				$stringSQL = $stringSQL . " OR pu.COD_PESSOA = '" . $pCodUsuario . "') ";	
				break;
			default:
				$pCodUsuario <> "" 	? $stringSQL = $stringSQL . " AND u.COD_USUARIO = '" . $pCodUsuario . "' " 		: "";
				$pSenha <> ""		? $stringSQL = $stringSQL . " AND u.SENHA = md5('" . func_get_arg(2) . "') "	: "";
				
		}
				$pCodFilial <> "" 	? $stringSQL = $stringSQL . " AND u.COD_FILIAL = " . $pCodFilial				: "";			
				$pCodStatus <> "" 	? $stringSQL = $stringSQL . " AND u.COD_STATUS = " . $pCodStatus				: "";

		$stringSQL = $stringSQL . " /*AND u.COD_PESSOA <> 2*/ ORDER BY pf.NOM_PESSOA, pu.NOM_PESSOA;";

		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;

	}
	
	public function inserir($pCodUsuario, $pCodOtica, $pCodPessoa, $pSenha, $pCodPermissao, $pCodStatus, $pCodFilial){
		$stringSQL = " INSERT INTO usuario ";
		$stringSQL = $stringSQL . " (COD_USUARIO, ";
		$stringSQL = $stringSQL . " COD_OTICA, ";
		$stringSQL = $stringSQL . " COD_PESSOA, ";
		$stringSQL = $stringSQL . " SENHA, ";
		$stringSQL = $stringSQL . " COD_PERMISSAO, ";
		$stringSQL = $stringSQL . " COD_STATUS, COD_FILIAL) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . "'" . $pCodUsuario . "', ";
		$stringSQL = $stringSQL . "'" . $pCodOtica . "', ";
		$stringSQL = $stringSQL . "'" . $pCodPessoa . "', ";
		$stringSQL = $stringSQL . "'" . $pSenha . "', ";
		$stringSQL = $stringSQL . "'" . $pCodPermissao . "', ";
		$stringSQL = $stringSQL . "'" . $pCodStatus . "', ";
		$stringSQL = $stringSQL . "'" . $pCodFilial . "' ";
		$stringSQL = $stringSQL . " ); ";
		
//		echo $stringSQL;
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	
	public function atualizar($pCodUsuario, $pCodOtica, $pSenha, $pCodPermissao, $pCodStatus){
		$stringSQL = " UPDATE usuario ";
		$stringSQL = $stringSQL . " SET ";
		$stringSQL = $stringSQL . " SENHA = '" . $pSenha . "', ";
		$stringSQL = $stringSQL . " COD_PERMISSAO = '" . $pCodPermissao . "', ";
		$stringSQL = $stringSQL . " COD_STATUS = '" . $pCodStatus . "' ";
		$stringSQL = $stringSQL . " WHERE COD_USUARIO = '" . $pCodUsuario . "' AND COD_OTICA = '" . $pCodOtica . "'; ";

//		echo $stringSQL;
//		exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function listaVendedorExterno($pCodOtica){
		$stringSQL = " SELECT COD_PESSOA, NOM_PESSOA FROM pessoa where FLG_EXTERNO = 1 AND COD_STATUS = 1 AND  COD_OTICA = $pCodOtica ORDER BY NOM_PESSOA;";
//		echo $stringSQL;
//		exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>