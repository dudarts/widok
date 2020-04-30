<?php
require_once("../model/usuarioCls.php");
require_once("oticaCtr.php");
require_once("pessoaCtr.php");
require_once("permissaoCtr.php");

class UsuarioCtr {
	public function validar($pCodOtica, $pCodUsuario, $pCodSenha){
//		$usuario = new UsuarioCls();
		$rUsuario = UsuarioCls::selecionar($pCodOtica, $pCodUsuario, $pCodSenha, 1, "", "")->fetch_array(MYSQLI_ASSOC);
		
//		$usuario->setCodOtica($rUsuario['COD_OTICA']);
//		$usuario->setCodPermissao($rUsuario['COD_PERMISSAO']);
//		$usuario->setCodPessoa($rUsuario['COD_PESSOA']);
//		$usuario->setCodStatus($rUsuario['COD_STATUS']);
//		$usuario->setCodUsuario($rUsuario['COD_USUARIO']);
		
		if ($rUsuario['COD_STATUS'] == false){
			return false;
		} else {
			@session_start();
			$_SESSION['codOtica'] = $rUsuario['COD_OTICA'];
			$_SESSION['codPermissao'] = $rUsuario['COD_PERMISSAO'];
			$_SESSION['codPessoa'] = $rUsuario['COD_PESSOA'];
			$_SESSION['codUsuario'] = $rUsuario['COD_USUARIO'];
			$_SESSION['nomPessoa'] = $rUsuario['NOM_PESSOA'];;
			$_SESSION['desOtica'] = $rUsuario['DES_OTICA'];;
			$_SESSION['desPermissao'] = $rUsuario['DES_PERMISSAO'];
			$_SESSION['desFilial'] = $rUsuario['FILIAL'];
			$_SESSION['codFilial'] = $rUsuario['COD_FILIAL'];
			$_SESSION['desCidade'] = $rUsuario['DES_CIDADE'];
			$_SESSION['codEstado'] = $rUsuario['COD_ESTADO'];
//			$_SESSION['codMatriz'] = $rUsuario['COD_MATRIZ'];
			return true;
		}	
		
	
	}
	
	public function selecionar($pCodOtica, $pCodUsuario, $pSenha, $pCodStatus, $pTipoBusca, $pCodFilial){
		return UsuarioCls::selecionar($pCodOtica, $pCodUsuario, $pSenha, $pCodStatus, $pTipoBusca, $pCodFilial);
	}
	
	public function inserir($pCodUsuario, $pCodOtica, $pCodPessoa, $pSenha, $pCodPermissao, $pCodStatus, $pCodFilial){
		$obj = new UsuarioCls();
		return $obj->inserir(strtolower($pCodUsuario), $pCodOtica, $pCodPessoa, md5($pSenha), $pCodPermissao, $pCodStatus, $pCodFilial);
	}
	
	public function atualizar($pCodUsuario, $pCodOtica, $pSenha, $pCodPermissao, $pCodStatus){
		$obj = new UsuarioCls();
		return $obj->atualizar($pCodUsuario, $pCodOtica, $pSenha, $pCodPermissao, $pCodStatus);
	}

	public function listaVendedorExterno($pCodOtica, $pCodFilial){
		$obj = new UsuarioCls();
		return $obj->listaVendedorExterno($pCodOtica, $pCodFilial);
	}

}



if (isset($_POST['pfUsuario']) && isset($_POST['pfSenha'])){
	$pfUsuario = $_POST['pfUsuario'];
	$pfSenha = $_POST['pfSenha'];
	$pfCodOtica = OticaCtr::getCodOtica($_POST['pfCodOtica']);
//	echo "Ótica: " . $_POST['pfCodOtica'];
	
	$usuario = new UsuarioCtr();
	$usarioOk = $usuario->validar($pfCodOtica, $pfUsuario, $pfSenha);
	if ($usarioOk == true){
		header("location:../view/pagina.php");
	} else {
		header("location:../../index.php?msg='ERRO NA AUTENTICAÇÃO'");
	}
}
?>