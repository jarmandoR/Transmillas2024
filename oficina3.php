<script>
function validarguia(des)
{
	trueorfalse=4;
		 if(trueorfalse==4){
		//	confirm('joseeeeee222');
			idservicio=1111;
			var mensaje;
			var opcion =confirm("hoLAAA")

			if (opcion == true) {
				mensaje = "Has clickado OK";
				return true;
			} else {
				mensaje = "Has clickado Cancelar";
			}
				

		}else{
					return true;
				}
				
			
			return false;
}



</script>

<script type="text/javascript">

async funtion mensaje(){

	idservicio=1111;
	$("#confirmarmensaje").modal("show"); 
					var divvalor= document.getElementById("confirmar");
					divvalor.innerHTML="<strong>Atencion!</strong> YA HAY UNA SERVICIO CON ESTE MISMO DESTINO, IDSERVICIO. "+idservicio+" </BR> VERIFIQUE GRACIAS!</a>"
					
					$("#modalAdd").click(function(){
						console.log('josee');
						return true;
					});
}


</script>
<?php 
 $variableunica=date("Y").date("m").date("d").date("h").date("i").date("s").$id_usuario;
$tcampod=1;
$tcampot=121;

if($estadofactura=='verificacion'){
	$tcampod=1;
	$tcampot=121;	
}

else if($estadofactura=='recoleccion'){
	$tcampod=117;
	$tcampot=120;	
}

@$param4=$rw[4];

echo '<form action="recolecciondatosok.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validarguia(this);" >';

$FB->titulo_azul1("Remitente",10,0, 5);  



$FB->llena_texto("Volumen:",27,1, $DB, "", "","0",1, 0);	
$FB->llena_texto("Estado Paquete:",31,9, $DB, "", "","" ,17, 0);
$FB->llena_texto("&iquest;Verificado?:",32, 214, $DB, "", "","", 4, 0);	
$FB->llena_texto("Giros $:",29,118, $DB, "", "","",4, 0);	
$FB->llena_texto("&iquest;Devolver Recibido?:", 25, 212, $DB, "", "3","",17, 0);	
echo '<div id="confirmacionmensaje" class="alert alert-danger" style="display:none;"  > </div>';


$FB->llena_texto("param15", 1, 13, $DB, "", "", "$param15", 5, 0); 
//$FB->llena_texto("param16", 1, 13, $DB, "", "", "0", 5, 0); 
$FB->llena_texto("id_param", 1, 13, $DB, "", "", "$rw[0]", 5, 0); // idcliente
$FB->llena_texto("id_param0", 1, 13, $DB, "", "", "$rw[21]", 5, 0);
$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "0", 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "$rw[19]", 5, 0);  // clientesdir
$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", "$id_usuario", 5, 0);
$FB->llena_texto("variableunica", 1, 13, $DB, "", "", "$variableunica", 5, 0);
?> 