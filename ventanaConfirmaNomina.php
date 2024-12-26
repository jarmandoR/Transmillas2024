<?php


$link=$_GET['link'];
?>
<script>

function confirmaAdmin(){

    alert("deseas confirmar este documento?");



}

</script>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Barra Superior y iframe</title>
    <link rel="stylesheet" href="styles.css">
    <style>
            body, html {
                margin: 0;
                padding: 0;
                height: 100%;
                font-family: Arial, sans-serif;
            }

            header {
                background-color: #333;
                color: white;
                padding: 10px 20px;
                position: fixed;
                top: 0;
                width: 100%;
            }

            button {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                border-radius: 4px;
            }

            main {
                margin-top: 50px; /* Ajusta el margen superior para dejar espacio para la barra fija */
                height: calc(100% - 50px); /* Calcula la altura del main para que ocupe el resto de la página */
                overflow: hidden;
            }

            iframe {
                width: 100%;
                height: 100%;
                border: none; /* Quita el borde del iframe */
            }
    </style> 
</head>
<body>
    <header>
        <button onclick="confirmaAdmin()">Confirmar</button>
    </header>
    <main>
        <iframe src="<?echo$link;?>" frameborder="0"></iframe>
    </main>
</body>
</html>

