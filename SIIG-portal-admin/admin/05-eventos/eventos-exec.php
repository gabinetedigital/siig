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
		 case 'evento_cadastrar':
            /*             * *********** CADASTRAR ************ */
            if(!empty($_POST['titulo']) && !empty($_POST['texto']) && !empty($_POST['assunto']) && !empty($_POST['tags']) && !empty($_POST['latitude']) && !empty($_POST['longitude'])) {    
                
                $titulo = $_POST['titulo'];
                $texto = $_POST['texto'];
                $assunto = $_POST['assunto'];  
                $tags = $_POST['tags'];  
                $latitude = $_POST['latitude']; 
                $longitude = $_POST['longitude']; 
                session_start();
                $cidade = $_SESSION['cidade'];
                $categoria = $_SESSION['categoria'];
                $subcategoria = $_SESSION['subcategoria'];
                $datahora = date('Y-m-d H:i:s');

             

                
                                         // sid = estado, default 1 = RS
                $sql = "insert into evento (sid, cidade_idcidade, categoria_idcategoria, subcategoria_idsubcategoria, titulo, texto, assunto, tags, latitude, longitude, ativo, datahora) 
                                    values (1,  '$cidade', '$categoria', '$subcategoria', '$titulo', '$texto', '$assunto', '$tags', '$latitude', '$longitude', 1, '$datahora')"; 
                $res = $dba->query($sql); 
                                                          
                header('location: eventos-listar.php');      
            }else{
                header('location: eventos-listar.php');
            }           
            
            /* ********************************** */
            break;

         case 'evento_editar':
            /*             * *********** EDITAR ************ */
               $ide = $_POST['id'];            
               if(!empty($_POST['titulo']) && !empty($_POST['texto']) && !empty($_POST['assunto']) && !empty($_POST['tags']) && !empty($_POST['latitude']) && !empty($_POST['longitude'])) {    
                    $titulo = $_POST['titulo'];
                    $texto = $_POST['texto'];
                    $assunto = $_POST['assunto'];  
                    $tags = $_POST['tags'];  
                    $latitude = $_POST['latitude']; 
                    $longitude = $_POST['longitude'];

                    session_start();
                    $cidade = $_SESSION['cidadeEditar'];
                    $categoria = $_SESSION['categoriaEditar'];
                    $subcategoria = $_SESSION['subcategoriaEditar'];

                    $sql = "UPDATE evento SET 
                            titulo='$titulo',
                            texto='$texto',
                            assunto='$assunto',
                            tags='$tags',
                            latitude='$latitude',
                            longitude='$longitude',
                            cidade_idcidade='$cidade',
                            categoria_idcategoria='$categoria',
                            subcategoria_idsubcategoria='$subcategoria'
                            WHERE idevento = $ide";        

                    $res = $dba->query($sql);                                            
                                    
                    header('location: eventos-listar.php');       
                }else{
                    header('location: eventos-listar.php');
                }           
            
            /* ********************************** */
            break;

         case 'evento_ativar':
            /*             * *********** ATIVAR ************ */
            $idn = $_GET['id'];                     
            $sql = "update evento set ativo = 1 where idevento = $idn"; 
            $res = $dba->query($sql);
            
            header('location: eventos-listar.php');            
            
            /* ********************************** */
            break;

        
         case 'evento_desativar':
            /*             * *********** DESATIVAR ************ */
            $idn = $_GET['id'];       
            $sql = "update evento set ativo = 0 where idevento = $idn"; 
            $res = $dba->query($sql);
            
            header('location: eventos-listar.php');            
            /* ********************************** */
            break;  


        case 'evento_excluir':  
              /*             * *********** EXCLUIR ************ */       
            $idn = $_GET['id'];    
             
            $sql = "delete from evento where idevento = '$idn'";
            $res = $dba->query($sql);
            
            header('location: eventos-listar.php');
        
             /* ********************************** */
            break; 


        /*
        case 'ajx-cat':
            $idc = $_REQUEST['idc'];
            $sql = "select * from categoria where cidade_idcidade = '$idc' ";
            $res = $dba->query($sql);
            $num = $dba->rows($res);
            $select = '<select class="selectCategoria">';
            for ($i=0; $i<$num; $i++) {
                $ida = $dba->result($res, $i, 'idcategoria');
                $cat = $dba->result($res, $i, 'nome');
                $select.= '<option value="'.$ida.'">'.$cat.'</option>';
            }
            $select.= '</select>';
            echo $select;
            break;
        */

	}

	//fim do switch
		
}
else{
	$msg = md5(01);
	header('location: ./?msg='.$msg);
	exit;
}

?>