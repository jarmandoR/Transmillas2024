<?php 
require("login_autentica.php");
include("cabezote3.php"); 


?>
<style type="text/css">
#segundo {
	width:628px;
     height:415px;
     overflow:auto;
}

#tercero {
     width:628px;
     height:415px;
     overflow:auto;
}
</style>
<?php 
if($param3!=''){ $conde3 =" and (rel_nom_credito like '%$param3%')";  }

$idfactura=$param6;
 $sql1="Select fac_idfacturados,fac_numeroref from facturascreditos where idfacturascreditos=$idfactura ";
$DB->Execute($sql1); 
$datosfact=mysqli_fetch_row($DB->Consulta_ID);
  $prefac=trim($datosfact[0]); 
 $numerofactura=$datosfact[1]; 
 $prefactura=explode(",",$prefac);
//print_r($prefactura);


  echo '
  <div id="contenedor" style="display:flex;">
   <div id="segundo" style="width: 50%; float:left;" >';
   echo '<table class="table table-hover"><tr bgcolor="#E40826" class="tittle3"><td>Guias Pendientes Credito</td></tr><tr><td>';
	   $FB->titulo_azul1("Fecha",1,0,7); 
	   $FB->titulo_azul1("Guia",1,0,0); 
	   $FB->titulo_azul1("%Seguro",1,0,0); 
	   $FB->titulo_azul1("Flete",1,0,0); 
	   $FB->titulo_azul1("Manifiesto",1,0,0); 
	  $FB->titulo_azul1("Agregar",1,0,0); 

	 $sql="SELECT `idservicios`,`ser_fecharegistro`,ser_guiare,ser_valorseguro,ser_valor,rel_nom_credito,ser_numerofactura,ser_manifiesto
	 FROM servicios s inner join rel_sercre rs on rs.idservicio=idservicios where date(ser_fecharegistro)>='2020-01-01' and ser_clasificacion=2 and ser_estado>=3 and ser_estado!=100 and (ser_numerofactura IS NULL or ser_numerofactura='' or ser_numerofactura='$numerofactura') $conde3 ORDER BY ser_fecharegistro $asc ";
	
	$DB->Execute($sql); $va=0; 
	 while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	 {
		 $id_p=$rw1[0];
		 
		 $va++; $p=$va%2;
		 if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		 $idguia=$rw1[2];
		 $pordeclarado=(intval($rw1[3])*1)/100;

		$displaynone='';
		if (($i = array_search($id_p, $prefactura)) !== FALSE){
			 $clave="SI";
			$displaynone='display:none';
		}else{
			$clave="NO";
			$displaynone='';
		}


		 echo "<tr class='text' style='$displaynone' id='$rw1[2]' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		 echo "
		 <td>".$rw1[1]."</td>
		 <td>".$rw1[2]."</td>
		 <td>".$pordeclarado."</td>
		 <td>".$rw1[4]."</td>
		 <td>".$rw1[7]."</td>
		 ";

		 echo "<td><button type='button' class='btn btn-success' onclick='agregarguia(\"$idguia\",\"$pordeclarado\",\"$rw1[4]\",\"$id_p\")'>Agregar</button></td></tr>";

	 } 

echo '</table></td></tr></table></div>

   <div id="tercero" style="width: 50%; float:left;">';
   echo '<table class="table table-hover"><tr bgcolor="#04B404" class="tittle3"><td>Guias a Facturar</td></tr><tr><td>';

  echo '<table  id="agregar" class="table table-hover"><tbody>
  <tr bgcolor="#074F91" class="tittle3">
  <td colspan="1" width="0" align="center">Guia</td>
  <td colspan="1" width="0" align="center">%Seguro</td>
  <td colspan="1" width="0" align="center">Flete</td>
  <td colspan="1" width="0" align="center">Manifiesto</td>
  <td colspan="1" width="0" align="center">Eliminar</td>
  </tr></tbody>';


  $sql="SELECT `idservicios`,`ser_fecharegistro`,ser_guiare,ser_valorseguro,ser_valor,rel_nom_credito,ser_numerofactura,ser_manifiesto
  FROM servicios s inner join rel_sercre rs on rs.idservicio=idservicios where date(ser_fecharegistro)>='2020-01-01' and ser_clasificacion=2 and ser_estado>=3 and ser_estado!=100  and idservicios in ($prefac) $conde3 ORDER BY ser_fecharegistro $asc ";
 $valor2=0;
 $DB->Execute($sql); $va=0; 
  while($rw1=mysqli_fetch_row($DB->Consulta_ID))
  {
	  $id_p=$rw1[0];
	  
	  $va++; $p=$va%2;
	  if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	  $idguia=$rw1[2];
	  $idguia2=$rw1[2].'2';
	  $pordeclarado=(intval($rw1[3])*1)/100;
	  echo "<tr class='text' id='$idguia2' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	  echo "
	  <td>".$rw1[2]."</td>
	  <td>".$pordeclarado."</td>
	  <td>".$rw1[4]."</td>
	  <td>".$rw1[7]."</td>
	  ";
	  $valor2=$rw1[4]+$pordeclarado+$valor2;
	echo "<td><button type='button' class='btn btn-danger' onclick='borrarguia(\"$idguia\",\"$pordeclarado\",\"$rw1[4]\",\"$id_p\")'>Quitar</button></td></tr>";
  } 

   echo '</table></td></tr></table></div>

</div>';
//$prefactura=json_encode($prefactura);
$FB->llena_texto("param7", 4, 13, $DB, "", "", $valor2, 5,2);
$FB->llena_texto("param8", 4, 13, $DB, "", "", $idfactura, 5,2);
$FB->llena_texto("param9", 4, 13, $DB, "", "", $prefac, 5,2);
include("footer.php");

?>