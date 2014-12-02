<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'eventos-editar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');

$id = $_GET['ide'];
//aramzena id do evento que está sendo editado
$tpl->assign('idevento', $id);	

$idsubcategoria = $_REQUEST['subcategoria'];

if($idsubcategoria == ''){
	$idsubcategoria = 0;
}

session_start();	
$_SESSION['subcategoriaEditar'] = $idsubcategoria;

// select para mostrar cidade atual
$sql = "SELECT * FROM evento WHERE idevento = '$id'";
$respro = $dba->query($sql);
$numpro = $dba->rows($respro);
for ($i=0; $i<$numpro; $i++) {
	$vetpro = $dba->fetch($respro);	
	$tpl->assign('titulo', $vetpro['titulo']);
	$tpl->assign('texto', $vetpro['texto']);
	$tpl->assign('assunto', $vetpro['assunto']);
	$tpl->assign('tags', $vetpro['tags']);
	$tpl->assign('latitude', $vetpro['latitude']);
	$tpl->assign('longitude', $vetpro['longitude']);	

}


// select que mostra a cidade escolhida nos passos anteriores
$idcidade = $_SESSION['cidadeEditar'];
$sqlpro = "SELECT * FROM cidade WHERE idcidade = $idcidade";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
for ($i=0; $i<$qntd; $i++) {
	$vet = $dba->fetch($query);	
	$nomecidade = $vet['nome'];
	$tpl->assign('cidade',  $nomecidade);
}

// select que mostra a categoria escolhida nos passos anteriores
$idcategoria = $_SESSION['categoriaEditar'];
$sqlpro = "SELECT * FROM categoria WHERE idcategoria = $idcategoria";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
for ($i=0; $i<$qntd; $i++) {
	$vet = $dba->fetch($query);	
	$nomecategoria = $vet['nome'];
	$tpl->assign('categoria',  $nomecategoria);
}

// select que mostra a subcategoria escolhida nos passos anteriores
$sqlpro = "SELECT * FROM subcategoria WHERE idsubcategoria = $idsubcategoria";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);	
		$nomesubcategoria = $vet['nome'];
		$tpl->assign('subcategoria',  $nomesubcategoria);
	}
}else{
	$tpl->assign('subcategoria', 'Nehuma');	

}



//--------------------------

$tpl->printToScreen();
?>