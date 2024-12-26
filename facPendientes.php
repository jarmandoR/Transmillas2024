

<?php
require("login_autentica.php"); 
include("layout.php");
$nivel_acceso=$_SESSION['usuario_rol'];



$fechaini=$param21;
$fechafin=$param22;
$cliente=$param23;
$nit=$param24;

if ($fechaini!="" and $fechafin!="") {$conde1=" and date(fac_fechafactura)>='$fechaini' and  date(fac_fechafactura)<='$fechafin'";}
// if ($fechafin!="") {$conde2=" and ";}
if ($cliente!="") $conde3="and fac_credito='$cliente'";
if ($nit!="") {$conde4="and fac_nit='$nit'";}

$FB->titulo_azul1("Facturas pendientes",9,0,7);  
$FB->abre_form("form1","facPendientes.php","post");


$FB->llena_texto("Fecha de Inicial:", 21, 10, $DB, "", "", "$fechaini", 17, 0);
$FB->llena_texto("Fecha de Final:", 22, 10, $DB, "", "", "$fechafin", 4, 0);
$FB->llena_texto("Cliente:",23, 280, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos` inner join `hojadevidacliente` on hoj_clientecredito =idcreditos where hoj_estado='Activo' )", "", "$param23",17,1);
$FB->llena_texto("# Nit:", 24, 1, $DB, "", "","$param24", 4,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 

// echo"<div id ='cuerpo'>";
$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Credito",1,0,0); 
$FB->titulo_azul1("#Nit",1,0,0); 
$FB->titulo_azul1("#Factura",1,0,0);
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("Valor Final",1,0,0);  
$FB->titulo_azul1("Tipo de pago",1,0,0); 



$sql2="SELECT `idfacturascreditos`, `fac_fechafactura`,`fac_credito`, `fac_numerofactura`, `fac_fechaprefac`,`fac_idservicios`, `fac_iduserpre`,`fac_numeroref`, `fac_fechafacturado`, `fac_fechavencimiento`, `fac_estado`,`fac_tipopago`,`fac_iduserfac`,fac_precio,`fac_fecharadicado`,fac_fechapago,fac_notacredito,fac_fecharafacturado,fac_pagoconfir,fac_userconfirmo,fac_fechacomfir,fac_valorpendiente,fac_preciofinal,fac_correoven, fac_nit FROM `facturascreditos` WHERE   (fac_tipopago='Pendiente' or fac_tipopago is  null) and fac_fechafactura>'2023-06-01' and fac_estado='Facturado'  $conde1 $conde2 $conde3 $conde4   ORDER BY fac_fechafactura desc";

$DB1->Execute($sql2); $va=0; 
$guias=0;
	while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$va++; $p=$va%2;
        $id_p=$rw2[0];
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "	
		<td>".$rw2[1]."</td>
		<td>".$rw2[2]."</td>
		<td>".$rw2[24]."</td>
		<td>Factura #:".$rw2[7]."</td>	
        <td>".$rw2[13]."</td>
		<td>".$rw2[22]."</td>
		";
		if($rw2[11]=='Pendiente'){
			echo"<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"TipoPago\",\"$rw2[3]\")';  title='Tipopago' >$rw2[11]</td>";

		}elseif($rw2[11]!=null or $rw2[11]!=''){
			
			$pago=$rw2[11]." \n Ver Imagen";
			$imagenpago= $LT->llenadocs31($DB1,"facturascreditos",$id_p, 2, 15,"$pago");
			echo"<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"TipoPago\",\"$rw2[3]\")';  title='Tipopago' >Actualizar Pago $imagenpago</td>";

			//echo "<td>".$rw2[11]."</td>";
		}else{
			echo"<td>".$rw2[11]."</td>";
		}

	}
	// echo"</div>";
include("footer.php");
?>