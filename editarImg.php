<?php
require("login_autentica.php");
include("cabezote3.php"); 
$ruta_imagen = $_GET['img'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotar Imagen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background-color: black;
            color: white;
        }
        /* .contenedor {
            width: 100%;
            text-align: center;
        } */
        .contenedor img {
            display: block;
            margin: auto;
            max-width: 80%;
            height: 90%;
        }
        .contenedor {
            position: relative;
            display: inline-block;
            overflow: hidden;
            width: 100%; /* Ajusta este valor al tamaño inicial de tu imagen */
            text-align: center;
        }

        #imagen {
            max-width: 100%;
            transition: transform 0.25s ease; /* Para una transición suave al hacer zoom */
        }

        .boton-zoom {
            margin-top: 10px;
        }


        .boton-rotar {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .boton-rotar:hover {
            background-color: darkblue;
        }
        .boton-confirmar {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .boton-confirmar:hover {
            background-color: darkgreen;
        }
        .fa-icon {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <input type="hidden" value="<?php echo $_GET['guia']; ?>" id="guia">
    <input type="hidden" value="<?php echo $_GET['idser']; ?>" id="idser">
    <input type="hidden" value="<?php echo $ruta_imagen; ?>" id="url">
    <button class="boton-zoom" onclick="zoomIn()">+</button>
    <button class="boton-zoom" onclick="zoomOut()">-</button>
    <div class="contenedor">
        <img id="imagen" src="<?php echo $ruta_imagen; ?>" alt="Imagen a rotar">
        <br>
        <button class="boton-rotar" onclick="rotar('izquierda', '<?php echo $ruta_imagen; ?>')">
            <i class="fa fa-rotate-left fa-icon"></i> Rotar a la izquierda
        </button>
        <button class="boton-rotar" onclick="rotar('derecha', '<?php echo $ruta_imagen; ?>')">
            <i class="fa fa-rotate-right fa-icon"></i> Rotar a la derecha
        </button>
        <button class="boton-confirmar" onclick="mostrarConfirmacion()">
            <i class="fa fa-check fa-icon"></i> Confirmar la guía <?php echo $_GET['guia']; ?>
        </button>

    </div>
    <script>
        var guia = document.getElementById('guia').value
        var idser = document.getElementById('idser').value
        var urll = document.getElementById('url').value


        alert('Recuerde verificar que la imagen coresponda a la guia'+guia);
        function rotar(direccion,url) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'rotar_imagen.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Recargar la imagen para ver los cambios
                    document.getElementById('imagen').src = ''+url+'?timestamp=' + new Date().getTime();
                }
            };
            xhr.send('direccion=' + encodeURIComponent(direccion) + '&url=' + encodeURIComponent(url));
            // xhr.send('direccion=' + direccion);
        }


        function mostrarConfirmacion() {
            let resultado = confirm("¿Deseas continuar?");
            if (resultado) {
                // Código a ejecutar si el usuario hace clic en "Aceptar"
                // alert("Has aceptado.");
                confirmar();
            } else {
                // Código a ejecutar si el usuario hace clic en "Cancelar"
                alert("Has cancelado.");
            }
        }
        function confirmar(){
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'confirma_imgias.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Recargar la imagen para ver los cambios
                    // document.getElementById('imagen').src = ''+url+'?timestamp=' + new Date().getTime();
                }
            };

            let texto = urll;
            console.log(texto);
            let tipo;

            if (texto.includes('Recogida')) {
                tipo ='Recogida' ; 
            } else if(texto.includes('Entrega')) {
                tipo ='Entrega' ; 
            }else{
                tipo ='' ; 
                
            }
            xhr.send('idser=' + encodeURIComponent(idser)+ '&tipo=' + encodeURIComponent(tipo));
            





        }

        let scale = 1;
        const img = document.getElementById("imagen");

        function zoomIn() {
            scale += 0.1;
            img.style.transform = `scale(${scale})`;
        }

        function zoomOut() {
            if (scale > 0.1) { // Para evitar que la imagen desaparezca
                scale -= 0.1;
                img.style.transform = `scale(${scale})`;
            }
        }

        // También puedes permitir zoom con la rueda del ratón
        img.addEventListener("wheel", function(e) {
            e.preventDefault();
            if (e.deltaY < 0) {
                // Zoom in
                zoomIn();
            } else {
                // Zoom out
                zoomOut();
            }
        });

        
    </script>
</body>
</html>