<?php
/**
 * @author Odi
 * @version 1.0
 * @description 
 * 		Classe para conexão com MySQL e PostgreSQL
 */

class DBAdmin
{
	//declarações das variáveis
	var $host;
	var $user;
	var $pass;
	var $type;
	var $id;
	
	//método construtor - 
	//inicializa o tipo de banco a ser usado
	function DBAdmin($tip='mysql') {
		$this->type = trim(strtolower($tip));
	}
	
	//método que faz a conexão de acordo com o tipo do banco
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
			$this->id = pg_connect($str) or die('Problemas de conexão PosgreSQL');
			break;
		default:
			die('Tipo de banco de dados inválido!');
		}
	}
		
	//método que executa uma consulta sql 
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
			die('Tipo de banco de dados inválido!');
		}
		return $res;
	}
	
	//método que retorna o número de linhas da consulta
	function rows($res) {
		switch ($this->type) {
		case 'mysql':
			$num = mysql_num_rows($res);
			break;
		case 'pgsql':
			$num = pg_num_rows($res);
			break;
		default:
			die('Tipo de banco de dados inválido!');
		}
		return $num;
	}
	
	//método que retorna um array com os dados da consulta SQL
	function fetch($res) {
		switch ($this->type) {
		case 'mysql':
			$arr = mysql_fetch_array($res);
			break;
		case 'pgsql':
			$arr = pg_fetch_array($res);
			break;
		default:
			die('Tipo de banco de dados inválido!');
		}
		return $arr;
	}
	
	//método que retorna o registro conforme a solicitação
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
			die('Tipo de banco de dados inválido!');
		}
		return $val;
	}
	
	//método que coloca o ponteiro de manipulação do resultado em uma posição escolhida
	function seek($res, $nro) {
		switch ($this->type) {
		case 'mysql':
			mysql_data_seek($res, $nro);
			break;
		case 'pgsql':
			pg_result_seek($res, $nro);
			break;
		default:
			die('Tipo de banco de dados inválido!');
		}
	}
	
	//método que retorna o id do último registro inserido
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
	
	//método para fechar a conexão..
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