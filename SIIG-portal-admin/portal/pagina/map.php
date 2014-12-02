<?php
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('map.htm');

$tpl->prepare();

//--------------------------

//testes para passagem dos parametros

if (isset($_REQUEST['cid']) && !empty($_REQUEST['cid'])) {
	$cid = $_REQUEST['cid'];
	$par = "cid=$cid";
	$tpl->assign('parametro', $par);
}
if (isset($_REQUEST['cat']) && !empty($_REQUEST['cat'])) {
	$cat = $_REQUEST['cat'];
	if (isset($_REQUEST['cid']) && !empty($_REQUEST['cid'])) {
		$par.= "&cat=$cat";
	} else {
		$par = "cat=$cat";
	}
	$tpl->assign('parametro', $par);
}

if (isset($_REQUEST['txt']) && !empty($_REQUEST['txt'])) {
	$txt = $_REQUEST['txt'];
	if (isset($_REQUEST['cid']) && !empty($_REQUEST['cid']) or 
		isset($_REQUEST['cat']) && !empty($_REQUEST['cat'])) {
		$par.= "&txt=$txt";
	} else {
		$par = "txt=$txt";
	}
	$tpl->assign('parametro', $par);
}

if ( !isset($_REQUEST['cid']) && !isset($_REQUEST['cat']) && !isset($_REQUEST['sub']) ) {
	$tpl->assign('parametro', 'RS');
}
//-----------------------------------



$sqlpro = "SELECT * FROM cidade WHERE ativo = 1 ORDER BY nome";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('cidade');
		$tpl->assign('id', $vet['idcidade']);	
		$tpl->assign('nome', $vet['nome']);
		if($cid == $vet['nome']){
			$tpl->assign('sel', 'selected="selected"');
		}else{
			$tpl->assign('sel', '');
		}
	}
} 

$sqlpro = "SELECT * FROM categoria  WHERE ativo = 1 ORDER BY nome";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('categoria');
		$tpl->assign('id', $vet['idcategoria']);	
		$tpl->assign('nome', $vet['nome']);
		if($cat == $vet['nome']){
			$tpl->assign('sel', 'selected="selected"');
		}else{
			$tpl->assign('sel', '');
		}		
	}
}

//--------------------------

$tpl->printToScreen();
?>