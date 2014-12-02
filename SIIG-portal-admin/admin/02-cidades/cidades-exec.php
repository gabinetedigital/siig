<?php
//referência ao arquvio de "auto load"
require_once('../inc/inc.autoload.php');
//referência à classe de conexão
require_once('../inc/inc.dbconfig.php');

if (isset($_REQUEST['act']) && !empty($_REQUEST['act'])) 
{
	$act = $_REQUEST['act'];

	switch($act)
    {
		 case 'cidade_cadastrar':
            /*             * *********** CADASTRAR ************ */
            if(!empty($_POST['nome'])) {    
                $nome = $_POST['nome'];                            
                                               // sid = estado, default 1 = RS
                $sql = "insert into cidade (nome, sid, ativo) values ('$nome', 1, 1)"; 
                $res = $dba->query($sql);                                            
                                
                header('location: cidades-listar.php');       
            }else{
                header('location: cidades-listar.php');
            }           
            
            /* ********************************** */
            break;

         case 'cidade_editar':
            /*             * *********** EDITAR ************ */
            $ide = $_POST['id'];            
            if(!empty($_POST['nome'])) {    
                $nome = $_POST['nome'];   

                $sql = "update cidade set nome='$nome' where idcidade = $ide";        

                $res = $dba->query($sql);                                            
                                
                header('location: cidades-listar.php');       
            }else{
                header('location: cidades-listar.php');
            }           
            
            /* ********************************** */
            break;

         case 'cidade_ativar':
            /*             * *********** ATIVAR ************ */
            $idn = $_GET['id'];                     
            $sql = "update cidade set ativo = 1 where idcidade = $idn"; 
            $res = $dba->query($sql);
            
            header('location: cidades-listar.php');            
            
            /* ********************************** */
            break;

        
         case 'cidade_desativar':
            /*             * *********** DESATIVAR ************ */
            $idn = $_GET['id'];         
        
            $sql = "update cidade set ativo = 0 where idcidade = $idn"; 
            $res = $dba->query($sql);
            
            header('location: cidades-listar.php');            
            /* ********************************** */
            break;  


        case 'cidade_excluir':  
              /*             * *********** EXCLUIR ************ */       
            $idn = $_GET['id'];    
             
            $sql = "delete from cidade where idcidade = '$idn'";
            $res = $dba->query($sql);
            
            header('location: cidades-listar.php');
        
             /* ********************************** */
            break; 

	}

	//fim do switch
		
}
else{
	$msg = md5(01);
	header('location: ./?msg='.$msg);
	exit;
}

?>