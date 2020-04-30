<?php
require_once("../model/conexaoCls.php");
require_once("../model/tipoPessoaCls.php");

//classe Controller. Faz a ligação entre o model e a view.
class TipoPessoaCtr {
	public static function selecionar($codTipoPessoa){
		return tipoPessoaCls::selecionar($codTipoPessoa);
	}
}
?>