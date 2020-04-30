<?php 
require_once("conexaoCls.php");
require_once("osCls.php");

class LancamentoCls {
	private $numLancamento;
	private $codOs;
	private $numParcela;
	private $valParcela;
	private $valPago;
	private $datPgto;
	private $flgEstorno;
	private $codUsuario;

	public function setNumLancamento ($pNumLancamento) {
		$this->numLancamento = $pNumLancamento;
	}
	
	public function getNumLancamento ($pNumLancamento) {
		return $this->numLancamento;
	}
	public function setCodOs ($pCodOs) {
		$this->codOs = $pCodOs;
	}
	
	public function getCodOs ($pCodOs) {
		return $this->codOs;
	}
	public function setNumParcela ($pNumParcela) {
		$this->numParcela = $pNumParcela;
	}
	
	public function getNumParcela ($pNumParcela) {
		return $this->numParcela;
	}
	public function setValParcela ($pValParcela) {
		$this->valParcela = $pValParcela;
	}
	
	public function getValParcela ($pValParcela) {
		return $this->valParcela;
	}
	public function setValPago ($pValPago) {
		$this->valPago = $pValPago;
	}
	
	public function getValPago ($pValPago) {
		return $this->valPago;
	}
	public function setDatPgto ($pDatPgto) {
		$this->datPgto = $pDatPgto;
	}
	
	public function getDatPgto ($pDatPgto) {
		return $this->datPgto;
	}
	public function setFlgEstorno ($pFlgEstorno) {
		$this->flgEstorno = $pFlgEstorno;
	}
	
	public function getFlgEstorno ($pFlgEstorno) {
		return $this->flgEstorno;
	}
	public function setCodUsuario ($pCodUsuario) {
		$this->codUsuario = $pCodUsuario;
	}
	
	public function getCodUsuario ($pCodUsuario) {
		return $this->codUsuario;
	}
	
	public function selecionar($pCodOtica, $pBusca, $pCodTipoBusca) {
		/*
		1 = NUM_LANCAMENTO
		2 = COD_PESSOA ou NOM_PESSOA ou CPF
		3 = NUM_LANCAMENTO OU COD_PESSOA ou NOM_PESSOA ou CPF OU COD_OS
		4 = COD_OS 
		4 = COD_OS e NUM_PARCELA EM ABERTO
		*/

		$stringSQL = "SELECT l.NUM_LANCAMENTO, l.COD_OS, l.NUM_PARCELA, l.VAL_PARCELA, l.VAL_PAGO,  DATE_FORMAT(l.DAT_PGTO, '%d/%m/%Y') AS DAT_PGTO, l.FLG_ESTORNO, l.COD_USUARIO, DATEDIFF(DAT_VENCIMENTO, NOW()) DIAS, DATEDIFF(DAT_VENCIMENTO, DAT_PGTO) ATRASO, l.VAL_MORA, l.VAL_JUROS, l.VAL_DESCONTO_PARCELA, l.DES_BAIXA_LANCAMENTO, l.COD_USUARIO_ESTORNO, pu.NOM_PESSOA DES_NOME_ESTORNO ";
		$stringSQL = $stringSQL . "  , DATE_FORMAT(DAT_VENCIMENTO, '%d/%m/%Y') AS DAT_VENCIMENTO, p.NOM_PESSOA, os.DAT_PEDIDO ";
		$stringSQL = $stringSQL . "  FROM lancamento l ";
		$stringSQL = $stringSQL . " INNER JOIN os ON (os.COD_OS = l.COD_OS) ";
		$stringSQL = $stringSQL . " INNER JOIN pessoa p ON (p.COD_PESSOA = os.COD_PESSOA) ";
		$stringSQL = $stringSQL . " LEFT JOIN usuario u ON (u.COD_USUARIO = l.COD_USUARIO_ESTORNO AND os.COD_OTICA = u.COD_OTICA) ";
		$stringSQL = $stringSQL . " LEFT JOIN pessoa pu ON (pu.COD_PESSOA = u.COD_PESSOA) ";
		$stringSQL = $stringSQL . " WHERE os.COD_OTICA = " . $pCodOtica;
		
		if ($pBusca <> "") {
			switch ($pCodTipoBusca){
				case 1:
					$stringSQL = $stringSQL . " AND l.NUM_LANCAMENTO = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " ORDER BY l.NUM_PARCELA;";
					break;
				case 2:
					$stringSQL = $stringSQL . " AND os.COD_PESSOA = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " OR p.NOM_PESSOA LIKE '" . $pBusca . "%'";
					$stringSQL = $stringSQL . " OR p.CPF = '" . $pBusca . "%'";
					$stringSQL = $stringSQL . " ORDER BY l.NOM_PESSOA;";
					break;
				case 3:
					$stringSQL = $stringSQL . " AND l.NUM_LANCAMENTO = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " OR os.COD_PESSOA = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " OR p.NOM_PESSOA LIKE '" . $pBusca . "%'";
					$stringSQL = $stringSQL . " OR p.CPF = '" . $pBusca . "%'";
					$stringSQL = $stringSQL . " OR l.COD_OS = '" . $pBusca . "%'";
					$stringSQL = $stringSQL . " ORDER BY p.NOM_PESSOA;";
					break;
				case 4:
					$stringSQL = $stringSQL . " AND l.COD_OS = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " ORDER BY l.NUM_PARCELA, NUM_LANCAMENTO;";
					break;
				case 5:
					$stringSQL = $stringSQL . " AND l.COD_OS = '" . $pBusca . "'";
					$stringSQL = $stringSQL . " ORDER BY l.NUM_PARCELA;";
					break;
				default:
					$stringSQL = $stringSQL . " ORDER BY l.NUM_LANCAMENTO, l.NUM_PARCELA;";
			}
		} 
		//echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function inserir($pCodOtica, $pCodOs, $pNumParcela, $pValParcela, $pCodUsuario){
		$obj = new OsCls();
		$rsOS = mysqli_fetch_assoc($obj->selecionar($pCodOtica, $pCodOs, 1, 0));
		if ($pNumParcela == 0) {
			$datVencimento = "DATE('" . $rsOS["DAT_ENTREGA"] . "')";
		} else {
			$d = getdate(strtotime($rsOS["DAT_ENTREGA"])); 
			$rsOS["DIA_PAGAMENTO"] == "" ? $dataPedido = $rsOS["DAT_PEDIDO"] : $dataPedido = $d["year"] . "-" . $d["mon"] . "-" . $rsOS["DIA_PAGAMENTO"];
			$datVencimento = " DATE_ADD(DATE('" . $dataPedido . "'), INTERVAL (" . $pNumParcela . ") MONTH) ";
		}
		
		//echo $datVencimento;
		//exit;

		$stringSQL = " INSERT INTO lancamento (";
		//$stringSQL = $stringSQL . " (NUM_LANCAMENTO, ";
		$stringSQL = $stringSQL . " COD_OS, ";
		$stringSQL = $stringSQL . " NUM_PARCELA, ";
		$stringSQL = $stringSQL . " VAL_PARCELA, ";
		$stringSQL = $stringSQL . " DAT_VENCIMENTO, ";
		//$stringSQL = $stringSQL . " VAL_PAGO, ";
		//$stringSQL = $stringSQL . " VAL_PAGO, ";
		//$stringSQL = $stringSQL . " DAT_PGTO, ";
		//$stringSQL = $stringSQL . " FLG_ESTORNO, ";
		$stringSQL = $stringSQL . " COD_USUARIO) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		//$stringSQL = $stringSQL . "'" . $pNumLancamento . "', ";
		$stringSQL = $stringSQL . "'" . $pCodOs . "', ";
		$stringSQL = $stringSQL . "'" . $pNumParcela . "', ";
		$stringSQL = $stringSQL . "'" . $pValParcela . "', ";
		$stringSQL = $stringSQL . $datVencimento . ", ";
		//$stringSQL = $stringSQL . "'" . $pValPago . "', ";
		//$stringSQL = $stringSQL . "'" . $pDatPgto . "', ";
		//$stringSQL = $stringSQL . "'" . $pFlgEstorno . "', ";
		$stringSQL = $stringSQL . "'" . $pCodUsuario . "' ";
		$stringSQL = $stringSQL . " ); ";
		
		//echo $stringSQL . "<br>";
		//exit();
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function inserirRetirada($pValPago, $pDesLancamento, $pCodUsuarioBaixa, $pCodOtica) {
		$stringSQL = " INSERT INTO lancamento (";
		$stringSQL = $stringSQL . " VAL_PAGO, ";
		$stringSQL = $stringSQL . " DES_BAIXA_LANCAMENTO, ";
		$stringSQL = $stringSQL . " COD_USUARIO, COD_OTICA, DAT_PGTO) ";
		$stringSQL = $stringSQL . " VALUES ";
		$stringSQL = $stringSQL . " ( ";
		$stringSQL = $stringSQL . "'" . $pValPago . "', ";
		$stringSQL = $stringSQL . "'" . $pDesLancamento . "', ";
		$stringSQL = $stringSQL . "'" . $pCodUsuarioBaixa . "', ";
		$stringSQL = $stringSQL . $pCodOtica . ", ";
		$stringSQL = $stringSQL . " NOW() ";
		$stringSQL = $stringSQL . " ); ";
		
		//echo $stringSQL . "<br>";
		//exit();
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function baixa($pNumLancamento, $pCodOs, $pNumParcela, $pValMora, $pValJuros, $pValDescontoParcela, $pValPago, $pCodUsuarioBaixa, $pDesBaixaLancamento, $pCodOtica){
		if ($pNumLancamento == NULL && $pCodOs == NULL && $pNumParcela == NULL ) {
			$l = new LancamentoCls();
			$l->inserirRetirada($pValPago, $pDesBaixaLancamento, $pCodUsuarioBaixa, $pCodOtica);
		} else {
			$stringSQL = " UPDATE lancamento SET";
			$stringSQL = $stringSQL . " VAL_MORA = '" . $pValMora . "', ";
			$stringSQL = $stringSQL . " VAL_JUROS = '" . $pValJuros . "', ";
			$stringSQL = $stringSQL . " VAL_DESCONTO_PARCELA = '" . $pValDescontoParcela . "', ";
			$stringSQL = $stringSQL . " VAL_PAGO = '" . $pValPago . "', ";
			$stringSQL = $stringSQL . " DAT_PGTO = NOW(), ";
			$stringSQL = $stringSQL . " COD_USUARIO_BAIXA = '" . $pCodUsuarioBaixa . "', ";
			$stringSQL = $stringSQL . " DES_BAIXA_LANCAMENTO = '" . $pDesBaixaLancamento . "' ";
			$stringSQL = $stringSQL . " WHERE COD_OS = " . $pCodOs;
			$stringSQL = $stringSQL . " AND NUM_PARCELA = " . $pNumParcela;
			$stringSQL = $stringSQL . " AND NUM_LANCAMENTO = " . $pNumLancamento;
			
			//echo $stringSQL;
			//exit();
			$con = Conexao::getInstanciar();
			$recordSet = "";
			$recordSet = $con->executar($stringSQL);
			return $recordSet;
		}
	}


//	public function baixa($pCodOS, $pNumParcela, $pCodValor, $pCodUsuario){
//		$stringSQL = " UPDATE lancamento";
//		$stringSQL = $stringSQL . " SET VAL_PAGO = " . $pCodValor;
//		$stringSQL = $stringSQL . " , DAT_PGTO = NOW(), COD_USUARIO_BAIXA = '" . $pCodUsuario . "' ";
//		$stringSQL = $stringSQL . " WHERE COD_OS = " . $pCodOS;
//		$stringSQL = $stringSQL . " AND NUM_PARCELA = " . $pNumParcela;
//		
//		//echo $stringSQL;
//		//exit();
//		$con = Conexao::getInstanciar();
//		$recordSet = "";
//		$recordSet = $con->executar($stringSQL);
//		return $recordSet;
//	}

	public function totalParcelaAbertas($pCodOS){
		$stringSQL = " SELECT COUNT(NUM_LANCAMENTO) TOTAL FROM lancamento";
		$stringSQL .= " where COD_OS = " . $pCodOS . " AND DAT_PGTO IS NULL;";
		
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function BuscaLancamento($pCodOtica, $pCodOS, $pNumParcela){
		$stringSQL = " SELECT NUM_LANCAMENTO FROM lancamento";
		$stringSQL .= " where COD_OS = " . $pCodOS . " AND NUM_PARCELA = " . $pNumParcela . " AND VAL_PAGO IS NULL LIMIT 1;";
		
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	
	
	public function LancamentosAtrasados($pCodOtica){
		$stringSQL = "SELECT l.NUM_LANCAMENTO, ";
		$stringSQL .= "       l.COD_OS, ";
		$stringSQL .= "       l.NUM_PARCELA, ";
		$stringSQL .= "       l.VAL_PARCELA, ";
		$stringSQL .= "       l.VAL_PAGO, ";
		//$stringSQL .= "       DATE_FORMAT(l.DAT_PGTO, '%d/%m/%Y') AS DAT_PGTO, ";
		//$stringSQL .= "       l.FLG_ESTORNO, ";
		$stringSQL .= "       l.COD_USUARIO, ";
		$stringSQL .= "       DATEDIFF(DAT_VENCIMENTO, NOW()) DIAS, ";
		$stringSQL .= "       DATEDIFF(DAT_VENCIMENTO, DAT_PGTO) ATRASO, ";
		$stringSQL .= "       DAT_VENCIMENTO, ";
		$stringSQL .= "       l.VAL_MORA, ";
		$stringSQL .= "       l.VAL_JUROS, ";
		$stringSQL .= "       l.VAL_DESCONTO_PARCELA, ";
		//$stringSQL .= "       DATE_FORMAT(DAT_VENCIMENTO, '%d/%m/%Y') AS DAT_VENCIMENTO, ";
		$stringSQL .= "       DATE_FORMAT(DAT_PEDIDO, '%Y') AS ANO, ";
		$stringSQL .= "       p.COD_PESSOA CLIENTE, p.NOM_PESSOA, p.NUM_TELEFONE, p.NUM_CELULAR, ";
		$stringSQL .= "       os.DAT_PEDIDO ";
		$stringSQL .= " FROM lancamento l ";
		$stringSQL .= " INNER JOIN os ON (os.COD_OS = l.COD_OS) ";
		$stringSQL .= " INNER JOIN pessoa p ON (p.COD_PESSOA = os.COD_PESSOA) ";
		$stringSQL .= " WHERE os.COD_OTICA = " . $pCodOtica;
		$stringSQL .= "    AND DATEDIFF(DAT_VENCIMENTO, NOW()) <= 0 ";
		$stringSQL .= "    AND DAT_PGTO IS NULL ";
		$stringSQL .= "    AND FLG_ESTORNO IS NULL ";
		$stringSQL .= "    AND os.COD_STATUS <> 4 ";
		$stringSQL .= " ORDER BY DAT_VENCIMENTO, p.NOM_PESSOA, l.NUM_PARCELA, ";
		$stringSQL .= "         NUM_LANCAMENTO;";
		
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function CaixaDiário($pCodOtica, $pDia){
		$stringSQL  = " SELECT L.COD_OS, L.NUM_LANCAMENTO, L.NUM_PARCELA, L.DES_BAIXA_LANCAMENTO, L.VAL_PAGO ";
		$stringSQL .= " FROM lancamento L ";
		$stringSQL .= " LEFT JOIN os OS ON (OS.COD_OS = L.COD_OS) ";
		$stringSQL .= " WHERE DATE_FORMAT(L.DAT_PGTO, '%Y-%m-%d') = '". $pDia ."' ";
		$stringSQL .= " AND (OS.COD_OTICA = " . $pCodOtica . " OR L.COD_OTICA = " . $pCodOtica . ") ;";
		
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;

	}
	
	public function estorno($pNumLancamento){
		
		$stringSQL  = " INSERT INTO lancamento (COD_OS, NUM_PARCELA, VAL_PARCELA, DAT_VENCIMENTO, COD_USUARIO) ";
		$stringSQL  .= "SELECT COD_OS, NUM_PARCELA, VAL_PARCELA, DAT_VENCIMENTO, COD_USUARIO ";
		$stringSQL  .= "FROM lancamento ";
		$stringSQL  .= "WHERE NUM_LANCAMENTO  = " . $pNumLancamento . ";";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		
		$stringSQL  = "UPDATE lancamento ";
		$stringSQL  .= "set FLG_ESTORNO = 1, DES_BAIXA_LANCAMENTO = concat('Estornado em ', DATE_FORMAT(NOW(), '%d/%m/%y')), COD_USUARIO_ESTORNO = '" . $_SESSION["codUsuario"] . "'";
		$stringSQL  .= " WHERE NUM_LANCAMENTO  = " . $pNumLancamento . "; ";
		
		//echo $stringSQL;
		//exit();
		
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;		
		
	}
	
	public function listaGeralAReceber($pCodOtica){
		$stringSQL = "SELECT OS.COD_OS, L.NUM_LANCAMENTO, P.COD_PESSOA, MONTH(L.DAT_VENCIMENTO) MES, YEAR(L.DAT_VENCIMENTO) ANO, P.NOM_PESSOA, DATE_FORMAT(L.DAT_VENCIMENTO, '%d/%m/%Y') DAT_VENCIMENTO, L.VAL_PARCELA ";
		$stringSQL .= "FROM lancamento L ";
		$stringSQL .= "INNER JOIN os OS ON (OS.COD_OS = L.COD_OS) ";
		$stringSQL .= "INNER JOIN pessoa P ON (P.COD_PESSOA = OS.COD_PESSOA AND OS.COD_OTICA = P.COD_OTICA) ";
		$stringSQL .= "WHERE OS.COD_OTICA = " . $pCodOtica;
		$stringSQL .= " AND IFNULL(L.FLG_ESTORNO, 0) <> 1  ";
		$stringSQL .= "AND IFNULL(DAT_PGTO, 0) = 0 ";
		$stringSQL .= "ORDER BY L.NUM_LANCAMENTO ";
		
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function listaGeralAReceberPorMes($pCodOtica){
		$stringSQL = "SELECT MONTH(L.DAT_VENCIMENTO) MES,  ";
		$stringSQL .= "        YEAR(L.DAT_VENCIMENTO) ANO, ";
		$stringSQL .= "        SUM(L.VAL_PARCELA) TOTAL ";
		$stringSQL .= "FROM lancamento L ";
		$stringSQL .= "INNER JOIN os OS ON (OS.COD_OS = L.COD_OS) ";
		$stringSQL .= "WHERE OS.COD_OTICA = " . $pCodOtica;
		$stringSQL .= "        AND IFNULL(L.FLG_ESTORNO, 0) <> 1  ";
		$stringSQL .= "        AND IFNULL(DAT_PGTO, 0) = 0 ";
		$stringSQL .= "GROUP BY MES, ANO  ";
		$stringSQL .= "ORDER BY ANO, MES ";
		
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;

	}
	
	public function listaGeralAReceberTotalGeral($pCodOtica){
		$stringSQL = "SELECT SUM(L.VAL_PARCELA) TOTAL ";
		$stringSQL .= "FROM lancamento L ";
		$stringSQL .= "INNER JOIN os OS ON (OS.COD_OS = L.COD_OS) ";
		$stringSQL .= "WHERE OS.COD_OTICA = " . $pCodOtica;
		$stringSQL .= "        AND IFNULL(L.FLG_ESTORNO, 0) <> 1  ";
		$stringSQL .= "        AND IFNULL(DAT_PGTO, 0) = 0 ";
		
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;

	}
	

	
}
?>