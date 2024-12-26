<?php
require("definirvar.php");
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
@$id_usuario=$_REQUEST["id_usuario"];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
//echo $condecion;
if($condecion==1){

	//$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23;  
	$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
	$param5 = str_replace('&0&','&&', $param5);
	$param25 = str_replace('.','', $param25);	

if (isset($_FILES['param77'])){
    
    
    
    
    //Comprobamos si el fichero es una imagen
        if ($_FILES['param77']['type']=='image/png' || $_FILES['param77']['type']=='image/jpeg' || $_FILES['param77']['type']=='application/pdf'){

         
           $imagen = $_FILES["param77"]["name"];
        
        //Subimos el fichero al servidor
        move_uploaded_file($_FILES["param77"]["tmp_name"],"./imgclientdoc/".$_FILES["param77"]["name"]);
        


        }
    
    }

	  if (isset($_FILES['param80'])){
    
    
    
    
    //Comprobamos si el fichero es una imagen
        if ($_FILES['param80']['type']=='image/png' || $_FILES['param80']['type']=='image/jpeg' || $_FILES['param80']['type']=='application/pdf'){

         
           $imagen2 = $_FILES["param80"]["name"];
        
        //Subimos el fichero al servidor
        move_uploaded_file($_FILES["param80"]["tmp_name"],"./imgclientdoc/".$_FILES["param80"]["name"]);
        


        }
    
    }

	 $sql1="INSERT INTO `clientes`(`idclientes`, `cli_iddocumento`,  `cli_email`, `cli_clasificacion`, `cli_tipo`, `cli_valoraprobado`, `cli_fecharegistro`) 
	VALUES ('','$param1','$param3','$param7',2,'$param25','$fechatiempo')";
	$idexec=$DB->Executeid($sql1	
	);




	 $sql="INSERT INTO `clientesdir`(`idclientesdir`, `cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`, `cli_au`, `cli_ac`, `cli_whatsap`,`cli_actividade`,`cli_CIIU`,`cli_tipoempresa`,`cli_regimen`,`cli_comercializadora`,`cli_prodoservicio`,`cli_apellidonombre`,`cli_identificacion`,`cli_fechaexp`,`cli_telefijo`,`cli_direcc`,`cli_correo`,`cli_verilistas`,`cli_personcont`,`cli_cargo`,`cli_certificadoen`,`cli_sistemagestion`,`cli_entecertifi`,`cli_normarelaciona`,`cli_fechavencicer`,`cli_ingresosdeactividad`,`cli_ingresosmensu`,`cli_otrosingresos`,`cli_especifiingresos`,`cli_totalactivos`,`cli_totalpasivos`,`cli_bancof`,`cli_producfina`,`cli_numeroref`,`cli_sucursalf`,`cli_nombrecom`,`cli_actividadcom`,`cli_direcciocom`,`cli_ciudadcom`,`cli_telefonocom`,`cli_herrcontrolavado`,`cli_siplaft`,`cli_sarlaft`,`cli_codigoet`,`cli_procedimientos`,`cli_recprovacti`,`cli_personexpue`,`cli_vincpersoexpue`,`cli_nombrepep`,`cli_identipep`,`cli_cargopep`,`cli_entidpep`,`cli_nomrepapo`,`cli_idenrepapo`,`cli_firmahuella`,`cli_autoreprede`,`cli_autonit`,`cli_autofirmarep`) VALUES ('','$param6','$param2','$param4','$param5','$idexec','1','$param26','$param27','$param14','$param28','$param29','$param30','$param31','$param32','$param33','$param34','$param35','$param36','$param37','$param38','$param39','$param40','$param41','$param42','$param43','$param44','$param45','$param46','$param47','$param48','$param49','$param50','$param51','$param52','$param53','$param54','$param55','$param56','$param57','$param58','$param59','$param60','$param61','$param62','$param63','$param64','$param65','$param66','$param67','$param68','$param69','$param70','$param71','$param72','$param73','$param74','$param75','$param76','$imagen','$param78','$param79','$imagen2')";
	$DB->Execute($sql);

	//$campos=$campos+1;
	if($campos>1){
		for($a=1;$a<$campos;$a++){
			
			$direccion=$_REQUEST['param4'.$a]."&".$_REQUEST['param5'.$a]."&".$_REQUEST['param6'.$a]."&".$_REQUEST['param7'.$a]."&".$_REQUEST['param8'.$a]."&";
			
			$direccion = str_replace('&0&','&&', $direccion);

			$sql2="INSERT INTO `clientesdir`(`idclientesdir`, `cli_idciudad`, `cli_direccion`,`cli_telefono`, `cli_nombre`,  `cli_idclientes`,`cli_au`,`cli_ac`) 
			VALUES ('','".$_REQUEST['param3'.$a]."','$direccion','".$_REQUEST['param9'.$a]."','".$_REQUEST['param10'.$a]."',$idexec,'".$_REQUEST['param11'.$a]."','".$_REQUEST['param12'.$a]."')";
			$DB1->Execute($sql2);
			
		}
	}	
}else if($condecion==2) {
	
	//$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23; 
	$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
	$param5 = str_replace('&0&','&&', $param5);	
	$param25 = str_replace('.','', $param25);	
	

 if (isset($_FILES['param77'])){
    
    
    
    
    //Comprobamos si el fichero es una imagen
        if ($_FILES['param77']['type']=='image/png' || $_FILES['param77']['type']=='image/jpeg' || $_FILES['param77']['type']=='application/pdf'){

         
           $imagen = $_FILES["param77"]["name"];
        
        //Subimos el fichero al servidor
        move_uploaded_file($_FILES["param77"]["tmp_name"],"./imgclientdoc/".$_FILES["param77"]["name"]);
        


        }
    
    }

	 if (isset($_FILES['param80'])){
    
    
    
    
    //Comprobamos si el fichero es una imagen
        if ($_FILES['param80']['type']=='image/png' || $_FILES['param80']['type']=='image/jpeg' || $_FILES['param80']['type']=='application/pdf'){

         
           $imagen2 = $_FILES["param80"]["name"];
        
        //Subimos el fichero al servidor
        move_uploaded_file($_FILES["param80"]["tmp_name"],"./imgclientdoc/".$_FILES["param80"]["name"]);
        


        }
    
    }





	 $sql1="UPDATE `clientes` SET  `cli_iddocumento`='$param1',`cli_email`='$param3', `cli_clasificacion`='$param7',
	`cli_tipo`='2', `cli_fecharegistro`='$fechatiempo',`cli_valoraprobado`='$param25'  WHERE `idclientes`='$id_param'";
	$DB->Execute($sql1);
	
	
	 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param6',`cli_telefono`='$param2',`cli_idciudad`='$param4',`cli_direccion`='$param5', cli_au='$param26', cli_ac='$param27',`cli_idclientes`='$id_param',`cli_principal`='1',`cli_whatsap`='$param14',`cli_actividade`='$param28',`cli_CIIU`='$param29',`cli_tipoempresa`='$param30',`cli_regimen`='$param31',`cli_comercializadora`='$param32',`cli_prodoservicio`='$param33',`cli_apellidonombre`='$param34',`cli_identificacion`='$param35',`cli_fechaexp`='$param36',`cli_telefijo`='$param37',`cli_direcc`='$param38',`cli_correo`='$param39',`cli_verilistas`='$param40',`cli_personcont`='$param41',`cli_cargo`='$param42',`cli_certificadoen`='$param43',`cli_sistemagestion`='$param44',`cli_entecertifi`='$param45',`cli_normarelaciona`='$param46',`cli_fechavencicer`='$param47',`cli_ingresosdeactividad`='$param48',`cli_ingresosmensu`='$param49',`cli_otrosingresos`='$param50',`cli_especifiingresos`='$param51',`cli_totalactivos`='$param52',`cli_totalpasivos`='$param53',`cli_bancof`='$param54',`cli_producfina`='$param55',`cli_numeroref`='$param56',`cli_sucursalf`='$param57',`cli_nombrecom`='$param58',`cli_actividadcom`='$param59',`cli_direcciocom`='$param60',`cli_ciudadcom`='$param61',`cli_telefonocom`='$param62',`cli_herrcontrolavado`='$param63',`cli_siplaft`='$param64',`cli_sarlaft`='$param65',`cli_codigoet`='$param66',`cli_procedimientos`='$param67',`cli_recprovacti`='$param68',`cli_personexpue`='$param69',`cli_vincpersoexpue`='$param70',`cli_nombrepep`='$param71',`cli_identipep`='$param72',`cli_cargopep`='$param73',`cli_entidpep`='$param74',`cli_nomrepapo`='$param75',`cli_idenrepapo`='$param76',`cli_firmahuella`='$imagen',`cli_autoreprede`='$param78',`cli_autonit`='$param79',`cli_autofirmarep`='$imagen2' where `idclientesdir`='".$_REQUEST['id_param0']."'";
	
	
	$DB->Execute($sql);
	$insert=$_REQUEST['inserta'];
	// $campos++;
		for($a=1;$a<$campos;$a++){
			
			$direccion=$_REQUEST['param4'.$a]."&".$_REQUEST['param5'.$a]."&".$_REQUEST['param6'.$a]."&".$_REQUEST['param7'.$a]."&".$_REQUEST['param8'.$a]."&";
			$direccion = str_replace('&0&','&&', $direccion);
			if($a<=$insert){
				
			 $sql2="UPDATE `clientesdir` SET  `cli_nombre`='".$_REQUEST['param10'.$a]."', `cli_telefono`='".$_REQUEST['param9'.$a]."',`cli_idciudad`='".$_REQUEST['param3'.$a]."',`cli_au`='".$_REQUEST['param11'.$a]."',`cli_ac`='".$_REQUEST['param12'.$a]."',`cli_direccion`='$direccion',  `cli_idclientes`='$id_param'  where `idclientesdir`='".$_REQUEST['paramid'.$a]."'";
				$DB1->Execute($sql2);
				
			}else {
				 $sql2="INSERT INTO `clientesdir`(`idclientesdir`, `cli_idciudad`, `cli_direccion`,`cli_telefono`, `cli_nombre`,  `cli_idclientes`,`cli_au`,`cli_ac`) 
				VALUES ('','".$_REQUEST['param3'.$a]."','$direccion','".$_REQUEST['param9'.$a]."','".$_REQUEST['param10'.$a]."',$id_param,'".$_REQUEST['param11'.$a]."','".$_REQUEST['param12'.$a]."')";
				$DB1->Execute($sql2);
			}
			
		}

}

 //`cli_nombre`, `cli_telefono`, `cli_idciudad`, `cli_direccion`,
 //'$param2','$param3','$param4','$param5',
	$DB->cerrarconsulta();
	

header ("Location: clientes.php?bandera=1");


?>