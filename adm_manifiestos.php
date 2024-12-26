<style>
        .container-left {
            float: left;
            margin-right: 10px; /* Espacio entre botones */
        }

        .container-right {
            float: right;
            margin-left: 10px; /* Espacio entre botones */
        }
</style>
<?php 
require("login_autentica.php"); 
include("layout.php");
$funcion=$_GET["funcion"];
$tabla=$_GET["tabla"];
echo '<div class="container-left">';

echo '<button type="button" class="btn btn-danger btn-lg" onclick="window.location.href = \'manifiesto.php\';" >Volver</button>';

echo'</div>';
echo'<div class="container-right">';


if ($funcion=="Vehiculos" or $tabla=="Editar vehiculo") {
    echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Agregar vehiculo\",\"$rw1[5]\")' >+Vehiculo</button>";

}elseif ($funcion=="Conductores" or $tabla=="Editar conductor") {
    echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Agregar conductor\",\"$rw1[5]\")' >+Conductor</button>";

}elseif ($funcion=="viaje" or $tabla=="Editar viaje") {
echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Agregar viaje\",\"$rw1[5]\")' >+Viaje</button>";
# code...
}
echo'</div>';

$FB->titulo_azul1("$funcion",9,0,5);  
$FB->abre_form("form1","manifiesto.php","post");

 $anioinc = 2020;
 $aniofin = date("Y");






if ($param6 !="" and $param6 !='0') {

	$cond6="and hoj_fechaingreso like '$param6%'";
	
}else{
	$cond6="";
}




$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 

$conde1=""; 

  if($param2!="" and $param3!=""){ 
   $conde1="and $param3 like '%$param2%' "; 
	}else { $conde1="  "; } 


  if($param4!='0' and $param4!=''){
	  $cond5=" and hoj_estado='$param4'";
  }

  if($param1!='0' and $param1!=''){
	$cond3=" and hoj_tipocontrato='$param1'";
}




if(isset($_REQUEST["ordby"])){ $ordby=$_REQUEST["ordby"]; } else { $ordby="hoj_nombre,hoj_apellido"; } 
if(@$_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } 	$asc2=""; if($asc=="ASC"){ $asc2="DESC";}



if ($funcion=="Vehiculos" or $tabla=="Editar vehiculo") {
    
$FB->titulo_azul1("Propietario ",1,0,7); 
$FB->titulo_azul1("Celular propietario",1,0,0); 
$FB->titulo_azul1("Placa Vehiculo",1,0,0); 
$FB->titulo_azul1("Numero poliza",1,0,0);
$FB->titulo_azul1("Poliza",1,0,0);
$FB->titulo_azul1("Tarjeta propiedad ",1,0,0); 
$FB->titulo_azul1("Foto ",1,0,0); 
$FB->titulo_azul1("Editar ",1,0,0); 
$FB->titulo_azul1("Eliminar ",1,0,0); 



    $sql="SELECT `vehimid`, `vehim_nombre_prop`, `vehim_num_cel_prop`, `vehim_placas`, `vehim_num_Poliza`, `vehim_foto_poli`, `vehim_foto_tarjeta`, `vehim_foto_vehiculo` FROM `vehiculo_manif` ORDER BY  vehimid asc ";

    $DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
        while($rw1=mysqli_fetch_row($DB->Consulta_ID))
        {
            $id_p=$rw1[0];
            $va++; $p=$va%2;
            if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
            echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
            echo "<td>".$rw1[1]."</td>";
            echo "<td>".$rw1[2]."</td>";
            echo "<td>".$rw1[3]."</td>";
            echo "<td>".$rw1[4]."</td>";
            echo "<td><a href='img_manifiestos/vehiculos/$rw1[5]' target='_blank'>ver</a></td>";
            echo "<td><a href='img_manifiestos/vehiculos/$rw1[6]' target='_blank'>ver</a></td>";
            echo "<td><a href='img_manifiestos/vehiculos/$rw1[7]' target='_blank'>ver</a></td>";
            echo "<td>	<a onclick='pop_dis16($id_p, \"Editar vehiculo\",\"$rw1[1]\")';  style='cursor: pointer;' title='editar' >Editar</td>";
        	if($nivel_acceso==1){
                $DB->edites($id_p, "vehiculos", 2, $condecion);
            }
    
    

        }
}elseif ($funcion=="Conductores" or $tabla=="Editar conductor") {
    
$FB->titulo_azul1("Nombre",1,0,7); 
$FB->titulo_azul1("Celular",1,0,0); 
$FB->titulo_azul1("Whatsapp",1,0,0); 
$FB->titulo_azul1("Numero cedula",1,0,0);
$FB->titulo_azul1("Foto",1,0,0);
$FB->titulo_azul1("Numero licencia ",1,0,0); 
$FB->titulo_azul1("Foto  ",1,0,0); 
$FB->titulo_azul1("Foto conductor ",1,0,0); 
$FB->titulo_azul1("Firma",1,0,0); 
$FB->titulo_azul1("Antecedentes",1,0,0); 

$FB->titulo_azul1("Editar ",1,0,0); 
$FB->titulo_azul1("Eliminar ",1,0,0); 




    $sql="SELECT `condid`, `cond_nombre`, `cond_celular`, `cond_whatsapp`, `cond_cedula`, `cond_foto_celula`, `cond_num_licen`, `cond_foto_licen`, `cond_foto_conductor`, `cond_firma`,con_antec FROM `conductor_mani`  ORDER BY  condid asc ";

    $DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
        while($rw1=mysqli_fetch_row($DB->Consulta_ID))
        {
            $id_p=$rw1[0];
            $va++; $p=$va%2;
            if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
            echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
            echo "<td>".$rw1[1]."</td>";
            echo "<td>".$rw1[2]."</td>";
            echo "<td>".$rw1[3]."</td>";
            echo "<td>".$rw1[4]."</td>";
            echo "<td><a href='img_manifiestos/conductores/$rw1[5]' target='_blank'>ver</a></td>";
            echo "<td>".$rw1[6]."</td>";
            echo "<td><a href='img_manifiestos/conductores/$rw1[7]' target='_blank'>ver</a></td>";
            echo "<td> <a href='img_manifiestos/conductores/$rw1[8]' target='_blank'>ver</a></td>";
            echo "<td> <a href='img_manifiestos/conductores/$rw1[9]' target='_blank'>ver</a></td>";
            echo "<td> <a href='img_manifiestos/conductores/$rw1[10]' target='_blank'>ver</a></td>";

            echo "<td><a  onclick='pop_dis16($id_p, \"Editar conductor\",\"$rw1[1]\")';  style='cursor: pointer;' title='editar' >Editar</td>";
            if($nivel_acceso==1){
                $DB->edites($id_p, "conductores", 2, $condecion);
            }
        }

}








include("footer.php");

?>