<?php 
require("login_autentica.php"); 
include("layout.php");

$FB->abre_form("form1","guiasok.php","post");
?>
<script language="javascript">
function buscarsede()
{

	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	p5=document.getElementById('param5').value;
	p4=document.getElementById('param4').value;
	destino="faltantes.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5;
	
	
	window.location=destino;
	
}

function guardar(valor){ 

	
		var descripcion=document.getElementById("des_"+valor).value;
		var idservicio=document.getElementById("servicio_"+valor).value;

		document.getElementById("tabla1").rows[valor].cells[10].innerHTML=descripcion;
      	datos = {"tipoguia":"validarfaltantes","servicio":idservicio,"descripcion":descripcion};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
			}); 

		
 
}

function validarUsuario(idusuario,fechaactual,fechafinal,confirmarPago,confirma,tipo){
	
	
    var Observacion = document.getElementById(tipo+idusuario).value;
    if (Observacion=="") {
      if (confirma=="no") {
        alert("Parar realizar esta accion debes escribir el motivo por el cual rechazas los documentos");
      }else{
        datos = {"idUsuario":idusuario,"fechaini":fechaactual,"fechafin":fechafinal,"funcion":confirmarPago,"confirma":confirma,"tipo":tipo,"Observacion":Observacion};
        $.ajax({
            url: "guardaNomina.php",
            type: "POST",
            data: datos
          }).done(function(respuesta){
            

          });
      }
      
    }else{


        datos = {"idUsuario":idusuario,"fechaini":fechaactual,"fechafin":fechafinal,"funcion":confirmarPago,"confirma":confirma,"tipo":tipo,"Observacion":Observacion};
        $.ajax({
            url: "guardaNomina.php",
            type: "POST",
            data: datos
          }).done(function(respuesta){
            

          });
    }
}



</script>

<?php


if($param5!=''){ 
			$id_sedes=$param5; 
			$idcidades=ciudadesedes($param5,$DB);
			if($idcidades=='0'){
				$conde1="";

			}else {
			  $conde1=" and cli_idciudad in $idcidades "; 	
			}
  } else {  
  
/* 		$idcidades=ciudadesedes($id_sedes,$DB);
		if($idcidades=='0'){
			$conde1="";

		}else {
		  $conde1=" and cli_idciudad in $idcidades "; 	
		} */
		$conde1="";

  }
if($nivel_acceso==1 or $nivel_acceso==10 or $nivel_acceso==12){ $conde2="";  	 } else {  $conde2=" and idsedes=$id_sedes"; }
 
 
 $conde3="";
if($param4==''){ $param4=0;   } else { $conde3=" and inner_sedes=$param4";   }




$FB->titulo_azul1("Mis pagos",10,0, 5);  

// //$FB->llena_texto("Mensajero:",1,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5)", "cambio2(this.value,\"guias.php\",\"Usuario\")", $rw[1], 1, 1);
// $FB->llena_texto("Sede Origen:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>=0 $conde2 )", "cambio4(\"param4\",\"param5\",\"faltantes.php\")", "", 1, 1);
// $FB->llena_texto("Sede Destino:",4,2,$DB,"(SELECT  `idsedes`,`sed_nombre` FROM sedes )", "cambio4(\"param4\",\"param5\",\"faltantes.php\")", "$param4", 4, 1);
// $FB->llena_texto("Busqueda por:",1,8,$DB,$busqueda1,"",$param1,17,0);
// $FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);


 //$FB->llena_texto("Buscar", 1, 142, $DB, "Buscar", "onclick=form3.submit();", 0, 12, 0);
// echo "<tr><td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede();'>Buscar</button></td><td></td>";
// echo "<td><button type='submit' class='btn btn-danger btn-lg' >Renviar</button></td><td></td><tr>";
//$FB->llena_texto("", 3, 133, $DB, "Guardar", "onclick=form1.submit();","", 4, 0);



$FB->titulo_azul1("Del",1,0,7); 
$FB->titulo_azul1("Al",1,0,0); 
$FB->titulo_azul1("Concepto",1,0,0); 
$FB->titulo_azul1("Ver",1,0,0); 
$FB->titulo_azul1("Observaciones",1,0,0); 
$FB->titulo_azul1("Validar",1,0,0); 





$conde=""; 

// if($param2!="" and $param1!=""){ 
//  $conde="and $param1 like '%$param2%' "; 
//   }else { $conde="  "; } 

 $tablaNomina1="SELECT   `nom_id`, `nom_confirma`, `nom_quincena`, `nom_img_compro`, `nom_año`, `nom_fecha_inicio`, `nom_fecha_fin`, `nom_id_usu`, `nom_tipo_pago`, `nom_cuentaCobro`,`nom_confirmaUsu`,nom_motivoObser from nomina where nom_id_usu='$id_usuario' and (nom_confirmaUsu='' or nom_confirmaUsu='no' ) ";
  $DB1->Execute($tablaNomina1); 
  // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
  while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
  {
    if ($rw1[9]!="") {
        $id_p=$rw1[0];
		
        $va++; $p=$va%2;
        if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

        if ($rw1[8]=="Basico") {
            $concepto="Salario basico devengado";
        }elseif ($rw1[8]=="Otros") {
            $concepto="Otros devengos ";
        }


        echo "<tr class='text' bgcolor='$color' ' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
        // $rw1[6]=str_replace("&"," ", $rw1[6]);
        // if($rw1[10]==7){
        //     $proceso='Sin validar';
        // }
        echo"<td>".$rw1[5]."</td>";
        echo"<td>".$rw1[6]."</td>";
        echo"<td>".$concepto."</td>";
        echo "<td><a href='".$rw1[9]."' target='_blank'>Abrir</a></td>
        <td><textarea id='".$rw1[8].$id_usuario."' name='' rows='' cols=''>$rw1[11]</textarea></td>";
       

        $colorselect1="rgb(7, 79, 145)";
        $si1="";
        $no1="";
        $imagencompr1="";
     
     


        
        echo "<td><div id='campo'>";
        echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:".$colorselect1.";color:#f9f9f9;font-size:15px'  name='$va' id='".$id_usuario."Otros'  onchange='validarUsuario($id_usuario,\"$rw1[5]\",\"$rw1[6]\",\"validarUsuario\",this.value,\"$rw1[8]\")' class='borrar' required>";
        // $LT->llenaselect_ar("Selecccione...",$estadosguiasinfin);
        echo"<option value='' selected >Seleccione...</option>";
        echo"<option value='no' $no1>NO</option>";
        echo"<option value='Si'$si1>SI</option>";
       

        echo"</select>";

    }


  }
  $tablaNomina2="SELECT   `idprimas`, `pri_confirma`, `pri_fecha_inicio`, `pri_fecha_fin`, `pri_idusu`, `pri_semestre`, `pri_fechaconfirmausu`, `pri_idadminconfi`, `pri_fechaadminconfi`, `pri_docprima`, `pri_confirmaUsus`, pri_confiAdmin from primas where  pri_idusu='$id_usuario'  and (pri_confirmaUsus='' or pri_confirmaUsus='no' ) ";
  $DB1->Execute($tablaNomina2); 
  // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
  while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
  {
    if ($rw2[9]!="") {
        $id_p=$rw2[0];
		
        $va++; $p=$va%2;
        if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

        // if ($rw2[8]=="Basico") {
            $concepto="Liquidacion prima";
        // }elseif ($rw2[8]=="Otros") {
        //     $concepto="Otros devengos ";
        // }


         echo "<tr class='text' bgcolor='$color' ' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
        // $rw2[6]=str_replace("&"," ", $rw2[6]);
        // if($rw2[10]==7){
        //     $proceso='Sin validar';
        // }
        echo"<td>".$rw2[2]."</td>";
        echo"<td>".$rw2[3]."</td>";
        echo"<td>".$concepto."</td>";
        echo "<td><a href='".$rw2[9]."' target='_blank'>Abrir</a></td>
        <td><textarea id='prima".$id_usuario."' name='' rows='' cols=''></textarea></td>";
       

        $colorselect1="rgb(7, 79, 145)";
        $si1="";
        $no1="";
        $imagencompr1="";
     
     


        
        echo "<td><div id='campo'>";
        echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:".$colorselect1.";color:#f9f9f9;font-size:15px'  name='$va' id='".$id_usuario."Otros'  onchange='validarUsuario($id_usuario,\"$rw2[2]\",\"$rw2[3]\",\"validarUsuarioPrima\",this.value,\"prima\")' class='borrar' required>";
        // $LT->llenaselect_ar("Selecccione...",$estadosguiasinfin);
        echo"<option value='' selected >Seleccione...</option>";
        echo"<option value='no' $no1>NO</option>";
        echo"<option value='Si'$si1>SI</option>";
       

        echo"</select>";

    }


  }


include("footer.php");
?>