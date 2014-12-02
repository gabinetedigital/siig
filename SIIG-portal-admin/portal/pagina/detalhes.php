<?php
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('detalhes.htm');

$tpl->prepare();

//--------------------------

if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	// select para mostrar cidade atual
	$sql = "SELECT * FROM evento WHERE idevento = '$id'";
	$respro = $dba->query($sql);
	$numpro = $dba->rows($respro);
	if ($numpro > 0) {
		$vetpro = $dba->fetch($respro);	
		
		$tpl->assign('titulo', $vetpro['titulo']);
		$tpl->assign('texto', $vetpro['texto']);
		$tpl->assign('assunto', $vetpro['assunto']);
		$tpl->assign('tags', $vetpro['tags']);
		$tpl->assign('latitude', $vetpro['latitude']);
		$tpl->assign('longitude', $vetpro['longitude']);	
		
		// select que mostra a cidade escolhida nos passos anteriores
		$idcidade = $vetpro['cidade_idcidade'];
		$sqlpro = "SELECT * FROM cidade WHERE idcidade = $idcidade";
		$query = $dba->query($sqlpro);
		$qntd = $dba->rows($query);
		if ($qntd > 0) {
			$vet = $dba->fetch($query);	
			$nomecidade = $vet['nome'];
			$tpl->assign('cidade',  $nomecidade);
		}
		
		// select que mostra a categoria escolhida nos passos anteriores
		$idcategoria =$vetpro['categoria_idcategoria'];
		$sqlpro = "SELECT * FROM categoria WHERE idcategoria = $idcategoria";
		$query = $dba->query($sqlpro);
		$qntd = $dba->rows($query);
		if ($qntd > 0) {
			$vet = $dba->fetch($query);	
			$nomecategoria = $vet['nome'];
			$tpl->assign('categoria',  $nomecategoria);
		}
		
		// select que mostra a subcategoria escolhida nos passos anteriores
		$idsubcategoria =$vetpro['subcategoria_idsubcategoria'];
		$sqlpro = "SELECT * FROM subcategoria WHERE idsubcategoria = $idsubcategoria";
		$query = $dba->query($sqlpro);
		$qntd = $dba->rows($query);
		if ($qntd > 0) {
			$vet = $dba->fetch($query);	
			$nomesubcategoria = $vet['nome'];
			$tpl->assign('subcategoria',  $nomesubcategoria);
		}
	}

}
else 
{
	header('location: ../');
	exit;
}

//--------------------------

$tpl->printToScreen();
?>