<?php
/**
 * @author			Odix - v 1.0 - nov/204
 * @description 	Obtém os eventos do BD e gera em JSON, conforme parâmetros enviados
 * @params
		aut 		autenticação do WS, aut=c2lpZy1kZWQtM3dk - base64_encode('siig-ded-3wd')
		tip 		tipo de consulta, est, cid, cat, sub, all (obrigatório)
		
		est 		estado (obrigatorio para o tipo "all", 2 letras, padrão RS)
		cid 		cidade (obrigatorio para o tipo "all", nome completo, case insensitive) - usar "cidades.php" para listar
		cat 		categoria (nome completo, case insensitive) - usar "categorias.php" para listar 
		sub 		subcategoria (nome completo, case insensitive) - usar "subcategorias.php" para listar
 */

if (isset($_REQUEST['aut']) && $_REQUEST['aut']=='c2lpZy1kZWQtM3dk' ) 
{
	require_once('inc.dbconfig.php');
	
	//inicializaçao json
	$json = '{ ';
	
	//testes para definir o tipo de uso no switch
	if (isset($_REQUEST['tip']) && !empty($_REQUEST['tip']) && $_REQUEST['tip']=='all' ) {
		$tip = 'all';
	} elseif ( isset($_REQUEST['est']) && !empty($_REQUEST['est']) ) {
		$tip = 'est';
	} elseif ( isset($_REQUEST['cid']) && !empty($_REQUEST['cid']) )  {
		$tip = 'cid';
	} elseif ( isset($_REQUEST['cat']) && !empty($_REQUEST['cat']) )  {
		$tip = 'cat';
	} elseif ( isset($_REQUEST['sub']) && !empty($_REQUEST['sub']) )  {
		$tip = 'sub';
	}
	
	//testes e geração do json
	switch ($tip) 
	{
		case 'est':
			if (isset($_REQUEST['est']) && strtolower($_REQUEST['est'])=='rs') {
				$est = $_REQUEST['est'];
				$est = strtoupper($est);
				//monta o SQL de estado (pra pegar o ID)
				$sqlest = "select * from estado where sigla = '$est'";
				$resest = $dba->query($sqlest);
				$numest = $dba->rows($resest);
				if ($numest > 0) {
					$sid = $dba->result($resest, 0, 'idestado'); //já era sabido que seria 1, ok.
					$est = $dba->result($resest, 0, 'sigla'); //já era sabido que seria RS, ok.
					$json.= '"uf":"'.$est.'" , ';
					
					//pega TODOS os eventos do estado
					$sqleve = "select * from evento where sid = $sid";
					$reseve = $dba->query($sqleve);
					$numeve = $dba->rows($reseve);
					$json.= '"eventos":[ ';
					for ($i=0; $i<$numeve; $i++) {
						$veteve = $dba->fetch($reseve);
						$idc = $veteve['cidade_idcidade'];
							$sqlcid = "select * from cidade where idcidade = $idc"; //die($sqlcid);
							$rescid = $dba->query($sqlcid);
							$numcid = $dba->rows($rescid);
							if ($numcid > 0) $cid = $dba->result($rescid, 0, 'nome');
							else $cid = 'Nenhuma Cidade';
						$ida = $veteve['categoria_idcategoria'];
							$sqlcat = "select * from categoria where idcategoria = $ida"; //die($sqlcat);
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
						$json.= '{';
						$json.= '"id":"'.$ide.'",';
						$json.= '"titulo":"'.$tit.'",';
						$json.= '"texto":"'.$txt.'",';
						$json.= '"assunto":"'.$ass.'",';
						$json.= '"tags":"'.$tag.'",';
						$json.= '"datahora":"'.$dth.'",';
						$json.= '"latitude":"'.$lat.'",';
						$json.= '"longitude":"'.$lon.'",';
						$json.= '"cidade":"'.$cid.'",';
						$json.= '"categoria":"'.$cat.'",';
						$json.= '"subcategoria":"'.$sub.'"';
						$json.= '},';
					}
					$json = substr($json, 0, strlen($json)-1); //para tirar a última vírgula antes de fechar o array de eventos
					$json.= ']';
				}
			}
		break; //fim do case 'est'
		
		
		
		
		case 'cid':
			if (isset($_REQUEST['cid']) && !empty($_REQUEST['cid']) ) {
				$cid = $_REQUEST['cid'];
				//monta o SQL de cidade (pra pegar o ID)
				$sqlcid = "select * from cidade where nome like '$cid'";
				$rescid = $dba->query($sqlcid);
				$numcid = $dba->rows($rescid);
				if ($numcid > 0) {
					$vetcid = $dba->fetch($rescid);
					$est = 'RS'; //fixo, mas depois pode ser obtido de consulta inner join
					$idc = $vetcid['idcidade']; 
					$cid = $vetcid['nome']; 
					$json.= '"uf":"'.$est.'" , ';
					$json.= '"cidade":"'.$cid.'" , ';
					
					//pega TODOS os eventos da cidade
					$sqleve = "select * from evento e where e.cidade_idcidade = $idc order by sid";
					$reseve = $dba->query($sqleve);
					$numeve = $dba->rows($reseve);
					$json.= '"eventos":[ ';
					for ($i=0; $i<$numeve; $i++) {
						$veteve = $dba->fetch($reseve);
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
						$json.= '{';
						$json.= '"id":"'.$ide.'",';
						$json.= '"titulo":"'.$tit.'",';
						$json.= '"texto":"'.$txt.'",';
						$json.= '"assunto":"'.$ass.'",';
						$json.= '"tags":"'.$tag.'",';
						$json.= '"datahora":"'.$dth.'",';
						$json.= '"latitude":"'.$lat.'",';
						$json.= '"longitude":"'.$lon.'",';
						$json.= '"categoria":"'.$cat.'",';
						$json.= '"subcategoria":"'.$sub.'"';
						$json.= '},';
					}
					$json = substr($json, 0, strlen($json)-1); //para tirar a última vírgula antes de fechar o array de eventos
					$json.= ']';
				}
			}
		break; //fim do case 'cid'
		
		
		
		
		case 'cat':
			if (isset($_REQUEST['cat']) && !empty($_REQUEST['cat']) ) {
				$cat = $_REQUEST['cat'];
				//monta o SQL de categoria (pra pegar o ID)
				$sqlcat = "select * from categoria where nome like '$cat'";
				$rescat = $dba->query($sqlcat);
				$numcat = $dba->rows($rescat);
				if ($numcat > 0) {
					$vetcat = $dba->fetch($rescat);
					$ida = $vetcat['idcategoria']; 
					$cat = $vetcat['nome']; 
					$json.= '"categoria":"'.$cat.'" , ';
					
					//pega TODOS os eventos da categoria
					$sqleve = "select * from evento e where e.categoria_idcategoria = $ida order by sid, cidade_idcidade";
					$reseve = $dba->query($sqleve);
					$numeve = $dba->rows($reseve);
					$json.= '"eventos":[ ';
					for ($i=0; $i<$numeve; $i++) {
						$veteve = $dba->fetch($reseve);
						$sid = $veteve['sid'];
							$sqlest = "select * from estado where idestado = $sid";
							$resest = $dba->query($sqlest);
							$numest = $dba->rows($resest);
							if ($numest > 0) $est = $dba->result($resest, 0, 'nome');
							else $est = 'Nenhuma Estado';
						$idc = $veteve['cidade_idcidade'];
							$sqlcid = "select * from cidade where idcidade = $idc";
							$rescid = $dba->query($sqlcid);
							$numcid = $dba->rows($rescid);
							if ($numcid > 0) $cid = $dba->result($rescid, 0, 'nome');
							else $cid = 'Nenhuma Cidade';
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
						$dth = $veteve[ 'datahora'];
						$tag = $veteve['tags'];
						$lat = $veteve['latitude'];
						$lon = $veteve['longitude']; 
						$json.= '{';
						$json.= '"id":"'.$ide.'",';
						$json.= '"titulo":"'.$tit.'",';
						$json.= '"texto":"'.$txt.'",';
						$json.= '"assunto":"'.$ass.'",';
						$json.= '"tags":"'.$tag.'",';
						$json.= '"datahora":"'.$dth.'",';
						$json.= '"latitude":"'.$lat.'",';
						$json.= '"longitude":"'.$lon.'",';
						$json.= '"uf":"'.$est.'",';
						$json.= '"cidade":"'.$cid.'",';
						$json.= '"subcategoria":"'.$sub.'"';
						$json.= '},';
					}
					$json = substr($json, 0, strlen($json)-1); //para tirar a última vírgula antes de fechar o array de eventos
					$json.= ']';
				}
			}
		break; //fim do case 'cat'
		
		
		
		
		case 'sub':
			if (isset($_REQUEST['sub']) && !empty($_REQUEST['sub']) ) {
				$sub = $_REQUEST['sub'];
				//monta o SQL de categoria (pra pegar o ID)
				$sqlsub = "select * from subcategoria where nome like '$sub'";
				$ressub = $dba->query($sqlsub);
				$numsub = $dba->rows($ressub);
				if ($numsub > 0) {
					$ids = $dba->result($ressub, 0, 'idsubcategoria'); 
					$sub = $dba->result($ressub, 0, 'nome'); 
					$json.= '"subcategoria":"'.$sub.'" , ';
					
					//pega TODOS os eventos da cidade
					$sqleve = "select * from evento e where e.subcategoria_idsubcategoria = $ids order by sid, cidade_idcidade, categoria_idcategoria";
					$reseve = $dba->query($sqleve);
					$numeve = $dba->rows($reseve);
					$json.= '"eventos":[ ';
					for ($i=0; $i<$numeve; $i++) {
						$sid = $dba->result($reseve, $i, 'sid');
							$sqlest = "select * from estado where idestado = $sid";
							$resest = $dba->query($sqlest);
							$numest = $dba->rows($resest);
							if ($numest > 0) $est = $dba->result($resest, 0, 'nome');
							else $est = 'Nenhuma Estado';
						$idc = $dba->result($reseve, $i, 'cidade_idcidade');
							$sqlcid = "select * from cidade where idcidade = $idc";
							$rescid = $dba->query($sqlcid);
							$numcid = $dba->rows($rescid);
							if ($numcid > 0) $cid = $dba->result($rescid, 0, 'nome');
							else $cid = 'Nenhuma Cidade';
						$ida = $dba->result($reseve, $i, 'categoria_idcategoria');
							$sqlcat = "select * from categoria where idcategoria = $ida";
							$rescat = $dba->query($sqlcat);
							$numcat = $dba->rows($rescat);
							if ($numsub > 0) $cat = $dba->result($rescat, 0, 'nome');
							else $cat = 'Nenhuma Categoria';
						$ide = $veteve['idevento'];
						$tit = $veteve['titulo'];
						$txt = $veteve['texto'];
						$ass = $veteve['assunto'];
						$dth = $veteve['datahora'];
						$tag = $veteve['tags'];
						$lat = $veteve['latitude'];
						$lon = $veteve['longitude']; 
						$json.= '{';
						$json.= '"id":"'.$ide.'",';
						$json.= '"titulo":"'.$tit.'",';
						$json.= '"texto":"'.$txt.'",';
						$json.= '"assunto":"'.$ass.'",';
						$json.= '"tags":"'.$tag.'",';
						$json.= '"datahora":"'.$dth.'",';
						$json.= '"latitude":"'.$lat.'",';
						$json.= '"longitude":"'.$lon.'",';
						$json.= '"uf":"'.$est.'",';
						$json.= '"cidade":"'.$cid.'",';
						$json.= '"categoria":"'.$cat.'"';
						$json.= '},';
					}
					$json = substr($json, 0, strlen($json)-1); //para tirar a última vírgula antes de fechar o array de eventos
					$json.= ']';
				}
			}
		break; //fim do case 'sub'
		
		
		
		
		case 'all':
			if (isset($_REQUEST['est']) && strtolower($_REQUEST['est'])=='rs') {
				if (isset($_REQUEST['cid']) && !empty($_REQUEST['cid'])) {
					//pega os parâmetros
					$est = $_REQUEST['est'];
					$cid = $_REQUEST['cid'];
					//monta o SQL de estado (pra pegar o ID)
					$sqlest = "select * from estado where sigla = '$est'";
					$resest = $dba->query($sqlest);
					$numest = $dba->rows($resest);
					if ($numest > 0) {
						$sid = $dba->result($resest, 0, 'idestado'); //já era sabido que seria 1, ok.
						$est = $dba->result($resest, 0, 'sigla'); //já era sabido que seria RS, ok.
						$json.= '"uf":"'.$est.'"';
						
						//monta o SQL de cidade (para pegar o ID)
						$sqlcid = "select idcidade from cidade where sid = $sid and nome like '$cid' ";
						$rescid = $dba->query($sqlcid);
						$numcid = $dba->rows($rescid);
						if ($numcid > 0) {
							$idc = $dba->result($rescid, 0, 'idcidade');
							$cid = $dba->result($rescid, 0, 'nome');
							$json.= ', "cidade":"'.$cid.'"';
							
							//monta o SQL de categorais - opcional
							$sqlcat = '';
							if (isset($_REQUEST['cat'])) {
								$cat = $_REQUEST['cat'];
								$sqlcat = " and nome like '$cat' ";
							}
							$sqlcat = "select * from categoria where cidade_idcidade = $idc $sqlcat";
							$rescat = $dba->query($sqlcat);
							$numcat = $dba->rows($rescat);
							if ($numcat > 0) {
								for ($i=0; $i<$numcat; $i++) {
									$ida = $dba->result($rescat, $i, 'idcategoria');
									$cat = $dba->result($rescat, $i, 'nome');
									
									$sqlsub = '';
									if (isset($_REQUEST['sub'])) {
										$cat = $_REQUEST['sub'];
										$sqlsub = " and nome like '$sub' ";
									}
									//monta o SQL de subcategorias - opctional
									$sqlsub = "select * from subcategoria where categoria_idcategoria = $ida $sqlsub";
									$ressub = $dba->query($sqlsub);
									$numsub = $dba->rows($ressub);
									if ($numsub > 0) {
										for ($j=0; $j<$numsub; $j++) {
											$sub = $dba->result($ressub, $j, 'nome');
											
											//----- GERA O JSON COM OS DADOS -----
											echo $est.' - '.$cid.' - '.$cat.' - '.$sub;
											//------------------------------------
											
										}
									}
									
								}
							}
							
						}
					}
				}
				else {
					die('O parâmetro "cid" DEVE ser enviado. Exemplo: Porto Alegre');
				}
			}
			else {
				die('O parâmetro "est" DEVE ser enviado. Default: RS');
			}
		break; //fim do case 'all'	
	}
	//fim do switch
	
	$json.= ' }';
	
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