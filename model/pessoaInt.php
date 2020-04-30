<?php
interface PessoaInt {
	public function selecionar($pCodOtica, $pCodBusca, $pCodTipoBusca, $pCodStatus);
	public function inserir($pCodOtica, $pCodTipoPessoa, $pCodCidade, $pEndPessoa, $pNumEndereco, $pCep, $pCpf, $pNomMae, $pNomPessoa, $pDatNascimento, $pNumTellefone, $pNumCelular, $pDesEmail, $pCodStatus, $pCodSexo, $pFlgExterno, $pDesBairro, $pFlgMedico);
	public function atualizar($pCodPessoa, $pCodOtica, $pCodTipoPessoa, $pCodCidade, $pEndPessoa, $pNumEndereco, $pCep, $pCpf, $pNomMae, $pNomPessoa, $pDatNascimento, $pNumTellefone, $pNumCelular, $pDesEmail, $pCodStatus, $pCodSexo, $pFlgExterno, $pDesBairro, $pFlgMedico);
}
?>