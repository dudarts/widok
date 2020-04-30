<?php 
function fSubdominio($url, $indice){
	$arrayUrl = explode(".",$url);
	return $arrayUrl[intval($indice)];
}

function fSeguranca(){
	if (!$_SESSION['codUsuario']) {
		fPaginaInicial();
	}
}

function fPaginaInicial(){
	header('location:../index.php?msg=Sessão Expirada');
}

function fDecimalMySQL($num){
	$num = str_replace(".","",$num);
	$num = str_replace(",",".",$num);
	//$num = str_replace("@","",$num);
	return $num;
}


function fDecimalPHP($num){
	$num = str_replace(",","",$num);
	$num = str_replace(".",",",$num);
	//$num = str_replace("@","",$num);
	return $num;
}

function fNomeCurto($nome){
	$num = strpos($nome, " ", strpos($nome, " ")+1);
	return $num == "" ? $nome : substr($nome, 0, $num);	
}

function fMask($val, $mask){
	$maskared = '';
	$k = 0;
	for($i = 0; $i<=strlen($mask)-1; $i++){
		if($mask[$i] == '#'){
			if(isset($val[$k]))
				$maskared .= $val[$k++];
		} else {
			if(isset($mask[$i]))
			$maskared .= $mask[$i];
		}
	}
	return $maskared;
}

	$configPorcentagemMora = 5;
	$configPorcentagemJurosDiario = 0.5;

function fCalculaJuros($valor, $porcetagem){
	return $valor * $porcetagem / 100;
}
?>