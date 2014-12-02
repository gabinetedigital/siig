<?php
if ( $_SERVER['HTTP_HOST'] == 'localhost' ) {
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('BASE', 'crfrs_portal');
}
else {
	define('HOST','mysql.crfrs.org.br');
	define('USER','crfrs');
	define('PASS','crfrs10702012');
	define('BASE','crfrs');
}

//include_once('../inc/class.DbAdmin.php');
$dba = new DBAdmin('mysql');
$dba->connect(HOST, USER, PASS, BASE);
//já tenho o objeto $dba pronto para usar...
?>