<?php
require("login_autentica.php");
include("cabezote3.php"); 

$descargar=$_GET['variable'];

$tablaPago = $_GET['tablaPago'];

$param34 = $_GET['param34'];

$param35 = $_GET['param35'];

$param36 = $_GET['param36'];

$param37 = $_GET['param37'];
?>
<style>
    /* Estilos básicos para la barra superior */
    .topbar {
        background-color: #333;
        color: #fff;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Estilos para el menú desplegable */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }


    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    /* Estilos para la tabla */
    .tabla {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd; /* Borde delgado de un solo color */
    }

    .tabla th,
    .tabla td {
        padding: 12px 15px;
        text-align: center;
        border: 1px solid #ddd; /* Borde delgado de un solo color */
        text-align: center;
    }


    .tabla th {
        background-color: #367fa9;
        color: #fff;
        font-weight: bold;
    }

    .tabla tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tabla tbody tr:hover {
        background-color: #ddd;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function descargar(tablaPago,p6){

var variable = "descargar"; // Variable que deseas enviar

// Codificar la variable
var variableCodificada = encodeURIComponent(variable);

// Abrir el enlace en una nueva página
window.open("excelPagoPrimas.php?variable="+variableCodificada+"&param36="+p6+"&tablaPago="+tablaPago);


    

}
</script>

<div class="topbar">


    <button onclick="descargar('<?echo$tablaPago;?>','<?echo$param36;?>')">Descargar</button>
</div>
<?php 
error_reporting(0);







$año=date('Y');

$NombreExcel = "Pago de Primas ".$param36." del  Año ".$año."";

if ($descargar=="descargar") {
    header('Content-type:application/xls');
// header('Content-Disposition: attachment; filename='.$nombre.'.xls');
header('Content-Disposition: attachment; filename='.$NombreExcel.'.xls');
}



$asc="ASC";



echo'<table  class="tabla">';
echo'<tr bgcolor="#074F91" style="color:#FFFFFF;">';
echo'<th>Tipo de identificacion</th>';
echo'<th>Numero de identificacion</th>';
echo'<th>Nombre </th>';
// echo'<th>No Cuenta</th>';
echo'<th>Apellido</th>';
echo'<th>Codigo del Banco</th>';
echo'<th>Tipo de producto o servicio</th>';
// echo'<th>Aux. Transporte</th>';
echo'<th>Numero del Producto o Servicio</th>';
echo'<th>Valor del Pago o de la Recarga</th>';

echo'</tr>';


echo$tablaPago;



      ?>

</table>