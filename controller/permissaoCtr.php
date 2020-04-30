<?PHP
require_once("../model/permissaoCls.php");

class PermissaoCtr {
	public static function selecionar($pCodPermissao){
		$obj = new PermissaoCls();
		return $obj->selecionar($pCodPermissao);
	}
}
?>