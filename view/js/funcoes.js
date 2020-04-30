// JavaScript Document

function bloquearEnter(){
	if (event.keyCode == 13){
		event.keyCode=0;
		return false;	
	}
	return true;
}

function marcarTodos(id, form){
	objId = eval(document.getElementById(id));
	objForm = eval(document.getElementById(form));
//	alert(objForm.elements.length);
	if (objId.checked) {
		for (i = 0; i < objForm.elements.length; i++) 
            if (objForm.elements[i].type == "checkbox")
                objForm.elements[i].checked = 1;
	} else {
		for (i = 0; i < objForm.elements.length; i++)
            if (objForm.elements[i].type == "checkbox")
                objForm.elements[i].checked = 0;
	}
//	alert(objForm.elements.length);
//	objClass.checked = true;
	
}


//function validaFormMarca(nome){
//	if (nome == 'Excluir') {
//		var r = confirm("Tem certeza que deseja excluir?");
//		if (r == true) {
//			return true;	
//		} else {
//			return false;
//		}	
//	} else {
//		if (document.getElementById('pfDesMarca').value == "") {
//			alert('Digite o nome da marca!')	;
//			document.getElementById('pfDesMarca').focus();
//			return false;
//		}
//	} 
//}

$(document).ready(function () {
	setTimeout(function () {
		$('#desMsg').fadeOut(1000);
	}, 2000);
});

$("#desMsg").ready(function() {
	$(this).fadeOut(100);
});

function redirecionar(url){
	location.href=url;
}

function ConfirmaExcluir(){
	var r = confirm('Tem certeza que deseja excluir este item?');
	if (r == true) {
		alert("confirmado");
	} else {
		alert("NEGADO");
	}
}


function alertaOSEntregue(){
	alert('Esta Ordem de Serviço já foi entrege. Não será possível editá-la!');
	return false;
}	

function alerta(){
	alert('alerta de teste');
}	

function calculaOS(){
	
	SubmitAjax('post','OSDadosFinanceirosAjax.php','formOS','OSDadosFinanceiros');
	
	if ((document.getElementById('pfValEntrada').value == "0,00") || (document.getElementById('pfValDesconto').value == 0)) {
		SubmitAjax('post','branco.php','formOS','divValorDasParcelas');			
	} else {
		SubmitAjax('post','OSDadosFinanceirosFormPgtoAjax.php','formOS','divFormaPgto');	
	}
	//SubmitAjax('post','OSDadosFinanceirosFormPgtoAjax.php','formOS','divFormaPgto');
	SubmitAjax('post','branco.php','formOS','divValorDasParcelas');	
}

function mostraParcelas(){
	SubmitAjax('post','OSDadosFinanceirosQtdParcelas.php','formOS','divQtdParcelas');	
}

function mostraResumoCalculoOS(){
	SubmitAjax('post','OSDadosFinanceirosResultadoCalculoAjax.php','formOS','divValorDasParcelas');	
}



function validaForm(nome){
//	alert(nome);
//	if (nome == 'Excluir') {
//		var r = confirm("Tem certeza que deseja excluir?");
//		if (r == true) {
//			return true;	
//		} else {
//			return false;
//		}
//		return;	
//	} else {
		switch (nome) {
			case 'formPessoa':
				return validaFormPessoa();
				break;
			case 'formMarca':
//				alert("denovo" + nome);
				return validaFormMarca();
				break;

		}
//	} 
}


function validaFormArmacao(){
	if (document.getElementById('pfCodMarca').value == "") {
		alert('Escolha uma Marca')	;
		document.getElementById('pfCodMarca').focus();
		return false;
	}
	if (document.getElementById('pfDesArmacao').value == "") {
		alert('Digite a descrição do modelo.')	;
		document.getElementById('pfDesArmacao').focus();
		return false;
	}
	if (document.getElementById('pfValArmacao').value == "") {
		alert('Digite o valor da armação.')	;
		document.getElementById('pfValArmacao').focus();
		return false;
	}
	return true;
}

function validaFormCor(){
	if (document.getElementById('pfDesCor').value == "") {
		alert('Digite um nome da Cor!')	;
		document.getElementById('pfDesCor').focus();
		return false;
	}
	return true;
}

function validaFormLente(){
	if (document.getElementById('pfDesLente').value == "") {
		alert('Digite a Descrição da Lente!')	;
		document.getElementById('pfDesLente').focus();
		return false;
	}
	if (document.getElementById('pfCodMarca').value == "") {
		alert('Escolha a Marca da Lente!')	;
		document.getElementById('pfCodMarca').focus();
		return false;
	}
	if (document.getElementById('pfCodTipoLente').value == "") {
		alert('Escolha o Tipo da Lente!')	;
		document.getElementById('pfCodTipoLente').focus();
		return false;
	}
	if (document.getElementById('pfCodCor').value == "") {
		alert('Escolha a Cor da Lente!')	;
		document.getElementById('pfCodCor').focus();
		return false;
	}
	if (document.getElementById('pfValLente').value == "") {
		alert('Digite o Valor da Lente')	;
		document.getElementById('pfValLente').focus();
		return false;
	}
	return true;
}

function validaFormMarca(){
	if (document.getElementById('pfDesMarca').value == "") {
		alert('Digite o nome da marca!')	;
		document.getElementById('pfDesMarca').focus();
		return false;
	}
	return true;
}

function validaFormtipoLente(){
	if (document.getElementById('pfDesTipoLente').value == "") {
		alert('Digite a descrição do Tipo da Lente!')	;
		document.getElementById('pfDesTipoLente').focus();
		return false;
	}
	return true;
}


function validaFormPessoa(){
	if (document.getElementById('pfNomPessoa').value == "") {
		alert('Digite o nome')	;
		document.getElementById('pfNomPessoa').focus();
		return false;
	}

//	if (document.getElementById('pfCodTipoPessoa').checked == false) {
	if (document.formPessoa.pfCodTipoPessoa[0].checked == false && document.formPessoa.pfCodTipoPessoa[1].checked == false) {
		alert('Escolha o Tipo de Pessoa.')	;
		document.getElementById('pfCodTipoPessoa').focus();
		return false;
	}

	if (document.getElementById('pfCpf').value == "") {
		alert('Digite o CPF/CNPJ')	;
		document.getElementById('pfCpf').focus();
		return false;
	} else {
		
		fValidaCPF(document.getElementById('pfCpf').value, 'pfCpf');
		
		
		//if (fValidaCPF(document.getElementById('pfCpf').value, 'pfCpf')) 
		//return false;
	}
	
	if (document.getElementById('pfDatNascimento').value === "") {
		alert('Digite a data de nascimento.')	;
		document.getElementById('pfDatNascimento').focus();
		return false;
	}
	
	if (document.getElementById('pfEndPessoa').value === "") {
		alert('Digite o enredeço')	;
		document.getElementById('pfEndPessoa').focus();
		return false;
	}

	if (document.getElementById('pfDesBairro').value === "") {
		alert('Digite o nome bairro ')	;
		document.getElementById('pfDesBairro').focus();
		return false;
	}
	
	if (document.getElementById('pfNumEndereco').value === "") {
		alert('Digite o número da residência')	;
		document.getElementById('pfNumEndereco').focus();
		return false;
	}
	
	if (document.getElementById('pfCep').value === "") {
		alert('Digite o CEP')	;
		document.getElementById('pfCep').focus();
		return false;
	}

	if (document.getElementById('pfCodCidade').selected === "") {
		alert('Escolha a Cidade')	;
		document.getElementById('pfCodCidade').focus();
		return false;
	}

	
	return true;
}

function confirma(msg, vetorCampos){
	if (confirm(msg)){
		vetor = vetorCampos.split(",");
		for (i = 0; i < vetor.length; i++) {
			campo = eval(document.getElementById(vetor[i]));
			
			if (campo.value == "" || campo.value == 0 || campo.value == null) {
				alert("Campo Obrigatório!");
				campo.focus();
				return false;
			} 
		}
		return true;
	} else {
		return false;	
	}
}

function listaParcelasAjax(){
	document.getElementsByClassName('ocultaLancamentos').innerHTML = "oi";
	//SubmitAjax('get','listaLancamentos.php?os=<?php echo $codOS; ?>','','divListaLancamentos<?php echo $codOS; ?>');SubmitAjax('post','branco.php','','ocultaLancamentos');"
}

function alteraStatus(codOS, codStatus, codPermissao){
	switch (codPermissao) {
		case 1:
		case 2:
		case 3:
			if (confirm("Tem certeza que deseja alterar o status desta OS?\n\n \b> > > ESTA OPERAÇÃO NÃO PODERÁ SER DESFEITA! < < <"))
				redirecionar('alteraStatus.php?os=' + codOS + "&s=" + codStatus);
				return true;
		case 4:
			alert("Você não tem permissão para alterar o status da OS.\nEntre em contato com o Gerente!");
			return false;
		break;
	}
}

function validadeFormQtdArmacacao(){
	if (document.getElementById("pfQtdArmacao").value == "") {
		alert("Informe a quantidade a ser adicionada");
		document.getElementById("pfQtdArmacao").focus();
		return false;
	}
	return true;
}

function fValidaCPF(strCPF, pIdCampo) {
	strCPF = strCPF.replace(".","");
	strCPF = strCPF.replace(".","");
	strCPF = strCPF.replace("-","");
	//alert("cpf: " + strCPF);
    
	var Soma;
    var Resto;
    Soma = 0;
    
	if (strCPF != "") {
		//if ((strCPF == "00000000000") || (strCPF == "11111111111") || (strCPF == "22222222222") || (strCPF == "33333333333") || (strCPF == "44444444444") || (strCPF == "55555555555") || (strCPF == "66666666666") || (strCPF == "77777777777") || (strCPF == "88888888888") || (strCPF == "99999999999")) {
//			alert("CPF Inválido");
//			document.getElementById(pIdCampo).focus();
//			return false;
//		}
		
		for (i = 1; i <= 9; i++)
			Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
			
		Resto = (Soma * 10) % 11;
		
		if ((Resto == 10) || (Resto == 11))
			Resto = 0;
		
		if (Resto != parseInt(strCPF.substring(9, 10))) {
			alert("CPF Inválido...");
			document.getElementById(pIdCampo).focus(); 	
			return false;
		}
	
		Soma = 0;
		for (i = 1; i <= 10; i++)
			Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
	
		Resto = (Soma * 10) % 11;
		if ((Resto == 10) || (Resto == 11))
			Resto = 0;
	
		if (Resto != parseInt(strCPF.substring(10, 11))) {
			alert("CPF Inválido!");
			document.getElementById(pIdCampo).focus();
			return false;
		}
	}
	return true;
}

function estorno(){
	if (confirm("Deseja realizar o estorno deste lançamento?\n\nEste processo cancelará o pagamentoatual e um novo lançamento será gerado, com o mesmo valor e a mesma data de vencimento.")) {
		return (confirm("Você tem certeza? Esta operação não poderá ser desfeita."));
	} else {
		return false;
	}
}

function validaFormLogin(){
	if (document.getElementById('pfUsuario').value === "") {
		alert('Digite seu usuário')	;
		document.getElementById('pfUsuario').focus();
		return false;
	}

	if (document.getElementById('pfSenha').selected === "") {
		alert('Digite sua senha')	;
		document.getElementById('pfSenha').focus();
		return false;
	}
	return true;
}