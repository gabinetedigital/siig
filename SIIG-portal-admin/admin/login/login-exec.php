<?php
if (isset($_POST['act']) && !empty($_POST['act'])) 
{
	$act = base64_decode($_POST['act']);
	

	switch($act) 
	{
		 case 'login':
            /*             * *********** LOGIN ************ */
            //pegar os dados do formulário
            $ema = addslashes($_POST['ema']);
            $sen = addslashes($_POST['sen']);
			$sen = sha1($sen);
            //montar o comando sql e executar
            $sql = "select * from usuario where email='$ema' and senha='$sen' "; //die($sql);
           	//referência ao arquvio de "auto load"
			require_once('../inc/inc.autoload.php');
            //referência à classe de conexão
			require_once('../inc/inc.dbconfig.php');
            $res = $dba->query($sql);
            $num = $dba->rows($res);
            //testar: se deu certo, vai, senão, volta
            if ($num > 0) {
            	session_start();
            	$_SESSION['login'] = $dba->result($res, 0, 'nome');                
                header('location: ../principal/');
            } else {
                $msg = md5(02);
				header('location: ./?msg='.$msg);
				exit;
            }
            /*             * ****************************** */
            break;

		/*case 'login':
			if (isset($_POST['log']) && !empty($_POST['log']) 
			&& isset($_POST['sen']) && !empty($_POST['sen'])) 
			{
				//pegar os parâmetros enviados por POST - ('or 1='1)
				$nro = addslashes($_POST['log']);
				$sen = addslashes($_POST['sen']);
				$sen = sha1($sen);
				
				//referência ao arquvio de "auto load"
				require_once('../inc/inc.autoload.php');
				//referência à classe de conexão
				require_once('../inc/inc.dbconfig.php');
				
				$sql = "select * from  where email = $nro and senha = $sen ";//die($sql);
				$res = $dba->query($sql);
				$num = $dba->rows($res);
				if ($num > 0) {
					session_start();
					$_SESSION['tip'] = 'pfexterno';
					$_SESSION['nro'] = $nro;
					$_SESSION['login'] = $dba->result($res, 0, 'nome');
					header('location: ../../principal/');
					exit;
				} 
				else {
					
				}
			}
			else 
			{
				$msg = md5(01);
				header('location: ./?msg='.$msg);
				exit;
			}
		break;*/
	}
	//fim do switch
		
}
else 
{
	$msg = md5(01);
	header('location: ./?msg='.$msg);
	exit;
}
?>