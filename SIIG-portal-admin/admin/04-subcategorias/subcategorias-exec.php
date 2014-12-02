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
		 case 'subcategoria_cadastrar':
            /*             * *********** CADASTRAR ************ */
            if(!empty($_POST['nome']) && $_POST['categoria']!='--') {    
                $nome = $_POST['nome'];
                $categoria = $_POST['categoria'];  
          
                if ($categoria  != 'Todas'){
                                                                       // sid = estado, default 1 = RS
                    $sql = "insert into subcategoria (categoria_idcategoria, nome, sid, ativo) values ($categoria, '$nome', 1, 1)"; 
                    $res = $dba->query($sql); 
                }else{
                  
                    $sqlpro = "select * from categoria";
                    $query = $dba->query($sqlpro);
                    $qntd = $dba->rows($query);
                    if ($qntd > 0) {
                        for ($i=0; $i<$qntd; $i++) {
                            $vet = $dba->fetch($query);                            
                            $idr = $vet['idcategoria'];  
                                                                               // sid = estado, default 1 = RS 
                            $sql = "insert into subcategoria (categoria_idcategoria, nome, sid, ativo) values ($idr, '$nome', 1, 1)"; 
                            $res = $dba->query($sql);
                        } 
                    }
                }                                            
                header('location: subcategorias-listar.php');       
            }else{
                header('location: subcategorias-listar.php');
            }           
            
            /* ********************************** */
            break;

         case 'subcategoria_editar':
            /*             * *********** EDITAR ************ */
            $ide = $_POST['id'];            
            if(!empty($_POST['nome'])) {    
                $nome = $_POST['nome'];  

                $categoria = '';
                if (!empty($_POST['categoria']) && $_POST['categoria']!='--') {
                $categoriar = $_POST['categoria'];
                $categoria = ", categoria_idcategoria='$categoriar' ";} 

                $sql = "update subcategoria set nome='$nome' $categoria where idsubcategoria = $ide";        

                $res = $dba->query($sql);                                            
                                
                header('location: subcategorias-listar.php');       
            }else{
                header('location: subcategorias-listar.php');
            }           
            
            /* ********************************** */
            break;

         case 'subcategoria_ativar':
            /*             * *********** ATIVAR ************ */
            $idn = $_GET['id'];                     
            $sql = "update subcategoria set ativo = 1 where idsubcategoria = $idn"; 
            $res = $dba->query($sql);
            
            header('location: subcategorias-listar.php');            
            
            /* ********************************** */
            break;

        
         case 'subcategoria_desativar':
            /*             * *********** DESATIVAR ************ */
            $idn = $_GET['id'];       
            $sql = "update subcategoria set ativo = 0 where idsubcategoria = $idn"; 
            $res = $dba->query($sql);
            
            header('location: subcategorias-listar.php');            
            /* ********************************** */
            break;  


        case 'subcategoria_excluir':  
              /*             * *********** EXCLUIR ************ */       
            $idn = $_GET['id'];    
             
            $sql = "delete from subcategoria where idsubcategoria = '$idn'";
            $res = $dba->query($sql);
            
            header('location: subcategorias-listar.php');
        
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