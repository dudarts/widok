<?php 
require_once("conexaoCls.php");
require_once("tipoPessoaInt.php");

class TipoPessoaCls implements TipoPessoaInt {
	private $codTipoPessoa;
	private $desTipoPessoa;
	
	public function setTipoPessoa($pCodTipoPessoa){
		$this->codTipoPessoa = $pCodTipoPessoa;	
	}
	
	public function getCodTipoPessoa(){
		return $this->codTipoPessoa;	
	}
	
	public function setDesTipoPessoa($pDesTipoPessoa){
		$this->desTipoPessoa = $pDesTipoPessoa;
	}
	
	public function getDesTipoPessoa(){
		return $this->desTipoPessoa;	
	}
	
	public static function selecionar($pCodTipoPessoa){
			$stringSQL = "SELECT * FROM tipo_pessoa";
			$pCodTipoPessoa <> "" ? $stringSQL = $stringSQL . " WHERE COD_TIPO_PESSOA = '" . $pCodTipoPessoa . "' ;" : $stringSQL = $stringSQL . ";";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
	}
}
?>