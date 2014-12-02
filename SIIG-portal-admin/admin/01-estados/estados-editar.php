<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'estados-editar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');

$id = $_GET['ide'];
$sql = "select * from estado where idestado = '$id'";
$respro = $dba->query($sql);
$numpro = $dba->rows($respro);
if ($numpro > 0) {
	for ($i=0; $i<$numpro; $i++) {
		$vetpro = $dba->fetch($respro);	
		$tpl->assign('id', $vetpro['idestado']);	
		$tpl->assign('nome', $vetpro['nome']);	
		$tpl->assign('sigla', $vetpro['sigla']);	

	}
}else{	
	header('admin.php?msg=000');
}



//--------------------------

$tpl->printToScreen();
?>