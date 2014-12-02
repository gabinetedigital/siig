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
		 case 'estado_cadastrar':
            /*             * *********** CADASTRAR ************ */
            if(!empty($_POST['nome']) && !empty($_POST['sigla'])) {    
                $nome = $_POST['nome'];
                $sigla = $_POST['sigla'];             

                $sql = "insert into estado (nome, sigla, ativo) values ('$nome','$sigla', 1)"; 
                $res = $dba->query($sql);                                            
                                
                header('location: estados-listar.php');       
            }else{
                header('location: estados-listar.php');
            }           
            
            /* ********************************** */
            break;

         case 'estado_editar':
            /*             * *********** EDITAR ************ */
            $ide = $_POST['id'];            
            if(!empty($_POST['nome']) && !empty($_POST['sigla'])) {    
                $nome = $_POST['nome'];
                $sigla = $_POST['sigla'];    

                $sql = "update estado set  nome='$nome', sigla='$sigla' where idestado = $ide";        

                $res = $dba->query($sql);                                            
                                
                header('location: estados-listar.php');       
            }else{
                header('location: estados-listar.php');
            }           
            
            /* ********************************** */
            break;

         case 'estado_ativar':
            /*             * *********** ATIVAR ************ */
            $idn = $_GET['id'];                     
            $sql = "update estado set ativo = 1 where idestado = $idn"; 
            $res = $dba->query($sql);
            
            header('location: estados-listar.php');            
            
            /* ********************************** */
            break;

        
         case 'estado_desativar':
            /*             * *********** DESATIVAR ************ */
            $idn = $_GET['id'];         
        
            $sql = "update estado set ativo = 0 where idestado = $idn"; 
            $res = $dba->query($sql);
            
            header('location: estados-listar.php');            
            /* ********************************** */
            break;  


        case 'estado_excluir':
              /*             * *********** EXCLUIR ************ */         
            $idn = $_GET['id'];    
             
            $sql = "delete from estado where idestado = '$idn'";
            $res = $dba->query($sql);
            
            header('location: estados-listar.php');
        
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