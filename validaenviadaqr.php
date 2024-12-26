<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();
$id_nombre=$_SESSION['usuario_nombre'];
$color="#B20F08";
//Obtenemos los datos de los input
$cond="";
$guia = $_REQUEST["guia"];
$pieza = $_REQUEST["pieza"];
$ciudado = $_POST["ciudado"];
?>
<style type="text/css">
  .boton_personalizado{
    text-decoration: none;
    padding: 50px;
    font-weight: 50;
    font-size: 50px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }

  table {
	width: 20x;
	height: 50px;
}
</style>
<?php
 $sql="SELECT `ser_piezas`,idservicios,ser_estado,ser_desvaliguia,ser_ciudadentrega,ser_idverificadopeso,ciu_nombre,sed_color,sed_nombre FROM  `servicios` INNER JOIN ciudades on idciudades=ser_ciudadentrega inner join  sedes on inner_sedes=idsedes WHERE ser_consecutivo='$guia'  ";		
$DB1->Execute($sql);
$rw1=mysqli_fetch_row($DB1->Consulta_ID);



$idser=$rw1[1];
$piezasg=$rw1[0];
$estado=$rw1[2];
$descricion=$rw1[3];
$inser=1;
if($idser==''){
	$color="#B20F08";
	echo "<table><tr style='font-size:62px;text-align:left;' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>";
	echo "<div class='alert alert-success'>";
	echo "<h1><span class='label label-warning'>EL NUMERO DE GUIA NO EXISTE,  VERIFIQUE!</span></h1>";
	echo "</div>";
	echo '<center><input  name="button" type="button" class="boton_personalizado" onclick="window.close();" value="ACEPTAR" /></center>';
	echo "</tr></table>"; 
}else {

	if($estado==6 and $rw1[5]==1){

			$estadog=7;
			if($piezasg>1){

				$sql="INSERT INTO `piezasguia`(`numeroguia`, `numeropieza`) values ('$guia',$pieza)";
				$DB1->Execute($sql);

				$sql="SELECT  count(numeropieza) from piezasguia where numeroguia='$guia' ";		
				$DB->Execute($sql);
				$rw2=mysqli_fetch_row($DB->Consulta_ID);

				if($rw2[0]!=$piezasg){
					$inser=0;
					$sql2="UPDATE `servicios` SET  `ser_fechaguia`='$fechatiempo' WHERE `idservicios`='$idser' ";			
					$DB->Execute($sql2);
					$color=$rw1[7];
					echo "<table><tr style='font-size:32px;text-align:left;' bgcolor='$color' >";
					echo "<td>";
					echo "<div class='alert alert-success'>";
					echo "<h1><span class='label label-warning'>GUIA:</span></h1>";
					echo "<h1><span class='label label-warning'>$guia</span></h1>";
					echo "<h1><span class='label label-warning'>DESTINO: </span></h1>";
					echo "<h1><span class='label label-warning'>$rw1[8] </span></h1>";
					echo "<h1><span class='label label-warning'>pieza $pieza</span></h1>";
					echo "</div>";
					echo '<center><input  name="button" type="button" class="boton_personalizado" onclick="window.close();" value="ACEPTAR" /></center>';
					echo "</tr></table>"; 
				}

			}else{

				$sql4="INSERT INTO `piezasguia`( `numeroguia`, `numeropieza`) values ('$guia',$pieza)";
				$DB1->Execute($sql4);
			}

			if($inser==1){

				$sql1="UPDATE `cuentaspromotor` SET  `cue_fecha`='$fechatiempo', cue_estado='7'  where cue_idservicio=$idser";
				$DB1->Execute($sql1);			
				
				  $sql2="UPDATE `servicios` SET  `ser_idusuarioregistro`='$id_usuario',`ser_fechaguia`='$fechatiempo',ser_estado='7'
				WHERE `idservicios`='$idser' ";			
				$DB->Execute($sql2);
				
				 $sql3="UPDATE `guias` SET `gui_ensede`='$id_nombre',`gui_fechaensede`='$fechatiempo' WHERE `gui_idservicio`='$idser'";
				$DB->Execute($sql3); 
				
				$color=$rw1[7];
				echo "<table ><tr style='font-size:32px;text-align:left;' bgcolor='$color' >";
				echo "<td>";
				echo "<div class='alert alert-success'>";
				echo "<h1><span class='label label-warning'>GUIA:</span></h1>";
				echo "<h1><span class='label label-warning'>$guia</span></h1>";
				echo "<h1><span class='label label-warning'>DESTINO: </span></h1>";
				echo "<h1><span class='label label-warning'>$rw1[8] </span></h1>";
				echo "<h1><span class='label label-warning'>pieza $pieza</span></h1>";
				echo "</div>";
				echo '<center><input  name="button" type="button" class="boton_personalizado" onclick="window.close();" value="ACEPTAR" /></center>';
				echo "</td></tr></table>"; 
			
			}

}else if($estado==7){
	$color="#B20F08";

		echo "<table><tr bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>";
	echo "<div style='font-size:32px;text-align:left;' class='alert alert-success'>";
	echo "<h1><span class='label label-warning'>LA GUIA YA FUE ENVIADA, </span></h1>";
	echo "<h1><span class='label label-warning'> VERIFIQUE LA GUIA</span></h1>";
	echo "</div>";
	echo '<center><input  name="button" type="button" class="boton_personalizado" onclick="window.close();" value="ACEPTAR" /></center>';
	echo "</td></tr></table>"; 


}else{
	$color="#B20F08";
		echo "<table><tr style='font-size:62px;text-align:left;' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>";
		echo "<div class='alert alert-success'>";
		echo "<h1><span class='label label-warning'>LA GUIA NO ESTA EN ESTADO  DE ENVIO,  VERIFIQUE LA GUIA!</span></h1>";
		echo "</div>";
		echo '<center><input  name="button" type="button" class="boton_personalizado" onclick="window.close();" value="ACEPTAR" /></center>';
		echo "</tr></table>"; 


	}
}


?>