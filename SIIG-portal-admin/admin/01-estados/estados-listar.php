<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'estados-listar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');


$sqlpro = "select * from estado ORDER BY sigla";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('estado');
		$tpl->assign('id', $vet['idestado']);
		$idr = $vet['idestado'];		
		$tpl->assign('nome', $vet['nome']);
		$tpl->assign('sigla', $vet['sigla']);
		$ativo = $vet['ativo'];		
		if($ativo == 1){
			$tpl->assign('ativo', '<a href="javascript:;" onclick="desativarEstado('.$idr.',\'estado_desativar\')" title="Desativar"><img src="../img/b_atisim.png" alt="Desativar" border="0" align="absmiddle" /></a>');
		}else{
			$tpl->assign('ativo', '<a href="javascript:;" onclick="ativarEstado('.$idr.',\'estado_ativar\')" title="Ativar"><img src="../img/b_atinao.png" alt="Ativar" border="0" align="absmiddle" /></a>');
		}
		
	}
} else {
	//não tem produtos, cria o block com o aviso
	$tpl->newBlock('noestado');
}


//--------------------------

$tpl->printToScreen();
?>