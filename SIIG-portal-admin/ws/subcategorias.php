<?php
/**
 * @author			Odix - v 1.0 - nov/204
 * @description 	Obtém a lista de cidades (RS) cadastradas no SIIG
 * @params
		aut 		autenticação do WS, aut=c2lpZy1kZWQtM3dk - base64_encode('siig-ded-3wd')
		est 		estado (obrigatorio, 2 letras, padrão RS)
		cid 		cidade (obrigatorio, nome completo)
		cat 		cidade (obrigatorio, nome completo)
 */

if (isset($_REQUEST['aut']) && $_REQUEST['aut']=='c2lpZy1kZWQtM3dk') 
{
	if (isset($_REQUEST['est']) && strtolower($_REQUEST['est'])=='rs') 
	{
		if (isset($_REQUEST['cid']) && !empty($_REQUEST['cid'])) 
		{
			if (isset($_REQUEST['cat']) && !empty($_REQUEST['cat'])) {
				require_once('inc.dbconfig.php');
				
				//pega os parâmetros
				$est = $_REQUEST['est'];
				$cid = $_REQUEST['cid'];
				$cat = $_REQUEST['cat'];
				//monta o SQL de estado (pra pegar o ID)
				$sqlest = "select * from estado where sigla = '$est'";
				$resest = $dba->query($sqlest);
				$numest = $dba->rows($resest);
				if ($numest > 0) {
					$sid = $dba->result($resest, 0, 'idestado'); //já era sabido que seria 1, ok.
					//monta o SQL de cidade (para pegar o ID)
					$sqlcid = "select idcidade from cidade where sid = $sid and nome like '$cid' ";
					$rescid = $dba->query($sqlcid);
					$numcid = $dba->rows($rescid);
					if ($numcid > 0) {
						$idc = $dba->result($rescid, 0, 'idcidade');
						//monta o SQL de categorais (para pegar o ID)
						$sqlcat = "select idcategoria from categoria where cidade_idcidade = $idc and nome like '$cat'";
						$rescat = $dba->query($sqlcat);
						$numcat = $dba->rows($rescat);
						if ($numcat > 0) {
							$ida = $dba->result($rescat, 0, 'idcategoria');
							//monta o SQL de subcategorais (para listar)
							$sqlsub = "select * from subcategoria where categoria_idcategoria = $ida";
							$ressub = $dba->query($sqlsub);
							$numsub = $dba->rows($ressub);
								for ($i=0; $i<$numsub; $i++) {
									$sub = $dba->result($ressub, $i, 'nome');
									echo $sub;
									echo '<br />';
								}
						}
					}
				}
			}
			else {
				die('O parâmetro "cat" DEVE ser enviado. Exemplo: Meio Ambiente');
			}
		}
		else 
		{
			die('O parâmetro "cid" DEVE ser enviado. Exemplo: Porto Alegre');
		}
	}
	else 
	{
		die('O parâmetro "est" DEVE ser enviado. Default: RS');
	}
}
else
{
	die('Falha de autenticação do WS!');
}
?>