<?php
interface UsuarioInt {
	public static function selecionar($pCodOtica, $pCodUsuario, $pSenha, $pCodStatus, $pTipoBusca, $pCodFilial);
//	public static function selecionar($pCodOtica, $pCodUsuario, $pSenha);
	public function inserir($pCodUsuario, $pCodOtica, $pCodPessoa, $pSenha, $pCodPermissao, $pCodStatus, $pCodFilial);
	public function atualizar($pCodUsuario, $pCodOtica, $pSenha, $pCodPermissao, $pCodStatus);
}
?>