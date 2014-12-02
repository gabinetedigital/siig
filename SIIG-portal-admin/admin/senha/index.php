<?php
/*
if ($_SERVER['SERVER_PORT'] == 80) {
	header('location: https://crfrs.org.br/~crfrs/admin/login/');
	exit;
}
*/

include_once('../inc/class.TemplatePower.php');

$tpl = new TemplatePower('../tpl/default.htm');
$tpl->assignInclude('content', 'senha.htm');

$tpl->prepare();

//------------------------

include_once('../inc/inc.mensagens.php');


//------------------------

$tpl->printToScreen();
?>