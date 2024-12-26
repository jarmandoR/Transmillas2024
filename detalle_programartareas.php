<?php 
require("login_autentica.php");
include("cabezote3.php"); 
$iduser=$_SESSION['usuario_id'];

$asc="ASC";
$conde=" ";
$conde1=" ";
$conde2=" ";

if($param32!='' and $param32!='0' and $param32!=0)
{ 
	 $conde.=" and tar_idoperario=$param32 "; 
}else{

	if($param33!='' and $param33!='0' and $param33!=0){ 
		$conde.=" and tar_idrol=$param33 "; 	
	}
	
	if($param35!='' and $param35!='0' and $param35!=0){
		 $id_sedes=$param35; 
		$conde.=" and tar_idsede=$id_sedes "; 	
	}else {
		$conde.=" and tar_idsede=$id_sedes "; 
	}

}

if($param36!='' and $param36!='0' ){ 
	$conde1 =" and (CASE WHEN t1.estado IS Null THEN 'Por Realizar' else t1.estado END)='$param36'";	
}else{
	$conde1 =" and (CASE WHEN t1.estado IS Null THEN 'Por Realizar' else t1.estado END)='Por Realizar'";	
}


	
$FB->titulo_azul1("Tarea",1,0,7); 
$FB->titulo_azul1("Dias Programados",1,0,0); 
$FB->titulo_azul1("Hora",1,0,0); 
$FB->titulo_azul1("Programador",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Fecha validacion",1,0,0); 
$FB->titulo_azul1("Usuario valido",1,0,0); 




//pasamos a timestamp
  //el parametro w en la funcion date indica que queremos el dia de la semana
 //lo devuelve en numero 0 domingo, 1 lunes,....
 $fechats = strtotime(date('d-m-Y')); 
 $dia='';
 switch (date('w', $fechats)){
	 case 0: $dia= "Domingo"; break;
	 case 1: $dia= "Lunes"; break;
	 case 2: $dia= "Martes"; break;
	 case 3: $dia= "Miercoles"; break;
	 case 4: $dia= "Jueves"; break;
	 case 5: $dia= "Viernes"; break;
	 case 6: $dia= "Sabado"; break;
 }
 
if($nivel_acceso==1 or $nivel_acceso==12){
	 $sql="SELECT `idtareas`, `tar_descripcion`, concat_ws(',', `tar_diassemana`, `tar_fecha`) as dias,tar_hora, `tar_usuario`, (CASE WHEN t1.estado IS Null THEN 'Por Realizar' else t1.estado END) as estados,t1.pro_comentario, t1.pro_fecha, t1.usu_nombre FROM `tareas` LEFT JOIN (select `pro_comentario`, `pro_fecha`, `usu_nombre`,(CASE WHEN pro_estado IS Null THEN 'Por Realizar' else pro_estado END) as estado,pro_idtareas from programartareas left join usuarios on idusuarios=pro_idusuario where pro_fecha like '%$fechaactual%' ) t1 ON t1.pro_idtareas=idtareas WHERE idtareas>=0 and tar_diassemana like '%$dia%'  and tar_estado='Activo' $conde $conde1 ORDER BY tar_hora asc";
//	 $sql="SELECT `idtareas`, `tar_descripcion`,  concat_ws(',', `tar_diassemana`, `tar_fecha`) as dias , tar_hora,`tar_usuario`, (CASE WHEN pro_estado IS Null THEN 'Por Realizar' else pro_estado END) as estado,`pro_comentario`, `pro_fecha`, `usu_nombre` FROM `tareas`  left JOIN programartareas ON pro_idtareas=idtareas left join usuarios on idusuarios=pro_idusuario  WHERE idtareas>=0 and  tar_diassemana like '%$dia%'  and tar_estado='Activo' $conde $conde1 ORDER BY idtareas  asc ";

}else{
	 $sql="SELECT `idtareas`, `tar_descripcion`, concat_ws(',', `tar_diassemana`, `tar_fecha`) as dias,tar_hora, `tar_usuario`, (CASE WHEN t1.estado IS Null THEN 'Por Realizar' else t1.estado END) as estados,t1.pro_comentario, t1.pro_fecha, t1.usu_nombre FROM `tareas` LEFT JOIN (select `pro_comentario`, `pro_fecha`, `usu_nombre`,(CASE WHEN pro_estado IS Null THEN 'Por Realizar' else pro_estado END) as estado,pro_idtareas from programartareas left join usuarios on idusuarios=pro_idusuario where pro_fecha like '%$fechaactual%'  ) t1 ON t1.pro_idtareas=idtareas WHERE idtareas>=0 and tar_diassemana like '%$dia%' and ((tar_idoperario='$iduser') or (tar_idoperario='0' and tar_idsede is NUll and tar_idrol='$nivel_acceso') or (tar_idoperario='0' and tar_idrol is NUll and tar_idsede='$id_sedes') or (tar_idoperario='0' and tar_idrol='$nivel_acceso' and tar_idsede='$id_sedes')) and tar_estado='Activo'  $conde1 ORDER BY tar_hora asc";
	// $sql="SELECT `idtareas`, `tar_descripcion`,  concat_ws(',', `tar_diassemana`, `tar_fecha`) as dias,tar_hora, `tar_usuario`, (CASE WHEN pro_estado IS Null THEN 'Por Realizar' else pro_estado END) as estado,`pro_comentario`, `pro_fecha`, `usu_nombre` FROM `tareas`  left JOIN programartareas ON pro_idtareas=idtareas left join usuarios on idusuarios=pro_idusuario  WHERE idtareas>=0 and  tar_diassemana like '%$dia%' and ((tar_idoperario='$iduser') or (tar_idoperario='0' and tar_idsede is NUll and tar_idrol='$nivel_acceso') or (tar_idoperario='0' and tar_idrol is NUll and tar_idsede='$id_sedes') or (tar_idoperario='0' and tar_idrol='$nivel_acceso' and tar_idsede='$id_sedes')) and tar_estado='Activo' $conde1 ORDER BY idtareas  asc ";

}
//SELECT `idtareas`, `tar_descripcion`, concat_ws(',', `tar_diassemana`, `tar_fecha`) as dias , `tar_usuario`, (CASE WHEN pro_estado IS Null THEN 'Por Realizar' else pro_estado END) as estado,`pro_comentario`, `pro_fecha`, `pro_idusuario` FROM `tareas` left JOIN programartareas ON pro_idtareas=idtareas WHERE idtareas>=0 and tar_diassemana like '%Martes%' and ((tar_idoperario='$iduser') or (tar_idoperario='0' and tar_idsede is NUll and tar_idrol='$nivel_acceso') or (tar_idoperario='0' and tar_idrol is NUll and tar_idsede='$id_sedes') or (tar_idoperario='0' and tar_idrol='$nivel_acceso' and tar_idsede='$id_sedes')) and tar_estado='Activo' ORDER BY idtareas asc;
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
		if($rw1[5]=='Por Realizar'){
			echo "<td colspan='1' width='0' align='center' ><a  onclick='pop_dis16(\"$rw1[5]\",\"validartarea\",\"$rw1[0]\")';  title='Validar' >$rw1[5] </td>";

		}else{
			echo "<td>".$rw1[5]."</td>";
		}
		echo "<td>".$rw1[6]."</td>";
		echo "<td>".$rw1[7]."</td>";
		echo "<td>".$rw1[8]."</td>";
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


include("footer.php");
?>