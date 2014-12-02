<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'cidades-listar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');


$sqlpro = "select * from cidade ORDER BY nome";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('cidade');
		$tpl->assign('id', $vet['idcidade']);
		$idr = $vet['idcidade'];		
		$tpl->assign('nome', $vet['nome']);
		$ativo = $vet['ativo'];		
		if($ativo == 1){
			$tpl->assign('ativo', '<a href="javascript:;" onclick="desativarCidade('.$idr.',\'cidade_desativar\')" title="Desativar"><img src="../img/b_atisim.png" alt="Desativar" border="0" align="absmiddle" /></a>');
		}else{
			$tpl->assign('ativo', '<a href="javascript:;" onclick="ativarCidade('.$idr.',\'cidade_ativar\')" title="Ativar"><img src="../img/b_atinao.png" alt="Ativar" border="0" align="absmiddle" /></a>');
		}
		
	}
} else {
	//não tem cidades, cria o block com o aviso
	$tpl->newBlock('nocidade');
}


//--------------------------

$tpl->printToScreen();
?>