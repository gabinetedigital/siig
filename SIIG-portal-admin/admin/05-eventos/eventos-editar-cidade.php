<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'eventos-editar-cidade.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');

$id = $_GET['ide'];
//aramzena id do evento que está sendo editado
$tpl->assign('idevento', $id);	

// select para mostrar cidade atual
$sql = "SELECT cidade.nome 
		FROM evento AS evento 
			INNER JOIN cidade AS cidade 
				ON cidade.idcidade = evento.cidade_idcidade and evento.idevento = '$id'";
$respro = $dba->query($sql);
$numpro = $dba->rows($respro);
for ($i=0; $i<$numpro; $i++) {
	$vetpro = $dba->fetch($respro);	
	$tpl->assign('cidadeatual', $vetpro[0]);	

}


// select que mostra as cidades
$sqlpro = "SELECT * from cidade order by nome asc";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$idc = $vet['idcidade'];		
		$cid = $vet['nome'];
		$tpl->newBlock('cidade');
		$tpl->assign('idc',  $idc);
		$tpl->assign('cid',  $cid);
	}
}


//--------------------------

$tpl->printToScreen();
?>