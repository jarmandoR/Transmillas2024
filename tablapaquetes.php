<?php 

 

require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/arrays.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
include("cabezote1.php"); 
include("cabezote4.php"); 

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;

https://www.transmillas.com/#

echo"<div >";
echo"<table style='margin: auto;'>";

$FB->titulo_azul1("Nombre",1,0,0); 
$FB->titulo_azul1("Precio",1,0,0); 

  $sql="SELECT  `paq_nombre`, `paq_precio`FROM `paquetes`  ORDER BY  paq_precio asc ";

       $DB->Execute($sql); 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$color="#FFFFFF";
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "
		<td>".$rw1[0]."</td>
		<td>".$rw1[1]."</td>";
		echo "</tr>";
	}
echo"</table>";
echo"</div >";
