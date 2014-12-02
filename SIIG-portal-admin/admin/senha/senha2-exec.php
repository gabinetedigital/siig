<?php
if ( isset($_POST['nro']) && is_numeric($_POST['nro']) ) 
{
	//pegar os parâmetros enviados por POST - ('or 1='1)
	$tip = $_POST['tip'];
	$nro = addslashes($_POST['nro']);
	$sen = addslashes($_POST['sen']);
	$sen = sha1($sen);
	
	//referência ao arquvio de "auto load"
	require_once('../inc/inc.autoload.php');
	//referência à classe de conexão
	require_once('../inc/inc.dbconfig.php');
	
	//verifica se já fez o recadastramento
	if ($tip == 'pf') {
		$cod = substr($nro, 0, strlen($nro)-2).'-'.substr($nro, -2);
		$col = 'cic';
		$nom = 'nome';
		$dtr = 'data_renovacao';
	} else {
		$cod = substr($nro, 0, strlen($nro)-2).'-'.substr($nro, -2);
		$cod = substr($cod, 0, strlen($cod)-7).'/'.substr($cod, -7);
		$col = 'cnpj';
		$nom = 'razao';
		$dtr = 'data_renovacao';
	}
	
	$sql = "select * from $tip where $col = '$cod' and $dtr <> '0000-00-00' ";die($sql);
	//$sql = "select * from $tip where $col = '$nro' ";//die($sql);
	$res = $dba->query($sql);
	$num = $dba->rows($res);
	if ($num > 0) {
		//criar senha aleatória 
		$pas = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"), 0, 6);
		
		//cpf ou cnpj - para gerar a chave de recuperacao de senha
		$cod = $dba->result($res, 0, $col);
		$ins = $dba->result($res, 0, 'inscricao');
		
		//dados para enviar por e-mail
		$nom = $dba->result($res, 0, $nom);
		$ema = $dba->result($res, 0, 'email');
		
		//gravar no BD a chave para recuperar senha (ou cadastrar nova)
		$chave = $cod.$pas; //CPF ou CNPJ concatenado com a senha aleatória
		$chave = md5($chave);
		$dtenv = date('Y-m-d');
		$sqlupd = "update $tip set chave_recupera_senha='$chave', data_envio_senha='$dtenv' where $col='$cod' ";
		$resupd = $dba->query($sqlupd);
		
		//enviar e-mail com link para ativação do acesso restrito 
		$lnk = '<a href="https://crfrs.org.br/restrito/senha/alterar.php?cha='.$chave.'&tip='.$tip.'&ins='.$ins.'">Cadastrar/Recuperar Senha para o Acesso Restrito do Portal CRF-RS</a>';
		include_once('senha-send.php');		
	} 
	else {
		//não fez o recadastramento
		if ($tip == 'pf')
			$msg = md5(04.1);
		else
			$msg = md5(04.2);
	}
}
else 
{
	//não informou CPF ou CNPJ
	$msg = md5(01);
}

header('location: ./?msg='.$msg);
?>