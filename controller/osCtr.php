<?php
require_once("../model/conexaoCls.php");
require_once("../model/osCls.php");
require_once("../model/lancamentoCls.php");
require_once("../model/armacaoCls.php");
require_once("../controller/funcoes.php");

//classe Controller. Faz a ligação entre o model e a view.
class OsCtr {
	public function cadastrar($pF){
		if ($pF) {
			$obj = new OsCls();
			$lcmt = new LancamentoCls();
			
			$pfLente = @$_POST['pfCodLente'];
			$pfArmacao = @$_POST['pfCodArmacao'];
			
			$pfLente == "" ? $codLente[0] = NULL : $codLente = explode("!@!", $pfLente);
			$pfArmacao == "" ? $codArmacao[0] = NULL : $codArmacao = explode("!@!", $pfArmacao);

			if ($obj->inserir(
					$pF['pfCodUsuario'],
					$pF['pfCodOtica'],
					$pF['pfCodPessoa'],
					$codArmacao[0],
					$codLente[0],
					'NOW()',
					$pF['pfDatEntrega'],
					$pF['pfNumAm'],
					$pF['pfNumPa'],
					$pF['pfNumAv'],
					$pF['pfNumPel'],
					$pF['pfNumCo'],
					$pF['pfNumDp'],
					$pF['pfNumEsfericoOD'],
					$pF['pfNumEsfericoOE'],
					$pF['pfNumCilindroOD'],
					$pF['pfNumCilindroOE'],
					$pF['pfNumEixoOD'],
					$pF['pfNumEixoOE'],
					$pF['pfNumDpnOD'],
					$pF['pfNumDpnOE'],
					$pF['pfNumAdicao'],
					$codArmacao[1],
					$pF['pfNumAltura'],
					$codLente[1],
					fDecimalMySQL($pF['pfValEntrada']),
					fDecimalMySQL($pF['pfValDesconto']),
					fDecimalMySQL($pF['pfValRestoEntrada']),
					fDecimalMySQL($pF['pfValTotal']),
					$pF['pfQtdParcelas'],
					$pF['pfObs'],
					1,
					$pF['pfCodTipoPagamento'],
					$pF['pfCodVendedorExterno'],
					$pF['pfCodMedico'],
					$pF['pfDiaPagamento']
					) 
				) {; // if
				
				$valorParcela = fDecimalMySQL($pF['pfValTotal'])/$pF['pfQtdParcelas'];
				
				for ($i = 0; $i <= $pF['pfQtdParcelas']; $i++){
					if ($i == 0) {
						$valor = fDecimalMySQL($pF['pfValEntrada']);
					} else {
						$valor = $valorParcela;
					}
					
					if ($valor > 0)
						$lcmt->inserir($pF['pfCodOtica'], $obj->ultimaOS($pF['pfCodOtica'], $pF['pfCodPessoa']), $i, $valor, $_SESSION['codUsuario']);
				}

				$ultimaOS = $obj->ultimaOS($pF['pfCodOtica'], $pF['pfCodPessoa']);
				$armacao = new ArmacaoCls();
				$armacao->atualizarQtd( $codArmacao[0], $pF['pfQtdArmacao'], $pF['pfCodUsuario'], $ultimaOS, $pF['pfAdiciona']);

				//exit();
				header('location:../view/pagina.php?m=2&op=16&msg=' . md5(3));
			} else {
				echo "Erro na gravação";	
			}
		}
	}
	
	public function selecionar($pfCodOtica, $pfBusca, $codTipoBusca, $pCodStatus){
		$obj = new OsCls();
		return $obj->selecionar($pfCodOtica, $pfBusca, $codTipoBusca, $pCodStatus);
	}

	public function atualizar($pF){
		if ($pF) {
			$this->m = new OsCls();

			$pfLente = @$_POST['pfCodLente'];
			$pfArmacao = @$_POST['pfCodArmacao'];
			
			$pfLente == "" ? $codLente[0] = NULL : $codLente = explode("!@!", $pfLente);
			$pfArmacao == "" ? $codArmacao[0] = NULL : $codArmacao = explode("!@!", $pfArmacao);		
			
			if ($this->m->atualizar(
									$pF['pfCodOs'],
									$pF['pfCodUsuario'],
									$pF['pfCodOtica'],
									$pF['pfCodPessoa'],
									$codLente[0],
									$codArmacao[0],
									$pF['pfDatPedido'],
									$pF['pfNumAm'],
									$pF['pfDatEntrega'],
									$pF['pfNumPa'],
									$pF['pfNumAv'],
									$pF['pfNumPel'],
									$pF['pfNumCo'],
									$pF['pfNumDp'],
									fDecimalMySQL($pF['pfValEntrada']),
									fDecimalMySQL($pF['pfValDesconto']),
									fDecimalMySQL($pF['pfValRestoEntrada']),
									fDecimalMySQL($pF['pfValTotal']),
									$pF['pfQtdParcelas'],
									$pF['pfNumEsfericoOD'],
									$pF['pfNumEsfericoOE'],
									$pF['pfNumCilindroOD'],
									$pF['pfNumCilindroOE'],
									$pF['pfNumEixoOD'],
									$pF['pfNumEixoOE'],
									$pF['pfNumDpnOD'],
									$pF['pfNumDpnOE'],
									$pF['pfNumAdicao'],
									$pF['pfNumAltura'],
									$pF['pfObs'],
									$pF['pfCodStatus'],
									$pF['pfCodTipoPagamento'],
									$pF['pfCodVendedorExterno'],
									$pF['pfCodMedico']
									)) {; 
				header('location:../view/pagina.php?m=2&op=16&msg=' . md5(5));
			} else {
				echo "Erro na gravação";	
			}
		}
	}
	
//	public function atualizar($pfCodPessoa, $pfCodOtica, $pfDesPessoa){
//		$this->m = new PessoaCls();
//		$this->m->atualizar($pfCodPessoa, $pfCodOtica, $pfDesPessoa);
//		header('location:../view/pagina.php?m=1&op=6&msg=' . md5(5));
//	}
	
	public function excluir($pfCodPessoa){
		$this->m = new PessoaCls();
		$this->m->excluir($pfCodPessoa);	
		header('location:../view/pagina.php?m=1&op=6&msg=' . md5(4));
	}
	
	public function alteraStatus($pCodOs, $pcodStatus){
		$obj = new OsCls();
		return $obj->alteraStatus($pCodOs, $pcodStatus);	
	}
	
	public function qtdOSGeral($pCodOtica, $pAno){
		$obj = new OsCls();
		return $obj->qtdOSGeral($pCodOtica, $pAno);	
	}
	
	public function getAnos($pCodOtica){
		$obj = new OsCls();
		return $obj->getAnos($pCodOtica);
	}
	
	public function qtdPorFilial($pCodOtica, $pAno){
		$obj = new OsCls();
		return $obj->qtdPorFilial($pCodOtica, $pAno);
	}
	
	public function qtdPorVendedor($pCodOtica, $pAno, $pCodExterno){
		$obj = new OsCls();
		return $obj->qtdPorVendedor($pCodOtica, $pAno, $pCodExterno);
	}

	public function qtdPorVendedorExterno($pCodOtica, $pAno){
		$obj = new OsCls();
		return $obj->qtdPorVendedorExterno($pCodOtica, $pAno);
	}
	
	public function qtdOsPorStatus($pCodOtica){
		$obj = new OsCls();
		return $obj->qtdOsPorStatus($pCodOtica);
	}

	public function osPorStatus($pCodOtica){
		$obj = new OsCls();
		return $obj->osPorStatus($pCodOtica);
	}

}

class TipoPessoaCtr{
	public static function selecionar($pCodTpoPessoa){
		return TipoPessoaCls::selecionar($pCodTpoPessoa);	
	}
}

$p = $_POST;
$obj = new OsCtr();

switch (@$_POST['btn']){
	case 'Gravar':
		$obj->cadastrar($p);
		break;
	case 'Atualizar OS':
		$obj->atualizar($p);
		break;
	case 'Excluir':
		$obj->excluir($p['pfCOD']);
		break;		
}
?>