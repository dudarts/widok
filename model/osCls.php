<?php 
@session_start();

require_once("conexaoCls.php");
require_once("osInt.php");

class OsCls implements OsInt {
	private $codOs;
	private $codUsuario;
	private $codOtica;
	private $codPessoa;
	private $codArmacao;
	private $codLente;
	private $datPedido;
	private $numAm;
	private $datEntrega;
	private $numPa;
	private $numAv;
	private $numPel;
	private $numCo;
	private $numDp;
	private $valEntrada;
	private $valDesconto;
	private $valRestoEntrada;
	private $valTotal;
	private $qtdParcelas;
	private $numEsfericoOd;
	private $numEsfericoOe;
	private $numCilindroOd;
	private $numCilindroOe;
	private $numEixoOd;
	private $numEixoOe;
	private $numDpnOd;
	private $numDpnOe;
	private $numAdicao;
	private $numAltura;
	private $obs;
	private $codStatus;
	private $codTipoPagamento;
	private $valArmacao;
	private $valLente;

	public function setCodOs ($pCodOs) {
		$this->codOs = $pCodOs;
	}
	
	public function getCodOs ($pCodOs) {
		return $this->codOs;
	}
	public function setCodUsuario ($pCodUsuario) {
		$this->codUsuario = $pCodUsuario;
	}
	
	public function getCodUsuario ($pCodUsuario) {
		return $this->codUsuario;
	}
	public function setCodOtica ($pCodOtica) {
		$this->codOtica = $pCodOtica;
	}
	
	public function getCodOtica ($pCodOtica) {
		return $this->codOtica;
	}
	public function setCodPessoa ($pCodPessoa) {
		$this->codPessoa = $pCodPessoa;
	}
	
	public function getCodPessoa ($pCodPessoa) {
		return $this->codPessoa;
	}
	public function setCodArmacao ($pCodArmacao) {
		$this->codArmacao = $pCodArmacao;
	}
	
	public function getCodArmacao ($pCodArmacao) {
		return $this->codArmacao;
	}
	public function setCodLente ($pCodLente) {
		$this->codLente = $pCodLente;
	}
	
	public function getCodLente ($pCodLente) {
		return $this->codLente;
	}
	public function setDatPedido ($pDatPedido) {
		$this->datPedido = $pDatPedido;
	}
	
	public function getDatPedido ($pDatPedido) {
		return $this->datPedido;
	}
	public function setNumAm ($pNumAm) {
		$this->numAm = $pNumAm;
	}
	
	public function getNumAm ($pNumAm) {
		return $this->numAm;
	}
	public function setDatEntrega ($pDatEntrega) {
		$this->datEntrega = $pDatEntrega;
	}
	
	public function getDatEntrega ($pDatEntrega) {
		return $this->datEntrega;
	}
	public function setNumPa ($pNumPa) {
		$this->numPa = $pNumPa;
	}
	
	public function getNumPa ($pNumPa) {
		return $this->numPa;
	}
	public function setNumAv ($pNumAv) {
		$this->numAv = $pNumAv;
	}
	
	public function getNumAv ($pNumAv) {
		return $this->numAv;
	}
	public function setNumPel ($pNumPel) {
		$this->numPel = $pNumPel;
	}
	
	public function getNumPel ($pNumPel) {
		return $this->numPel;
	}
	public function setNumCo ($pNumCo) {
		$this->numCo = $pNumCo;
	}
	
	public function getNumCo ($pNumCo) {
		return $this->numCo;
	}
	public function setNumDp ($pNumDp) {
		$this->numDp = $pNumDp;
	}
	
	public function getNumDp ($pNumDp) {
		return $this->numDp;
	}
	public function setValEntrada ($pValEntrada) {
		$this->valEntrada = $pValEntrada;
	}
	
	public function getValEntrada ($pValEntrada) {
		return $this->valEntrada;
	}
	public function setValDesconto ($pValDesconto) {
		$this->valDesconto = $pValDesconto;
	}
	
	public function getValDesconto ($pValDesconto) {
		return $this->valDesconto;
	}
	public function setValRestoEntrada ($pValRestoEntrada) {
		$this->valRestoEntrada = $pValRestoEntrada;
	}
	
	public function getValRestoEntrada ($pValRestoEntrada) {
		return $this->valRestoEntrada;
	}
	public function setValTotal ($pValTotal) {
		$this->valTotal = $pValTotal;
	}
	
	public function getValTotal ($pValTotal) {
		return $this->valTotal;
	}
	public function setQtdParcelas ($pQtdParcelas) {
		$this->qtdParcelas = $pQtdParcelas;
	}
	
	public function getQtdParcelas ($pQtdParcelas) {
		return $this->qtdParcelas;
	}
	public function setNumEsfericoOd ($pNumEsfericoOd) {
		$this->numEsfericoOd = $pNumEsfericoOd;
	}
	
	public function getNumEsfericoOd ($pNumEsfericoOd) {
		return $this->numEsfericoOd;
	}
	public function setNumEsfericoOe ($pNumEsfericoOe) {
		$this->numEsfericoOe = $pNumEsfericoOe;
	}
	
	public function getNumEsfericoOe ($pNumEsfericoOe) {
		return $this->numEsfericoOe;
	}
	public function setNumCilindroOd ($pNumCilindroOd) {
		$this->numCilindroOd = $pNumCilindroOd;
	}
	
	public function getNumCilindroOd ($pNumCilindroOd) {
		return $this->numCilindroOd;
	}
	public function setNumCilindroOe ($pNumCilindroOe) {
		$this->numCilindroOe = $pNumCilindroOe;
	}
	
	public function getNumCilindroOe ($pNumCilindroOe) {
		return $this->numCilindroOe;
	}
	public function setNumEixoOd ($pNumEixoOd) {
		$this->numEixoOd = $pNumEixoOd;
	}
	
	public function getNumEixoOd ($pNumEixoOd) {
		return $this->numEixoOd;
	}
	public function setNumEixoOe ($pNumEixoOe) {
		$this->numEixoOe = $pNumEixoOe;
	}
	
	public function getNumEixoOe ($pNumEixoOe) {
		return $this->numEixoOe;
	}
	public function setNumDpnOd ($pNumDpnOd) {
		$this->numDpnOd = $pNumDpnOd;
	}
	
	public function getNumDpnOd ($pNumDpnOd) {
		return $this->numDpnOd;
	}
	public function setNumDpnOe ($pNumDpnOe) {
		$this->numDpnOe = $pNumDpnOe;
	}
	
	public function getNumDpnOe ($pNumDpnOe) {
		return $this->numDpnOe;
	}
	public function setNumAdicao ($pNumAdicao) {
		$this->numAdicao = $pNumAdicao;
	}
	
	public function getNumAdicao ($pNumAdicao) {
		return $this->numAdicao;
	}
	public function setNumAltura ($pNumAltura) {
		$this->numAltura = $pNumAltura;
	}
	
	public function getNumAltura ($pNumAltura) {
		return $this->numAltura;
	}
	public function setObs ($pObs) {
		$this->obs = $pObs;
	}
	
	public function getObs ($pObs) {
		return $this->obs;
	}
	public function setCodStatus ($pCodStatus) {
		$this->codStatus = $pCodStatus;
	}
	
	public function getCodStatus ($pCodStatus) {
		return $this->codStatus;
	}

	public function setCodTipoPagamento ($pCodTipoPagamento) {
		$this->codTipoPagamento = $pCodTipoPagamento;
	}
	
	public function getCodTipoPagamento ($pCodTipoPagamento) {
		return $this->codTipoPagamento;
	}

	public function setValArmacao ($pValArmacao) {
		$this->valArmacao = $pValArmacao;
	}
	
	public function getValArmacao ($pValArmacao) {
		return $this->valArmacao;
	}

	public function setValLente ($pValLente) {
		$this->valLente = $pValLente;
	}
	
	public function getValLente ($pValLente) {
		return $this->valLente;
	}



	public function selecionar($pCodOtica, $pCodBusca, $pCodTipoBusca, $pCodStatus) {
		/*
		COD TIPO BUSCA
		1 - BUSCA SÓ PELO COD_OS
		2 - BUSCA PELO COD_PESSOA OR COD_OS
		3 - BUSCA PELO COD_PESSOA OR NOM_PESSOA OR COD_OS
		4 - BUSCA SÓ PELO COD_PESSOA
		*/
		$stringSQL = " SELECT  pu.NOM_PESSOA VENDEDOR,  ";
		$stringSQL = $stringSQL . " p.NOM_PESSOA CLIENTE, p.CPF,  ";
		$stringSQL = $stringSQL . " DATE_FORMAT(os.DAT_PEDIDO, '%d/%m/%Y %H:%m') as DAT_PEDIDO,   ";
		$stringSQL = $stringSQL . " os.COD_OS, ";
		$stringSQL = $stringSQL . " os.COD_USUARIO, ";
		$stringSQL = $stringSQL . " os.COD_OTICA, ";
		$stringSQL = $stringSQL . " os.COD_PESSOA, ";
		$stringSQL = $stringSQL . " os.COD_ARMACAO, ";
		$stringSQL = $stringSQL . " os.COD_LENTE, ";
		$stringSQL = $stringSQL . " os.DAT_PEDIDO, ";
		$stringSQL = $stringSQL . " os.NUM_AM, ";
		$stringSQL = $stringSQL . " os.DAT_ENTREGA, DATEDIFF(os.DAT_ENTREGA, NOW()) ATRASO, ";
		$stringSQL = $stringSQL . " os.NUM_PA, ";
		$stringSQL = $stringSQL . " os.NUM_AV, ";
		$stringSQL = $stringSQL . " os.NUM_PEL, ";
		$stringSQL = $stringSQL . " os.NUM_CO, ";
		$stringSQL = $stringSQL . " os.NUM_DP, ";
		$stringSQL = $stringSQL . " os.VAL_ENTRADA, ";
		$stringSQL = $stringSQL . " os.VAL_DESCONTO, ";
		$stringSQL = $stringSQL . " os.VAL_RESTO_ENTRADA, ";
		$stringSQL = $stringSQL . " os.VAL_TOTAL, ";
		$stringSQL = $stringSQL . " os.QTD_PARCELAS, ";
		$stringSQL = $stringSQL . " os.NUM_ESFERICO_OD, ";
		$stringSQL = $stringSQL . " os.NUM_ESFERICO_OE, ";
		$stringSQL = $stringSQL . " os.NUM_CILINDRO_OD, ";
		$stringSQL = $stringSQL . " os.NUM_CILINDRO_OE, ";
		$stringSQL = $stringSQL . " os.NUM_EIXO_OD, ";
		$stringSQL = $stringSQL . " os.NUM_EIXO_OE, ";
		$stringSQL = $stringSQL . " os.NUM_DPN_OD, ";
		$stringSQL = $stringSQL . " os.NUM_DPN_OE, ";
		$stringSQL = $stringSQL . " os.NUM_ADICAO, ";
		$stringSQL = $stringSQL . " os.NUM_ALTURA, ";
		$stringSQL = $stringSQL . " os.OBS, ";
		$stringSQL = $stringSQL . " os.COD_STATUS, ";
		$stringSQL = $stringSQL . " os.COD_TIPO_PAGAMENTO,";
		$stringSQL = $stringSQL . " CASE os.COD_STATUS  ";
		$stringSQL = $stringSQL . " WHEN 1 THEN 'Aberta'  ";
		$stringSQL = $stringSQL . " WHEN 2 THEN 'Entregue'  ";
		$stringSQL = $stringSQL . " WHEN 3 THEN 'Encerrada'  ";
		$stringSQL = $stringSQL . " WHEN 4 THEN 'Cancelada'  ";
		$stringSQL = $stringSQL . " ELSE 'Indefinido' END AS STATUS,  os.DIA_PAGAMENTO, ";
		$stringSQL = $stringSQL . " a.DES_ARMACAO, l.DES_LENTE, COUNT(lc.NUM_LANCAMENTO) TOTAL, COUNT(DAT_PGTO) PAGO, lc.VAL_PARCELA, ";
		$stringSQL = $stringSQL . " ma.DES_MARCA MARCA_ARMACAO, ml.DES_MARCA MARCA_LENTE, a.NUM_REFERENCIA, c.DES_COR, ";
		$stringSQL = $stringSQL . " os.VAL_ARMACAO, os.VAL_LENTE, tp.DES_TIPO_PAGAMENTO, tp.COD_TIPO_PAGAMENTO, pf.NOM_PESSOA FILIAL, os.COD_VENDEDOR_EXTERNO, os.DES_DEPENDENTE ";
		$stringSQL = $stringSQL . " FROM os ";
		$stringSQL = $stringSQL . " INNER JOIN usuario u ON (u.COD_USUARIO = os.COD_USUARIO AND u.COD_OTICA = os.COD_OTICA) ";
		$stringSQL = $stringSQL . " INNER JOIN pessoa pu ON (u.COD_PESSOA = pu.COD_PESSOA) ";
		$stringSQL = $stringSQL . " INNER JOIN pessoa p ON (p.COD_PESSOA = os.COD_PESSOA) ";
		$stringSQL = $stringSQL . " LEFT JOIN armacao a ON (a.COD_ARMACAO = os.COD_ARMACAO) ";
		$stringSQL = $stringSQL . " LEFT JOIN lente l ON (l.COD_LENTE = os.COD_LENTE) ";
		$stringSQL = $stringSQL . " LEFT JOIN marca ma ON (a.COD_MARCA = ma.COD_MARCA) ";
		$stringSQL = $stringSQL . " LEFT JOIN marca ml ON (l.COD_MARCA = ml.COD_MARCA) ";
		$stringSQL = $stringSQL . " LEFT JOIN cor c ON (c.COD_COR = l.COD_COR) ";
		$stringSQL = $stringSQL . " INNER JOIN filial f ON (f.COD_OTICA = os.COD_OTICA) ";
//		$stringSQL = $stringSQL . " INNER JOIN filial f ON (f.COD_OTICA = os.COD_OTICA AND f.COD_PESSOA_FILIAL = pu.COD_OTICA) ";
		$stringSQL = $stringSQL . " INNER JOIN pessoa pf ON (pf.COD_PESSOA = f.COD_PESSOA_FILIAL AND pf.COD_OTICA = os.COD_OTICA) ";
		$stringSQL = $stringSQL . " LEFT JOIN tipo_pagamento tp ON (tp.COD_TIPO_PAGAMENTO = os.COD_TIPO_PAGAMENTO) ";
		$stringSQL = $stringSQL . " LEFT JOIN lancamento lc ON (lc.COD_OS = os.COD_OS AND lc.NUM_PARCELA <> 0) ";
		$stringSQL = $stringSQL . " WHERE os.COD_OTICA = " . $pCodOtica;
		if ($pCodBusca <> "") {
			switch ($pCodTipoBusca) {
				case 1:
					$stringSQL = $stringSQL . " AND os.COD_OS = " . $pCodBusca;	
					break;
				case 2:
					$stringSQL = $stringSQL . " AND (os.COD_OS = " . $pCodBusca;
					$stringSQL = $stringSQL . " OR os.COD_PESSOA = " . $pCodBusca . ") ";
					break;
				case 3: 		
					$stringSQL = $stringSQL . " AND (os.COD_OS = '" . $pCodBusca . "'";
					$stringSQL = $stringSQL . " OR os.COD_PESSOA = '" . $pCodBusca . "'";	
					$stringSQL = $stringSQL . " OR p.NOM_PESSOA LIKE '" . $pCodBusca . "%'";
					$stringSQL = $stringSQL . " OR os.DES_DEPENDENTE LIKE '" . $pCodBusca . "%')";
					break;
				case 4: 		
					$stringSQL = $stringSQL . " AND os.COD_PESSOA = " . $pCodBusca;					
					break;
				case 5: 		
					$stringSQL = $stringSQL . " AND u.COD_FILIAL = " . $pCodBusca;					
					break;

			}
		} 
		$pCodStatus == 1 ? $stringSQL = $stringSQL . " AND os.COD_STATUS in (1, 2)" : "";
		$stringSQL = $stringSQL . " GROUP BY pu.NOM_PESSOA, p.NOM_PESSOA, p.CPF, DAT_PEDIDO, os.COD_OS, os.COD_USUARIO, os.COD_OTICA, os.COD_PESSOA, os.COD_ARMACAO, os.COD_LENTE, os.DAT_PEDIDO, os.NUM_AM, os.DAT_ENTREGA, os.NUM_PA, os.NUM_AV, os.NUM_PEL, os.NUM_CO, os.NUM_DP, os.VAL_ENTRADA, os.VAL_DESCONTO, os.VAL_RESTO_ENTRADA, os.VAL_TOTAL, os.QTD_PARCELAS, os.NUM_ESFERICO_OD, os.NUM_ESFERICO_OE, os.NUM_CILINDRO_OD, os.NUM_CILINDRO_OE, os.NUM_EIXO_OD, os.NUM_EIXO_OE, os.NUM_DPN_OD, os.NUM_DPN_OE, os.NUM_ADICAO, os.NUM_ALTURA, os.OBS, os.COD_STATUS, os.COD_TIPO_PAGAMENTO, STATUS, a.DES_ARMACAO, l.DES_LENTE ";
		$stringSQL = $stringSQL . " ORDER BY os.DAT_PEDIDO DESC ;";
		//echo $stringSQL;
		//exit();
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;	
	}

	public function inserir($pCodUsuario, $pCodOtica, $pCodPessoa, $pCodArmacao, $pCodLente, $pDatPedido, $pDatEntrega, $pNumAm, $pNumPa, $pNumAv, $pNumPel, $pNumCo, $pNumDp, $pNumEsfericoOd, $pNumEsfericoOe, $pNumCilindroOd, $pNumCilindroOe, $pNumEixoOd, $pNumEixoOe, $pNumDpnOd, $pNumDpnOe, $pNumAdicao, $pValArmacao, $pNumAltura, $pValLente, $pValEntrada, $pValDesconto, $pValRestoEntrada, $pValTotal, $pQtdParcelas, $pObs, $pCodStatus, $pCodTipoPagamento, $pCodVendedorExterno, $pCodMedico, $pDiaPagamento, $pDesDependente){
		$stringSQL = " INSERT INTO os (";
		//$stringSQL = $stringSQL . " COD_OS, ";
		$stringSQL = $stringSQL . " COD_USUARIO, ";
		$stringSQL = $stringSQL . " COD_OTICA, ";
		$stringSQL = $stringSQL . " COD_PESSOA, ";
		$stringSQL = $stringSQL . " COD_ARMACAO, ";
		$stringSQL = $stringSQL . " COD_LENTE, ";
		$stringSQL = $stringSQL . " DAT_PEDIDO, ";
		$stringSQL = $stringSQL . " DAT_ENTREGA, ";
		$stringSQL = $stringSQL . " NUM_AM, ";
		$stringSQL = $stringSQL . " NUM_PA, ";
		$stringSQL = $stringSQL . " NUM_AV, ";
		$stringSQL = $stringSQL . " NUM_PEL, ";
		$stringSQL = $stringSQL . " NUM_CO, ";
		$stringSQL = $stringSQL . " NUM_DP, ";
		$stringSQL = $stringSQL . " NUM_ESFERICO_OD, ";
		$stringSQL = $stringSQL . " NUM_ESFERICO_OE, ";
		$stringSQL = $stringSQL . " NUM_CILINDRO_OD, ";
		$stringSQL = $stringSQL . " NUM_CILINDRO_OE, ";
		$stringSQL = $stringSQL . " NUM_EIXO_OD, ";
		$stringSQL = $stringSQL . " NUM_EIXO_OE, ";
		$stringSQL = $stringSQL . " NUM_DPN_OD, ";
		$stringSQL = $stringSQL . " NUM_DPN_OE, ";
		$stringSQL = $stringSQL . " NUM_ADICAO, ";
		$stringSQL = $stringSQL . " VAL_ARMACAO, ";
		$stringSQL = $stringSQL . " NUM_ALTURA, ";
		$stringSQL = $stringSQL . " VAL_LENTE, ";
		$stringSQL = $stringSQL . " VAL_ENTRADA, ";
		$stringSQL = $stringSQL . " VAL_DESCONTO, ";
		$stringSQL = $stringSQL . " VAL_RESTO_ENTRADA, ";
		$stringSQL = $stringSQL . " VAL_TOTAL, ";
		$stringSQL = $stringSQL . " QTD_PARCELAS, ";
		$stringSQL = $stringSQL . " OBS, ";
		$stringSQL = $stringSQL . " COD_STATUS, ";
		$stringSQL = $stringSQL . " COD_TIPO_PAGAMENTO, ";
		$stringSQL = $stringSQL . " COD_VENDEDOR_EXTERNO, ";
		$stringSQL = $stringSQL . " COD_MEDICO, ";
		$stringSQL = $stringSQL . " DIA_PAGAMENTO, ";
		$stringSQL = $stringSQL . " DES_DEPENDENTE ";
		$stringSQL = $stringSQL . " ) VALUES ( ";
//		$pCodOs 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodOs . "', ";
		$pCodUsuario 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodUsuario . "', ";
		$pCodOtica 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodOtica . "', ";
		$pCodPessoa 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodPessoa . "', ";
		$pCodArmacao 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodArmacao . "', ";
		$pCodLente 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodLente . "', ";
		$pDatPedido 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "" . $pDatPedido . ", ";
		$pDatEntrega 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pDatEntrega . "', ";
		$pNumAm 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumAm . "', ";
		$pNumPa 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumPa . "', ";
		$pNumAv 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumAv . "', ";
		$pNumPel 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumPel . "', ";
		$pNumCo 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumCo . "', ";
		$pNumDp 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumDp . "', ";
		$pNumEsfericoOd 	== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumEsfericoOd . "', ";
		$pNumEsfericoOe 	== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumEsfericoOe . "', ";
		$pNumCilindroOd 	== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumCilindroOd . "', ";
		$pNumCilindroOe 	== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumCilindroOe . "', ";
		$pNumEixoOd 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumEixoOd . "', ";
		$pNumEixoOe 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumEixoOe . "', ";
		$pNumDpnOd 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumDpnOd . "', ";
		$pNumDpnOe 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumDpnOe . "', ";
		$pNumAdicao 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumAdicao . "', ";
		$pValArmacao 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pValArmacao . "', ";
		$pNumAltura 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pNumAltura . "', ";
		$pValLente 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pValLente . "', ";
		$pValEntrada 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pValEntrada . "', ";
		$pValDesconto 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pValDesconto . "', ";
		$pValRestoEntrada 	== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pValRestoEntrada . "', ";
		$pValTotal 			== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pValTotal . "', ";
		$pQtdParcelas 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pQtdParcelas . "', ";
		$pObs 				== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pObs . "', ";
		$pCodStatus 		== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodStatus . "', ";
		$pCodTipoPagamento 	== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodTipoPagamento . "', ";
		$pCodVendedorExterno== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodVendedorExterno . "', ";
		$pCodMedico		 	== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pCodMedico . "', ";
		$pDiaPagamento	 	== "" ? $stringSQL .=  "NULL, " : $stringSQL .= "'" . $pDiaPagamento . "', ";
		$pDesDependente	 	== "" ? $stringSQL .=  "NULL " : $stringSQL .= "'" . $pDesDependente . "' ";
		$stringSQL = $stringSQL . " ); ";
		
		//echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function atualizar($pCodOs, $pCodUsuario, $pCodOtica, $pCodPessoa, $pCodArmacao, $pCodLente, $pDatPedido, $pNumAm, $pDatEntrega, $pNumPa, $pNumAv, $pNumPel, $pNumCo, $pNumDp, $pValEntrada, $pValDesconto, $pValRestoEntrada, $pValTotal, $pQtdParcelas, $pNumEsfericoOd, $pNumEsfericoOe, $pNumCilindroOd, $pNumCilindroOe, $pNumEixoOd, $pNumEixoOe, $pNumDpnOd, $pNumDpnOe, $pNumAdicao, $pNumAltura, $pObs, $pCodStatus, $pCodTipoPagamento, $pDesDependente
, $pCodVendedorExterno, $pCodMedico){
		$stringSQL = " UPDATE os ";
		$stringSQL = $stringSQL . " SET ";
		//$stringSQL = $stringSQL . " COD_OS = '" . $pCodOs . "', ";
		$stringSQL = $stringSQL . " COD_USUARIO = '" . $pCodUsuario . "', ";
		$stringSQL = $stringSQL . " COD_OTICA = '" . $pCodOtica . "', ";
		$stringSQL = $stringSQL . " COD_PESSOA = '" . $pCodPessoa . "', ";
		$stringSQL = $stringSQL . " COD_ARMACAO = '" . $pCodArmacao . "', ";
		$stringSQL = $stringSQL . " COD_LENTE = '" . $pCodLente . "', ";
		$stringSQL = $stringSQL . " DAT_PEDIDO = '" . $pDatPedido . "', ";
		$stringSQL = $stringSQL . " NUM_AM = '" . $pNumAm . "', ";
		$stringSQL = $stringSQL . " DAT_ENTREGA = '" . $pDatEntrega . "', ";
		$stringSQL = $stringSQL . " NUM_PA = '" . $pNumPa . "', ";
		$stringSQL = $stringSQL . " NUM_AV = '" . $pNumAv . "', ";
		$stringSQL = $stringSQL . " NUM_PEL = '" . $pNumPel . "', ";
		$stringSQL = $stringSQL . " NUM_CO = '" . $pNumCo . "', ";
		$stringSQL = $stringSQL . " NUM_DP = '" . $pNumDp . "', ";
		$stringSQL = $stringSQL . " VAL_ENTRADA = '" . $pValEntrada . "', ";
		$stringSQL = $stringSQL . " VAL_DESCONTO = '" . $pValDesconto . "', ";
		$stringSQL = $stringSQL . " VAL_RESTO_ENTRADA = '" . $pValRestoEntrada . "', ";
		$stringSQL = $stringSQL . " VAL_TOTAL = '" . $pValTotal . "', ";
		$stringSQL = $stringSQL . " QTD_PARCELAS = '" . $pQtdParcelas . "', ";
		$stringSQL = $stringSQL . " NUM_ESFERICO_OD = '" . $pNumEsfericoOd . "', ";
		$stringSQL = $stringSQL . " NUM_ESFERICO_OE = '" . $pNumEsfericoOe . "', ";
		$stringSQL = $stringSQL . " NUM_CILINDRO_OD = '" . $pNumCilindroOd . "', ";
		$stringSQL = $stringSQL . " NUM_CILINDRO_OE = '" . $pNumCilindroOe . "', ";
		$stringSQL = $stringSQL . " NUM_EIXO_OD = '" . $pNumEixoOd . "', ";
		$stringSQL = $stringSQL . " NUM_EIXO_OE = '" . $pNumEixoOe . "', ";
		$stringSQL = $stringSQL . " NUM_DPN_OD = '" . $pNumDpnOd . "', ";
		$stringSQL = $stringSQL . " NUM_DPN_OE = '" . $pNumDpnOe . "', ";
		$stringSQL = $stringSQL . " NUM_ADICAO = '" . $pNumAdicao . "', ";
		$stringSQL = $stringSQL . " NUM_ALTURA = '" . $pNumAltura . "', ";
		$stringSQL = $stringSQL . " COD_VENDEDOR_EXTERNO = '" . $pCodVendedorExterno . "', ";
		$stringSQL = $stringSQL . " OBS = '" . $pObs . "', ";
		$stringSQL = $stringSQL . " COD_STATUS = '" . $pCodStatus . "', ";
		$stringSQL = $stringSQL . " COD_MEDICO = '" . $pCodMedico . "' ";
		$stringSQL = $stringSQL . " DES_DEPENDENTE = '" . $pDesDependente . "' ";
		$stringSQL = $stringSQL . " WHERE COD_OS = '" . $pCodOs . "'; ";
		
		echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function ultimaOS($pCodOtica, $pCodPessoa) {
		$stringSQL = " SELECT MAX(COD_OS) OS FROM os WHERE COD_OTICA = " . $pCodOtica . " AND COD_PESSOA = " . $pCodPessoa . "; ";
		
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		$rs = mysqli_fetch_assoc($recordSet);
		return $rs["OS"];
	}
	
	public function alteraStatus($pCodOs, $pcodStatus){
		$stringSQL = " UPDATE os SET COD_STATUS = " . $pcodStatus . " WHERE COD_OS = " . $pCodOs;

		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function qtdOSGeral($pCodOtica, $pAno){
		$stringSQL = " SELECT COD_MES, DES_MES, IFNULL(EXTRACT(YEAR FROM DAT_PEDIDO),0) ANO, ";
		$stringSQL = $stringSQL . " COUNT(COD_OS) TOTAL ";
		$stringSQL = $stringSQL . " FROM os ";
		$stringSQL = $stringSQL . " RIGHT JOIN mes ON (mes.COD_MES = EXTRACT(MONTH FROM DAT_PEDIDO)) ";
		
		$pAno <> "" ? $stringSQL .= " WHERE IFNULL(EXTRACT(YEAR FROM DAT_PEDIDO),0) IN (0," . $pAno . ") " : "";
		$stringSQL .= " AND os.COD_STATUS <> 4 ";

		$stringSQL = $stringSQL . " GROUP BY COD_MES, ANO ";

		//echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}
	
	public function getAnos($pCodOtica){
		$stringSQL = " SELECT DISTINCT EXTRACT(YEAR FROM DAT_PEDIDO) ANO  ";
		$stringSQL = $stringSQL . " FROM os ";
		$stringSQL = $stringSQL . " WHERE os.COD_OTICA = " . $pCodOtica;
		$stringSQL = $stringSQL . " ORDER BY ANO DESC ";
	
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function qtdPorFilial($pCodOtica, $pAno){
		$stringSQL = " SELECT PF.NOM_PESSOA FILIAL, ";
		$stringSQL = $stringSQL . " COUNT(OS.COD_OS) TOTAL  ";
		$stringSQL = $stringSQL . " FROM os OS ";
		$stringSQL = $stringSQL . " INNER JOIN usuario U ON (OS.COD_OTICA = U.COD_OTICA AND U.COD_USUARIO = OS.COD_USUARIO) ";
		$stringSQL = $stringSQL . " INNER JOIN filial F ON (U.COD_OTICA = F.COD_OTICA AND U.COD_FILIAL = F.COD_PESSOA_FILIAL) ";
		$stringSQL = $stringSQL . " INNER JOIN pessoa PF ON (PF.COD_PESSOA = F.COD_PESSOA_FILIAL) ";
		$stringSQL = $stringSQL . " WHERE OS.COD_OTICA = " . $pCodOtica;
		$stringSQL = $stringSQL . " AND EXTRACT(YEAR FROM DAT_PEDIDO) = " . $pAno;
		$stringSQL .= " AND OS.COD_STATUS <> 4 ";
		$stringSQL = $stringSQL . " GROUP BY FILIAL ";
	
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function qtdPorVendedor($pCodOtica, $pAno, $pCodExterno){
		$stringSQL = " SELECT P.NOM_PESSOA VENDEDOR, MONTH(OS.DAT_PEDIDO) MES, YEAR(OS.DAT_PEDIDO) ANO, ";
		$stringSQL = $stringSQL . " COUNT(OS.COD_OS) QTD, SUM(IFNULL(OS.VAL_ENTRADA,0) + IFNULL(OS.VAL_TOTAL,0)) VALOR ";
		$stringSQL = $stringSQL . " FROM os OS ";
		$stringSQL = $stringSQL . " INNER JOIN usuario U ON (OS.COD_OTICA = U.COD_OTICA AND U.COD_USUARIO = OS.COD_USUARIO) ";
		$stringSQL = $stringSQL . " INNER JOIN pessoa P ON (U.COD_OTICA = P.COD_OTICA AND P.COD_PESSOA = U.COD_PESSOA) ";
		$stringSQL = $stringSQL . " WHERE OS.COD_OTICA = " . $pCodOtica;
		$stringSQL = $stringSQL . " AND EXTRACT(YEAR FROM DAT_PEDIDO) = " . $pAno;
		$stringSQL .= " AND OS.COD_STATUS <> 4 ";
		switch ($pCodExterno){
			case 0:
				$stringSQL .= " AND (IFNULL(COD_VENDEDOR_EXTERNO, 0) = 0)";
				break;
			case 1:
				$stringSQL .= " AND (IFNULL(COD_VENDEDOR_EXTERNO, 0) <> 0)";
				break;
			default:
				break;
		}
		
		$stringSQL = $stringSQL . " GROUP BY VENDEDOR, MES, ANO ORDER BY ANO, MES, VENDEDOR ";
	
		echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function qtdPorVendedorExterno($pCodOtica, $pAno){
		$stringSQL = " SELECT P.COD_PESSOA, P.NOM_PESSOA VENDEDOR, MONTH(OS.DAT_PEDIDO) MES, YEAR(OS.DAT_PEDIDO) ANO, ";
		$stringSQL = $stringSQL . " COUNT(OS.COD_OS) QTD, SUM(OS.VAL_ENTRADA + OS.VAL_TOTAL) VALOR ";
		$stringSQL = $stringSQL . " FROM os OS ";
		$stringSQL = $stringSQL . " INNER JOIN pessoa P ON (OS.COD_OTICA = P.COD_OTICA AND P.COD_PESSOA = OS.COD_VENDEDOR_EXTERNO) ";
		$stringSQL = $stringSQL . " WHERE OS.COD_OTICA = " . $pCodOtica;
		$stringSQL .= " AND COD_VENDEDOR_EXTERNO IS NOT NULL";
		$stringSQL = $stringSQL . " AND EXTRACT(YEAR FROM DAT_PEDIDO) = " . $pAno;
		$stringSQL .= " AND OS.COD_STATUS <> 4 ";
		
		$stringSQL = $stringSQL . " GROUP BY VENDEDOR, MES, ANO ";
		//echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}


	public function osPorStatus($pCodOtica){
		$stringSQL = "SELECT  os.COD_OS, ";
		$stringSQL .= "        v.NOM_PESSOA VENDEDOR, ";
		$stringSQL .= "        'N' EXTERNO,";
		$stringSQL .= "        os.COD_PESSOA, ";
		$stringSQL .= "        p.NOM_PESSOA CLIENTE, ";
		//$stringSQL .= "        DATE_FORMAT(os.DAT_PEDIDO, '%d/%m/%Y') PEDIDO,";
		$stringSQL .= "        os.DAT_PEDIDO, ";
		$stringSQL .= "        CASE os.COD_STATUS";
		$stringSQL .= "            WHEN 1 THEN 'Em aberto'";
		$stringSQL .= "            WHEN 2 THEN 'Cancelado'";
		$stringSQL .= "            WHEN 3 THEN 'Entregue'";
		$stringSQL .= "            WHEN 4 THEN 'Encerrada' END AS STATUS";
		$stringSQL .= " FROM os";
		$stringSQL .= " INNER JOIN pessoa p ON (p.COD_PESSOA = os.COD_PESSOA)";
		$stringSQL .= " INNER JOIN usuario u ON (u.COD_USUARIO = os.COD_USUARIO AND u.COD_OTICA = os.COD_OTICA)";
		$stringSQL .= " INNER JOIN pessoa v ON (v.COD_PESSOA = u.COD_PESSOA)";
		$stringSQL .= " WHERE os.COD_OTICA = " . $pCodOtica;
		$stringSQL .= " AND os.COD_STATUS <> 4 ";
		$stringSQL .= " AND (COD_VENDEDOR_EXTERNO IS NULL OR COD_VENDEDOR_EXTERNO = 0)";
		$stringSQL .= " ";
		$stringSQL .= " UNION ALL";
		$stringSQL .= " ";
		$stringSQL .= " SELECT  os.COD_OS, ";
		$stringSQL .= "        v.NOM_PESSOA VENDEDOR, ";
		$stringSQL .= "        'S' EXTERNO,";
		$stringSQL .= "        os.COD_PESSOA, ";
		$stringSQL .= "        p.NOM_PESSOA CLIENTE, ";
		//$stringSQL .= "        DATE_FORMAT(os.DAT_PEDIDO, '%d/%m/%Y') PEDIDO,";
		$stringSQL .= "        os.DAT_PEDIDO, ";
		$stringSQL .= "        CASE os.COD_STATUS";
		$stringSQL .= "            WHEN 1 THEN 'Em aberto'";
		$stringSQL .= "            WHEN 2 THEN 'Cancelado'";
		$stringSQL .= "            WHEN 3 THEN 'Entregue'";
		$stringSQL .= "            WHEN 4 THEN 'Encerrada' END AS STATUS";
		$stringSQL .= " FROM os";
		$stringSQL .= " INNER JOIN pessoa p ON (p.COD_PESSOA = os.COD_PESSOA)";
		$stringSQL .= " INNER JOIN pessoa v ON (v.COD_PESSOA = os.COD_VENDEDOR_EXTERNO)";
		$stringSQL .= " WHERE os.COD_OTICA = " . $pCodOtica;
		$stringSQL .= " AND os.COD_STATUS <> 4 ";
		$stringSQL .= " AND os.COD_VENDEDOR_EXTERNO IS NOT NULL";
	
		//echo $stringSQL;
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

	public function qtdOsPorStatus($pCodOtica){
		$stringSQL = "SELECT COUNT(os.COD_OS) TOTAL, ";
		$stringSQL .= "        CASE os.COD_STATUS";
		$stringSQL .= "            WHEN 1 THEN 'Em aberto'";
		$stringSQL .= "            WHEN 2 THEN 'Cancelado'";
		$stringSQL .= "            WHEN 3 THEN 'Entregue'";
		$stringSQL .= "            WHEN 4 THEN 'Encerrada' END AS STATUS";
		$stringSQL .= " FROM os";
		$stringSQL .= " WHERE os.COD_OTICA = " . $pCodOtica;
		$stringSQL .= " GROUP BY COD_STATUS";
	
		$con = Conexao::getInstanciar();
		$recordSet = "";
		$recordSet = $con->executar($stringSQL);
		return $recordSet;
	}

}
?>