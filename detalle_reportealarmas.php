<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde5=" ";

//if($param34!=''){ $fechaactual=$param34; }

if($param35!=''){ $id_sedes=$param35; 

	$conde=" and idsedes=$id_sedes "; 	
}

	
$FB->titulo_azul1("Alarma",1,0,7); 
$FB->titulo_azul1("Fecha Vencimiento",1,0,0); 
$FB->titulo_azul1("Documento",1,0,0); 
$FB->titulo_azul1("Dias x Vencer",1,0,0); 
$FB->titulo_azul1("E-mails",1,0,0); 
$FB->titulo_azul1("Registro",1,0,0);
$FB->titulo_azul1("Fecha Actulizo",1,0,0); 
$FB->titulo_azul1("Sede",1,0,0); 
$FB->titulo_azul1("Actualizar",1,0,0); 

if($nivel_acceso==1 or $nivel_acceso==12){
$FB->titulo_azul1("Eliminar",1,'5%',0); 
}

if($param36!='0'){ $conde1=" and rep_fechavencimiento<='$fechaactual'";  }

 $sql="SELECT `idreportealertas`, `rep_alerta`, `rep_fechavencimiento`, `rep_emails`, `rep_useractualiza`, `rep_fechareporte`, `rep_idsede`,sed_nombre FROM `reportealertas` inner join sedes on rep_idsede=idsedes WHERE idreportealertas>=0  $conde  $conde1 ORDER BY idreportealertas  asc ";

$DB1->Execute($sql); 
$va=0; 
$totalasignadas=0;


	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{

		
		$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			$fecha1= new DateTime("$rw1[2]");
			$fecha2= new DateTime("$fechaactual");
			$resta = $fecha1->diff($fecha2);
			$dias=$resta->days;
			$fecha11= strtotime($rw1[2]);
			$fecha22= strtotime($fechaactual);
			if($fecha22 > $fecha11)
			{
			//echo "La fecha actual es mayor a la comparada.</br>";
				$dias=$dias*-1;
				$diasantes=$dias-3;
			}else
				{
						//echo "La fecha comparada es igual o menor</br>";
						$diasantes=$dias;
				}
			if($diasantes<=0){
				$color="#ff5f42";
			}
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "<td>".$rw1[1]."</td>";
			echo "<td>".$rw1[2]."</td>";
			echo $LT->llenadocs3($DB, "reportealarmas",$id_p, 1, 35, 'Ver');
		
			echo "<td>".$dias."</td>";
			echo "<td>".$rw1[3]."</td>";
			echo "<td>".$rw1[4]."</td>";
			echo "<td>".$rw1[5]."</td>";
			echo "<td>".$rw1[7]."</td>";
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"reportealarmas\",\"$rw1[2]\")';  title='Actualizar Reportes' >Actualizar</td>";
							
			if($nivel_acceso==1 or $nivel_acceso==12){
				$DB->edites($id_p, "reportealarmas", 2,0);
			}
		
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


include("footer.php");
?>