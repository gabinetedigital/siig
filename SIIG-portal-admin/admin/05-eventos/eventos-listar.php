<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'eventos-listar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');


$sqlpro = "select * from evento";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('evento');
		$tpl->assign('id', $vet['idevento']);
		$idr = $vet['idevento'];		
		$tpl->assign('nome', $vet['titulo']);
		$ativo = $vet['ativo'];		
		if($ativo == 1){
			$tpl->assign('ativo', '<a href="javascript:;" onclick="desativarEvento('.$idr.',\'evento_desativar\')" title="Desativar"><img src="../img/b_atisim.png" alt="Desativar" border="0" align="absmiddle" /></a>');
		}else{
			$tpl->assign('ativo', '<a href="javascript:;" onclick="ativarEvento('.$idr.',\'evento_ativar\')" title="Ativar"><img src="../img/b_atinao.png" alt="Ativar" border="0" align="absmiddle" /></a>');
		}
		
	}
} else {
	//não tem cidades, cria o block com o aviso
	$tpl->newBlock('noevento');
}


//--------------------------

$tpl->printToScreen();
?>