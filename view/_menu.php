<?php
@session_start();
require_once("../controller/menuCtr.php");
$resultado = MenuCtr::menu($_SESSION['codPermissao']);
?>
<ul>
<?php

while ($row = $resultado->fetch_array(MYSQLI_ASSOC)){
	if ($row['COD_MENU'] == 100) {
?>
	<li></li>
	<a href="sair.php"><li id="sair"><?php echo $row['DES_MENU']; ?></li></a>	
<?php
	} else {
?>
	<a href="?m=<?php echo $row['COD_MENU']?>"><li><?php echo $row['DES_MENU']; ?></li></a>	
<?php
	}
}
?>
</ul>