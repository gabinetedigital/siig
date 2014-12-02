<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'subcategorias-cadastrar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');

$sqlpro = "SELECT ctg.idcategoria, ctg.nome FROM categoria AS ctg ORDER BY ctg.nome";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('categoria');
		$idr = $vet[0];		
		$nome = $vet[1];
		$cidade = $vet[2];
		$tpl->assign('categorias',  '<option value="'.$idr.'">'.$nome.' - '.$cidade.'</option>');
		
	}
}


//--------------------------

$tpl->printToScreen();
?>