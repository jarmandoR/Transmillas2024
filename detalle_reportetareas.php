<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde=" ";

if($param32!=''){ 
	$conde.=" and tar_idoperario=$param32 "; 
}else{

	if($param33!=''){ 
		$conde.=" and tar_idrol=$param33 "; 	
	}
	
	if($param35!=''){ 
		$id_sedes=$param35; 
		$conde=" and tar_idsede=$id_sedes "; 	
	}

}

if($param36!='' and $param36!='0' ){ 
	$conde.=" and tar_estado='$param36'";	
}
	
$FB->titulo_azul1("Tarea",1,0,7); 
$FB->titulo_azul1("Dias",1,0,0); 
$FB->titulo_azul1("Hora",1,0,0); 
$FB->titulo_azul1("Fecha de tarea",1,0,0); 
$FB->titulo_azul1("Sede",1,0,0); 
$FB->titulo_azul1("Rol",1,0,0); 
$FB->titulo_azul1("Operario",1,0,0);
$FB->titulo_azul1("usuario",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 

if($nivel_acceso==1 or $nivel_acceso==12){
$FB->titulo_azul1("Acciones",2,'5%',0); 
}

if($param36!='0'){ $conde1=" and rep_fechavencimiento<='$fechaactual'";  }

 $sql="SELECT `idtareas`, `tar_descripcion`, `tar_diassemana`, tar_hora,`tar_fecha`, `rol_nombre`, `sed_nombre`, `usu_nombre`, `tar_usuario`, `tar_estado` FROM `tareas` left join sedes on idsedes=tar_idsede left join roles on idroles=tar_idrol left join usuarios on tar_idoperario=idusuarios WHERE idtareas>=0  $conde  ORDER BY idtareas  asc ";
$DB1->Execute($sql); 
$va=0; 
$totalasignadas=0;

	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{

		
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>";
		echo "<td>".$rw1[2]."</td>";
		echo "<td>".$rw1[3]."</td>";
		echo "<td>".$rw1[4]."</td>";
		echo "<td>".$rw1[5]."</td>";
		echo "<td>".$rw1[6]."</td>";
		echo "<td>".$rw1[7]."</td>";
		echo "<td>".$rw1[8]."</td>";
		echo "<td>".$rw1[9]."</td>";
					
		if($nivel_acceso==1 or $nivel_acceso==12){
			$DB->edites($id_p, "Tareas", 1,0);
		}
		echo "</tr>";
	}
	
	$FB->titulo_azul1(" ------",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 


include("footer.php");
?>