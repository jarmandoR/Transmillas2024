<?php
 header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reporte_facturacion.xls");
header("Pragma: no-cache");
header("Expires: 0");  
require("login_autentica.php");
//include("layout.php");
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
?>
 <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#001A55">
    
    <?php 
	
	$date=date("Y-m-d");
	if($param1!=0){ $cond1=" AND not_idsemestre='$param1' "; }
	if($param2!=0){ $cond2=" AND not_iddocente='$param2' "; }
	if($param3!=0){ $cond3=" AND not_idalumno='$param3' "; }
	if($param4!=0){ $cond4=" AND idmodulo='$param4' "; }

/* CREATE VIEW reporte_facturacion AS 
SELECT idfactura, `fac_fecha`, `fac_nombre`,`tipodocumento_idtipodocumento`, `fac_iddocumento`, `fac_telefono`,`fac_barrio`, usu_nombre,fac_cosec,`ser_codigo`, `exa_nombre`, `ser_catidad`, `ser_valor`,`fac_abono`, `fac_cajero`, `fac_resolucion`,fac_sede from examenes inner join servicio on ser_idexamen=idexamen 
inner join facturacion on ser_idviene=idfactura  
left join historiaclinica on fac_cosec=his_codfactura left join usuarios on his_idusuario=idusuarios 
union 
SELECT idfactura, `fac_fecha`, `fac_nombre`,`tipodocumento_idtipodocumento`, `fac_iddocumento`, `fac_telefono`,`fac_barrio`, usu_nombre,fac_cosec,`ser_codigo`, `exa_nombre`, `ser_catidad`, `ser_valor`,`fac_abono`, `fac_cajero`, `fac_resolucion`,fac_sede from examenes inner join servicio on ser_idexamen=idexamen 
inner join facturacion on ser_idviene=idfactura  
left join saludocupacional on  fac_cosec=sal_cosfactura left join usuarios on  sal_idusuario=idusuarios 

  */
  
if($param1==""){ 

$cond1="";

}else {
	
$cond1="Where fac_fecha>='$param1' and  fac_fecha<='$param2'";	
} 
$sql2="SELECT ser_idviene,sum(ser_catidad*ser_valor) FROM `servicio` group by ser_idviene";
$datos = array(); 
$DB1->Execute($sql2);    
while($row2 = mysqli_fetch_row($DB1->Consulta_ID)) { 
    
$datos[$row2[0]]=$row2[1];
    
} 
 
 $sql="SELECT idfactura, `fac_fecha`, `fac_nombre`, `fac_iddocumento`, `fac_telefono`,`fac_barrio`, fac_cosec,`ser_codigo`, `exa_nombre`, `ser_catidad`, `ser_valor`,(ser_catidad*ser_valor) as valor ,exa_tipo,idservicio from examenes inner join servicio on ser_idexamen=exa_idexamen inner join facturacion on ser_idviene=idfactura $cond1 order by idfactura ";
 ?>
    <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="">
     <tr>
     <td width="10%"  class=""><div align="center" class="tittle2">Fecha</div></td>
     <td width="10%"  class=""><div align="center" class="tittle2">Nombre</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Identificacion</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Telefono</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Barrio</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Medico</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Codigo</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">servicio</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">cantidad</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Valor Servicio</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Valor Total Servicio </div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Valor Total Factura </div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">SU</div></td>
       </tr>
     <?php
$DB->Execute($sql);
$va=1;
$total=0;
$total1=0;
while($rw=mysqli_fetch_row($DB->Consulta_ID))
{

	$p=$va%2;
	if($p==0){$color="#EFEFEF";}
	else{$color="#FFFFFF";}
	$va++;
	
		echo "<tr bgcolor='$color' class='text'>";
		echo "<td>".$rw[1]."</td>"; 
		echo "<td>".$rw[2]."</td>"; 
		echo "<td>".$rw[3]."</td>"; 
		echo "<td>".$rw[4]."</td>"; 
		echo "<td>".$rw[5]."</td>"; 
		
		if($rw[12]=="matrizlaboratorio"){
			
		 $sel="SELECT usu_nombre FROM matizlaboratorio inner join usuarios on idusuarios=mat_valor and mat_nombre='USUARIO' where mat_ididentificador='$rw[13]'";
		$DB1->Execute($sel);		
		$medico=$DB1->recogedato(0);	
		echo "<td>".$medico."</td>"; 
		
		}
		else if($rw[12]=="Saludocupacional"){
		 $sel="SELECT usu_nombre FROM saludocupacional inner join usuarios on idusuarios=sal_idusuario where sal_idservicio='$rw[13]'";
		$DB1->Execute($sel);		
		$medico=$DB1->recogedato(0);	
		echo "<td>".$medico."</td>"; 	
			
		}
		else if($rw[12]=="historiaclinica"){
			
		 $sel="SELECT usu_nombre FROM historiaclinica inner join usuarios on  his_idusuario=idusuarios  where his_idservicio='$rw[13]'";
		$DB1->Execute($sel);		
		$medico=$DB1->recogedato(0);	
		echo "<td>".$medico."</td>"; 
		}
		
		echo "<td>".$rw[7]."</td>"; 
		echo "<td>".$rw[8]."</td>"; 
		echo "<td>".$rw[9]."</td>"; 
		echo "<td>".$rw[10]."</td>"; 
		echo "<td align='center'>".number_format($rw[11],2,".",".")."</td>";		
		echo "<td align='center'>".number_format($datos[$rw[0]],2,".",".")."</td>";	
		echo "<td>".$rw[6]."</td>"; 		

}
echo "</tr>";


?></table>
