<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'categorias-listar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');


$sqlpro = "SELECT ctg.idcategoria, ctg.nome, ctg.ativo FROM categoria AS ctg ORDER BY ctg.nome";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('categoria');
		$tpl->assign('id', $vet[0]);
		$idr = $vet[0];		
		$tpl->assign('nome', $vet[1]);
		$ativo = $vet[2];		
		if($ativo == 1){
			$tpl->assign('ativo', '<a href="javascript:;" onclick="desativarCategoria('.$idr.',\'categoria_desativar\')" title="Desativar"><img src="../img/b_atisim.png" alt="Desativar" border="0" align="absmiddle" /></a>');
		}else{
			$tpl->assign('ativo', '<a href="javascript:;" onclick="ativarCategoria('.$idr.',\'categoria_ativar\')" title="Ativar"><img src="../img/b_atinao.png" alt="Ativar" border="0" align="absmiddle" /></a>');
		}
		
	}
} else {
	//não tem cidades, cria o block com o aviso
	$tpl->newBlock('nocategoria');
}


//--------------------------

$tpl->printToScreen();
?>