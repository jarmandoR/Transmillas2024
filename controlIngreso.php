
<script>

function filtrar(){

    let operario = document.getElementById('param33').value;

    let fechaini = document.getElementById('param34').value;

    let sede = document.getElementById('param35').value;
    let contrato = document.getElementById('param38').value;

    // let fechafin = document.getElementById('param36').value;

    var url = "controlIngreso.php?param34=" + fechaini+"&param35="+ sede+"&param33="+ operario+"&param38="+ contrato;
                window.location.href = url;
console.log("ok");





}
let matriz = [];

function agregarAlArray(checkbox, valor1) {
  if (checkbox.checked) {
    matriz.push(valor1);
    console.log(matriz);
  } else {
      let index = matriz.indexOf(valor1);
      if (index !== -1) {
        matriz.splice(index, 1);
      }
      console.log(matriz);
    }
  
}


function pop_festivos(valor1,valor2,valor3){
console.log('pop_festivis');

$(document).ready(function() {
  $('#myModal').modal('show');
});

    let parametro = encodeURIComponent(JSON.stringify(matriz));
    let url = 'detalle_pop.php?parametro='+parametro+'&id_param='+valor1+'&tabla='+valor2+'&ide='+valor3;
    // window.location.href = url;
     MostrarConsulta(url,'llena_sub1');

  


}
</script>
<?php 


require("login_autentica.php"); 
include("layout.php");
include("cabezote3.php"); 
$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde5=" ";

$fechaactu= date('Y-m-d');

if($param34!=''){ $fechaactual=$param34; }

if($param35!=''){ $id_sedes=$param35; 

	$conde4=" and usu_idsede=$id_sedes "; 	
}else{
    $conde4=" and usu_idsede=$id_sedes "; 	
}

if($param38!=''){ $conde5=" and usu_tipocontrato='$param38'";  }
if($param33!=''){ $conde="and `idusuarios`= '$param33' ";  }
if($param32!='' and $param32!=0){ $conde1="and `seg_motivo`= '$param33' ";  }

$FB->abre_form("form1","","post");
//  if($nivel_acceso==1 or $nivel_acceso==12){
	 
// 	if($rcrear==1) { $FB->nuevoname("SeguimientoUser", $condecion, "Inasistencia"); }
// }
// if($rcrear==1) { $FB->nuevoname("ingresoprueba", $condecion, "Prueba Alcolemia"); }

echo'<a class="btn btn-primary" href="seguimientouser.php" role="button">volver</a>';

$FB->titulo_azul1("Ingresos de Personal",9,0,5);  



if($nivel_acceso==1 or $nivel_acceso==12){
	if($param35!=''){   $conde2=""; }  

}
else {	
	$param35=$id_sedes;
	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}

$FB->llena_texto("Fecha :", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
// $FB->llena_texto("Fecha de Final:", 36, 10, $DB, "", "", "$fechaactual", 4, 0);

$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio_sede(this.value)", "$param35",1, 0);
$FB->llena_texto("Operario:", 33, 2, $DB, "SELECT idusuarios,usu_nombre FROM usuarios WHERE usu_estado = '1'and usu_filtro='1'  ORDER BY usu_nombre  asc ", "", "",4,0);
// $FB->llena_texto("Motivo Ingreso:", 32, 82, $DB, $motivoingreso, "", "", 1, 0);
$FB->llena_texto("Tipo de Contrato:",38,82, $DB, $tipocontrato, "", "", 4, 0);

$FB->llena_texto("", 37, 277, $DB, "", "", "filtrar()",1,0);
echo "<td><button type='button' class='btn btn-danger btn-lg' onclick='pop_festivos(\"$id_p\",\"Agregar festivos\",\"$rw1[5]\")' >+Vacaciones</button></td><td></td><tr>";
echo "<td></td><td></td><tr>";

$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 






$FB->titulo_azul1("Operador",1,0,7); 

 $FB->titulo_azul1("Identificacion",1,0,0); 
 $FB->titulo_azul1("Fecha y hora",1,0,0); 
 $FB->titulo_azul1("Nuevo ingreso",1,0,0); 
 $FB->titulo_azul1("Agregar festivo",1,0,0); 

if($nivel_acceso==1 or $nivel_acceso==12){
$FB->titulo_azul1("Eliminar",1,'5%',0); 
}



$conde3=""; 
if($param34!=''){ $fechaactual=$param34;  }
// if($param36!=''){ $fechafinal=$param36." 23:59:59";  }

// if($param37!='0'){ $conde5=" and usu_tipocontrato='$param37'";  }

//  $sql="SELECT idusuarios,usu_nombre,preestado,seg_alcohol,`seg_fechaingreso`, `seg_horaalmuerzo`, `seg_horaregreso`, `seg_idzona`,prefechaingreso,idseguimiento_user,seg_motivo,seg_descr,seg_fechafinalizo FROM `pre-operacional` inner join `usuarios` on preidusuario=idusuarios left join seguimiento_user on idusuarios=seg_idusuario and seg_fechaalcohol>='$fechaactual' and  seg_fechaalcohol<='$fechafinal'  where  (usu_estado=1 or usu_filtro=1)  and prefechaingreso>='$fechaactual' and prefechaingreso<='$fechafinal'  $conde  $conde2  $conde4 ORDER BY usu_nombre  asc ";




echo$sql="SELECT idusuarios,usu_nombre,usu_identificacion,usu_tipocontrato,usu_fechalicencia,usu_idsede FROM usuarios WHERE usu_estado = '1'and usu_filtro='1' $conde4 $conde $conde5 ORDER BY usu_nombre  asc ";

//   $sql="SELECT idusuarios,usu_nombre,preestado,prefechaingreso,idpreoperacinal,usu_tipocontrato,prevehiculo,usu_fechalicencia FROM `pre-operacional` inner join usuarios on idusuarios=preidusuario  where  (usu_estado=1 or usu_filtro=1)  and prefechaingreso>='$fechaactual' and prefechaingreso<='$fechafinal'  $conde  $conde2  $conde4 $conde5 ORDER BY usu_nombre  asc ";

$DB1->Execute($sql); 
$va=0; 
$totalasignadas=0;
// $color1='';
// $color2='';

	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{

		
		$id_p=$rw1[0];

		
    $sql1="SELECT preidusuario FROM `pre-operacional` where preidusuario='$rw1[0]'   and prefechaingreso like '$fechaactual%'   ";
	// $DB->Execute($sql1); 
    $DB->Execute($sql1); 
    $valor=$DB->recogedato(0);
		if($valor<=0){ 
            $color="#922B21";
            $colorletra='style="color: #FFFFFF;"';
            $fechaHora= "";
        }else{
            $color="#FFFFFF";
            $colorletra='';
            $sql1="SELECT preidusuario,prefechaingreso FROM `pre-operacional` where preidusuario='$rw1[0]'   and prefechaingreso like '$fechaactual%'  ";
            // $DB->Execute($sql1); 
            $DB->Execute($sql1);
            while($rw2=mysqli_fetch_row($DB->Consulta_ID))
            {
               $fechaHora= $rw2[1];
    
               
            }
        }



// $color1='';
// $color2='';



   
		// if($imprimir==1){
			$va++; $p=$va%2;
			// if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		// 	if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){}else{ $color="#ff5f42"; }
			echo "<tr class='text' bgcolor='$color' $colorletra onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		 	echo "<td>".$rw1[1]."</td>";
             echo "<td>".$rw1[2]."</td>";
             echo "<td>".$fechaHora."</td>";
             echo "<td colspan='1' width='0' align='center' ><a id='link' onclick='pop_dis16(\"$id_p\",\"SeguimientoUser\",\"$rw1[5]\")';   title='Ingreso' >+Ingreso</td>";
             echo "<td colspan='1' width='0' align='center' ><a id='link' onclick='pop_dis16(\"$id_p\",\"Agregar festivos\",\"$rw1[5]\")';   title='Ingreso' >+Festivo</td>";

      //        echo "<td><input type='checkbox' name='CheckFestivo' id='$id_p'  style='width:95px; class='trans' onchange='agregarAlArray(this, $id_p)' >
			
			// </td>";
	}
	
    


	$FB->titulo_azul1(" Totales :",1,0,10); 
	$FB->titulo_azul1(" $va",1,0,0); 

	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	
	
	/* $FB->titulo_azul1("$ $totalalcobro",1,0,0); 
	$FB->titulo_azul1("$ $totalprestamos",1,0,0);  */

include("footer.php");
?>