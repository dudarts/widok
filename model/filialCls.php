<?php 
require_once("conexaoCls.php");

class filialCls {
	public function inserir ($pCodOtica, $pCodFilial, $pflgMatriz){
		$stringSQL = "INSERT INTO filial VALUES (" . $pCodOtica . ", " . $pCodFilial . ", " . $pflgMatriz . ");";
		echo $stringSQL . "<br>";
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function deletar($pCodOtica, $pCodFilial){
		$stringSQL = "DELETE FROM filial WHERE COD_OTICA = " . $pCodOtica;
		
		if ($pCodFilial <> ""){
			$stringSQL = $stringSQL . " AND COD_PESSOA_FILIAL = " . $pCodFilial;			
		} 
		$stringSQL = $stringSQL . " AND FLG_MATRIZ <> 1; ";
		
		echo $stringSQL . "<br>";
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodOtica, $vetorFiliais){
		
		
		$pCodFilialam = count($vetorFiliais);

		$stringSQL = " DELETE FROM filial WHERE COD_OTICA = " . $pCodOtica . " AND FLG_MATRIZ <> 1;";
		
		for ($i = 0; $i < $tam; $i++){
			$stringSQL = $stringSQL . " INSERT INTO filial ";
			$stringSQL = $stringSQL . " (COD_OTICA, COD_PESSOA_FILIAL) VALUES (";
			$stringSQL = $stringSQL . " '" . $pCodOtica . "', ";
			$stringSQL = $stringSQL . " '" . $vetorFiliais[$i] . "');";
		}
		echo $stringSQL . "<br>";
				
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
}
?>