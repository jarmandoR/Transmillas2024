<?php
require("login_autentica.php");
include("cabezote3.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Barra Superior y PDF en Iframe</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Evita el desbordamiento horizontal y vertical */
        }

        #barra-superior {
            background-color: #333;
            color: white;
            padding: 10px;
        }

        #iframe-container {
            position: absolute;
            top: 50px; /* Altura de la barra superior */
            left: 0;
            right: 0;
            bottom: 0;
            overflow: auto; /* Hace que el contenedor tenga una barra de desplazamiento si el contenido es demasiado grande */
        }

        #pdf-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<?php 
$pdf=$_GET["pdf"];
$firma=$_GET["dato"];
?>

<body>
    <!-- Barra superior con botón "Firmar" -->
    <div id="barra-superior">
        <button onclick="firmar('<?php echo$pdf;?>','<?php echo$firma;?>')">Firmar</button>
    </div>

    <!-- Contenedor para el iframe -->
    <div id="iframe-container">
        <!-- Iframe para mostrar el PDF -->
        <iframe id="pdf-iframe" src="img_manifiestos/manifiestos/<?echo$_GET["pdf"];?>"></iframe>
    </div>

    <!-- Función JavaScript para firmar -->
    <script>
        function firmar(valor1,valor2) {
            // Aquí puedes llamar a tu función JavaScript para firmar
            // alert("Firmar");
            
            datos = {"pdf":valor1,"firma":valor2};
			$.ajax({
					url: "firmarManifiesto.php",
					type: "POST",
					data: datos
				}).done(function(respuesta){
					
					
						alert("Firmado");
                        // location.reload();
				});
        }
    </script>
</body>
</html>