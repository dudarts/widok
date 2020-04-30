<?php
@session_start();
require_once("usuarioCtr.php");

$p = $_POST;
$obj = new UsuarioCtr();

//echo "Usuario: " . $p["pfCod"] . "<br><br><br>";

switch ($p["btn"]){
	case "Gravar":
		if ($p["pfSenha"] == $p["pfConfirmaSenha"]) {
			$obj->inserir($p["pfCod"], $p["pfCodOtica"], $p["pfCodPessoa"], $p["pfSenha"], $p["pfCodPermissao"], $p["pfCodStatus"], $_SESSION['codFilial']);		
			header("location:../../view/pagina.php?m=22&op=25&cod=" . $p["pfCod"] . "&msg=".md5(3));		
		} else {
//			header("Location: javascript:history.back(1)&msg".md5(6));
			header("location:../../view/pagina.php?m=22&op=25&cod=" . $p["pfCod"] . "&msg=".md5(6));
		}
		break;
	case "Atualizar Usuário" :
		if ($obj->validar($p["pfCodOtica"], $p["pfCod"], $p["pfSenhaAntiga"], "", "", "") == true){
			if ($p["pfSenha"] == $p["pfConfirmaSenha"]) {
				$obj->atualizar($p["pfCod"], $p["pfCodOtica"], md5($p["pfSenha"]), $p["pfCodPermissao"], $p["pfCodStatus"]);
				header("location:../../view/pagina.php?m=22&op=25&msg=".md5(3));
			} else {
				header("location:../../view/pagina.php?m=22&op=25&cod=" . $p["pfCod"] . "&msg=".md5(6));
			}
		} else {
			header("location:../../view/pagina.php?m=22&op=25&cod=" . $p["pfCod"] . "&msg=".md5(1));		
		}
		break;
}
?>