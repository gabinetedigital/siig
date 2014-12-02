<?php
if ( $_SERVER['HTTP_HOST'] == 'localhost' ) {
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('BASE', 'siig');
}
else {
	//define('HOST','mysql.siig.tmp.br');
	define('HOST','pgsql.siig.tmp.br');
	define('USER','siig');
	define('PASS','s11gt4rs0');
	define('BASE','siig');
}

//include_once('../inc/class.DbAdmin.php');
$dba = new DBAdmin('pgsql');
$dba->connect(HOST, USER, PASS, BASE);
//já tenho o objeto $dba pronto para usar...
?>