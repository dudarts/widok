<?php 
@session_start();
require_once("../controller/menuCtr.php");;
	?>
	<ul>
	<?php
if (isset($opMenuPai)) {
	$arrayMenu = MenuCtr::subMenu($opMenuPai, $_SESSION['codPermissao']);					
	while ($rowArrayMenu = $arrayMenu->fetch_array(MYSQLI_ASSOC)){
		if ($opMenuFilho == $rowArrayMenu['COD_MENU']){
			$opMenuAtivo = "class='subMenuEscolhido'";
		} else {
			$opMenuAtivo = "";
		}
	?>
		<a href="?m=<?php echo $opMenuPai; ?>&op=<?php echo $rowArrayMenu['COD_MENU']?>" <?php echo $opMenuAtivo; ?>><li><?php echo $rowArrayMenu['DES_MENU']; ?></li></a>	
	<?php	
	}
}
?>
</ul>