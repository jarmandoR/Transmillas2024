<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
//echo $_SESSION['usuario_rol'];
$fechainicial=date('Y-m-01');
$fechainicial=date("Y-m-d",strtotime($fechainicial."- 3 month")); 
?>

<script>



timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param31').value;
	//if(document.getElementById('param2')){ p2=document.getElementById('param2').value; } else { p2=0;} 
	p2=document.getElementById('param32').value;
	p3=document.getElementById('param33').value;
	p4=document.getElementById('param34').value;
	
	if(nivel==1){
	p5=document.getElementById('param35').value;
	}else{ p5=0; }
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_validardatosx.php?p1="+p1+"&p2="+p2+"&p3="+p3;
		location.href=destino;
	}
	else {
		destino="detalle_validardatos.php?param31="+p1+"&param32="+p2+"&param33="+p3+"&param34="+p4+"&param35="+p5+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}
  $(function () {
    $(document).on('change', '.borrar', function (event) {
		
		var valor = $(this).val();
		var descripcion=document.getElementById("des_"+$(this).attr('name')).value;
		var idservicio=document.getElementById("servicio_"+$(this).attr('name')).value;
		event.preventDefault();
		$(this).closest('tr').remove();
      	datos = {"tipoguia":"cancelar","servicio":idservicio,"descripcion":descripcion,"llego":valor};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				console.log(respuesta);
			});

    });
});



function buscar_ajax(cadena){

var palabra = cadena;
var d = palabra.search("documento");
var p = palabra.search("papel");
var s = palabra.search("sobre");

var D = palabra.search("DOCUMENTO");
var P = palabra.search("PAPEL");
var S = palabra.search("SOBRE");

var Do = palabra.search("Documento");
var Pa = palabra.search("Papel");
var So = palabra.search("Sobre");

if (d > -1 ) 
{
	var nuevapal = palabra.replace('documento', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;
}else if(p> -1  )
{
	var nuevapal = palabra.replace('papel', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;
}
else if (s > -1 )
{
	var nuevapal = palabra.replace('sobre', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;

}else if ( D > -1) 
{
	var nuevapal = palabra.replace('DOCUMENTO', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;
}else if(P> -1  )
{
	var nuevapal = palabra.replace('PAPEL', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;
}
else if (S > -1)
{
	var nuevapal = palabra.replace('SOBRE', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;

}else if ( Do > -1) 
{
	var nuevapal = palabra.replace('DOocumento', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;
}else if(Pa> -1  )
{
	var nuevapal = palabra.replace('Papel', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;
}
else if (So > -1)
{
	var nuevapal = palabra.replace('Sobre', 'archivo');
	// alert(nuevapal);
	var inputNombre = document.getElementById("param13");
	inputNombre.value = nuevapal;

}
}
//timer =setTimeout(mostrarAviso(),5000);
/* function mostrarAviso(){
	var obj = document.getElementById("submit");
	alert('jose');
	if (obj){
	   obj.click();   
	}
} */

/* 	function cambioo2(valor, valor2,valor3,valor4)
{
    var ruta="param20="+valor+"&param21="+valor2+"&paramtipser="+valor3+"&cro="+valor4;
    $.ajax({
    
    url: 'detalle_recoleccioncomprarecogida.php',
    type: 'Get',
    data: ruta,
    }).done(function(res){

        $('#respuesta').html(res)
    });
} */
</script>
<body onLoad="llena_datos(0,<?php echo $nivel_acceso;?> , '', 'ASC'); ">
<?php 

$FB->titulo_azul1("Validar Datos del Cliente",9,0,5);  
$FB->abre_form("form1","","post");


if($nivel_acceso==1){
	if($param35!=''){ $id_ciudad=$param35;  }  else {  $id_ciudad=""; }
$FB->llena_texto("Ciudad Origen:",35,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "", "$id_ciudad", 17, 0);
$FB->llena_texto("Fecha de inicio:", 33, 10, $DB, "", "", "$fechainicial", 17, 0);
$FB->llena_texto("Fecha de Final:", 34, 10, $DB, "", "", "$fechaactual", 4, 0);
}else {
   $FB->llena_texto("Fecha de inicio:", 33, 10, $DB, "", "", "$fechainicial", 17, 0);
   $FB->llena_texto("Fecha de Final:", 34, 10, $DB, "", "", "$fechaactual", 4, 0);
	
}

	

$FB->llena_texto("Busqueda por:",31,82,$DB,$busqueda,"",$param31,1,0);
$FB->llena_texto("Dato:", 32, 1, $DB, "", "","$param32", 4,0);
$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",4,0);
echo "<tr>";
echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='enviarids(\"$id_p\",\"Enviar Whatsapp Servicios\")' ><i class='fas fa-envelope'></i>Mensaje a clientes</button></td><tr>";

echo "</table><table>";
$FB->div_valores("destino_vesr",6); 




include("footer.php");
?>
<script>
	 let idsSeleccionados = [];
	function enviarids(id_param,tabla) {
	let arrayParam = encodeURIComponent(JSON.stringify(idsSeleccionados));
	$("#myModal").modal("show");
	var destino=`detalle_pop.php?ide=${arrayParam}&id_param=${encodeURIComponent(id_param)}&tabla=${encodeURIComponent(tabla)}`;
	MostrarConsulta(destino, "llena_sub1");
	}

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
	function sendWhatsapp(fileNames) {
		const loadingElement = document.getElementById('loading');
		// Mostrar el GIF de carga
		loadingElement.style.display = 'block';
		const mensaje = document.getElementById('chekWhatsapp').value;
    // Recorre cada elemento en fileNames y ejecuta una función para cada uno
    fileNames.forEach(function (service) {
        // Cada `service` contiene [idservicios, ser_telefonocontacto, ser_consecutivo, cli_telefono]
        const [id, contacto, consecutivo, telefono] = service;
        
        // Llama a una función o envía un mensaje por cada servicio
        // console.log(`Procesando servicio ID: ${id}, Contacto: ${contacto}, Consecutivo: ${consecutivo}, Teléfono: ${telefono}, Mensaje: ${mensaje}`);
        
		 enviarAlertaWhat(consecutivo,contacto,mensaje,id);
		 enviarAlertaWhat(consecutivo,telefono,mensaje,id);
        // Aquí puedes ejecutar la función deseada para cada servicio
        // Por ejemplo, podrías enviar un mensaje por WhatsApp usando una API o una integración adicional
    });
	alert('Todos las alertas han sido enviadas');
    // Ocultar el GIF de carga
    loadingElement.style.display = 'none';
}

async function enviarAlertaWhat(numguia, telefono, tipo, idservi) {
    // URL de la API
    const url = "https://www.transmillas.com/ChatbotTransmillas/alertas.php";

    // Datos a enviar en la solicitud
    const data = {
        numero_guia: numguia, // Número de guía
        telefono: telefono,    // Número de teléfono
        tipo_alerta: tipo,     // Tipo de alerta
        id_guia: idservi       // ID de la guía
    };

    try {
        // Realizar la solicitud POST con fetch
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer MiSuperToken123" // Si la API requiere autenticación
            },
            body: JSON.stringify(data) // Convertir los datos a JSON
        });

        // Verificar si la respuesta fue exitosa
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }

        // Decodificar la respuesta
        const responseData = await response.json();
        
        // Mostrar la respuesta
        console.log("Respuesta de la API:", responseData);
		    // Muestra solo el mensaje de éxito (o el campo específico que necesites)
			// if (responseData.message) {
			// 	alert(responseData.message); // Muestra solo el mensaje
			// } else {
			// 	alert("Operación realizada con éxito");
			// }
    } catch (error) {
        // Manejar errores
        console.error("Error en la solicitud:", error);
    }
}



</script>