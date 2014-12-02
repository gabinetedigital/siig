<?php
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('home.htm');

$tpl->prepare();

//--------------------------

$sqlpro = "SELECT * FROM categoria WHERE ativo = 1 ORDER BY RANDOM() LIMIT 5";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('catg');
		$tpl->assign('id', $vet['idcategoria']);	
		$tpl->assign('nome', $vet['nome']);	
	}
}


$sqlpro = "SELECT * FROM evento WHERE ativo = 1 ORDER BY RANDOM() LIMIT 4";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('evento');
		$tpl->assign('id', $vet['idevento']);		
		$tpl->assign('titulo', $vet['titulo']);
		$tpl->assign('assunto', $vet['assunto']);	
	}
}


//--------------------------

$tpl->printToScreen();
?>