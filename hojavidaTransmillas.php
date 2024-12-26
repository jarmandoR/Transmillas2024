<style>
        .container-left {
            float: left;
            margin-right: 10px; /* Espacio entre botones */
        }

        .container-right {
            float: right;
            margin-left: 10px; /* Espacio entre botones */
        }
        .email-button {
            display: inline-flex;
            align-items: center;
            background-color: #2196F3; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .file-button {
            display: inline-flex;
            align-items: center;
            background-color: #4CAF50; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .email-button i {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }

        .file-button i {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }



        .file-button {
            background-color: #4CAF50;
        }
        #loading {
            display: none; /* Ocultar inicialmente */
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; /* Asegurarse de que está por encima de otros elementos */
        }
                /* Estilos específicos para la tabla de preguntas */
        .tabla-preguntas {
            width: 100%;
            border-collapse: collapse;
        }
        .tabla-preguntas th, .tabla-preguntas td {
            border: 1px solid gray;
            
            padding: 8px;
            text-align: left;
        }
        
        .tabla-preguntas th {
            background-color: #003366; /* Azul oscuro */
            color: white; /* Letra blanca */
        }
        #loading {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; /* Asegurarse de que está por encima de otros elementos */
        }
        .search-box {
            position: relative;
            width: 300px;
            justify-content: flex-end; /* Alinear a la derecha */
        }
        .search-box input[type="text"] {
            width: 100%;
            padding: 10px;
            padding-left: 40px; /* Espacio para el icono */
            border: 2px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .search-box .fa-search {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<?php 

require("login_autentica.php"); 
include("layout.php");
echo '<div class="container-left">';

// echo '<button type="button" class="btn btn-danger btn-lg" onclick="window.location.href = \'adm_manifiestos.php?funcion=Vehiculos\';" >Vehiculos</button>';
// echo '<button type="button" class="btn btn-danger btn-lg" onclick="window.location.href = \'adm_manifiestos.php?funcion=Conductores\';" >Conductores</button>';

echo'</div>';

echo'<div class="container-right">';

echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Agregar carpeta\",\"$rw1[5]\")' >Agregar carpeta</button>";

echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Agregar un documento\",\"$rw1[5]\")' >Agregar un documento</button>";

echo'</div>';

echo"aqui".$nivel_acceso;
$FB->titulo_azul1("Hoja de vida Transmillas",9,0,5);  
$FB->abre_form("form1","hojavidaTransmillas.php","post");

$FB->llena_texto("Nombre carpeta:", 2, 1, $DB, "", "","$param2",17,0);
// $FB->llena_texto("Fecha:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
// $FB->llena_texto("Sede :",4,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 and sed_principal='si' $conde2  order by sed_nombre asc  )", "", "$id_sedes",1, 0);
$FB->llena_texto("Sede:",7,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 and sed_principal='si'  order by sed_nombre asc)","","$param7",2,0);
if($nivel_acceso==1){

    $FB->llena_texto("Rol:",5,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","","$param5",2,0);

}else{
    $FB->llena_texto("Rol:",5,2,$DB,"SELECT idroles, rol_nombre FROM roles where idroles='$nivel_acceso' ORDER BY rol_nombre ","","$nivel_acceso",2,0);

}
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 
echo "<tr><td colspan='4'>

<div style='display: inline-block;'>
<button type='button' class='email-button' onclick='enviarids(\"$id_p\",\"Enviar correo\")' ><i class='fas fa-envelope'></i>Email</button>
<button type='button' class='icon-button file-button' onclick='pop_dis16(\"$id_p\",\"Preguntas y respuestas\",\"$rw1[5]\")'><i class='fas fa-file'></i>Preguntas</button>
<button type='button' class='icon-button file-button' onclick='pop_dis16(\"$id_p\",\"Informacion Transmillas\",\"$rw1[5]\")'><i class='fas fa-file'></i>Informacion</button>
<button type='button' class='icon-button file-button' onclick='pop_dis16(\"23\",\"Ver carpeta\",\"$rw1[5]\")'><i class='fas fa-file'></i>Documentos membrete</button>

</div>";



 $anioinc = 2020;
 $aniofin = date("Y");





if ($param2 !=""){
    $cond="and car_nombre like '$param2%'";	
}else{
	$JOIN="";
	$cond="";
}

if($param7!=''){ 
    $cond1="and car_sede = '$param7'"; 
}else {
    $cond1="and car_sede = '$id_sedes'"; 
} 
 
 
if($param5!=''){
    $cond2=" and car_rol='$param5'";
}else {
    if($nivel_acceso==1){

        $cond2="";

    }else{
        $cond2=" and car_rol='$nivel_acceso'";

    }
} 













if(isset($_REQUEST["ordby"])){ $ordby=$_REQUEST["ordby"]; } else { $ordby="hoj_nombre,hoj_apellido"; } 
if(@$_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } 	$asc2=""; if($asc=="ASC"){ $asc2="DESC";}
//$condlimit=$FB->llena_sigant($pagina, $ordby, $asc, $valor); 


// $FB->titulo_azul1("#",1,0,7); 
$FB->titulo_azul1("✔️",1,0,7); 
$FB->titulo_azul1("Nombre",1,0,0); 
// $FB->titulo_azul1("Editar",1,0,0); 
 $FB->titulo_azul1("Eliminar",1,0,0); 



$sql="SELECT `idcarpeta`,`car_nombre`,car_sede,car_rol FROM `carpetasTransmillas` WHERE idcarpeta>=0 $cond $cond1 $cond2  ";

$DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
        $vencido=0;
        $recuerde="";
        $tipoalerta="";
        $tipoalertaproxi="";
        // $vencido=$vencido+1;
        $proxivencer=0;
        if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
        $sql1="SELECT doct_fechavence as max_doct_fechavence FROM `documentosTransmillas` WHERE `doct_id_carpeta` = '$rw1[0]' and  doct_renovado in('','No renovado') and doct_fechavence!='0000-00-00'";
        $DB1->Execute($sql1); 
        while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
        {
            $fechavence=$rw2[0];
            // $fechavence=$DB1->recogedato(0);

            if ($fechavence!=null or $fechavence!="") {
                $fechaAlmacenada = new DateTime($fechavence);

                // Obtener la fecha actual
                $fechaActual = new DateTime();
                
                // Calcular la diferencia en días
                $diferencia = $fechaActual->diff($fechaAlmacenada)->days;
                
                // Verificar si la fecha actual está por encima o por debajo en 5 días o si es igual
                if ($fechaActual >= $fechaAlmacenada  ) {
                    // if ($diferencia <= 5) {
                        // echo "La fecha actual está dentro de los 5 días por encima de la fecha almacenada.";
                        // $color="#EC7063";
                        // $recuerde="         ¡Debe renovar el documento!";
                        $tipoalerta="vencido";
                        $vencido=$vencido+1;
                    // } else {
                    //     // echo "La fecha actual está más de 5 días por encima de la fecha almacenada.";
                    // }
                } elseif ($fechaActual < $fechaAlmacenada ) {
                    if ($diferencia <= 5) {
                        // echo "La fecha actual está dentro de los 5 días por debajo de la fecha almacenada.";
                        // $color="#F1A20F";
                        // $recuerde="";
                        $tipoalertaproxi="Proximo a vencerse";
                        // $vencido=$vencido+1;
                        $proxivencer=$proxivencer+1;
                    } else {
                        // echo "La fecha actual está más de 5 días por debajo de la fecha almacenada.";
                    }
                } else {
                    // echo "La fecha actual es igual a la fecha almacenada.";
                    // $color="##EC7063";
                }

                if ($proxivencer>0) {

                    $color="#F1A20F";
                    if ($proxivencer>1) {
                        $recuerde2="  ¡Tiene $proxivencer  documentos $tipoalertaproxi! ";

                    }else {
                        $recuerde2="  ¡Tiene $proxivencer documento $tipoalertaproxi! ";

                    }


                }else{
                    $recuerde2="";

                }

                if ($vencido>0) {
                    $color="#EC7063";

                    if ($vencido>1) {
                        $recuerde1="  ¡Tiene $vencido  documentos $tipoalerta! ";

                    }else {
                        $recuerde1="  ¡Tiene $vencido documento $tipoalerta! ";

                    }


                }else{
                    $recuerde1="";

                }

                $recuerde=$recuerde1." --- ".$recuerde2;
            }
        }

        $sql2="SELECT MAX(`doctid`) as doctid FROM `documentosTransmillas` WHERE `doct_id_carpeta` = '$rw1[0]'";
        $DB1->Execute($sql2); 
        $iddoc=$DB1->recogedato(0);
        if ($fechavence==null or $fechavence=="") {$iddoc=0;}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
        echo "<td><input type='checkbox'  onchange='selecionado($iddoc)' class='checkbox' id='".$iddoc."s' value='$iddoc'></td>";

		echo "<td><a href=''   onclick='pop_dis16(\"$id_p\",\"Ver carpeta\",\"$rw1[5]\"); return false;' target='_blank'><img src='images/carpeta.png'>".$rw1[1]."</a>$recuerde</td>";
        if($nivel_acceso==1){
            $DB->edites($rw1[0], "carpetahvt", 2, $condecion);
        }
    }

include("footer.php");

?>
<script>
	function califica(idMani,valor) {
    var checkbox = document.getElementById(idMani);
    // var boton = document.getElementById(tipo+idusuario+"guardarCuenCobro");
	var option = "Seleccione"
	var estado = "calificacion";


		datos = {"idMani":idMani,"valor":valor,"estado":estado};
			$.ajax({
						url: "guardaManifiesto.php",
						type: "POST",
						data: datos
					}).done(function(respuesta){
						
				if (valor=='Buena') {
					checkbox.style.backgroundColor = "#28B463";
					
				}else if (valor=='Regular') {
					checkbox.style.backgroundColor = "#D35400";
					
				}else if (valor=='Mala') {
					checkbox.style.backgroundColor = "#8B0000";
					
				}else{
					checkbox.style.backgroundColor = "rgb(7, 79, 145)";

				}

			});
	
}

document.querySelectorAll('textarea').forEach(textarea => {
            textarea.oninput = function() {
				var estado = "observacion";
                const id = textarea.id;
                const name = textarea.name;
                const value = textarea.value;


				datos = {"idMani":name,"Observacion":value,"estado":estado};
				$.ajax({
							url: "guardaManifiesto.php",
							type: "POST",
							data: datos
						}).done(function(respuesta){
							
				});
            };
        });

        let idsSeleccionados = [];

    // Función para manejar los clics en los checkboxes
    function selecionado(iduser) {
		var checkbox = document.getElementById(iduser+"s");
        // const checkbox = event.target;
        const id = iduser;

        if (checkbox.checked) {
            // Si el checkbox está marcado, agregar el ID al array
            idsSeleccionados.push(id);
        } else {
            // Si el checkbox está desmarcado, eliminar el ID del array
            const index = idsSeleccionados.indexOf(id);
            if (index !== -1) {
                idsSeleccionados.splice(index, 1);
            }
        }

        console.log("IDs seleccionados:", idsSeleccionados);
    }

    // Obtener todos los checkboxes y agregar un event listener para manejar los clics
    // const checkboxes = document.querySelectorAll('.checkbox');
    // checkboxes.forEach(checkbox => {
    //     checkbox.addEventListener('click', manejarClicCheckbox);
    // });



function enviarids(id_param,tabla) {



    let arrayParam = encodeURIComponent(JSON.stringify(idsSeleccionados));
    $("#myModal").modal("show");
	var destino=`detalle_pop.php?ide=${arrayParam}&id_param=${encodeURIComponent(id_param)}&tabla=${encodeURIComponent(tabla)}`;
	MostrarConsulta(destino, "llena_sub1");
   

}

      // Pasar el array de PHP a JavaScript
        
        
function sendEmail(fileNames) {
            // const fileNames = 
            // let arrayParam = encodeURIComponent(JSON.stringify(fileNames));
            console.log(fileNames);
            const email = document.getElementById('param2');
            const fileInput = document.getElementById('param3');
            const formData = new FormData();

            // Agregar archivo subido
            if (fileInput.files.length > 0) {
                formData.append('file', fileInput.files[0]);
            }

            // Agregar nombres de archivos como JSON
            formData.append('file_names', JSON.stringify(fileNames));
            //agregar correo
            formData.append('correo', email.value);

            const loadingElement = document.getElementById('loading');

            // Mostrar el GIF de carga
            loadingElement.style.display = 'block';
            // Enviar datos al servidor
            fetch('hojvidaTranEmail.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log(result);
                alert('Correo enviado');
                idsSeleccionados = [];
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al enviar el correo');
            }).finally(() => {
                // Ocultar el GIF de carga
                loadingElement.style.display = 'none';
            });
}

function guardarPregunta(){

    const pregunta = document.getElementById('param2').value;
    const respuestas = document.getElementById('param3').value;
    var funcion="preres";
    // const datos = {"pregunta": pregunta, "respuesta": respuesta};
    datos = {"pregunta":pregunta,"respuesta":respuestas,"funcion":funcion};
				$.ajax({
							url: "guardarHVT.php",
							type: "POST",
							data: datos
						}).done(function(respuesta){
							// Convertir la respuesta en objeto si es necesario
                            // const data = JSON.parse(respuesta);

                            // Añadir la nueva fila a la tabla
                            const tabla = document.getElementById('tablaPreguntas').getElementsByTagName('tbody')[0];
                            const nuevaFila = tabla.insertRow();

                            const celdaPregunta = nuevaFila.insertCell(0);
                            const celdaRespuesta = nuevaFila.insertCell(1);

                            celdaPregunta.innerHTML = pregunta;
                            celdaRespuesta.innerHTML = respuestas;

                            // Limpiar los campos del formulario
                            document.getElementById('param2').value = '';
                            document.getElementById('param3').value = '';
				});




}
function guardarPregunta(){

const pregunta = document.getElementById('param2').value;
const respuestas = document.getElementById('param3').value;
var funcion="informacion";
// const datos = {"pregunta": pregunta, "respuesta": respuesta};
datos = {"pregunta":pregunta,"respuesta":respuestas,"funcion":funcion};
            $.ajax({
                        url: "guardarHVT.php",
                        type: "POST",
                        data: datos
                    }).done(function(respuesta){
                        // Convertir la respuesta en objeto si es necesario
                        // const data = JSON.parse(respuesta);

                        // Añadir la nueva fila a la tabla
                        const tabla = document.getElementById('tablaPreguntas').getElementsByTagName('tbody')[0];
                        const nuevaFila = tabla.insertRow();

                        const celdaPregunta = nuevaFila.insertCell(0);
                        const celdaRespuesta = nuevaFila.insertCell(1);

                        celdaPregunta.innerHTML = pregunta;
                        celdaRespuesta.innerHTML = respuestas;

                        // Limpiar los campos del formulario
                        document.getElementById('param2').value = '';
                        document.getElementById('param3').value = '';
            });




}
const buscador = document.getElementById('buscador');
buscador.oninput = function() {
    
    var input = buscador.value;
    console.log(input);
  };


  function renovar(valor1,valor2){
    var funcion ="renovar";
    datos = {"valor":valor1,"idDoc":valor2,"funcion":funcion};
            $.ajax({
                        url: "guardarHVT.php",
                        type: "POST",
                        data: datos
                    }).done(function(respuesta){
                        // Convertir la respuesta en objeto si es necesario
                        // const data = JSON.parse(respuesta);

                        // Añadir la nueva fila a la tabla
                        // const tabla = document.getElementById('tablaPreguntas').getElementsByTagName('tbody')[0];
                        // const nuevaFila = tabla.insertRow();

                        // const celdaPregunta = nuevaFila.insertCell(0);
                        // const celdaRespuesta = nuevaFila.insertCell(1);

                        // celdaPregunta.innerHTML = pregunta;
                        // celdaRespuesta.innerHTML = respuestas;

                        // // Limpiar los campos del formulario
                        // document.getElementById('param2').value = '';
                        // document.getElementById('param3').value = '';
            });



  }
</script>