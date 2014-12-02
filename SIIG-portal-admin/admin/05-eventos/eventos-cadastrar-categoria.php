<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'eventos-cadastrar-categoria.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');


$idc = $_REQUEST['cidade'];

if($idc != ''){
	session_start();
	$_SESSION['cidade'] = $idc;

	$sqlpro = "SELECT * FROM cidade WHERE idcidade = '$idc'";
	$query = $dba->query($sqlpro);
	$qntd = $dba->rows($query);
	if ($qntd > 0) {
		for ($i=0; $i<$qntd; $i++) {
			$vet = $dba->fetch($query);	
			$nomecidade = $vet['nome'];
			$tpl->assign('nomecidade',  $nomecidade);
		}
	}


	$sqlpro = "SELECT * FROM categoria order by nome asc";
	$query = $dba->query($sqlpro);
	$qntd = $dba->rows($query);
	if ($qntd > 0) {
		for ($i=0; $i<$qntd; $i++) {
			$vet = $dba->fetch($query);
			$idctg = $vet['idcategoria'];		
			$ctg = $vet['nome'];
			$tpl->newBlock('categoria');
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