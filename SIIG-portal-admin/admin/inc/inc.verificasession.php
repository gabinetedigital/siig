<?php
/*
if ($_SERVER['SERVER_PORT'] == 80) {
	header('location: https://crfrs.org.br/restrito/login/');
	exit;
}*/


//teste de verificação da session
session_start();

if (!isset($_SESSION['login'])) {
	//volta pra página de login
	session_destroy();
	$msg = md5(03);
	header('location: ../login/?msg='.$msg);
	exit; //nem precisa interpretar mais nada...
}
?>