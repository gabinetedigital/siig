<?php
require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');

$tpl = new TemplatePower('../tpl/default.htm');
$tpl->assignInclude('content', 'alterar.htm');
$tpl->prepare();

//------------------------
include_once('../inc/inc.mensagens.php');


if ( isset($_REQUEST['cha']) && isset($_REQUEST['tip']) && isset($_REQUEST['ins']) )
{
	//depois, deve ser comparada a "chave_recupera_senha" com o que foi enviado no link por e-mail - "alterar.php"
	//deve ter algum valor cadastrado na coluna, ou seja, a pessoa clicou em solicitar senha ou alterar senha...
	//se estiver em branco, mostra aviso que a solicitação já foi concluída, ou seja, clicou no link novamente depois de ter feito a senha... 
		//consulta a tabela conforme o tipo enviado e pega o CPF ou CNPJ (conforme inscricao enviada pelo link)
	//se são iguais (CPF.senhatemp) e tá tudo certo, aí abre a etapa para cadastrar uma nova senha
	//AÍ SIM, grava na coluna de nova senha e apaga a "chave_recupera_senha"
	
	//pega os dados enviados pelo direcionamento do "exec"
	$cha = $_REQUEST['cha'];
	$tip = $_REQUEST['tip'];
	$ins = $_REQUEST['ins'];
	if ($tip == 'pf') {
		$col = 'cic';
		$nom = 'nome';
	} else {
		$col = 'cnpj';
		$nom = 'razao';
	}
	//consulta o BD do sistema interno pra obter as informacoes
	$sql = "select * from $tip where inscricao = '$ins' and chave_recupera_senha = '$cha' ";
	$res = $dba->query($sql);
	$num = $dba->rows($res);
	if ($num > 0) {
		//Ok, chave de recuperação de senha confirmada
		$tpl->newBlock('form');
		$tpl->assign('cha', $cha);
		$tpl->assign('tip', $tip);
		$tpl->assign('ins', $ins);
	} 
	else {
		//NAO, já usou a chave de recuperaçao... 
		$tpl->newBlock('aviso');
	}
	
}
else 
{
	//não veio pelo link do email
	header('location: https://www.crfrs.org.br/restrito');
	exit;
}


//------------------------

$tpl->printToScreen();
?>