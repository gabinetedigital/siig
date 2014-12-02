<?php
include_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'principal.htm');

$tpl->prepare();

//------------------------

//mostrar dados no HEADER
$tpl->newBlock('logado');
$tpl->assign('nom', $_SESSION['login']);

$tpl->gotoBlock('_ROOT');
/*

//se já deu o "ok" na política de privacidade, não mostra...
if ($_SESSION['tip'] == 'pf') $coluna = 'cic';
if ($_SESSION['tip'] == 'pj') $coluna = 'cnpj';
$tabela = $_SESSION['tip'];
$nro = $_SESSION['nro'];
$sql = "select data_aceite_termos from $tabela where $coluna = '$nro' "; //die($sql);
$res = $dba->query($sql);
$dat = $dba->result($res, 0, 'data_aceite_termos');
if ($dat == '' or $dat == '0000-00-00') {
	header('location: crfrs-restrito-politica-privacidade.php');
	exit;
}

$tpl->gotoBlock('_ROOT');

//mostrar os dados do tipo de acesso
$tpl->newBlock('menu_'.$_SESSION['tip']);
$tpl->newBlock('content_'.$_SESSION['tip']); 
//mostrar o menu de renovacao de cr
if (isset($_SESSION['mcr']) && !empty($_SESSION['mcr'])) 
	$tpl->newBlock('menu_'.$_SESSION['mcr']);
*/

include_once('../inc/inc.mensagens.php');

//------------------------

$tpl->printToScreen();
?>