<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'eventos-editar-categoria.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');

$id = $_GET['ide'];
//aramzena id do evento que está sendo editado
$tpl->assign('idevento', $id);

$idcidade = $_REQUEST['cidade'];

session_start();	
$_SESSION['cidadeEditar'] = $idcidade;

// select que mostra a cidade escolhida no passo anterior
$sqlpro = "SELECT * FROM cidade WHERE idcidade = $idcidade";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
for ($i=0; $i<$qntd; $i++) {
	$vet = $dba->fetch($query);	
	$nomecidade = $vet['nome'];
	$tpl->assign('cidade',  $nomecidade);
}


// select para mostrar categoria atual
$sql = "SELECT categoria.nome 
		FROM evento AS evento 
			INNER JOIN categoria AS categoria 
				ON categoria.idcategoria = evento.categoria_idcategoria AND evento.idevento = '$id'";
$respro = $dba->query($sql);
$numpro = $dba->rows($respro);
for ($i=0; $i<$numpro; $i++) {
	$vetpro = $dba->fetch($respro);	
	$tpl->assign('categoriaatual', $vetpro[0]);	

}


// select que mostra as categorias de acordo com a cidade selecionada
$sqlpro = "SELECT * from categoria order by nome asc";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$idcategoria = $vet['idcategoria'];		
		$nomecategoria = $vet['nome'];
		$tpl->newBlock('categoria');
		$tpl->assign('idcategoria',  $idcategoria);
		$tpl->assign('nomecategoria',  $nomecategoria);
	}
}

//--------------------------

$tpl->printToScreen();
?>