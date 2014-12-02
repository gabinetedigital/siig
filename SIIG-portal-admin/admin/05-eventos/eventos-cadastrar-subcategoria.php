<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'eventos-cadastrar-subcategoria.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');


$idcatg = $_REQUEST['categoria'];


if($idcatg != ''){
	session_start();
	$_SESSION['categoria'] = $idcatg;

	$sqlpro = "SELECT * FROM cidade WHERE idcidade = '".$_SESSION['cidade']."'";
	$query = $dba->query($sqlpro);
	$qntd = $dba->rows($query);
	if ($qntd > 0) {
		for ($i=0; $i<$qntd; $i++) {
			$vet = $dba->fetch($query);	
			$nomecidade = $vet['nome'];
			$tpl->assign('nomecidade',  $nomecidade);
		}
	}

	$sqlpro = "SELECT * FROM categoria WHERE idcategoria = '".$_SESSION['categoria']."'";
	$query = $dba->query($sqlpro);
	$qntd = $dba->rows($query);
	if ($qntd > 0) {
		for ($i=0; $i<$qntd; $i++) {
			$vet = $dba->fetch($query);	
			$nomecategoria = $vet['nome'];
			$tpl->assign('nomecategoria',  $nomecategoria);
		}
	}



	$sqlpro = "SELECT * FROM subcategoria WHERE categoria_idcategoria = '$idcatg' order by nome asc";
	$query = $dba->query($sqlpro);
	$qntd = $dba->rows($query);
	if ($qntd > 0) {
		for ($i=0; $i<$qntd; $i++) {
			$vet = $dba->fetch($query);
			$idctg = $vet['idsubcategoria'];		
			$ctg = $vet['nome'];
			$tpl->newBlock('subcategoria');
			$tpl->assign('idctg',  $idctg);
			$tpl->assign('ctg',  $ctg);
		}
	}
}else{
	 header('location: eventos-cadastrar-cidade.php');
}


//--------------------------

$tpl->printToScreen();
?>