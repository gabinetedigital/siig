<?php
/**
 * @author Odi
 * @version 1.0
 * @description 
 * 		Classe para conex�o com MySQL e PostgreSQL
 */

class DBAdmin
{
	//declara��es das vari�veis
	var $host;
	var $user;
	var $pass;
	var $type;
	var $id;
	
	//m�todo construtor - 
	//inicializa o tipo de banco a ser usado
	function DBAdmin($tip='mysql') {
		$this->type = trim(strtolower($tip));
	}
	
	//m�todo que faz a conex�o de acordo com o tipo do banco
	function connect($ho, $us, $pa, $db) {
		switch ($this->type) {
		case 'mysql':
			$this->id = @mysql_connect($ho, $us, $pa);
			if (empty($this->id)) {
				header('location: ../../erros/500.html');
				exit;
			}
			mysql_select_db($db) or die('Problemas ao acessar os dados.');
			break;
		case 'pgsql':
			$str = "host=$ho port=5432 dbname=$db user=$us password=$pa";
			$this->id = pg_connect($str) or die('Problemas de conex�o PosgreSQL');
			break;
		default:
			die('Tipo de banco de dados inv�lido!');
		}
	}
		
	//m�todo que executa uma consulta sql 
	//retorna um identificador de resultado
	function query($sql) {
		switch ($this->type) {
		case 'mysql':
			$res = mysql_query($sql, $this->id) or die(mysql_error());
			break;
		case 'pgsql':
			$res = pg_query($this->id, $sql) or die('Problemas para executar a Query PosgreSQL');
			break;
		default:
			die('Tipo de banco de dados inv�lido!');
		}
		return $res;
	}
	
	//m�todo que retorna o n�mero de linhas da consulta
	function rows($res) {
		switch ($this->type) {
		case 'mysql':
			$num = mysql_num_rows($res);
			break;
		case 'pgsql':
			$num = pg_num_rows($res);
			break;
		default:
			die('Tipo de banco de dados inv�lido!');
		}
		return $num;
	}
	
	//m�todo que retorna um array com os dados da consulta SQL
	function fetch($res) {
		switch ($this->type) {
		case 'mysql':
			$arr = mysql_fetch_array($res);
			break;
		case 'pgsql':
			$arr = pg_fetch_array($res);
			break;
		default:
			die('Tipo de banco de dados inv�lido!');
		}
		return $arr;
	}
	
	//m�todo que retorna o registro conforme a solicita��o
	function result($res, $lin, $col) {
		switch ($this->type) {
		case 'mysql':
			$val = mysql_result($res, $lin, $col);
			break;
		case 'pgsql':
			$vet = $this->fetch($res);
			for ($i=0; $i<count($vet); $i++) {
				if ($i == $lin) {
					$val = $vet[$col];
					break;
				}
			}
			break;
		default:
			die('Tipo de banco de dados inv�lido!');
		}
		return $val;
	}
	
	//m�todo que coloca o ponteiro de manipula��o do resultado em uma posi��o escolhida
	function seek($res, $nro) {
		switch ($this->type) {
		case 'mysql':
			mysql_data_seek($res, $nro);
			break;
		case 'pgsql':
			pg_result_seek($res, $nro);
			break;
		default:
			die('Tipo de banco de dados inv�lido!');
		}
	}
	
	//m�todo que retorna o id do �ltimo registro inserido
	function lastid(){
		switch( $this->type ){
		case 'mysql':
			$id =  mysql_insert_id( $this->id );
			break;
		case 'pgsql':
			$id =  pg_last_oid( $this->id );			
			break;
		}
		return $id;
	}
	
	//m�todo para fechar a conex�o..
	function close() {
		switch ( $this->type ){
			case 'mysql':
				mysql_close($this->id);
				break;
				
			case 'pgsql':
				pg_close($this->id);
				break;
		}
	}
}
?>