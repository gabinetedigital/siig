<?php
if ( isset($_POST['cha']) && !empty($_POST['cha']) && 
	 isset($_POST['tip']) && !empty($_POST['tip']) &&
	 isset($_POST['ins']) && !empty($_POST['ins']) &&
	 isset($_POST['sen1']) && !empty($_POST['sen1']) && isset($_POST['sen2']) && !empty($_POST['sen2']) 
	) 
{
	//pegar os parâmetros enviados por POST - ('or 1='1)
	$tip = $_POST['tip'];
	$cha = $_POST['cha'];
	$ins = $_POST['ins'];
	$se1 = $_POST['sen1'];
	$se2 = $_POST['sen2'];
	
	if ($se1 == $se2) {
		if (strlen($se1) >= 6) {
			//referência ao arquvio de "auto load"
			require_once('../inc/inc.autoload.php');
			//referência à classe de conexão
			require_once('../inc/inc.dbconfig.php');
			
			if ($tip == 'pf') {
				$col = 'cic';
				$nom = 'nome';
			} else {
				$col = 'cnpj';
				$nom = 'razao';
			}
			//faz o cadastro/alteração da senha conforme dados enviados
			$sen = sha1($se1);
			$sqlupd = "update $tip set senha_portal_restrito='$sen', chave_recupera_senha='' 
					   where inscricao='$ins' and chave_recupera_senha='$cha' ";
			$resupd = $dba->query($sqlupd);
			if ($resupd > 0) {
				$msg = md5(05.5); //sucesso
				header('location: ./?msg='.$msg);
				exit;
			} 
			else {
				$msg = md5(05.4); //problemas ao atualizar a senha no BD
				header("location: ./alterar.php?msg=$msg&cha=$cha&ins=$ins&tip=$tip");
				exit;
			}
		}
		else {
			$msg = md5(05.3); //a senha deve ter 6 dígitos ou mais
			header("location: ./alterar.php?msg=$msg&cha=$cha&ins=$ins&tip=$tip");
			exit;
		}
	}
	else {
		$msg = md5(05.2); //as senhas são diferentes
		header("location: ./alterar.php?msg=$msg&cha=$cha&ins=$ins&tip=$tip");
		exit;
	}
}
else 
{
	$tip = $_POST['tip'];
	$cha = $_POST['cha'];
	$ins = $_POST['ins'];
	$msg = md5(05.1); //link informado no e-mail com dados incorretos
	header("location: ./alterar.php?msg=$msg&cha=$cha&ins=$ins&tip=$tip");
	exit;
}
?>