<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'subcategorias-editar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');

$id = $_GET['ide'];


$sql = "SELECT sctg.idsubcategoria, sctg.nome, ctg.nome 
		FROM subcategoria AS sctg 
			INNER JOIN categoria AS ctg 
				ON ctg.idcategoria = sctg.categoria_idcategoria 
			ORDER BY ctg.nome, sctg.nome";
$respro = $dba->query($sql);
$numpro = $dba->rows($respro);
if ($numpro > 0) {
	for ($i=0; $i<$numpro; $i++) {
		$vetpro = $dba->fetch($respro);	
		$tpl->assign('id', $vetpro[0]);	
		$tpl->assign('nome', $vetpro[1]);
		$tpl->assign('cidade', $vetpro[2]);	

	}
}else{	
	header('admin.php?msg=000');
}


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