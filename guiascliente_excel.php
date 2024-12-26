<?php
header('Content-type: application/vnd.ms-excel; charset=utf-8');
header("Content-Disposition: attachment; filename=reporte_creditos.xls;  charset=utf-8");
header("Pragma: no-cache");
header("Expires: 0");  
//echo "\xEF\xBB\xBF";   
require("login_autentica.php");


//include("layout.php");
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$id_usuario=$_SESSION['usuario_id'];

$conde1=""; 
$conde3=""; 

if($param2!="" and $param1!=""){ 
$conde1=" and $param1 like '%$param2%' "; 
}else { $conde1=""; } 

if($param1==""){ $param1="ser_prioridad"; } 
if($param4!=''){  $fechaactual=$param4;  } else { $param4=$fechaactual; }


	
 ?>
    <table width="99%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="">
     <tr bgcolor="#F75700">
     <td width="10%"  class=""><div align="center" class="tittle2">#Idservicio</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">#Guia</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Destinatario</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Ciudad D</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Fecha Ingreso</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Telefono</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Direccion</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Piezas</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Volumen </div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Peso</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Valor</div></td>	
       </tr>
     <?php	


$idtelefono="SELECT `usu_telefono`,`usu_idcredito` FROM `usuarios` WHERE  `idusuarios`='$id_usuario'";
$DB->Execute($idtelefono);
$telefono=$DB->recogedato(0);

	 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_estado,'1' as tipoc,ser_peso,ser_volumen,ser_valor,ser_valorseguro,ser_piezas
	FROM serviciosdia where cli_telefono='$telefono' and ser_fecharegistro like  '$fechaactual%' and ser_estado!=100  $conde1  ORDER BY $param1 $asc ";

$DB->Execute($sql); $va=0; 
$totalcontado=0;
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			
			$direct2=str_replace("&"," ", $rw1[7]);			
			$pordeclarado=(intval($rw1[19])*1)/100;
			$rw1[18]=$rw1[18]+$pordeclarado;
			$totalcontado=$rw1[18]+$totalcontado;
			$totalpiezas=$rw1[20]+$totalpiezas;
			echo "
			<td>".$rw1[0]."</td>
			<td>".$rw1[12]."</td>
			<td>".$rw1[5]."</td>
			<td>".$rw1[8]."</td>
			<td>".$rw1[10]."</td>
			<td>".$rw1[6]."</td>
			<td>".$direct2."</td>
			<td>".$rw1[20]."</td>
			<td>".$rw1[17]."</td>
			<td>".$rw1[16]."</td>
			<td>".$rw1[18]."</td>
			";

		echo "</tr>"; 
	}
	
	echo'<tr bgcolor="#F75700">
	<td width="10%"  class=""></td>
	<td width="10%"  class=""></td>
	<td width="10%"  class=""></td>
	<td width="10%"  class=""></td>
	<td width="10%"  class=""></td>
	<td width="10%"  class=""></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Total Piezas</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">'.$totalpiezas.'</div></td>
	<td width="10%"  class=""></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Total Factura</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">'.$totalcontado.'</div></td>';

	echo "</tr>"; 
?>


</table>
