<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'categorias-editar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');

$id = $_GET['ide'];


$sql = "SELECT ctg.idcategoria, ctg.nome FROM categoria AS ctg where ctg.idcategoria = '$id' ORDER BY ctg.nome";
$respro = $dba->query($sql);
$numpro = $dba->rows($respro);
if ($numpro > 0) {
	for ($i=0; $i<$numpro; $i++) {
		$vetpro = $dba->fetch($respro);	
		$tpl->assign('id', $vetpro[0]);	
		$tpl->assign('nome', $vetpro[1]);

	}
}else{	
	header('admin.php?msg=000');
}



//--------------------------

$tpl->printToScreen();
?>