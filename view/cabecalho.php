<?php
//Inicia a sessão
@session_start();

//Inclui as páginas externas necessárias
require_once("../controller/paginaCtr.php");
?>
<table border="0" cellpadding="0" cellspacing="0" id="printTabelaTopo">
  <tr>
	<td><img id="printLogo" src="<?php echo PaginaCtr::getLogo($_SESSION['codOtica']); ?>" alt="widok - Sistema para Oticas"></td>
	<td>
	  <h1><?php echo @$tituloRelatorio; ?></h1>
	</td>
  </tr>
</table>