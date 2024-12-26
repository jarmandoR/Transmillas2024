<?php 
require("login_autentica.php"); 
include("layout.php");

?>
<head>
  <script>  
  </script>
</head>
<body>

<?php 

$FB->abre_form("form1","","post");
echo "<a class='btn btn-success' onclick='pop_dis13(1,\"Buzonmovil\")'>Enviar Mensaje</a>";
$FB->titulo_azul1("Buzon de mensajes",1,0,5);  

$conde3="";	
$conde3="and ser_idusuarioguia='$id_usuario'";	
$fechainicial=date("Y-m-d",strtotime($fechaactual."- 1 days")); 
$conde1="and  ser_fechaguia>='$fechainicial' ";

 $sql="SELECT `idnoticia`, `not_fecha`, `not_titulo`, `not_descripcion`, `not_expiracion`, `not_idrol`, `not_idusuario`, `not_userinsert`, `not_visto` FROM `noticia` WHERE not_idusuario='$id_usuario' and not_expiracion like '$fechaactual%' ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	
		echo "<tr style='font-size:12px;text-align:left;' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>";
		
		echo "<div class='alert alert-success'>";
		echo "<h4><span class='label label-warning'>DE: $rw1[7]</span></h4>";
		echo "<h4><span class='label label-success'>Titulo: $rw1[2]</span></h4>";

	
		echo "<div class='alert alert-info'> $rw1[3]</span></h2></div>";

	
		if($rw1[8]==1){ $st="SI"; $colorfondo="#074f91"; 
		
		$estado_rec2[0]="SI";
		echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  required>";
		$LT->llenaselect_ar($st,$estado_rec2);
		echo "</select>";
		
		} else { $st="NO"; $colorfondo="#941727"; 
		echo "<div id='campo$va'>"; 
		echo " ¿Mensaje Visto?<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:12px'  name='param$va' id='param$va'  onChange='cambio_ajax2(this.value, 70, \"campo$va\", \"$va\", 1, $id_p)'  required>";
			$LT->llenaselect_ar($st,$estado_rec);
		echo "</select>";
		echo "</div>";
		}
		
	//	echo "<a  onclick='pop_dis13($id_p,\"Entregar Guias\")';  style='cursor: pointer;' class='btn btn-primary btn-lg' title='Entregar Guias' role='button' >Entregar</a>";

		echo "</p></div></td>";
		
		
	echo "</tr>"; 
	}


include("footer.php");
?>