<?php
require_once('../inc/inc.verificasession.php');

require_once('../inc/inc.autoload.php');
require_once('../inc/inc.dbconfig.php');

include_once('../inc/class.TemplatePower.php');
$tpl = new TemplatePower('../tpl/_MASTER.htm');
$tpl->assignInclude('content', 'categorias-cadastrar.htm');

$tpl->prepare();

//--------------------------
include_once('../inc/inc.mensagens.php');


//--------------------------

$tpl->printToScreen();
?>