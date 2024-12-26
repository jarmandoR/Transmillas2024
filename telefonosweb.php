<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
?>
 <script>
$(function () {
    $(document).on('change', '.borrar', function (event) {
		
		var valor = $(this).val();
		var descripcion=document.getElementById("des_"+$(this).attr('name')).value;
		var idservicio=document.getElementById("servicio_"+$(this).attr('name')).value;


		event.preventDefault();
		$(this).closest('tr').remove();
      	datos = {"tipoguia":"validartelefono","servicio":idservicio,"descripcion":descripcion,"llego":valor};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
			});

		
    });
});
</script>
<?php 
// if($nivel_acceso==1 or $nivel_acceso==10 or $nivel_acceso==9){ $conde2="";  	 } else {  $conde2=" and idsedes=$id_sedes"; }


$FB->abre_form("form1","","post");
 
 $conde1="";
 $conde3="";
	if($param1!=''){ 
		$fechainicio=$param1;

	 }

	 if($param3!=''){ 
		$fechaactual=$param3;

	 }
		if($param2!='' and $param2!='0'){ 

			$conde2=" And  tel_estado = '$param2' "; 	
		 }else if($param2=='0') {
				$conde2=" "; 	
			} else {
				$conde2=" And  tel_estado = 'Sin validar' "; 	
				} 
  

$FB->titulo_azul1("Validar telefonos Enviados",10,0, 5);  


$FB->llena_texto("Fecha Inicio:", 1, 10, $DB, "", "", "$fechainicio", 2, 1);
$FB->llena_texto("Fecha Fin:", 3, 10, $DB, "", "", "$fechaactual", 2, 1);
$FB->llena_texto("Estado:",2,82,$DB,$teleweb,"",$param2,4,0);

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->titulo_azul1("Fecha",1,0,7); 
$FB->titulo_azul1("Telefono",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0);
$FB->titulo_azul1("Valido",1,0,0);

$fechaactual=date($fechaactual." 23:59:59");

  $sql="SELECT `idtelefonospagina`,  `tel_fechaingreso`,`tel_enviado`,  `tel_descripcion`,`tel_estado`, `tel_usuario`, `tel_fecha`
 FROM `telefonospagina` WHERE idtelefonospagina>0 and tel_fechaingreso>='$fechainicio' and tel_fechaingreso<='$fechaactual'  $conde2";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		";
		$descrip="des_$va";
		echo "<td><textarea name='des_$va' id='des_$va' value='' style='width:195px; class='text' >$rw1[3]</textarea></td>";	
		
		if($rw1[4]=='Sin validar'){
			$color="#CD1A08";
		}elseif($rw1[4]=='Agendado'){
			$color="#08CD1A";
		}elseif($rw1[4]=='LLamar despues'){
			$color="#D7D70D";
		}else{
			$color="#CD1A08";
		}
		if($rw1[4]=='Sin validar' or $nivel_acceso==1 or $rw1[4]=='LLamar despues'){
			echo "<td><div id='campo$va'>";
			echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:$color;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   class='borrar' required>";
			$LT->llenaselect_ar2($rw1[4],$teleweb);
			echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";
		}else {
			echo "<td style='width:120px;border:1px solid #f9f9f9;background-color:$color;color:#f9f9f9;font-size:15px'>$rw1[4]</td>";
		}
		echo "<td>".$rw1[5]."</td>";

	}

include("footer.php");
?>