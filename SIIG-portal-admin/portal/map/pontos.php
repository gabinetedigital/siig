<?php
/**
 * @author			Odix - v 1.0 - nov/204
 * @description 	Obtém os eventos do BD e gera em JSON, para colocar os pontos no mapa
 * @params
		aut 		autenticação do WS, aut=c2lpZy1kZWQtM3dk - base64_encode('siig-ded-3wd')
		est 		estado (obrigatorio, 2 letras, padrão RS)
 */

if (isset($_REQUEST['aut']) && $_REQUEST['aut']=='c2lpZy1kZWQtM3dk' ) 
{
	require_once('../inc/inc.dbconfig.php');
	
	//inicializaçao json
	$json = 'markers = ';
	
	//inicializacao das vars de consulta
	$sid = 1;
	$idc = '%';
	$ida = '%';
	$ids = '%';
	$txt = '%';
	
	//definir o tipo de uso no switch
	if ( isset($_REQUEST['est']) && !empty($_REQUEST['est']) ) {
		$est = $_REQUEST['est'];
		$est = strtoupper($est);
		$sqlest = "select * from estado where sigla like '$est'";
		$resest = $dba->query($sqlest);
		$numest = $dba->rows($resest);
		if ($numest > 0) {
			$sid = $dba->result($resest, 0, 'idestado'); //já era sabido que seria 1, ok.
		}
	}
	if ( isset($_REQUEST['cid']) && !empty($_REQUEST['cid']) )  {
		$cid = $_REQUEST['cid'];
		$sqlcid = "select * from cidade where nome like '$cid'"; //die($sqlcid);
		$rescid = $dba->query($sqlcid);
		$numcid = $dba->rows($rescid);
		if ($numcid > 0) {
			$idc = $dba->result($rescid, 0, 'idcidade'); 
		}
	}
	if ( isset($_REQUEST['cat']) && !empty($_REQUEST['cat']) )  {
		$cat = $_REQUEST['cat'];
		$sqlcat = "select * from categoria where nome like '$cat'"; //die($sqlcat);
		$rescat = $dba->query($sqlcat);
		$numcat = $dba->rows($rescat);
		if ($numcat > 0) {
			$ida = $dba->result($rescat, 0, 'idcategoria'); 
		}
	}
	if ( isset($_REQUEST['txt']) && !empty($_REQUEST['txt']) )  {
		$txt = $_REQUEST['txt']; 
		$txt = strtolower($txt);
	}
	
	//pega TODOS os eventos cfme parametros
	$sqleve = "select * from evento 
				where sid = $sid 
				  and cast(cidade_idcidade as text) like '$idc' 
				  and cast(categoria_idcategoria as text) like '$ida' 
				  and cast(subcategoria_idsubcategoria as text) like '$ids' 
				  and (lower(titulo) like '%$txt%' or lower(assunto) like '%$txt%' or lower(tags) like '%$txt%') "; //die($sqleve);				  
	$reseve = $dba->query($sqleve);
	$numeve = $dba->rows($reseve);
	$json.= '[';
	for ($i=0; $i<$numeve; $i++) {
		$veteve = $dba->fetch($reseve);
		$idc = $veteve['cidade_idcidade'];
			$sqlcid = "select * from cidade where idcidade = $idc";
			$rescid = $dba->query($sqlcid);
			$numcid = $dba->rows($rescid);
			if ($numcid > 0) $cid = $dba->result($rescid, 0, 'nome');
			else $cid = 'Nenhuma Cidade';
		$ida = $veteve['categoria_idcategoria'];
			$sqlcat = "select * from categoria where idcategoria = $ida";
			$rescat = $dba->query($sqlcat);
			$numcat = $dba->rows($rescat);
			if ($numcat > 0) $cat = $dba->result($rescat, 0, 'nome');
			else $cat = 'Nenhuma Categoria';
		$ids = $veteve['subcategoria_idsubcategoria'];
			$sqlsub = "select * from subcategoria where idsubcategoria = $ids";
			$ressub = $dba->query($sqlsub);
			$numsub = $dba->rows($ressub);
			if ($numsub > 0) $sub = $dba->result($ressub, 0, 'nome');
			else $sub = 'Nenhuma Subcategoria';
		$ide = $veteve['idevento'];
		$tit = $veteve['titulo'];
		$txt = $veteve['texto'];
		$ass = $veteve['assunto'];
		$dth = $veteve['datahora'];
		$tag = $veteve['tags'];
		$lat = $veteve['latitude'];
		$lon = $veteve['longitude']; 
		//formatacao
		//$tit = utf8_encode($tit);
		//$ass = utf8_encode($ass);
		//$txt = utf8_encode($txt);
		//$txt = str_replace("\r\n", '<br/>', $txt);
		$json.= '{';
		$json.= '"name":"'.$tit.'",';
		$json.= '"url":"../pagina/detalhes.php?id='.$ide.'",';
		$json.= '"lat":'.$lat.',';
		$json.= '"lng":'.$lon.'';
		$json.= '},';
	}
	$json = substr($json, 0, strlen($json)-1); //para tirar a última vírgula antes de fechar o array de eventos
	$json.= ']';
	
	header('Content-Type: application/json');
	echo $json;
	
	$ref = fopen('eventos.json', 'w');
	fwrite($ref, $json);
	fclose($ref);
}
else 
{
	die('Falha de autenticação do WS!');
}
?>