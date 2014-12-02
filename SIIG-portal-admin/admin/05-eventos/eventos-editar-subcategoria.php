<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'eventos-editar-subcategoria.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');

$id = $_GET['ide'];
//aramzena id do evento que está sendo editado
$tpl->assign('idevento', $id);

$idcategoria = $_REQUEST['categoria'];

session_start();	
$_SESSION['categoriaEditar'] = $idcategoria;


// select que mostra a cidade escolhida no passo anterior ao anterior
$idcidade = $_SESSION['cidadeEditar'];
$sqlpro = "SELECT * FROM cidade WHERE idcidade = $idcidade";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
for ($i=0; $i<$qntd; $i++) {
	$vet = $dba->fetch($query);	
	$nomecidade = $vet['nome'];
	$tpl->assign('cidade',  $nomecidade);
}

// select que mostra a categoria escolhida no passo anterior
$sqlpro = "SELECT * FROM categoria WHERE idcategoria = $idcategoria";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
for ($i=0; $i<$qntd; $i++) {
	$vet = $dba->fetch($query);	
	$nomecategoria = $vet['nome'];
	$tpl->assign('categoria',  $nomecategoria);
}



// select para mostrar subcategoria atual
$sql = "SELECT subcategoria.nome 
		FROM evento AS evento 
			INNER JOIN subcategoria AS subcategoria 
				ON subcategoria.idsubcategoria = evento.subcategoria_idsubcategoria AND evento.idevento = '$id'";
$respro = $dba->query($sql);
$numpro = $dba->rows($respro);
if ($numpro > 0) {
	for ($i=0; $i<$numpro; $i++) {
		$vetpro = $dba->fetch($respro);
		$nomesubcategoria = $vet[0];	
		$tpl->assign('subcategoriaatual', $vetpro[0]);		
	}
}else{
	$tpl->assign('subcategoriaatual', 'Nehuma');	

}

// select que mostra as subcategorias de acordo com a categoria selecionada
$sqlpro = "SELECT * from subcategoria where categoria_idcategoria = $idcategoria order by nome asc";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$idsubcategoria = $vet['idsubcategoria'];		
		$nomesubcategoria = $vet['nome'];
		$tpl->newBlock('subcategoria');
		$tpl->assign('idsubcategoria',  $idsubcategoria);
		$tpl->assign('nomesubcategoria',  $nomesubcategoria);
	}
}else{
	$tpl->newBlock('nosubcategoria');	
}


//--------------------------

$tpl->printToScreen();
?>