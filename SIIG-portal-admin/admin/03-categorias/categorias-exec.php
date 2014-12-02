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
		 case 'categoria_cadastrar':
            /*             * *********** CADASTRAR ************ */
            if(!empty($_POST['nome']) && $_POST['cidade']!='--') {    
                $nome = $_POST['nome'];
                $sql = "insert into categoria (nome, sid, ativo) values ('$nome', 1, 1)"; 
                $res = $dba->query($sql);   
            }          
            header('location: categorias-listar.php');
            /* ********************************** */
            break;

         case 'categoria_editar':
            /*             * *********** EDITAR ************ */
            $ide = $_POST['id'];            
            if(!empty($_POST['nome'])) {    
                $nome = $_POST['nome'];  
                $sql = "update categoria set nome='$nome' where idcategoria = $ide";        
				$res = $dba->query($sql);     
            }           
            header('location: categorias-listar.php');
            /* ********************************** */
            break;

         case 'categoria_ativar':
            /*             * *********** ATIVAR ************ */
            $idn = $_GET['id'];                     
            $sql = "update categoria set ativo = 1 where idcategoria = $idn"; 
            $res = $dba->query($sql);
            
            header('location: categorias-listar.php');            
            
            /* ********************************** */
            break;

        
         case 'categoria_desativar':
            /*             * *********** DESATIVAR ************ */
            $idn = $_GET['id'];       
            $sql = "update categoria set ativo = 0 where idcategoria = $idn"; 
            $res = $dba->query($sql);
            
            header('location: categorias-listar.php');            
            /* ********************************** */
            break;  


        case 'categoria_excluir':  
              /*             * *********** EXCLUIR ************ */       
            $idn = $_GET['id'];    
             
            $sql = "delete from categoria where idcategoria = '$idn'";
            $res = $dba->query($sql);
            
            header('location: categorias-listar.php');
        
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