<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'subcategorias-listar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');


/*$sqlpro = "SELECT sctg.idsubcategoria, sctg.nome, sctg.ativo, ctg.nome, cid.nome 
			FROM subcategoria AS sctg 
			INNER JOIN categoria AS ctg 
			INNER JOIN cidade AS cid 
				ON ctg.idcategoria = sctg.categoria_idcategoria 
					AND cid.idcidade = ctg.cidade_idcidade 
			ORDER BY ctg.nome, sctg.nome";*/
$sqlpro = "SELECT sctg.idsubcategoria, sctg.nome, sctg.ativo, ctg.nome
			FROM subcategoria AS sctg, categoria as ctg
			where sctg.categoria_idcategoria = ctg.idcategoria
			ORDER BY ctg.nome, sctg.nome";
$query = $dba->query($sqlpro);
$qntd = $dba->rows($query);
if ($qntd > 0) {
	for ($i=0; $i<$qntd; $i++) {
		$vet = $dba->fetch($query);
		$tpl->newBlock('subcategoria');
		$tpl->assign('id', $vet[0]);
		$idr = $vet[0];		
		$tpl->assign('nomesubcategoria', $vet[1]);
		$ativo = $vet[2];		
		if($ativo == 1){
			$tpl->assign('ativo', '<a href="javascript:;" onclick="desativarSubcategoria('.$idr.',\'subcategoria_desativar\')" title="Desativar"><img src="../img/b_atisim.png" alt="Desativar" border="0" align="absmiddle" /></a>');
		}else{
			$tpl->assign('ativo', '<a href="javascript:;" onclick="ativarSubcategoria('.$idr.',\'subcategoria_ativar\')" title="Ativar"><img src="../img/b_atinao.png" alt="Ativar" border="0" align="absmiddle" /></a>');
		}
		$tpl->assign('nomecategoria', $vet[3]);	
	}
} else {
	//não tem cidades, cria o block com o aviso
	$tpl->newBlock('nosubcategoria');
}


//--------------------------

$tpl->printToScreen();
?>