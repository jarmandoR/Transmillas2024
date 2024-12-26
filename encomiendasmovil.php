<?php 
require("login_autentica.php"); 
include("layout.php");
if($param2=='') { $param2=0;  }
?>
<head>
	<script language="JavaScript" type="text/javascript" src="js/jquery-1.4.4.min"></script> 
 <!--    <script src="js/jquery.printPage.js" type="text/javascript"></script> -->
  <script>  
 /*   var version2 = jQuery.noConflict(); 
  version2(document).ready(function() {
    version2(".btnPrint").printPage();
  });   */ 
  

  </script>

</head>
<body onload="<?php 
 switch ($tabla)
{
	case "Factura":
	echo "pop_dis4($id_param,'Factura');";
	break;
	
	default:
	
	break;

} 
 ?>
">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Recogidas/Encomiendas",1,0,5);  

$conde3="";	
$conde3="and ser_idusuarioguia='$id_usuario'";	
$fechainicial=date("Y-m-d",strtotime($fechaactual."- 1 days")); 
$conde1="and  ser_fechaguia>='$fechainicial' ";

 $sql="SELECT `idservicios`, `ser_consecutivo`, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`, `ser_telefonocontacto`,`usu_nombre`,ser_estado,ser_visto,ser_guiare
 FROM serviciosdia
 inner join usuarios on ser_idusuarioguia=idusuarios where ser_estado in (9) $conde1 $conde3 ORDER BY ser_fechaguia $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		$rw1[7]=str_replace("&"," ", $rw1[7]);
		echo "<tr style='font-size:12px;text-align:left;' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>";
		
		echo "<div class='alert alert-success'>";
		echo "<h4><span class='label label-warning'>ENCOMIENDA</span></h4>";

	
		echo "<div class='alert alert-info'>DIRECCIÓN: $rw1[4]</div>";
		echo "<p  align='left'>DESTINATARIO: $rw1[2]<br>";
		echo "TELÉFONO: ***********<br>";
		echo "CIUDAD: $rw1[3]<br>";
		echo "Pre GUIA: $rw1[9]<br>";
		echo "GUIA: $rw1[1]<br></p>";
	
		if($rw1[8]==1){
			
		$st="SI"; $colorfondo="#074f91"; 
		$estado_rec2[0]="SI";
		echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  required>";
		$LT->llenaselect_ar($st,$estado_rec2);
		echo "</select>";
		
		} else { 
		
		$st="NO"; $colorfondo="#941727"; 
		echo "<div id='campo$va'>"; 
		echo " ¿EN RUTA?<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:12px'  name='param$va' id='param$va'  onChange='cambio_ajax2(this.value, 70, \"campo$va\", \"$va\", 1, $id_p)'  required>";
			$LT->llenaselect_ar($st,$estado_rec);
		echo "</select>";
		echo "</div>";
		}
		
		echo "<a  onclick='pop_dis13($id_p,\"Entregar Guias\")';  style='cursor: pointer;' class='btn btn-primary btn-lg' title='Entregar Guias' role='button' >Entregar</a>";

		echo "</p></div></td>";
		
		
	echo "</tr>"; 
	}


include("footer.php");
?>